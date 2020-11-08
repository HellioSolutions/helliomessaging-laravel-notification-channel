<?php

namespace NotificationChannels\Hellio;

class HellioMessage
{
    /**
     * Sender's id.
     * @var string
     */
    public $senderId;

    /**
     * Recipient phone number.
     * @var string
     */
    public $msisdn;

    /**
     * Message.
     * @var string
     */
    public $message;

    public function __construct($senderId = null, $msisdn = null, $message = null)
    {
        $this->senderId = $senderId;
        $this->msisdn = $msisdn;
        $this->message = $message;
    }

    /**
     * Set the message sender's id.
     * @param $senderID
     * @return $this
     */
    public function from($senderID)
    {
        $this->senderId = $senderID;

        return $this;
    }

    /**
     * Set the message sender's id.
     * @param $senderID
     * @return $this
     */
    public function senderID($senderID)
    {
        return $this->from($senderID);
    }

    /**
     * Set the recipient's phone number.
     * @param $msisdn
     * @return $this
     */
    public function to($msisdn)
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * Set the recipient's phone number.
     * @param $msisdn
     * @return $this
     */
    public function msisdn($msisdn)
    {
        return $this->to($msisdn);
    }

    /**
     * Set the message content.
     * @param $message
     * @return $this
     */
    public function content($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the message content.
     * @param $message
     * @return $this
     */
    public function message($message)
    {
        return $this->content($message);
    }
}