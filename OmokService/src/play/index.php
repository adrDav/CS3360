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

		//TODO (Adrian) isWin: 

		//TODO (Adrian) isDraw:
	}
}
