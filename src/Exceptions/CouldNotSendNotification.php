<?php

namespace NotificationChannels\Hellio\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function senderIDNotSetError()
    {
        return new static('Sender id not set');
    }

    public static function msisdnNotSetError()
    {
        return new static('Recipient mobile number not set');
    }

    public static function messageNotSetError()
    {
        return new static('Message content empty');
    }
    
    public static function messageTypeNotSetError()
    {
        return new static('You must set message type to either 0 or 1');
    }
}
