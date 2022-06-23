<?php

namespace NotificationChannels\Hellio\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function clientIDNotSet(): InvalidConfiguration
    {
        return new static('Hellio client_id not set');
    }

    public static function appSecretNotSet(): InvalidConfiguration
    {
        return new static ('Hellio app_secret not set');
    }

    public static function missingConfig(): InvalidConfiguration
    {
        return new static("Missing config file");
    }
}
