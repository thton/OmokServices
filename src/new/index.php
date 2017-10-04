<?php
#Toan Ton
#80535761
#Progamming Languages Lab 1
require('..\play\Board.php');

$Strats = $_GET['strategy'];

if(!$Strats){
	$response = "false";
	$reason = "Strategy not specified";
}

elseif($Strats == "Smart" || $Strats == "Random"){
	$response = true;
	$pid = uniqid();
	$game = new Board($Strats);
	$pidFile = fopen("../writeable/$pid","w");
	fwrite($pidFile, json_encode($game));
	fclose($pidFile);
}

else{
	$response = false;
	$reason = "Unknown strategy";
}

if ($response == false) {
	$output = array("response"=>$response,"reason"=>$reason);
}
else{
	$output = array("response"=>$response,"pid"=>$pid);
}
	echo json_encode($output);
?>