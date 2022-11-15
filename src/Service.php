<?php

declare(strict_types=1);

namespace Wearesho\Delivery\NigeriaBulkSms;

use GuzzleHttp;
use Wearesho\Delivery;

/**
 * TODO: add batch sending, balance method implementations
 */
class Service implements Delivery\ServiceInterface
{
    private ConfigInterface $config;
    private GuzzleHttp\ClientInterface $client;

    public function __construct(GuzzleHttp\ClientInterface $client, ConfigInterface $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @return static
     * @see https://github.com/wearesho-team/turbosms-message-delivery/blob/1.0.4/src/Service.php#L23
     */
    public static function instance(): self
    {
        static $instance;
        if (!$instance) {
            $instance = new self(new GuzzleHttp\Client, new EnvironmentConfig);
        }
        return $instance;
    }

    public function send(Delivery\MessageInterface $message): void
    {
        $this->request([
            // moved here for the sake of further implementation of additional API methods
            'sender' => $this->config->getSenderName(),
            // multiple recipients can be sent separated by commas
            'mobiles' => $message->getRecipient(),
            'message' => $message->getText(),
        ]);
    }

    /**
     * @throws Delivery\Exception
     */
    private function request(array $config): array
    {
        try {
            $response = $this->client->request(
                'GET',
                ConfigInterface::GATEWAY_BASEURL,
                [
                    GuzzleHttp\RequestOptions::QUERY => [
                            'username' => $this->config->getUsername(),
                            'password' => $this->config->getPassword(),
                        ] + $config,
                ]
            );
        } catch (GuzzleHttp\Exception\GuzzleException $exception) {
            throw new Delivery\Exception("Request failed: " . $exception->getMessage(), 0, $exception);
        }

        try {
            $body = json_decode((string)$response->getBody(), true, 32, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new Delivery\Exception(
                "Unable to parse JSON response: " .$exception->getMessage(),
                -1,
                $exception
            );
        }

        if (array_key_exists('status', $body) && strtoupper($body['status']) === 'OK') {
            return $body;
        }
        if (!empty($body['error']) && !empty($body['errno'])) {
            throw new Exception($body['error'], (int)$body['errno']);
        }
        throw new Delivery\Exception("Unable to process response.", -2);
    }
}
