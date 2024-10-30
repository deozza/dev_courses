<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrameworkController extends AbstractController
{
    #[Route('/exercices/framework/1', name: 'exerices_framework_1')]
    public function welcomeUser(Request $request, EntityManagerInterface $em): JsonResponse
    {

        if($request->getMethod() === 'POST'){
            $data = json_decode($request->getContent(), true);

            $form = $this->createFormBuilder()
                ->add('login', TextType::class)
                ->add('password', TextType::class)
                ->getForm();

            $form->submit($data);

            if($form->isValid()){
                
                $foo = $form->getData();
                if(strlen($foo['login']) === 0){
                    $response = new Response();
                    $response->setStatusCode(400);
                    $response->setContent(json_encode([
                        'error' => 'Login is empty'
                    ]));

                    return $response;
                }

                if(strlen($foo['password']) === 0){
                    $response = new Response();
                    $response->setStatusCode(400);
                    $response->setContent(json_encode([
                        'error' => 'Password is empty'
                    ]));

                    return $response;
                }

                if(strlen($foo['login']) > 50){
                    $response = new Response();
                    $response->setStatusCode(400);
                    $response->setContent(json_encode([
                        'error' => 'Login is too long'
                    ]));

                    return $response;
                }

                $user = $em->getRepository(User::class)->findOneBy([
                    'login' => $foo['login'],
                    'password' => $foo['password']
                ]);

                if(empty($user) === false){
                    $response = new Response();
                    $response->setStatusCode(200);
                    $response->setContent(json_encode([
                        'token' => 'yoursecrettoken'
                    ]));

                    return $response;
                }else{
                    $response = new Response();
                    $response->setStatusCode(400);
                    $response->setContent(json_encode([
                        'error' => 'Invalid credentials'
                    ]));

                    return $response;
                }
            }else{
                $response = new Response();
                $response->setStatusCode(400);
                $response->setContent(json_encode([
                    'error' => 'Invalid form'
                ]));

                return $response;
            }    
        }else{

            $response = new Response();
            $response->setStatusCode(405);
            $response->setContent(json_encode([
                'error' => 'Method not allowed'
            ]));

            return $response;
        }
    }

    #[Route('/exercices/framework/2', name: 'exerices_framework_2', methods: ['GET'])]
    public function getCarWithFilters(Request $request, CarRepository $carRepository): JsonResponse
    {
        $filters = $request->query->all('filters');
        
        $carsQuery = $carRepository->createQueryBuilder('c');
        foreach($filters as $filterName => $filterValue){
            $carsQuery->andWhere('c.'.$filterName.' = :'.$filterName)
            ->setParameter($filterName, $filterValue);
        }

        $cars = $carsQuery->getQuery()->getResult();

        return new JsonResponse($cars);
    }
}
