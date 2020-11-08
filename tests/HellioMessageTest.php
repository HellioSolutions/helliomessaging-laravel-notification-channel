<?php

namespace NotificationChannels\Hellio\Tests;

use NotificationChannels\Hellio\HellioMessage;
use Orchestra\Testbench\TestCase;

class HellioMessageTest extends TestCase
{
    public $message;

    public function setUp(): void
    {
        parent::setUp();
        $this->message = new HellioMessage();
    }

    /** @test * */
    public function it_can_construct_the_message_with_the_basic_required_parameters()
    {
        $message = new HellioMessage('Norris', '1234567890', 'Hello There');
        $this->assertEquals('Norris', $message->senderId);
        $this->assertEquals('1234567890', $message->msisdn);
        $this->assertEquals('Hello There', $message->message);
    }

    /** @test * */
    public function it_can_set_the_message_sender_id_from_a_method()
    {
        $this->message->from('Norris');
        $this->assertEquals('Norris', $this->message->senderId);
    }

    /** @test * */
    public function the_sender_id_method_is_an_alias_for_the_from_method()
    {
        $this->message->senderID('Norris');
        $this->assertEquals('Norris', $this->message->senderId);
    }

    /** @test * */
    public function it_can_set_the_message_recipient_from_a_method()
    {
        $this->message->to('1234567890');
        $this->assertEquals('1234567890', $this->message->msisdn);
    }

    /** @test * */
    public function the_msisdn_method_is_an_alias_for_the_to_method()
    {
        $this->message->msisdn('1234567890');
        $this->assertEquals('1234567890', $this->message->msisdn);
    }

    /** @test * */
    public function it_can_set_the_message_content_from_a_method()
    {
        $this->message->content('Hello Baby Boakye');
        $this->assertEquals('Hello Baby Boakye', $this->message->message);
    }

    /** @test * */
    public function the_message_method_is_an_alias_for_the_content_method()
    {
        $this->message->content('Hello Baby Boakye');
        $this->assertEquals('Hello Baby Boakye', $this->message->message);
    }
}