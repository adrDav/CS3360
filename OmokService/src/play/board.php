<?php
//Class board with the player's id, strategy of the game, board, win status, draw status, player's win status, computer's win status.
class board
{
	//assignments of the class.
	private
		$pid,
		$strategy,
		$board,
		$_win = false,
		$_draw = false,
		$_winUser = false,
		$_winComputer = false;
	//function will initialize player's id and the board.
	function __construct($pid)
	{
		$this->pid = $pid;
		$this->board = $this->constructBoard($pid);
	}
	//function assigns the data received to the board for each player's id. 
	function constructBoard($pid)
	{
		//locate the json string of the data.
		$jdata = file_get_contents('../data/' . $pid . '.json');
		//decode json string.
		$data = json_decode($jdata);
		//data is assigned to the strategy.
		$this->strategy = $data->strategy;
		//data is assigned to board and returned.
		return $data->board;
	}
	//getter for the board class.
	public function getBoard()
	{
		return $this->board;
	}
	//function assigns the value in the specified x,y coordinates for the user.
	function updateUserInput($x, $y)
	{
		$this->board[$x][$y] = 1;
	}
	//function assigns the value in the specified x,y coordinates for the computer.
	function updateCompInput($x, $y)
	{
		$this->board[$x][$y] = 2;
	}
	//function stores the data in a json string.
	function storingData()
	{
		//file path is specified.
		$fp = fopen('../data/' . $this->pid . '.json', 'w');
		//json string is encoded.
		fwrite($fp, json_encode(
			array(
				'pid' => $this->pid,
				'strategy' => $this->strategy,
				'board' => $this->board
			)
		));
		//file path is closed.
		fclose($fp);
	}
}
