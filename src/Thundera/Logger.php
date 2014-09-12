<?php

namespace Thundera;

use Gelf\Logger as GelfLogger;
use Gelf\Transport\UdpTransport;
use Gelf\Publisher;
use Gelf\Message;

class Logger extends GelfLogger{

    protected $_publisher;

    public function __construct()
    {
        $transport = new UdpTransport("127.0.0.1", 12202, UdpTransport::CHUNK_SIZE_LAN);

        $this->_publisher = new Publisher();
        $this->_publisher->addTransport($transport);

        parent::__construct($this->_publisher);
    }


    public static function send()
    {
        $message = new Message();
        $message->setShortMessage("Foobar!")
            ->setLevel(\Psr\Log\LogLevel::ALERT)
            ->setFullMessage("There was a foo in bar")
            ->setFacility("example-facility");
        self::$_publisher->publish($message);
    }

}