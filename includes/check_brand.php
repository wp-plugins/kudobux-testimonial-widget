<?php
	ini_set("display_errors", 1);
	
	require "../scripts/config.php";
	
	$vanity = $_POST["vanity"];

	$result = file_get_contents(BASE_URL ."check-vanity/". $vanity);
		
	echo $result;
?>
