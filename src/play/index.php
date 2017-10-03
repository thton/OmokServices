<?php

require('.\Board.php');
#require_once('..\new\index.php');

$play_pid = $_GET['pid'];
$player_move = $_GET['move'];
$isWin = false;
$isDraw = false;
$row = array();


if($play_pid == NULL || $player_move == NULL){
	$response = false;
	$reason = $play_pid==NULL ? 'Pid not specified' : 'Move not specified';
	$output = array("response"=>$response,"reason"=>$reason);
	echo json_encode($output);
}

else{

	$pidFile = fopen("../writeable/$play_pid", "r");
	$game = fread($pidFile, filesize("../writeable/$play_pid"));
	fclose($pidFile);
	$board = new Board();
	$board->grid = json_decode($game, true);

	$response = true;



	$ack_move = array("x"=>(int)$player_move[0],"y"=>(int)$player_move[2],"isWin"=>$isWin,"isDraw"=>$isDraw,"row"=>$row);
	#$board->set((int)$player_move[0],(int)$player_move[2],true);
	$board->grid[(int)$player_move[2]][(int)$player_move[0]] = 1;

	$computerx = mt_rand(0,14);
	$computery = mt_rand(0,14);

	$move = array("x"=>$computerx,"y"=>$computery,"isWin"=>$isWin,"isDraw"=>$isDraw,"row"=>$row);
	#$board->set($computerx,$computery,false);
	$board->grid[$computery][$computerx] = 2;

	$pidFile = fopen("../writeable/$play_pid","w");
	fwrite($pidFile, json_encode($board->grid));
	fclose($pidFile);

	echo json_encode(array("response"=>$response,"ack_move"=>$ack_move,"move"=>$move));
}

?>