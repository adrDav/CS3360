<?php
function validate()
{
	if (!isset($_GET['pid'])) {
		return json_encode(
			array(
				'response' => false,
				'reason' => 'Pid not specified'
			)
		);
	} else if (!isset($_GET['move'])) {
		return json_encode(
			array(
				'response' => false,
				'reason' => 'Move not specified'
			)
		);
	} else {

		// get values
		$pid = json_decode($_GET['pid']);
		$move = $_GET['move'];

		if (!file_exists('../data/' . $pid)) {
			return json_encode(
				array(
					'response' => false,
					'reason' => 'Unknown pid'
				)
			);
		} else if (strlen($move) != 3 || !is_numeric($move[0]) || !is_numeric($move[2]) || $move[1] != ',') {
			return json_encode(
				array(
					'response' => false,
					'reason' => 'Move not well-formed'
				)
			);
		} else if ($move[0] < 0 || $move[0] > 14) { //between 0 - 14 is valid
			return json_encode(
				array(
					'response' => false,
					$move[0] >= 0,
					'reason' => 'Invalid x coordinate'
				)
			);
		} else if ($move[2] < 0 && $move[2] > 14) {
			return json_encode(
				array(
					'response' => false,
					'reason' => 'Invalid y coordinate'
				)
			);
		} else {
			return array(
				'response' => true
			);
		}
	}
}

function validateCompInput($x, $y, $board)
{
	//TODO!
	return true;
}

function validateIsNotPicked()
{
	//TODO!
	return
		array(
			'response' => true
		);
}
