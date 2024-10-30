<?php

namespace App\Service\Calculator;

abstract class AbstractOperationService
{
    protected $leftOperand;
    protected $rightOperand;
    
    public function __construct($leftOperand, $rightOperand)
    {
        $this->leftOperand = $leftOperand;
        $this->rightOperand = $rightOperand;
    }

    abstract protected function getValue(): float;
}