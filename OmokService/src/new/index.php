<?php //index.php 
//Class that contains the strategy, the player's id, and the response from the server.
class Game
{
	public $strategy, $pid, $response;

	//assignments of the class.
	function __construct($strategy)
	{
		$this->response = true;
		$this->pid = uniqid();
		$this->strategy = $strategy;
	}
	//getter for server's response.
	function getResponse()
	{
		return $this->response;
	}
	//getter for player's id.
	function getPid()
	{
		return $this->pid;
	}
	//function allocate a space for the board and return it.
	function generateBoard()
	{
		$board = array();
		//board's size should be 15x15
		for ($i = 0; $i < 15; $i++) {
			for ($j = 0; $j < 15; $j++) {
				$board[$i][$j] = 0;
			}
		}
		//return statement.
		return $board;
	}
}
//if there is no strategy specified or either of them, a message will be printed. Else game is created.
if (!isset($_GET['strategy'])) {
	echo json_encode(array('response' => false, 'reason' => 'Strategy not specified.'));
} else if ($_GET['strategy'] != 'Random' && $_GET['strategy'] != 'Smart') {
	echo json_encode(array('response' => false, 'reason' => 'Unknown strategy'));
} else {
	//Game is created with the defined strategy.
	$gm = new Game($_GET['strategy']);
	//Game variables are assigned.
	$gameSession = array(
		'pid' => $gm->getPid(),
		'strategy' => $_GET['strategy'],
		'board' => $gm->generateBoard()
	);
	//fp stores file location and player's id.
	$fp = fopen('../data/' . $gm->getPid() . '.json', 'w');
	//write happens in file location stored in the variable.
	fwrite($fp, json_encode($gameSession));
	fclose($fp);
	//prints message with the json string and the server's response with the player's id.
	echo json_encode(array(
		"response" => $gm->getResponse(),
		"pid" => $gm->getPid()
	));
}
