<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserByToken(string $token){

        $explodedToken = explode('_', $token);

        if(count($explodedToken) === 2){
            $userId = $explodedToken[1];
            $user = $this->userRepository->getUserById($userId);

            return $user;
        }else{
            return null;
        }
    }
}