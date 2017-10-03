<?php

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
	$response = true;
	$ack_move = array("x"=>(int)$player_move[0],"y"=>(int)$player_move[2],"isWin"=>$isWin,"isDraw"=>$isDraw,"row"=>$row);
	$move = array("x"=>mt_rand(0,14),"y"=>mt_rand(0,14),"isWin"=>$isWin,"isDraw"=>$isDraw,"row"=>$row);
	echo json_encode(array("response"=>$response,"ack_move"=>$ack_move,"move"=>$move));
}

?>