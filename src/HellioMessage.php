<?php

namespace NotificationChannels\Hellio;

class HellioMessage
{
    /**
     * Sender's id.
     */
    public ?string $senderId;

    /**
     * Recipient phone number.
     */
    public ?string $msisdn;

    /**
     * Message.
     */
    public ?string $message;

    /**
     * Set if message type is Text or Flash. [You can set 0 = Text and 1 = Flash]. By default, it's set to 0 which is Text.
     */
    public ?int $messageType;


    public function __construct(?string $senderId = null, ?string $msisdn = null, ?string $message = null, ?int $messageType = 0)
    {
        $this->senderId = $senderId;
        $this->msisdn = $msisdn;
        $this->message = $message;
        $this->messageType = $messageType;
    }

    /**
     * Set the message sender's id.
     */
    public function senderID(string $senderID): self
    {
        return $this->from($senderID);
    }

    /**
     * Set the message sender's id.
     */
    public function from(string $senderID): self
    {
        $this->senderId = $senderID;

        return $this;
    }

    /**
     * Set the recipient's phone number.
     */
    public function msisdn(string $msisdn): self
    {
        return $this->to($msisdn);
    }

    /**
     * Set the recipient's phone number.
     */
    public function to(string $msisdn): self
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * Set the message content.
     */
    public function message(string $message): self
    {
        return $this->content($message);
    }

    /**
     * Set the message content.
     */
    public function content(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the message type.
     */
    public function type(int $messageType): self
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Set the message type.
     */
    public function messageType(int $messageType): self
    {
        return $this->type($messageType);
    }
}
