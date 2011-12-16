<?php
/**
 * ZeroMQMessagePack Wrapper
 */
class ZeroMQMessagePackClient
{
	private $_socket;

	public static function construct($uri)
	{
		return new self($uri);
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

	public function send($error)
	{
		$this->_socket->send($this->_pack($error), ZMQ::MODE_NOBLOCK);
	}

	private function _pack($data)
	{
		$msgPack = new MessagePack();
		return $msgPack->pack($data);
	}
}
