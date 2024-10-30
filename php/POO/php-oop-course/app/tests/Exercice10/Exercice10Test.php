<?php

namespace Tests\Exercice10;

final class Exercice10Test extends \PHPUnit\Framework\TestCase
{
    public function test_fileExists()
    {
        $filename = __DIR__ . '/../../src/Rectangle.php';
        $this->assertFileExists($filename);
    }

    public function test_classExists()
    {
        $this->assertTrue(class_exists('App\Rectangle'));
    }

    public function test_objectInstance()
    {
        $rectangle = new \App\Rectangle();
        $this->assertInstanceOf(\App\Rectangle::class, $rectangle);
    }

    public function test_getLength()
    {
        $rectangle = new \App\Rectangle();
        $rectangle->length = 5;
        $this->assertEquals(5, $rectangle->getLength());
    }

    public function test_setLength()
    {
        $rectangle = new \App\Rectangle();
        $rectangle->length = 5;
        $this->assertEquals(5, $rectangle->length);

        $rectangle->setLength(50);
        $this->assertEquals(50, $rectangle->length);
    }

    public function test_getWidth()
    {
        $rectangle = new \App\Rectangle();
        $rectangle->width = 5;
        $this->assertEquals(5, $rectangle->getWidth());
    }

    public function test_setWidth()
    {
        $rectangle = new \App\Rectangle();
        $rectangle->width = 5;
        $this->assertEquals(5, $rectangle->width);

        $rectangle->setWidth(50);
        $this->assertEquals(50, $rectangle->width);
    }

    public function test_getArea()
    {
        $rectangle = new \App\Rectangle();
        $rectangle->length = 5;
        $rectangle->width = 10;
        $this->assertEquals(50, $rectangle->getArea());
    }
}