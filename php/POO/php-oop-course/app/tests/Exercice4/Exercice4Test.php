<?php

namespace Tests\Exercice4;

final class Exercice4Test extends \PHPUnit\Framework\TestCase
{
    public function test_propertiesAreTyped()
    {
        $product = new \App\Product();

        $this->assertIsFloat($product->price);
        $this->assertIsString($product->name);
        $this->assertInstanceOf(\DateTime::class, $product->dateOfRelease);
    }
}