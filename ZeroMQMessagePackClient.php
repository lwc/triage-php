<?php
/**
 * ZeroMQMessagePack Wrapper
 */
class ZeroMQMessagePackClient
{
	private $_socket;

	public static function construct($args)
	{
		return new self($args['uri']);
	}

	public function __construct($uri)
	{
		/* Create new queue object */
		$this->_socket = new ZMQSocket(
			new ZMQContext(),
			ZMQ::SOCKET_PUB,
			'socket1'
		);

		$this->_socket->connect($uri);
	}

	public function logError($error)
	{
		$this->_send(array(
				'error' => $error,
				'time' => time()
			));

		return $this;
	}

	public function logMessage($level, $message)
	{
		$this->_send(array(
				'message' => $message,
				'level' => $level,
				'time' => time()
			));

		return $this;
	}

	private function _send($error)
	{
		$this->_socket->send($this->_pack($error), ZMQ::MODE_NOBLOCK);
	}

	private function _pack($data)
	{
		$msgPack = new MessagePack();
		return $msgPack->pack($data);
	}
}
