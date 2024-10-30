<?php

namespace App\Controller;

use App\Service\GameService;
use App\Service\TurnService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TurnController extends AbstractController
{

    private TurnService $turnService;
    private GameService $gameService;

    public function __construct(TurnService $turnService, GameService $gameService)
    {
        $this->turnService = $turnService;
        $this->gameService = $gameService;
    }

    #[Route('/game/{id}/turn', name: 'create_turn', methods: ['POST'])]
    public function createTurn(string $id): Response
    {
        list($game, $err) = $this->gameService->getGame($id, $this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        list($turn, $err) = $this->turnService->createNewTurn($game);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($turn, 201, [], ['groups' => 'turn']);    
    }

    #[Route('/turn/{id}', name: 'get_turn', methods: ['GET'])]
    public function getTurn(string $id): Response
    {
        list($turn, $err) = $this->turnService->getTurn($id, $this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($turn, 200, [], ['groups' => 'turn']);    
    }

    #[Route('/turn/{id}/wage', name: 'wage_turn', methods: ['PATCH'])]
    public function wageTurn(string $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        list($turn, $err) = $this->turnService->wageTurn($id, $this->getUser(), $data);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        list($turn, $err) = $this->turnService->initializeTurn($turn);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($turn, 200, [], ['groups' => 'turn']);    
    }

    #[Route('/turn/{id}/hit', name: 'hit_turn', methods: ['PATCH'])]
    public function hitTurn(string $id): Response
    {
        list($turn, $err) = $this->turnService->hitTurn($id, $this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        if($turn->getStatus() === 'busted') {
            list($turn, $err) = $this->turnService->distributeGains($turn);
            if($err instanceof \Error) {
                return $this->json($err->getMessage(), $err->getCode());
            }    
        }

        return $this->json($turn, 200, [], ['groups' => 'turn']);    
    }

    #[Route('/turn/{id}/stand', name: 'stand_turn', methods: ['PATCH'])]
    public function standTurn(string $id): Response
    {
        list($turn, $err) = $this->turnService->standTurn($id, $this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        list($turn, $err) = $this->turnService->dealerAutoDraw($turn);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        list($turn, $err) = $this->turnService->distributeGains($turn);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($turn, 200, [], ['groups' => 'turn']);    
    }


}
