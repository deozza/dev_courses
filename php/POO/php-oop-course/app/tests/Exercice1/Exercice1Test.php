<?php

namespace Tests\Exercice1;

final class Exercice1Test extends \PHPUnit\Framework\TestCase
{
    public function test_fileExists()
    {
        $filename = __DIR__ . '/../../src/Product.php';
        $this->assertFileExists($filename);
    }

    public function test_classExists()
    {
        $this->assertTrue(class_exists('App\Product'));
    }

    public function test_objectInstance()
    {
        $product = new \App\Product();
        $this->assertInstanceOf(\App\Product::class, $product);
    }
}