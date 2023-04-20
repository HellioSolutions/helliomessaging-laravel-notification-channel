<?php

namespace NotificationChannels\Hellio\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function senderIDNotSetError(): CouldNotSendNotification
    {
        return new self('Sender id not set');
    }

    public static function msisdnNotSetError(): CouldNotSendNotification
    {
        return new self('Recipient mobile number not set');
    }

    public static function messageNotSetError(): CouldNotSendNotification
    {
        return new self('Message content empty');
    }

    public static function messageTypeNotSetError(): CouldNotSendNotification
    {
        return new self('Message type not set');
    }
}
