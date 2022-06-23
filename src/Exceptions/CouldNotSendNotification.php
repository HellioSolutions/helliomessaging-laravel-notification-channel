<?php

namespace NotificationChannels\Hellio\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function senderIDNotSetError(): CouldNotSendNotification
    {
        return new static('Sender id not set');
    }

    public static function msisdnNotSetError(): CouldNotSendNotification
    {
        return new static('Recipient mobile number not set');
    }

    public static function messageNotSetError(): CouldNotSendNotification
    {
        return new static('Message content empty');
    }

    public static function messageTypeNotSetError(): CouldNotSendNotification
    {
        return new static('Message type not set');
    }

}
