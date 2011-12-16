<?php
require_once "ZeroMQMessagePackClient.php";

class TriageClient extends ZeroMQMessagePackClient
{
	public function logError($error)
	{
		$this->send(array(
				'error' => $error,
				'time' => time()
			));

		return $this;
	}

	public function logMessage($level, $message)
	{
		$this->send(array(
				'message' => $message,
				'level' => $level,
				'time' => time()
			));

		return $this;
	}
}
