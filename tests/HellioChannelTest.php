<?php


namespace NotificationChannels\Hellio\Tests;

use NotificationChannels\Hellio\HellioChannel;
use NotificationChannels\Hellio\HellioServiceProvider;
use Orchestra\Testbench\TestCase;

class HellioChannelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [HellioServiceProvider::class];
    }

    /** @test */
    public function it_can_create_a_hellio_channel_with_the_given_config()
    {
        $this->app['config']->set('hellio.config.client_id', 'somekey');
        $this->app['config']->set('hellio.config.app_secret', 'somekey');

        $channel = $this->app->get(HellioChannel::class);
        $this->assertInstanceOf(HellioChannel::class, $channel);
    }
}