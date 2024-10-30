<?php

namespace Tests\Exercice2;

final class Exercice2Test extends \PHPUnit\Framework\TestCase
{
    public function test_propertiesExist()
    {
        $product = new \App\Product();
        $this->assertObjectHasProperty('name', $product);
        $this->assertObjectHasProperty('price', $product);
        $this->assertObjectHasProperty('dateOfRelease', $product);
    }
}