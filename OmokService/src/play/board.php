<?php
class board
{

	private
		$pid,
		$strategy,
		$board,
		$_win,
		$_draw = false,
		$_winUser = false,
		$_winComputer = false;

	function __construct($pid)
	{
		$this->pid = $pid; //pid initialize
		$this->board = $this->constructBoard($pid); //board initialize
	}

	function constructBoard($pid)
	{
		$jdata = file_get_contents('../data/' . $pid . '.json');
		$data = json_decode($jdata);
		$this->strategy = $data->strategy;
		return $data->board;
	}

	public function getBoard()
	{
		return $this->board;
	}

	function updateUserInput($x, $y)
	{
		$this->board[$x][$y] = 1;
	}

	function updateCompInput($x, $y)
	{
		$this->board[$x][$y] = 2;
	}

	function storingData()
	{
		$fp = fopen('../data/' . $this->pid . '.json', 'w');
		fwrite($fp, json_encode(
			array(
				'pid' => $this->pid,
				'strategy' => $this->strategy,
				'board' => $this->board
			)
		));
		fclose($fp);
	}
}
