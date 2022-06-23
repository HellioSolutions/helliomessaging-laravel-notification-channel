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

    /**
     * Set if message type is Text or Flash. [You can set 0 = Text and 1 = Flash]. By default, it's set to 0 which is Text.
     * @var string
     */
    public $messageType;


    public function __construct($senderId = null, $msisdn = null, $message = null, $messageType = 0)
    {
        $this->senderId = $senderId;
        $this->msisdn = $msisdn;
        $this->message = $message;
        $this->messageType = $messageType;
    }

    /**
     * Set the message sender's id.
     * @param $senderID
     * @return $this
     */
    public function senderID($senderID): HellioMessage
    {
        return $this->from($senderID);
    }

    /**
     * Set the message sender's id.
     * @param $senderID
     * @return $this
     */
    public function from($senderID): HellioMessage
    {
        $this->senderId = $senderID;

        return $this;
    }

    /**
     * Set the recipient's phone number.
     * @param $msisdn
     * @return $this
     */
    public function msisdn($msisdn): HellioMessage
    {
        return $this->to($msisdn);
    }

    /**
     * Set the recipient's phone number.
     * @param $msisdn
     * @return $this
     */
    public function to($msisdn): HellioMessage
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * Set the message content.
     * @param $message
     * @return $this
     */
    public function message($message): HellioMessage
    {
        return $this->content($message);
    }

    /**
     * Set the message content.
     * @param $message
     * @return $this
     */
    public function content($message): HellioMessage
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the message type.
     * @param $messageType
     * @return $this
     */
    public function type($messageType): HellioMessage
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Set the message type.
     * @param $messageType
     * @return $this
     */
    public function messageType($messageType): HellioMessage
    {
        return $this->content($messageType);
    }
}
