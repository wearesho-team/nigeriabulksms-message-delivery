<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms\Tests;

use Wearesho\Delivery\NigeriaBulkSms;
use PHPUnit\Framework\TestCase;
use Wearesho\Delivery;
use GuzzleHttp;

class ServiceTest extends TestCase
{
    public function sendDataProvider(): array
    {
        return [
            [200, '<html lang="ua">not JSON response</html>', "Unable to parse JSON response: Syntax error", -1],
            [200, '{"msg": "Invalid JSON keys"}', 'Unable to process response.', -2],
            [200, '{"error":"Login denied.","errno":"103"}', "Login denied.", 103],
            [200, '{"status":"OK","count":1,"price":2}',],
        ];
    }

    /**
     * @dataProvider sendDataProvider
     */
    public function testSend(
        int $responseCode,
        string $responseBody,
        ?string $exceptionMessage = null,
        ?int $exceptionCode = null
    ) {
        $guzzle = $this->getMockForAbstractClass(GuzzleHttp\ClientInterface::class);
        $method = $guzzle->expects($this->exactly(1))->method('request');
        $method->willReturnCallback(
            function (string $method, string $url, array $config) use ($responseCode, $responseBody) {
                $this->assertEquals('GET', $method);
                $this->assertEquals(NigeriaBulkSms\ConfigInterface::GATEWAY_BASEURL, $url);
                $this->assertEquals([GuzzleHttp\RequestOptions::QUERY => [
                    'username' => 'username',
                    'password' => 'password',
                    'message' => 'text',
                    'sender' => 'senderName',
                    'mobiles' => '2348030000000',
                ]], $config);
                return new GuzzleHttp\Psr7\Response($responseCode, [
                    'Content-Type' => 'application/json'
                ], $responseBody);
            }
        );

        $config = new NigeriaBulkSms\Config("username", "password", "senderName");
        $client = new NigeriaBulkSms\Service($guzzle, $config);

        if (!empty($exceptionMessage) && !empty($exceptionCode)) {
            $exceptionClass = ($exceptionCode <= 0) ? Delivery\Exception::class : NigeriaBulkSms\Exception::class;
            $this->expectException($exceptionClass);
            $this->expectExceptionMessage($exceptionMessage);
            $this->expectExceptionCode($exceptionCode);
        }

        $client->send(new Delivery\Message("text", "2348030000000"));
    }
}
