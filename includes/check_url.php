<?php
	ini_set("display_errors", 1);
	require "config.php";
	
	$param = $_POST["url"];
	$url = BASE_URL ."check-url";
	

	//$result = file_get_contents(BASE_URL ."check-url/". urlencode($url));
	
	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query(array('url' => $param)));
	
	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
	
	echo $result;
	//var_dump(BASE_URL);
?>
