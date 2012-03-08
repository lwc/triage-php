<?php
require_once "ZeroMQMessagePackClient.php";

class TriageClient
{
	private $_client;

	public function __construct($mode, $args)
	{
		if ($mode == 'zeromq')
		{
			$this->_client = ZeroMQMessagePackClient::construct($args);
		}
		elseif ($mode == 'msgpackrpc')
		{
			$this->_client = MessagePackRPCClient::construct($args);
		}
	}

	public function logError($error)
	{
		$this->_client->logError($error);
		return $this;
	}

	public function logMessage($level, $message)
	{
		$this->_client->logMessage($level, $message);
		return $this;
	}
}
