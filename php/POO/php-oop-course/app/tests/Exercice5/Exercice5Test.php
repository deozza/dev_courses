<?php

namespace Tests\Exercice5;

final class Exercice5Test extends \PHPUnit\Framework\TestCase
{
    public function test_gettersExist()
    {
        $product = new \App\Product();
        $now = new \DateTime('now');

        $this->assertEquals(9.99, $product->getPrice());
        $this->assertEquals('New product', $product->getName());
        $this->assertEquals($now->format('Y-m-d'), $product->getDateOfRelease()->format('Y-m-d'));
    }

    public function test_settersExistAndHaveSideEffects()
    {
        $product = new \App\Product();
        $now = new \DateTime('now');

        $this->assertEquals(9.99, $product->getPrice());
        $product->setPrice(19.99);
        $this->assertEquals(19.99, $product->getPrice());

        $this->assertEquals('New product', $product->getName());
        $product->setName('Product');
        $this->assertEquals('Product', $product->getName());

        $this->assertEquals($now->format('Y-m-d'), $product->getDateOfRelease()->format('Y-m-d'));
        $product->setDateOfRelease(new \DateTime('2020-01-01'));
        $this->assertEquals('2020-01-01', $product->getDateOfRelease()->format('Y-m-d'));
    }
}