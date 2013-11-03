<?php

if (isset($_GET["user_id"])){
$user_id = $_GET["user_id"];
$uid = get_option( 'kudobuzz_uid' );

if($uid != ""){
$url = site_url().'/wp-admin/admin.php?page=Kudobuzz';
echo "<script>location.href='$url'</script>";
}else{
//new url
$new_url = site_url().'/wp-admin/admin.php?page=Step0';
//activating user
$activate_url = 'https://kudobuzz.com/';
    $sent_to = $activate_url ."activate-account?user_id=".$user_id;
    $result = wp_remote_fopen($sent_to);  
   
    //getting user account id
      $account_url = 'https://kudobuzz.com/';
	$account_sent_to = $account_url ."get_account_id/".$user_id;
        $results = wp_remote_fopen($account_sent_to);
        $obj= json_decode($results);
        $account_id = $obj->response;
        
        //hashing user id
         $user_id_dec = dechex($user_id);
    	 $account_id_dec = dechex($account_id);
    
    $uid = $user_id_dec."-".$account_id_dec;
    //updating db
    update_option('kudobuzz_uid', $uid);
    echo "<script>location.href='$new_url'</script>";
}
}



?>

