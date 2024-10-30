<?php

namespace App\Controller;

use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypingController extends AbstractController
{
    #[Route('/exercices/typing/1', name: 'exercices_typing_1', methods: ['GET'])]
    public function getSum(): Response
    {
        $a = 1.6;
        $b = 2.2;

        $result = $this->sum($a, $b);

        return new Response('The result is 3.8 : ' . $result==3.8);
    }

    private function sum($a, $b): int
    {
        return $a + $b;
    }

    #[Route('/exercices/typing/2', name: 'exercices_typing_2', methods: ['POST'])]
    public function sellCar(CarService $carService): Response
    {
        $brand = 'Renault';
        $model = 'Clio';
        $isManual = true;
        $engine = 'petrol';
        $doorNulber = 5;
        $category = 'city';
        $dateOfBuild = new \DateTime('1992-01-01');
        $dateSold = new \DateTime();
        $price = 10000;
        $buyerName = 'John Doe';
        $buyerAddress = '1 rue de la Paix, 75000 Paris';
        $buyerPhone = '0600000000';
        $buyerEmail = 'johndoe@gmail.com';

        $message = $carService->sellCar($brand, $model, $isManual, $engine, $doorNulber, $category, $dateOfBuild, $dateSold, $price, $buyerName, $buyerAddress, $buyerPhone, $buyerEmail);

        return new JsonResponse($message, 201);
    }
}
