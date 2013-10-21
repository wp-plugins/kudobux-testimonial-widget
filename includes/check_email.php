<?php
	ini_set("display_errors", 1);
	require "../scripts/config.php";
	
	$email = $_POST["email"];
	
	$result = file_get_contents(BASE_URL ."check-email/".$email);
	echo $result;
	//var_dump(BASE_URL);
?>
