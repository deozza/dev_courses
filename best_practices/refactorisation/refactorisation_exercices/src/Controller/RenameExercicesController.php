<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RenameExercicesController extends AbstractController
{
    #[Route('/exercices/rename/1', name: 'exercices_rename_1', methods: ['POST'])]
    public function checkIfAuthorized(Request $request): JsonResponse
    {
        $variables = json_decode($request->getContent(), 1);

        if($variables['a'] > 20){
            return new JsonResponse(['result' => 1], 200);
        }

        return new JsonResponse(['result' => -1], 403);
    }
}
