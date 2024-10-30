<?php

namespace Tests\Exercice6;

final class Exercice6Test extends \PHPUnit\Framework\TestCase
{
    public function test_name_firstLetterIsCapitallized()
    {
        $product = new \App\Product();

        $this->assertEquals('New product', $product->getName());
        $product->setName('product');
        $this->assertEquals('Product', $product->getName());
    }
}