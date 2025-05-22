<?php

namespace NotificationChannels\Hellio;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\Hellio\Clients\HellioSMSClient;
use NotificationChannels\Hellio\Exceptions\InvalidConfiguration;

class HellioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/hellio.php' => config_path('hellio.php'),
        ]);

        $this->app->when(HellioChannel::class)
            ->needs(HellioSMSClient::class)
            ->give(function () {
                /** @var array{client_id: string, app_secret: string}|null */
                $config = config('hellio.config');

                if (is_null($config)) {
                    throw InvalidConfiguration::missingConfig();
                }

                return new HellioSMSClient(
                    $config['client_id'],
                    $config['app_secret'],
                    new Client
                );
            });
    }
}
