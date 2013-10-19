<?php
	ini_set("display_errors", 1);
	require "../scripts/config.php";
		
	$email = $_POST["email"];
	$user_id = $_POST["user_id"];
	$vanity_name = $_POST["vanity_name"];
	$pass = isset($_POST["pass"])?$_POST["pass"]:"";
	$send_via = isset($_POST["send-via"]) ? $_POST["send-via"] : NULL;

	$sent_to = BASE_URL ."user/success";
	

	//$result = file_get_contents(BASE_URL ."check-url/". urlencode($url));
	
	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $sent_to);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query(array(
																'email' => $email, 
																'pass' => $pass,
																'user_id' =>$user_id,
																'vanity_name'=>$vanity_name,
																'type' => "wp",
																'send-via' => $send_via
																)
														)
				);
	
	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
	
	echo $result;
	//var_dump(BASE_URL);
?>
