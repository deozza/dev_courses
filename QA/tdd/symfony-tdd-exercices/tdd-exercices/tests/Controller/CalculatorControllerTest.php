<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function test_calculate_responseInJson(): void
    {
        $client = static::createClient();
        $client->request('GET', '/calculate');
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
    }

    /**
     * @dataProvider dataprovider_calculate_methodIsValid
     */
    public function test_calculate_methodIsValid(string $method): void
    {
        $client = static::createClient();
        $client->request($method, '/calculate');
        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    private static function dataprovider_calculate_methodIsValid(): array
    {
        return [
            ['POST'],
            ['PUT'],
            ['DELETE'],
            ['PATCH']
        ];
    }
}