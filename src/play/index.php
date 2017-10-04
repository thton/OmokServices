<?php
#Toan Ton
#80535761
#Progamming Languages Lab 1
require('.\Board.php');

$play_pid = $_GET['pid'];
$player_move = explode(",",$_GET['move']);
$playerx = (int)$player_move[0];
$playery = (int)$player_move[1];

if($play_pid == NULL || $player_move == NULL){
	$response = false;
	$reason = $play_pid==NULL ? 'Pid not specified' : 'Move not specified';
	$output = array("response"=>$response,"reason"=>$reason);
	echo json_encode($output);
}

elseif($playerx >= 15 || $playery >= 15){
	$response = false;
	$reason = $playerx>= 15 ? 'Invalid x coordinate, ' . $playerx : 'Invalid y coordinate, ' . $playery;
	$output = array("response"=>$response,"reason"=>$reason);
	echo json_encode($output);
}

else{
	#Reading game data from a json encoded file
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
	#player move
	$board->set($playerx,$playery,true);
	$board->isWin = $board->checkWin($playerx,$playery,true);
	$board->isDraw = $board->checkDraw();
	$ack_move = array("x"=>$playerx,"y"=>$playery,"isWin"=>$board->isWin,"isDraw"=>$board->isDraw,"row"=>$board->row);
	
	if($board-> isWin == true||$board->isDraw == true){
		echo json_encode(array("response"=>$response,"ack_move"=>$ack_move));
		exit();
	}
	#random and smart strats
	if($board->strat == "Random"){
		while(true){
			$computerx = mt_rand(0,14);
			$computery = mt_rand(0,14);
			if($board->grid[$computery][$computerx] == 0){
				break;
			}
		}
	}
	elseif($board->strat == "Smart"){
		$nextMove = $board->checkMove();
		$computerx = $nextMove[1];
		$computery = $nextMove[0];
	}
	#computer move
	$board->set($computerx,$computery,false);
	$board->isWin = $board->checkWin($computerx, $computery, false);
	$board->isDraw = $board->checkDraw();
	$move = array("x"=>$computerx,"y"=>$computery,"isWin"=>$board->isWin,"isDraw"=>$board->isDraw,"row"=>$board->row);

	#Writing new game info into the same gamefile with the pid name
	$pidFile = fopen("../writeable/$play_pid","w");
	fwrite($pidFile, json_encode($board));
	fclose($pidFile);
	
	#response sent to api
	echo json_encode(array("response"=>$response,"ack_move"=>$ack_move,"move"=>$move));
}

?>