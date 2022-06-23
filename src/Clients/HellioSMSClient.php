<?php

namespace NotificationChannels\Hellio\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use NotificationChannels\Hellio\Exceptions\InvalidConfiguration;
use NotificationChannels\Hellio\HellioMessage;
use Psr\Http\Message\ResponseInterface;

class HellioSMSClient
{
    public $client;

    public $clientID;

    public $appSecret;

    /**
     * HellioSMSClient constructor.
     * @param $clientID
     * @param $appSecret
     * @param Client $client
     */
    public function __construct($clientID, $appSecret, Client $client)
    {
        $this->clientID = $clientID;
        $this->appSecret = $appSecret;
        $this->client = $client;
    }

    /**
     * @param HellioMessage $message
     * @return ResponseInterface
     * @throws InvalidConfiguration
     * @throws GuzzleException
     */
    public function send(HellioMessage $message)
    {
        return $this->client->get($this->getApiURL() . $this->buildMessage($message, $this->clientID, $this->appSecret));
    }

    /**
     * @return string
     */
    public function getApiURL(): string
    {
        return 'https://helliomessaging.com/api/v2/sms?';
    }

    /**
     * @param HellioMessage $message
     * @param $clientID
     * @param $appSecret
     * @return string
     * @throws InvalidConfiguration
     */
    public function buildMessage(HellioMessage $message, $clientID, $appSecret): string
    {
        $this->validateConfig($clientID, $appSecret);

        $params = ['clientId' => $clientID, 'authKey' => sha1($clientID . $appSecret . date('YmdH'))];

        foreach (get_object_vars($message) as $property => $value) {
            if (!is_null($value)) {
                $params[$property] = $value;
            }
        }

        return http_build_query($params);
    }

    /**
     * @param $clientID
     * @param $appSecret
     * @return $this
     * @throws InvalidConfiguration
     */
    public function validateConfig($clientID, $appSecret): HellioSMSClient
    {
        if (is_null($clientID)) {
            throw InvalidConfiguration::clientIDNotSet();
        }

        if (is_null($appSecret)) {
            throw InvalidConfiguration::appSecretNotSet();
        }

        return $this;
    }
}
