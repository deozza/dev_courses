<?php

namespace App\Service;

use App\Entity\User;
use App\Form\User\CreateUserType;
use App\Form\User\UpdateUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UserService
{

    private UserRepository $userRepository;
    private FormFactoryInterface $formFactory;
    private PasswordHasherFactoryInterface $passwordHasherFactory;
    private EntityManagerInterface $em;

    public function __construct(UserRepository $userRepository, FormFactoryInterface $formFactory, PasswordHasherFactoryInterface $passwordHasherFactory, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->passwordHasherFactory = $passwordHasherFactory;
        $this->em = $em;
    }

    public function getPaginatedUserList(int $limit, int $page): array
    {
        $users = $this->userRepository->findBy([], [], $limit, $page * $limit);
        return [$users, null];        
    }

    public function createUser(array $data): array
    {
        list($user, $errors) = $this->checkPayloadIsValidForCreateUser($data);
        if(!empty($errors)) {
            $err = new \Error(json_encode($errors), 400);
            return [null, $err];
        }

        list($user, $errors) = $this->checkUserAlreadyExist($user);
        if(!empty($errors)) {
            $err = new \Error(json_encode($errors), 400);
            return [null, $err];
        }

        $user = $this->createUserAcccordingToPayload($data);

        $this->userRepository->save($user, true);
        return [$user, null];
    }

    public function checkPayloadIsValidForCreateUser(array $data): array
    {
        $user = new User();
        $form = $this->formFactory->create(CreateUserType::class, $user);
        $form->submit($data);
        $errors = [];

        if(!$form->isValid()) {
            $errors = FormService::getFormErrors($form);
            return [null, $errors];
        }

        return [$user, null];
    }

    public function checkUserAlreadyExist(User $user): array
    {
        $errors = [];

        $existingEmail = $this->userRepository->findOneBy(['email' => $user->getEmail()]);
        if(!empty($existingEmail) && $existingEmail->getId() !== $user->getId()) {
            $errors['email'][] = 'Email already exist';
        }

        $existingUsername = $this->userRepository->findOneBy(['username' => $user->getUsername()]);
        if(!empty($existingUsername) && $existingUsername->getId() !== $user->getId()) {
            $errors['username'][] = 'Username already exist';
        }

        return [$user, $errors];
    }

    public function createUserAcccordingToPayload(array $data): User
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $hashedPassword = $this->passwordHasherFactory->getPasswordHasher(User::class)->hash('$data["password"]');

        $user->setPassword($hashedPassword);
        $user->setCreationDate(new \DateTime());
        $user->setLastUpdateDate(new \DateTime());
        $user->setWallet(1000);
        
        return $user;
    }

    public function getUser(string $id): array
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);
        if($user === null) {
            $err = new \Error('User not found', 404);
            return [null, $err];
        }

        return [$user, null];
    }

    public function updateUser(string $id, array $data): array
    {
        list($user, $err) = $this->getUser($id);
        if($err !== null) {
            return [null, $err];
        }

        list($user, $errors) = $this->checkPayloadIsValidForUpdateUser($user, $data);
        if(!empty($errors)) {
            $err = new \Error(json_encode($errors), 400);
            return [null, $err];
        }

        list($user, $errors) = $this->checkUserAlreadyExist($user);
        if(!empty($errors)) {
            $err = new \Error(json_encode($errors), 400);
            return [null, $err];
        }

        $this->userRepository->save($user);
        return [$user, null];
    }

    public function checkPayloadIsValidForUpdateUser(User $user, array $data): array
    {
        $form = $this->formFactory->create(UpdateUserType::class, $user);
        $form->submit($data, false);
        $errors = [];

        if(!$form->isValid()) {
            $errors = FormService::getFormErrors($form);
            return [null, $errors];
        }

        return [$user, null];
    }

    public function deleteUser(string $id): array
    {
        list($user, $err) = $this->getUser($id);
        if($user === null) {
            return [null, $err];
        }

        $this->em->remove($user);
        $this->em->flush();
        return [null, null];
    }
}