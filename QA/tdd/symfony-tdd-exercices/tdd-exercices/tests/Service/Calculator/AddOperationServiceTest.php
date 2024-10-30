<?php

namespace App\Tests\Service\Calculator;

use App\Service\Calculator\AddOperationService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AddOperationServiceTest extends KernelTestCase
{
    public function test_getValue_checkResultWithPositive(): void
    {
        $addOperationService = new AddOperationService(1, 2);
        $this->assertEquals(3, $addOperationService->getValue());
    }

    public function test_getValue_checkResultWithNegative(): void
    {
        $addOperationService = new AddOperationService(-1, -2);
        $this->assertEquals(-3, $addOperationService->getValue());
    }

    public function test_getValue_checkResultWithPositiveAndNegative(): void
    {
        $addOperationService = new AddOperationService(1, -2);
        $this->assertEquals(-1, $addOperationService->getValue());
    }
}