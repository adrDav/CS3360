<?php
//files required for game to work.
require('validation.php');
require('board.php');
//if response is not valid, message will be printed.
$isValid = validate();
if (!$isValid['response']) {
	echo json_encode($isValid);
} else {
	// echo json_encode($_GET['pid']);
	//assignment of values to variables.
	$board = new Board($_GET['pid']);
	$pid = $_GET['pid'];
	$move = $_GET['move'];
	$data = file_get_contents('../data/'.$pid.'.json');
	//json string is encoded with the board received.
	echo json_encode(
		$board->getBoard()
	);
	echo '<h1>-</h1>';
	//response from function is stored.
	$validate = validateIsNotPicked($move[0], $move[2], $board->getBoard());
	//if response is not valid, message will be printed. Board will be updated if response is valid.
	if(!$validate['response']){
		echo json_encode($isValid);
	}
	//board is updated.
	$board->updateUserInput($move[0], $move[2]);

	// $jdata['board'][$move[0]][$move[2]] = 1;
	// echo json_encode($jdata);
	$x = -1;
	$y = -1;
	while ($x < 0 || $x > 14 || $y < 0 || $y > 14 /* TODO needs to be added validateCompInput($x, $y, $board->getBoard())*/) {
		$x = rand(0, 14);
		$y = rand(0, 14);
	}
	// $jdata['board'][$y][$y] = 2;
	$board->updateCompInput($x, $y);
	// echo '<h1>--------</h1>';
	// echo json_encode($jdata);
	
	// $fp = fopen('../data/'.$pid.'.json', 'w');
	// fwrite($fp, json_encode($jdata));
	// fclose($fp);
	//json string of board is printed.
	echo json_encode(
		$board->getBoard()
	);
	//data is stored.
	$board->storingData();
	//game logic is stored.
	echo json_encode(
		array(
			'response' => true,
			'ack_move' => array(
				'x' => $move[0],
				'y' => $move[2],
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

	/*
	file_put_contents('../data/'.$pid.'.json', json_encode($jdata));
*/

	/*echo json_encode(
		array(
			'response' => true,
		)
	);*/

	//TODO (Adrian) isWin:

	//TODO (Adrian) isDraw:
}
