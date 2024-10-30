<?php

namespace App\Service;

use App\Entity\Card;
use App\Entity\Game;
use App\Entity\Hand;
use App\Entity\Turn;
use App\Entity\User;
use App\Form\Turn\WageTurnFormType;
use App\Repository\TurnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class TurnService
{

    private TurnRepository $turnRepository;
    private FormFactoryInterface $formFactory;
    private EntityManagerInterface $em;
    private HandService $handService;

    public function __construct(TurnRepository $turnRepository, FormFactoryInterface $formFactory, EntityManagerInterface $em, HandService $handService)
    {
        $this->turnRepository = $turnRepository;
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->handService = $handService;
    }

    public function createNewTurn(Game $game): array
    {
        list($_, $err) = $this->checkIsAbleToCreateNewTurn($game);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $turn = $this->generateTurn($game);
        $cards = self::shuffleDeck(self::generateDeck());
        $turn->setDeck($deck);
        $turn->setStatus('waging');

        $this->turnRepository->save($turn, true);

        return [$turn, null];
    }

    public function checkIsAbleToCreateNewTurn(Game $game): array
    {
        if(!in_array($game->getStatus(), ['playing', 'created'])) {
            return [null, new \Error('The game has not started', 409)];
        }

        if($game->getTurns()->count() === 0) {
            return [$game, null];
        }

        $lastTurn = $game->getTurns()->last();
        if(!in_array($lastTurn->getStatus(), ['draw', 'won', 'lost'])) {
            return [null, new \Error('A turn is already playing', 409)];
        }

        return [$game, null];
    }

    public function generateTurn(Game $game): Turn
    {
        $turn = new Turn();
        $turn->setGame($game);
        $turn->setCreationDate(new \DateTime());
        $turn->setLastUpdateDate(new \DateTime());

        return $turn;
    }

    public static function generateDeck(): array
    {
        $suits = ['heart', 'diamond', 'club', 'spade'];
        $values = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

        $deck = [];
        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = new Card($suit, $value);
            }
        }

        return $deck;
    }

    public static function shuffleDeck(array $deck): array
    {
        shuffle($deck);

        return $deck;
    }

    public function getTurn(string $id, User $user): array
    {
        $turn = $this->turnRepository->findOneBy(['id' => $id]);
        if($turn === null) {
            return [null, new \Error('Turn not found', 404)];
        }

        if($turn->getGame()->getUser()->getId() !== $user->getId()) {
            return [null, new \Error('You are not allowed to see this turn', 403)];
        }

        return [$turn, null];
    }

    public function wageTurn(string $id, User $user, array $data): array
    {
        list($turn, $err) = $this->getTurn($id, $user);
        if($err instanceof \Error) {
            return [null, $err];
        }

        if($turn->getStatus() !== 'waging') {
            return [null, new \Error('You can not wage this turn', 409)];
        }

        list($turn, $errors) = $this->checkPayloadIsValidForWageTurn($data, $turn);
        if(!empty($errors)) {
            $err = new \Error(json_encode($errors), 400);
            return [null, $err];
        }

        $user->setWallet($user->getWallet() - $turn->getWager());
        $user->setLastUpdateDate(new \DateTime());
        $this->em->getRepository(User::class)->save($user);

        $turn->setLastUpdateDate(new \DateTime());
        $turn->setStatus('initializing');
        $this->em->getRepository(Turn::class)->save($turn);

        return [$turn, null];
    }

    public function checkPayloadIsValidForWageTurn(array $data, Turn $turn): array
    {
        $form = $this->formFactory->create(WageTurnFormType::class, $turn);
        $form->submit($data);
        $errors = [];

        if(!$form->isValid()) {
            $errors = FormService::getFormErrors($form);
            return [null, $errors];
        }

        if($turn->getWager() > $turn->getGame()->getUser()->getWallet()) {
            $errors = ['wager' => 'You do not have enough money'];
            return [null, $errors];
        }

        return [$turn, null];
    }

    public function initializeTurn(Turn $turn): array
    {
        $turn->setPlayerHand(new Hand());
        list($card, $err) = $this->drawTopCard($turn);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $turn->getPlayerHand()->addCard($card);


        list($card, $err) = $this->drawTopCard($turn);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $turn->getPlayerHand()->addCard($card);
        
        list($hand, $err) = $this->handService->calculateScore($turn->getPlayerHand());
        if($err instanceof \Error) {
            return [null, $err];
        }
        
        $turn->setPlayerHand($hand);
        
        $turn->setDealerHand(new Hand());
        list($card, $err) = $this->drawTopCard($turn);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $turn->getDealerHand()->addCard($card);

        list($hand, $err) = $this->handService->calculateScore($turn->getDealerHand());
        if($err instanceof \Error) {
            return [null, $err];
        }
        
        $turn->setDealerHand($hand);

        $turn->setLastUpdateDate(new \DateTime());
        $turn->setStatus('playing');
        $this->turnRepository->save($turn);

        return [$turn, null];
    }

    public function drawTopCard(Turn $turn): array
    {
        if(!in_array($turn->getStatus(), ['playing'])) {
            return [null, new \Error('You can not draw a card', 409)];
        }

        if(count($turn->getDeck()) === 0) {
            $deck = self::shuffleDeck(self::generateDeck());
            $turn->setDeck($deck);
        }

        $deck = $turn->getDeck();
        $card = array_shift($deck);
        $turn->setDeck($deck);

        return [$card, null];
    }

    public function hitTurn(string $id, User $user): array
    {
        list($turn, $err) = $this->getTurn($id, $user);
        if($err instanceof \Error) {
            return [null, $err];
        }

        list($card, $err) = $this->drawTopCard($turn);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $turn->getPlayerHand()->addCard($card);
        
        list($hand, $err) = $this->handService->calculateScore($turn->getPlayerHand());
        if($err instanceof \Error) {
            return [null, $err];
        }
        
        $turn->setPlayerHand($hand);

        if($turn->getPlayerHand()->getIsBusted()) {
            $turn->setStatus('busted');
        }

        $turn->setLastUpdateDate(new \DateTime());
        $this->turnRepository->save($turn);
        return [$turn, null];
    }

    public function standTurn(string $id, User $user): array
    {
        list($turn, $err) = $this->getTurn($id, $user);
        if($err instanceof \Error) {
            return [null, $err];
        }

        if($turn->getStatus() !== 'playing') {
            return [null, new \Error('You can not stand', 409)];
        }

        $turn->setStatus('dealer');
        $this->turnRepository->save($turn);

        return [$turn, null];
    }

    public function dealerAutoDraw(Turn $turn): array
    {
        if($turn->getStatus() !== 'dealer') {
            return [null, new \Error('You can not draw a card', 409)];
        }

        while($turn->getDealerHand()->getScore() < 17) {
            list($card, $err) = $this->drawTopCard($turn);
            if($err instanceof \Error) {
                return [null, $err];
            }

            $turn->getDealerHand()->addCard($card);

            list($hand, $err) = $this->handService->calculateScore($turn->getDealerHand());
            if($err instanceof \Error) {
                return [null, $err];
            }
            
            $turn->setDealerHand($hand);
        }

        $turn->setStatus('distributeGains');
        $this->turnRepository->save($turn, true);

        return [$turn, null];
    }

    public function distributeGains(Turn $turn): array
    {
        if($turn->getStatus() !== 'distributeGains') {
            return [null, new \Error('You can not distribute gains', 409)];
        }

        $turn->setLastUpdateDate(new \DateTime());

        if($turn->getPlayerHand()->getIsBusted()) {
            $turn->setStatus('lost');
            $this->em->getRepository(Turn::class)->save($turn);
            return [$turn, null];
        }

        $gains = $turn->getWager();

        if($turn->getPlayerHand()->getIsBlackjack()) {
            $gains = $gains * 2;
        }

        if($turn->getDealerHand()->getIsBusted() === true) {
 
            $turn->getGame()->getUser()->addToWallet($gains + $turn->getWager());
            $turn->setStatus('won');
            $this->em->getRepository(Turn::class)->save($turn);
            $this->em->getRepository(User::class)->save($turn->getGame()->getUser());

            return [$turn, null];
        }

        if($turn->getDealerHand()->getScore() > $turn->getPlayerHand()->getScore()) {
            $turn->setStatus('lost');
            $this->em->getRepository(Turn::class)->save($turn);
            return [$turn, null];
        }

        if($turn->getDealerHand()->getIsBlackjack() && $turn->getPlayerHand()->getIsBlackjack()) {
            $turn->setStatus('draw');
            $turn->getGame()->getUser()->addToWallet($turn->getWager());
            $this->em->getRepository(Turn::class)->save($turn);
            $this->em->getRepository(User::class)->save($turn->getGame()->getUser());
            return [$turn, null];
        }

        if($turn->getDealerHand()->getScore() === $turn->getPlayerHand()->getScore()) {
            $turn->getGame()->getUser()->addToWallet($turn->getWager());
            $turn->setStatus('draw');
            $this->em->getRepository(Turn::class)->save($turn);
            $this->em->getRepository(User::class)->save($turn->getGame()->getUser());
            return [$turn, null];
        }


        $turn->getGame()->getUser()->addToWallet($gains + $turn->getWager());
        $turn->setStatus('won');
        $this->em->getRepository(Turn::class)->save($turn);
        $this->em->getRepository(User::class)->save($turn->getGame()->getUser());
            
        return [$turn, null];
    }

}