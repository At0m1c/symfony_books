<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class TestTransaction extends TestCase
{
    // успешный тест
    public function testSendSuccess()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET', 'http://web:80/transactions', [
                'query' => [
                    'email_from' => 'bettye16@p-response.com',
                    'email_to' => 'meagan08@gogreenon.com',
                    'amount' => 100,
                ]
            ]
        );

        $this->assertTrue(boolval($response->getContent()));
    }

    // с превышением суммы на счёте
    public function testSendError()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET', 'http://web:80/transactions', [
                'query' => [
                    'email_from' => 'bettye16@p-response.com',
                    'email_to' => 'meagan08@gogreenon.com',
                    'amount' => 100000,
                ]
            ]
        );

        $this->assertFalse(boolval($response->getContent()));
    }
}