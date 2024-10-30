<?php

namespace App\Service\Calculator;

class CalculatorService
{
    const OPERATIONS = [
        'add',
        'subtract',
        'multiply',
        'divide'
    ];

    public function getErrorsFromRequestParams(array $requestParams): array
    {
        $errors = [];

        if(!isset($requestParams['operation']))
        {
            $errors[] = 'The operation is missing';
        }
        
        if(!isset($requestParams['leftOperand']))
        {
            $errors[] = 'The left operand is missing';
        }

        if(!isset($requestParams['rightOperand']))
        {
            $errors[] = 'The right operand is missing';
        }

        return $errors;
    }

    public function checkOperationExists(string $operation): string
    {
        return in_array($operation, self::OPERATIONS);
    }

    public function checkOperatorsAreNumeric($leftOperand, $rightOperand): bool
    {
        return is_numeric($leftOperand) && is_numeric($rightOperand);
    }

    public function calculate(string $operation, $leftOperand, $rightOperand): float
    {
        switch($operation){
            case 'add':
                $operationService = new AddOperationService($leftOperand, $rightOperand);
                break;
            case 'subtract':
                $operationService = new SubOperationService($leftOperand, $rightOperand);
                break;
            case 'multiply':
                $operationService = new MultOperationService($leftOperand, $rightOperand);
                break;
            case 'divide':
                $operationService = new DivOperationService($leftOperand, $rightOperand);
                break;
        }
        return $operationService->getValue();
    }
}