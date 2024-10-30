<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/user', name: 'get_list_of_users', methods: ['GET'])]
    public function getListOfUsers(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $limit = $request->query->get('limit', 12);
        $page = $request->query->get('page', 0);

        list($users, $err) = $this->userService->getPaginatedUserList($limit, $page);
        if($err instanceof \Error) {
            return $this->json($err->getMessage(), $err->getCode());
        }

        return $this->json($users, 200, [], ['groups' => 'user']);
    }

    #[Route('/user', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        list($user, $err) = $this->userService->createUser($data);
        if($err instanceof \Error) {
            return $this->json(json_decode($err->getMessage(), true), $err->getCode());
        }

        return $this->json($user, 201, [], ['groups' => 'user']);
    }

    #[Route('/user/profile', name: 'get_current_user', methods: ['GET'])]
    public function geCurrenttUser(): Response
    {
        list($user, $err) = $this->userService->getUser($this->getUser()->getId());
        if($err instanceof \Error) {
            return $this->json('User not found', 404);
        }

        return $this->json($user, 200, [], ['groups' => 'user']);
    }

    #[Route('/user/profile', name: 'update_current_user', methods: ['PATCH'])]
    public function updateCurrentUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        list($user, $err) = $this->userService->updateUser($this->getUser()->getId(), $data);
        if($err instanceof \Error) {
            return $this->json(json_decode($err->getMessage(), true), $err->getCode());
        }

        return $this->json($user, 200, [], ['groups' => 'user']);
    }

    #[Route('/user/profile', name: 'delete_current_user', methods: ['DELETE'])]
    public function deleteCurrentUser(): Response
    {
        list($_, $err) = $this->userService->deleteUser($this->getUser()->getId());
        if($err instanceof \Error) {
            return $this->json(json_decode($err->getMessage(), true), $err->getCode());
        }

        return $this->json([], 204);
    }

    #[Route('/user/{id}', name: 'get_user_by_uuid', methods: ['GET'])]
    public function getUserByUuid(string $id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        list($user, $err) = $this->userService->getUser($id);
        if($err instanceof \Error) {
            return $this->json(json_decode($err->getMessage(), true), $err->getCode());
        }

        return $this->json($user, 200, [], ['groups' => 'user']);
    }

    #[Route('/user/{id}', name: 'update_user_by_uuid', methods: ['PATCH'])]
    public function updateUserByUuid(string $id, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $data = json_decode($request->getContent(), true);

        list($user, $err) = $this->userService->updateUser($id, $data);
        if($err instanceof \Error) {
            return $this->json(json_decode($err->getMessage(), true), $err->getCode());
        }

        return $this->json($user, 200, [], ['groups' => 'user']);
    }

    #[Route('/user/{id}', name: 'delete_user_by_uuid', methods: ['DELETE'])]
    public function deleteUserByUuid(string $id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        list($_, $err) = $this->userService->deleteUser($id);
        if($err instanceof \Error) {
            return $this->json(json_decode($err->getMessage(), true), $err->getCode());
        }

        return $this->json([], 204);
    }
}
