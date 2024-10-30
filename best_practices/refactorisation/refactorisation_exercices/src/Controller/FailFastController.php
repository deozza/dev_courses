<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\UserService;

class FailFastController extends AbstractController
{
    #[Route('/exercices/failfast/1', name: 'exercices_failfast_1', methods: ['GET'])]
    public function getProfile(Request $request, UserService $userService): Response
    {
        $token = $request->headers->get('Authorization');

        if($token !== null){
            if(strpos($token, 'superxtrasecrettoken') !== false){
                $user = $userService->getUserByToken($token);
                if($user !== null){
                    return new Response('Hello '.$user, 200);
                }else{
                    return new Response('Unauthorized', 401);
                }
            }else{
                return new Response('Unauthorized', 401);
            }
        }else{
            return new Response('Unauthorized', 401);
        }
    }

    #[Route('/exercices/failfast/2/{brand}/{model}', name: 'exercices_failfast_2', methods: ['PATCH'])]
    public function updateCar(Request $request, EntityManagerInterface $em, string $brand, string $model): Response
    {   
        $token = $request->headers->get('Authorization');

        if($token !== null){
            if($token === 'iamthecaptainnow'){

                $car = $em->getRepository(Car::class)->findOneBy([
                    'brand' => $brand,
                    'model' => $model
                ]);
        
                if($car !== null){
                    $data = json_decode($request->getContent(), true);
                    $form = $this->createForm(UpdateCarType::class, $car);
        
                    $form->submit($data);
        
                    if($form->isValid()){

                        if($car->getGeabox() === 'manual'){
                            if($car->getEngine() === 'electric'){
                                return new Response('Invalid data', 400);
                            }elseif($car->getEngine() === 'hybrid'){
                                return new Response('Invalid data', 400);
                            }
                        }

                        $em->flush();
        
                        return new Response('Car updated', 200);
                    }else{
                        return new Response('Invalid data', 400);
                    }
                }else{
                    return new Response('Car not found', 404);
                }
            }else{
                return new Response('Forbidden', 403);
            }
        }else{
            return new Response('Unauthorized', 401);
        }
    }
}
