<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\User;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class GameService
{
    private GameRepository $gameRepository;
    private FormFactoryInterface $formFactory;
    private EntityManagerInterface $em;
    private TurnService $turnService;

    public function __construct(GameRepository $gameRepository, FormFactoryInterface $formFactory, EntityManagerInterface $em, TurnService $turnService)
    {
        $this->gameRepository = $gameRepository;
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->turnService = $turnService;
    }

    public function getPaginatedGameList(int $limit, int $page, string $userId = null): array
    {
        $criteria = [];

        if(!empty($userId)) {
            $criteria['user'] = $userId;
        }

        $games = $this->gameRepository->findBy($criteria, [], $limit, $page * $limit);
        return [$games, null];        
    }

    public function createGame(User $user): array
    {
        if($user->getWallet() < 10) {
            return [null, new \Error('Not enough money to create a game', 400)];
        }

        $game = $this->generateNewGame($user);
        $this->gameRepository->save($game, true);

        return [$game, null];
    }

    public function generateNewGame(User $user): Game
    {
        $game = new Game();
        $game->setUser($user);
        $game->setStatus('created');
        $game->setDateCreation(new \DateTime());
        $game->setLastUpdateDate(new \DateTime());

        return $game;
    }

    public function initializeGame(Game $game): array
    {
        list($turn, $err) = $this->turnService->createNewTurn($game);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $game->setStatus('playing');
        $game->setLastUpdateDate(new \DateTime());   
        $game->addTurn($turn);
        $this->gameRepository->save($game);

        return [$game, null];
    }

    public function getGame(string $id, User $user): array
    {
        $game = $this->gameRepository->find($id);
        if($game === null) {
            return [null, new \Error('Game not found', 404)];
        }

        if($game->getUser()->getId() !== $user->getId() && in_array('ROLE_ADMIN', $user->getRoles()) === false) {
            return [null, new \Error('You are not allowed to access this game', 403)];
        }

        return [$game, null];
    }

    public function deleteGame(string $id, User $user): array
    {
        list($game, $err) = $this->getGame($id, $user);
        if($err instanceof \Error) {
            return [null, $err];
        }

        $this->em->remove($game);

        return [null, null];
    }

}