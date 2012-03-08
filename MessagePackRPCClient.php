<?php

include_once 'Net/MessagePackRPC.php';

/**
 * Client for MessagePack RPC error logging server
 */
class MessagePackRPCClient
{
	private $_client;

	public static function construct($args)
	{
		return new self($args['host'], $args['port']);
	}

	public function __construct($host, $port)
	{
		$this->_client = new MessagePackRPC_Client($host, $port);
	}

	public function logError($error)
	{
		$this->_client->call('error', array($error));
	}

	public function logMessage($level, $message)
	{
		$this->_client->call('message', array($level, $message));
	}
}