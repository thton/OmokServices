<?php

$Strats = $_GET['strategy'];

if(!$Strats){
	$response = "false";
	$reason = "Strategy not specified";
}

elseif($Strats == "Smart" || $Strats == "Random"){
	$response = true;
	$pid = uniqid();
}

else{
	$response = false;
	$reason = "Unknown strategy";
}

if ($response == false) {
	$output = array("response"=>$response,"reason"=>$reason);
	echo json_encode($output);
}
else{
	$output = array("response"=>$response,"pid"=>$pid);
	echo json_encode($output);
}
?>