<?php

namespace Tests\Exercice9;
use PHPUnit\Framework\Attributes\DataProvider;

final class Exercice9Test extends \PHPUnit\Framework\TestCase
{
    
    #[DataProvider('dataprovider_squareCommand')]
    public function test_squareCommand(string $length, string $expectedOuput): void
    {
        $output = shell_exec("echo $length | php src/SquareCommand.php");
        $this->assertStringContainsString($expectedOuput, $output);
    }


    public static function dataprovider_squareCommand(): array 
    {
        return [
            ['6', 'Area of square is 36'],
            ['5', 'Area of square is 25'],
            ['4', 'Area of square is 16'],
            ['3', 'Area of square is 9'],
            ['2', 'Area of square is 4'],
        ];
    }

}