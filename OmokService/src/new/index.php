<?php

class Game
{

	public $strategy, $pid, $response;

	function __construct($strategy)
	{
		$this->response = true;
		$this->pid = uniqid();
		$this->strategy = $strategy;
	}

	function getResponse()
	{
		return $this->response;
	}

	function getPid()
	{
		return $this->pid;
	}

	function generateBoard()
	{
		$board = array();
		for ($i = 0; $i < 15; $i++) {
			for ($j = 0; $j < 15; $j++) {
				$board[$i][$j] = 0;
			}
		}
		return $board;
	}
}

if (!isset($_GET['strategy'])) {
	echo json_encode(array('response' => false, 'reason' => 'Strategy not specified.'));
} else if ($_GET['strategy'] != 'Random' && $_GET['strategy'] != 'Smart') {
	echo json_encode(array('response' => false, 'reason' => 'Unknown strategy'));
} else {
	$gm = new Game($_GET['strategy']);

	$gameSession = array(
		'pid' => $gm->getPid(),
		'strategy' => $_GET['strategy'],
		'board' => $gm->generateBoard()
	);
	$fp = fopen('../data/' . $gm->getPid() . '.json', 'w');
	fwrite($fp, json_encode($gameSession));
	fclose($fp);

	echo json_encode(array(
		"response" => $gm->getResponse(),
		"pid" => $gm->getPid()
	));
}
