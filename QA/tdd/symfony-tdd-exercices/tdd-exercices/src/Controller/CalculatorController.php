<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Calculator\CalculatorService;

class CalculatorController extends AbstractController
{
    #[Route('/calculate', name: 'calculate', methods:['GET'])]
    public function calculate(Request $request): JsonResponse
    {
        $calculatorService = new CalculatorService();
        $requestParams = $request->query->all();

        $errors = $calculatorService->getErrorsFromRequestParams($requestParams);
        if(count($errors) > 0)
        {
            return $this->json(
                ['errors' => $errors],
                headers: ['Content-Type' => 'application/json'],
                status: 400
            );
        }

        $operation = $requestParams['operation'];

        if(!$calculatorService->checkOperationExists($operation))
        {
            return $this->json(
                ['errors' => ['The operation is invalid']],
                headers: ['Content-Type' => 'application/json'],
                status: 400
            );
        }

        $leftOperand = $requestParams['leftOperand'];
        $rightOperand = $requestParams['rightOperand'];

        if(!$calculatorService->checkOperatorsAreNumeric($leftOperand, $rightOperand))
        {
            return $this->json(
                ['errors' => ['The operands must be numeric']],
                headers: ['Content-Type' => 'application/json'],
                status: 400
            );
        }

        $result = $calculatorService->calculate($operation, $leftOperand, $rightOperand);

        return $this->json(
            ['result' => $result],
            headers: ['Content-Type' => 'application/json']
        );
    }
}
