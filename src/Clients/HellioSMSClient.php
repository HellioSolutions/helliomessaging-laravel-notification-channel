<?php

namespace NotificationChannels\Hellio\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use NotificationChannels\Hellio\Exceptions\InvalidConfiguration;
use NotificationChannels\Hellio\HellioMessage;
use Psr\Http\Message\ResponseInterface;

class HellioSMSClient
{
    public Client $client;

    public string $clientID;

    public string $appSecret;

    /**
     * HellioSMSClient constructor.
     */
    public function __construct(string $clientID, string $appSecret, Client $client)
    {
        $this->clientID = $clientID;
        $this->appSecret = $appSecret;
        $this->client = $client;
    }

    /**
     * @throws InvalidConfiguration
     * @throws GuzzleException
     */
    public function send(HellioMessage $message): ResponseInterface
    {
        return $this->client->get($this->getApiURL() . $this->buildMessage($message, $this->clientID, $this->appSecret));
    }

    public function getApiURL(): string
    {
        return 'https://helliomessaging.com/api/v2/sms?';
    }

    /**
     * @throws InvalidConfiguration
     */
    public function buildMessage(HellioMessage $message, string $clientID, string $appSecret): string
    {
        $this->validateConfig($clientID, $appSecret);

        $params = [
            'clientId' => $clientID,
            'authKey' => sha1($clientID . $appSecret . date('YmdH')),
        ];

        foreach (get_object_vars($message) as $property => $value) {
            if (!is_null($value)) {
                $params[$property] = $value;
            }
        }

        return http_build_query($params);
    }

    /**
     * @throws InvalidConfiguration
     */
    public function validateConfig(string $clientID, string $appSecret): self
    {
        if (empty($clientID)) {
            throw InvalidConfiguration::clientIDNotSet();
        }

        if (empty($appSecret)) {
            throw InvalidConfiguration::appSecretNotSet();
        }

        return $this;
    }
}
