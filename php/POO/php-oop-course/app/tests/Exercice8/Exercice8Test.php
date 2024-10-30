<?php

namespace Tests\Exercice8;

final class Exercice8Test extends \PHPUnit\Framework\TestCase
{
    public function test_fileExists()
    {
        $filename = __DIR__ . '/../../src/Square.php';
        $this->assertFileExists($filename);
    }

    public function test_classExists()
    {
        $this->assertTrue(class_exists('App\Square'));
    }

    public function test_objectInstance()
    {
        $square = new \App\Square();
        $this->assertInstanceOf(\App\Square::class, $square);
    }

    public function test_getLength()
    {
        $square = new \App\Square();
        $square->length = 5;
        $this->assertEquals(5, $square->getLength());
    }

    public function test_setLength()
    {
        $square = new \App\Square();
        $square->length = 5;
        $this->assertEquals(5, $square->length);

        $square->setLength(50);
        $this->assertEquals(50, $square->length);
    }

    public function test_getArea()
    {
        $square = new \App\Square();
        $square->length = 5;
        $this->assertEquals(25, $square->getArea());
    }
}