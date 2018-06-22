<?php
namespace GSoares\RatchetChat;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
	    $this->clients = [];
 	    $this->way_clients = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
		$query = $conn->WebSocket->request->getQuery()->toArray();
		print_r($query['way']);

		$this->clients[$conn->resourceId] = $conn;
		$this->way_clients[$conn->resourceId] = $query['way'];

		echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
		$way_from = $this->way_clients[$from->resourceId];


		foreach ($this->clients as $client) {
			$way_client = $this->way_clients[$client->resourceId];

			if ($from !== $client && $way_from===$way_client ) {
				// The sender is not the receiver, send to each client connected
				$client->send($msg);
			}
		}
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
	   unset($this->clients[$conn->resourceId]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
