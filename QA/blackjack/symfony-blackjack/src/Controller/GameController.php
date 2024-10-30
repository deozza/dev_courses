<?php

namespace App\Controller;

use App\Service\GameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    private GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    #[Route('/game', name: 'get_list_of_games', methods: ['GET'])]
    public function getListOfGames(Request $request): Response
    {
        $userId = null;
        if(in_array('ROLE_ADMIN', $this->getUser()->getRoles()) === false){
            $userId = $this->getUser()->getId();
        }

        $limit = $request->query->get('limit', 12);
        $page = $request->query->get('page', 0);

        list($games, $err) = $this->gameService->getPaginatedGameList($limit, $page, $userId);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($games, 200, [], ['groups' => 'game']);
    }

    #[Route('/game', name: 'create_game', methods: ['POST'])]
    public function createGame(): Response
    {
        list($game, $err) = $this->gameService->createGame($this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        list($game, $err) = $this->gameService->initializeGame($game);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($game, 201, [], ['groups' => 'game']);
    }

    #[Route('/game/{id}', name: 'get_game', methods: ['GET'])]
    public function getGame(string $id): Response
    {
        list($game, $err) = $this->gameService->getGame($id, $this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($game, 200, [], ['groups' => 'game']);
    }

    #[Route('/game/{id}', name: 'delete_game', methods: ['DELETE'])]
    public function deleteGame(string $id): Response
    {
        list($_, $err) = $this->gameService->deleteGame($id, $this->getUser());
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json(null, 204);
    }
}
