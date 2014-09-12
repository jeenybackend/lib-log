<?php

use Gelf\Logger as GelfLogger;
use Gelf\Transport\UdpTransport;
use Gelf\Publisher;

class Logger extends GelfLogger{

    protected $_publisher;


    public function __construct()
    {
        $transport = new UdpTransport("127.0.0.1", 12202, UdpTransport::CHUNK_SIZE_LAN);

        $publisher = new Publisher();
        $publisher->addTransport($transport);

        parent::__construct($publisher);
    }

}