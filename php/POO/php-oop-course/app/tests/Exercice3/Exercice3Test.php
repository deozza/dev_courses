<?php

namespace Tests\Exercice4;

final class Exercice3Test extends \PHPUnit\Framework\TestCase
{
    public function test_propertiesHaveDefaultValues()
    {
        $product = new \App\Product();
        $now = new \DateTime('now');

        $this->assertEquals(9.99, $product->price);
        $this->assertEquals('New product', $product->name);
        $this->assertEquals($now->format('Y-m-d'), $product->dateOfRelease->format('Y-m-d'));
    }
}