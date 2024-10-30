<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeadCodeController extends AbstractController
{
    #[Route('/exercices/deadcode/1', name: 'exercise_deadcode_1', methods: ['POST'])]
    public function getFactoriel(Request $request): Response
    {

        // On récupère les données envoyées par l'utilisateur
        /**
         * @param array $data
         */
        $data = json_decode($request->getContent(), true);
        $message = '';

        // Si l'utilisateur n'a pas envoyé de données, on retourne une erreur
        if(isset($data['number'])){
            $number = $data['number'];

            // Si la valeur recue n'est pas un nombre, on retourne une erreur
            if(ctype_digit($number) === false){
                $message = 'La valeur doit être un nombre';
                return new Response('Invalid data', 400);
            }

            // Si la valeur recue est un nombre négatif, on retourne une erreur
            if($number > 0){
                // On calcule le factoriel
                /*
                // ETO 20/01/2022 : on faisait une boucle for avant, mais on a appris a faire de la recursive depuis 
                $factoriel = 1;
                for($i = 1; $i <= $number; $i++){
                    $factoriel *= $i;
                }
                return new Response($factoriel, 200);
                */

                // ETO 20/01/2022 : on fait de la recursive pour calculer le factoriel
                /**
                 * @param int $number
                 */
                $factoriel = $this->getFactorielRecursive($number);
                return new Response($factoriel, 200);
            }elseif($number === 0){
                $message = 'Le résultat est 1';
                return new Response(1, 200);
            }else{
                $message = 'Le nombre doit être positif';
                return new Response('Invalid data', 400);
            }
        }else{
            $message = 'Il faut envoyer des données';
            return new Response('Invalid data', 400);
        }

        return $this->render('dead_code/index.html.twig', [
            'controller_name' => 'DeadCodeController',
            'data' => $data,
            'message' => $message
        ]);
    }

    // ETO 20/01/2022 : on fait de la recursive pour calculer le factoriel
    private function getFactorielRecursive(int $number): int
    {
        if($number === 1){
            return 1;
        }else{
            return $number * $this->getFactorielRecursive($number - 1);
        }
    }
}
