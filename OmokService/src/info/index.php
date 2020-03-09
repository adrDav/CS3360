<?php //index.php file
//	echo json_encode(["size"=> 15, "strategies"=> ["Smart", "Random"]]);
//infoGame contains the size of the table and the strategy which the game will be in.
class infoGame
{
	public $size;
	public $strategies;
	//infoGame size of table and strategy which the game will be in.
	function __construct($size, $strategies)
	{
		$this->size = $size;
		$this->strategies = $strategies;
	}
}
//info contains the game specifications.
$info = new infoGame(15, array("Smart", "Random"));
//variable is encoded as a json string and printed.
echo (json_encode($info));
