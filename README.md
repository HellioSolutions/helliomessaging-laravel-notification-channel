# Hellio Messaging Laravel Notification Channel

[![Latest Stable Version](https://poser.pugx.org/helliomessaging/helliomessaging-laravel-notification-channel/v/stable)](https://packagist.org/packages/helliomessaging/helliomessaging-laravel-notification-channel)
[![Total Downloads](https://poser.pugx.org/helliomessaging/helliomessaging-laravel-notification-channel/downloads)](https://packagist.org/packages/helliomessaging/helliomessaging-laravel-notification-channel)
[![License](https://poser.pugx.org/helliomessaging/helliomessaging-laravel-notification-channel/license)](https://packagist.org/packages/helliomessaging/helliomessaging-laravel-notification-channel)

This package makes it easy to send notifications using [Hellio Messaging](https://helliomessaging.com/)

## Content

- [Installation](#installation)
	- [Setting up the Hellio Messaging Service](#setting-up-the-hellio-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

To get the latest version of Hellio Messaging Notification channel is intended for Laravel 5.5 and up, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require helliomessaging/helliomessaging-laravel-notification-channel
```

If you use Laravel 5.5+ you don't need the following step.
If not, once package is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `NotificationChannels\Hellio\HellioServiceProvider::class`


### Setting up the Hellio Messaging Service

First, you must have an account with Hellio. Once you've registered for an account, login into your account and click on the [Profile & API Integration](https://app.helliomessaging.com/settings) menu on your Hellio Messaging dashboard. Click on the API Keys & Webhooks tab and copy your `Client ID` and `Application Secret`

In your terminal run
```bash
$ php artisan vendor:publish --provider="NotificationChannels\Hellio\HellioServiceProvider"
```
This creates a `hellio.php` file in your `config` directory.

Paste your api keys in the `config/hellio.php` configuration file. You may copy the example configuration below to get started:
```php
<?php

return [
    'config' => [
        'client_id' => env('HELLIO_CLIENT_ID'),
        'app_secret' => env('HELLIO_APP_SECRET')
    ],

];
```

Or 

Add the `HELLIO_CLIENT_ID` and `HELLIO_APP_SECRET` to your `.env` file

## Usage

Now you can use the channel in your `via()` method in any notification you want to send using Hellio Messaging:
``` php
use Illuminate\Notifications\Notification;
use NotificationChannels\Hellio\HellioChannel;
use NotificationChannels\Hellio\HellioMessage;

class WelcomeSMS extends Notification
{
    public function via($notifiable)
    {
        return [HellioChannel::class];
    }

    public function toHellioSMS($notifiable)
    {
        return (new HellioMessage)
			->from("HellioSMS")
			->to("233242813656") //Add the country code to the number you wish to send to without the need to add the  +
           	 	->content("Welcome to Hellio Messaging, a new world of litmitless possibilities.")
           	 	->messageType(0); //0 = text, 1 = flash
    }
}
```

In order to let your Notification know which phone number you are sending to, add the `routeNotificationForHellioSMS` method to your Notifiable model e.g your User Model

```php
public function routeNotificationForHellioSMS()
{
    return $this->phone; // where phone is a column in your users table;
}
```

### Available Message methods

* `from($from)` : set the sender's id
* `senderID($id)`: an alias for `from($from)`
* `to($to)` : set the recipient's phone number
* `msisdn($msisdn)`: an alias for `to($to)`
* `messageType($messageType)`: an alias for `type($type)`
* `content($content)` : set the message content
* `message($message)`: an alias for `content($content)`

Read more about the available methods on the [Hellio Messaging Documentation Portal](https://helliomessaging.com/docs/messaging/api)

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email support@helliomessaging.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Norris Oduro Tei](https://github.com/Norris1z)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
