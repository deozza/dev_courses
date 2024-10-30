<?php

namespace App\Service\Calculator;

class DivOperationService extends AbstractOperationService
{
    public function __construct($leftOperand, $rightOperand)
    {
        parent::__construct($leftOperand, $rightOperand);
    }
    
    public function getValue(): float
    {
        if($this->rightOperand == 0)
        {
            throw new \InvalidArgumentException('The right operand cannot be 0');
        }
        
        return $this->leftOperand / $this->rightOperand;
    }
}
