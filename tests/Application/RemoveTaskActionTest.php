<?php

declare(strict_types=1);

namespace App\Tests\Application;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CompleteTaskActionTest extends WebTestCase
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

        $url = $client->getResponse()->headers->get('Location');

        $client->xmlHttpRequest(
            method: 'DELETE',
            uri: $url,
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function testFailed(): void
    {
        $client = static::createClient();

        $client->xmlHttpRequest(
            method: 'DELETE',
            uri: '/tasks/0',
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }
}
