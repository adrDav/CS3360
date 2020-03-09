<?php
//files required for game to work.
require('validation.php');
require('board.php');
//if response is not valid, message will be printed.
$isValid = validate();
if (!$isValid['response']) {
	echo json_encode($isValid);
} else {
	//assignment of values to variables.
	$board = new Board($_GET['pid']);
	$pid = $_GET['pid'];
	$move = $_GET['move'];
	$data = file_get_contents('../data/' . $pid . '.json');
	$moveArr = explode(',', $move);

	//response from function is stored.
	$validate = validPicked($moveArr[0], $moveArr[1], $board->getBoard());
	//if response is not valid, message will be printed. Board will be updated if response is valid.
	if (!$validate['response']) {
		echo json_encode($validate);
	} else {
		//board is updated.
		$board->updateUserInput($moveArr[0], $moveArr[1]);

		$x = -1;
		$y = -1;
		while (!validateCompInput($x, $y, $board->getBoard())) {
			$x = rand(0, 14);
			$y = rand(0, 14);
		}
		$board->updateCompInput($x, $y);

		//data is stored.
		$board->storingData();
		//game logic is stored.
		echo json_encode(
			array(
				'response' => true,
				'ack_move' => array(
					'x' => $moveArr[0],
					'y' => $moveArr[1],
					'isWin' => false, //make function
					'isDraw' => false, //make function
					'row' => array()
				),
				'move' => array(
					'x' => $x,
					'y' => $y,
					'isWin' => false, //make function
					'isDraw' => false, //make funtion
					'row' => array()
				)
			)
		);

	}
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

//TODO (Adrian) isDraw:
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
