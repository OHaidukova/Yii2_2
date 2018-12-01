<?php

namespace console\components;


use common\models\Chat;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class WsServer implements MessageComponentInterface
{
    protected $clients = [];


    function onOpen(ConnectionInterface $conn) {
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode("=", $queryString)[1];
        echo $channel;
        $this->clients['channel'][$conn->resourceId] = $conn;

        echo "New connection: {$conn->resourceId}\n";
    }

    function onMessage(ConnectionInterface $from, $data) {
        $data = json_decode($data, true);
        $channel = $data['channel'];
        try {
            (new Chat($data))->save();
        } catch(\Exception $e) {
            var_dump($e->getMessage());
        }


        foreach ($this->clients['channel'] as $client) {
            $client->send($data['message']);
        }
    }

    function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconnect!";
    }

    function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
        echo "\nconn {$conn->resourceId} closed with error\n";
    }
}