<?php
//function validates if chosen input does not violate constraints in the placement of new chips.
function validate()
{
	if (!isset($_GET['pid'])) {
		return array(
			'response' => false,
			'reason' => 'Player\'s ID not specified.'
		);
	} else if (!isset($_GET['move'])) {
		return array(
			'response' => false,
			'reason' => 'Move was not specified'
		);
	} else {
		$pid = $_GET['pid'];
		$move = $_GET['move'];
		$moveArr = explode(',', $move);

		if (!file_exists('../data/' . $pid . '.json')) {
			return array(
				'response' => false,
				'reason' => 'Player\'s ID is unknown.'
			);
		} else if (sizeof($moveArr) != 2 || !is_numeric($moveArr[0]) || !is_numeric($moveArr[1])) {
			return array(
				'response' => false,
				'reason' => 'Move was not well-formed'
			);
		} else if ($moveArr[0] < 0 || $moveArr[0] > 14) { //between 0 - 14 is valid
			return array(
				'response' => false,
				$move[0] >= 0,
				'reason' => 'Invalid x-coordinate value'
			);
		} else if ($moveArr[1] < 0 || $moveArr[1] > 14) {
			return array(
				'response' => false,
				'reason' => 'Invalid y-coordinate value'
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
	if ($x < 0 || $x > 14 || $y < 0 || $y > 14) {
		return false;
	} else if ($board[$x][$y] != 0) {
		return false;
	} else {
		return true;
	}
}

function validPicked($x, $y, $board)
{
	if ($board[$x][$y] != 0) {
		return array(
			'response' => false,
			'reason' => 'Previously selected coordinates.'
		);
	} else {
		return array(
			'response' => true,
		);
	}
}
