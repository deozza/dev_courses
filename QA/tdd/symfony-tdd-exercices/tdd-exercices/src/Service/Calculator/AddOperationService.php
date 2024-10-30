<?php

namespace App\Service\Calculator;

class AddOperationService extends AbstractOperationService
{
    public function __construct($leftOperand, $rightOperand)
    {
        parent::__construct($leftOperand, $rightOperand);
    }
    
    public function getValue(): float
    {
        return $this->leftOperand + $this->rightOperand;
    }
}
