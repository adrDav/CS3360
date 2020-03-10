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
	//if the either the user or the computer has 8 chips in a line, true is returned.
	function isWin () {
		//counter for user's chips and computer's chips.
		$counterUser = 0;
		$counterComputer = 0;
		//traverse through the board.
		for($i = 0; $i < $moveArr[0].length ; $i++){
			for($j = 0; $j < $moveArr[1].length; $i++){
				//if there is a user's chip and no computer's chip surrounding it, one should be added
				if($board[$i][$j] == 1 && $board[$i-1][$j] != 2 && $board[$i][$j-1] != 2 && $board[$i-1][$j-1] != 2){
					$counterUser += 1;
				}
				//user has won.
				if($counterUser == 8){
					return true;
				}
				//if there is a computer's chip and user computer's chip surrounding it, one should be added
				if($board[$i][$j] == 2 && $board[$i-1][$j] != 1 && $board[$i][$j-1] != 1 && $board[$i-1][$j-1] != 1){
					$counterComputer += 1;
				}
				//computer has won.
				if($counterComputer == 8){
					return true;
				}
			}

		}
		//neither user or computer has won
		return false;
	}
	//if the either the user or the computer has 8 chips in a line, true is returned.
	function isDraw () {
		//counter for user's chips and computer's chips.
		$counter = 0;
		//traverse through the board.
		for($i = 0; $i < $moveArr[0].length ; $i++){
			for($j = 0; $j < $moveArr[1].length; $i++){
				//if there is a user's chip or computer's chip, one should be added
				if($board[$i][$j] == 1 || $board[$i][$j] == 2){
					$counterUser += 1;
				}
				//if all spaces are taken, a draw is decided.
				if(sizeof($board) == $counter){
					return true;
				}
			}
		}
		//else there is still room for movements
		return false;
	}
}

