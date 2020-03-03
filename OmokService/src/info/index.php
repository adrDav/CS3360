<?php // index.php
//	echo json_encode(["size"=> 15, "strategies"=> ["Smart", "Random"]]);
class infoGame
{
	public $size;
	public $strategies;
	function __construct($size, $strategies)
	{
		$this->size = $size;
		$this->strategies = $strategies;
	}
}

$info = new infoGame(15, array("Smart", "Random"));
echo (json_encode($info));
