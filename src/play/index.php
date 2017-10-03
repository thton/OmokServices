<?php

require('.\Board.php');

$play_pid = $_GET['pid'];
$player_move = $_GET['move'];

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
	$gamedata = json_decode($game);
	$board = new Board($gamedata->strat);
	$board->grid = $gamedata->grid;
	$board->isWin = $gamedata->isWin;
	$board->isDraw = $gamedata->isDraw;
	$board->row = $gamedata->row;

	$response = true;
	
	$board->set((int)$player_move[0],(int)$player_move[2],true);
	
	$ack_move = array("x"=>(int)$player_move[0],"y"=>(int)$player_move[2],"isWin"=>$board->isWin,"isDraw"=>$board->isDraw,"row"=>$board->row);

	
	if($board->strat == "Random"){
		
	$computerx = mt_rand(0,14);
	$computery = mt_rand(0,14);
	$board->set($computerx,$computery,false);
	
	$move = array("x"=>$computerx,"y"=>$computery,"isWin"=>$board->isWin,"isDraw"=>$board->isDraw,"row"=>$board->row);

	}
	
	$pidFile = fopen("../writeable/$play_pid","w");
	fwrite($pidFile, json_encode($board));
	fclose($pidFile);

	echo json_encode(array("response"=>$response,"ack_move"=>$ack_move,"move"=>$move));
}

?>