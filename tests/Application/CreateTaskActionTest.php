<?php

declare(strict_types=1);

namespace App\Tests\Application;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskActionTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $client = static::createClient();

        $client->xmlHttpRequest(
            method: 'POST',
            uri: '/tasks',
            content: json_encode([
                'name' => 'test task',
                'description' => 'my first test task',
                'expiryDate' => '2021-12-24 18:00',
            ]),
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function testFailed(): void
    {
        $client = static::createClient();

        $client->xmlHttpRequest(
            method: 'POST',
            uri: '/tasks',
            content: json_encode([
                'name' => '',
                'description' => '',
                'expiryDate' => '',
            ]),
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }
}
