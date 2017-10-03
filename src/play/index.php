<?php

require('.\Board.php');
require('.\smartMove.php');

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
	
	$board->set($playerx,$playery,true);
	$board->isWin = $board->checkWin($playerx,$playery,true);
	$board->isDraw = $board->checkDraw();
	$ack_move = array("x"=>$playerx,"y"=>$playery,"isWin"=>$board->isWin,"isDraw"=>$board->isDraw,"row"=>$board->row);
	
	if($board-> isWin == true||$board->isDraw == true){
		echo json_encode(array("response"=>$response,"ack_move"=>$ack_move));
		exit();
	}
	
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
		$nextMove = new smartMove($board);
		$nextMove->callAll();
		$nextMoveArray = $nextMove->makeMove();
		$computerx = $nextMoveArray[0];
		$computery = $nextMoveArray[1];
	}
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