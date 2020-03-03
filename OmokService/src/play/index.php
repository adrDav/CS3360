<?php
if (!isset($_GET['pid'])) {
	echo json_encode(
		array(
			'response' => false,
			'reason' => 'Pid not specified'
		)
	);
} else if (!isset($_GET['move'])) {
	echo json_encode(
		array(
			'response' => false,
			'reason' => 'Move not specified'
		)
	);
} else {
	$pid = json_decode($_GET['pid']);
	$move = json_decode($_GET['move']);
	if (!file_exists('../data/' . $pid)) {
		echo json_encode(
			array(
				'response' => false,
				'reason' => 'Unknown pid'
			)
		);
	} else if (strlen($move) != 3 || !is_numeric($move[0]) || !is_numeric($move[2]) || $move[1] == ',') {
		echo json_encode(
			array(
				'response' => false,
				'reason' => 'Move not well-formed'
			)
		);
	} else if ($move[0] >= 0 && $move[0] < 16) {
		echo json_encode(
			array(
				'response' => false,
				'reason' => 'Invalid x coordinates'
			)
		);
	} else if ($move[2] >= 0 && $move[2] < 15) {
		echo json_encode(
			array(
				'response' => false,
				'reason' => 'Invalid y coordinates'
			)
		);
	} else {
		$data = file_get_contents('../data/5e5c8d06e9255.json');
		$jdata = json_decode($data, true);
		$jdata['board'][$move[0]][$move[2]] = 1;
		$x = -1;
		$y = -1;
		while ($x < 0 || $x > 14 || $y < 0 || $y > 14) {
			$x = rand(0, 14);
			$y = rand(0, 14);
		}
		$jdata['board'][$y][$y] = 2;
		echo json_encode(
			array(
				'response' => true,
				'ack_move' => array(
					'x' => $move[0],
					'y' => $move[2],
					'isWin' => false,
					'isDraw' => false,
					'row' => array()
				),
				'move' => array(
					'x' => $move[0],
					'y' => $move[2],
					'isWin' => false,
					'isDraw' => false,
					'row' => array()
				)
			)
		);
	}
}
