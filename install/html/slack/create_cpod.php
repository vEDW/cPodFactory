<?php

$command = $_POST['command'];
$text = $_POST['text'];
$token = $_POST['token'];
$user_name = $_POST['user_name'];

require 'token.php';

if ($text != '') {
	$CPOD=explode(" ", $text);
	$NAME = strtoupper($CPOD[0]);
	if (strpos($NAME,"_") !== false) {
		$msg = ":thumbsdown: Name should not contains underscore.";
		die($msg);
	}
	if (strpos($NAME,"CPOD") !== false) {
		$msg = ":thumbsdown: Name should not contains ".$CPOD[0].".";
		die($msg);
	}
	$STATUS = exec("./check_cpod.sh ".$CPOD[0]);
	if ($STATUS == "Ok!" ) {
		if ($CPOD[1] == '') {
			$CPOD[1] = 3;
		}
		if ($CPOD[1] > 5) {
			$msg = ":thumbsdown: You are not allowed to deploy more than 5 ESXi.";
			die($msg);
		}
		exec("nohup ./create_cpod.sh ".strtoupper($CPOD[0])." ".$CPOD[1]." ".$user_name." > nohup.out & > /dev/null");
	} else {
		echo ":zombie: This name already exists.";
	}
} else {
	echo ":wow: Nothing to do! Parameters are missing.";
}

?>
