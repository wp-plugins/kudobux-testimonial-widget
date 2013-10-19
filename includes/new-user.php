<?php
	function creat_user($email,$pass,$url,$vanity_name){
	require "config.php";
		
	$email = $_POST["email"];
	$pass = $_POST["pass"];
	$url = $_POST["url"];
	$vanity_name = $_POST["vanity_name"];

	$sent_to = BASE_URL ."new-user";
	
	//$result = file_get_contents(BASE_URL ."check-url/". urlencode($url));
	
	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $sent_to);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query(array(
	'email' => $email, 
	'pass' => $pass,
	'url' =>$url,
	'vanity_name'=>$vanity_name														)
														)	);
	
	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
	
	echo $result;
	//var_dump(BASE_URL);
        }
?>

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Sign up ', 'oscimp_trdom' ) . "</h2>"; ?>  
      
    <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="oscimp_hidden" value="Y">  
        <?php    echo "<h4>" . __( 'OSCommerce Database Settings', 'oscimp_trdom' ) . "</h4>"; ?>  
        <p><?php _e("Database host: " ); ?><input type="text" name="oscimp_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>  
        <p><?php _e("Database name: " ); ?><input type="text" name="oscimp_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: oscommerce_shop" ); ?></p>  
        <p><?php _e("Database user: " ); ?><input type="text" name="oscimp_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>  
        <p><?php _e("Database password: " ); ?><input type="text" name="oscimp_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></p>  
        <hr />  
        <?php    echo "<h4>" . __( 'OSCommerce Store Settings', 'oscimp_trdom' ) . "</h4>"; ?>  
        <p><?php _e("Store URL: " ); ?><input type="text" name="oscimp_store_url" value="<?php echo $store_url; ?>" size="20"><?php _e(" ex: http://www.yourstore.com/" ); ?></p>  
        <p><?php _e("Product image folder: " ); ?><input type="text" name="oscimp_prod_img_folder" value="<?php echo $prod_img_folder; ?>" size="20"><?php _e(" ex: http://www.yourstore.com/images/" ); ?></p>  
          
      
        <p class="submit">  
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />  
        </p>  
    </form>  
</div>  