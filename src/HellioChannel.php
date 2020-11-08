<?php

namespace NotificationChannels\Hellio;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use NotificationChannels\Hellio\Clients\HellioSMSClient;
use NotificationChannels\Hellio\Exceptions\CouldNotSendNotification;
use Psr\Http\Message\ResponseInterface;

class HellioChannel
{
    /**
     * @var HellioSMSClient
     */
    public $client;

    public function __construct(HellioSMSClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @return ResponseInterface
     * @throws CouldNotSendNotification|Exceptions\InvalidConfiguration|GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toHellioSMS($notifiable);
        $route = $notifiable->routeNotificationFor('HellioSMS');

        if (is_null($message->senderId)) {
            throw CouldNotSendNotification::senderIDNotSetError();
        }

        if (is_null($message->msisdn) && is_null($route)) {
            throw CouldNotSendNotification::msisdnNotSetError();
        }

        if (is_null($message->message)) {
            throw CouldNotSendNotification::messageNotSetError();
        }

        if (is_null($message->msisdn) && !is_null($route)) {
            $message->msisdn = $route;
        }

        return $this->client->send($message);
    }
}