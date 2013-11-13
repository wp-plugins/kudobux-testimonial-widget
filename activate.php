<?php
if(!isset($_SESSION)) 
    { 
        @session_start(); 
    }
if (isset($_POST['kudobuzz_uid']) && $_POST['kudobuzz_uid'] != "") {
    $conf_code = $_POST['kudobuzz_uid'];
  
    $output = validate_code($conf_code);

    $account_id=get_account_id($conf_code);
    
    $user_id_dec = dechex($conf_code);
    $account_id_dec = dechex($account_id);
    
    $uid = $user_id_dec."-".$account_id_dec;
    if($output==1 && $account_id != 0){
    update_option('kudobuzz_uid', $uid);
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Hurray your account is activated. You will be redirected now')
    window.location='./admin.php?page=Step0';
    </SCRIPT>");
    }else{
         
        $conf_message = 'Error : Activation code is invalid. A valid one has been emailed to you';
    }
    
} else {
    $conf_message = 'Error : Check your email address for confirmation code';
}

if(isset($_POST['kudobuzz_resend_email']) && $_POST['kudobuzz_resend_email']=""){
    send_confirmation_code();
}else{
    $conf_message = '';
}
?>  
<style type="text/css">
    
    #kudobuzz_uid_input{
    border: 2px solid #bdc3c7;
color: #34495e;
font-family: 'Lato', sans-serif;
font-size: 14px;
padding: 8px 5px;
height: 41px;
text-indent: 6px;
-webkit-appearance: none;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: none;
-moz-box-shadow: none;
box-shadow: none;
border:2px solid transparent;
-webkit-transition: border .25s linear, color .25s linear;
-moz-transition: border .25s linear, color .25s linear;
-o-transition: border .25s linear, color .25s linear;
transition: border .25s linear, color .25s linear;
-webkit-backface-visibility: hidden;
    
    }
    #kudobuzz_uid_input:hover{
        border:2px solid #8b99a3;
    }
    #kudobuzz_uid_input:focus{
        border:2px solid #d35400;
    }
    #activate_btn:hover{
             color: #fff !important;
background: #e87e04 !important;
          }
          #activate_btn{
       color: #fff;
text-decoration: none;
font-size: 14px;
background: #8b99a3 !important;
margin: 0px;
box-shadow: inset 0 -2px 0 rgba(0,0,0,0.15);
border-radius: 4px;
text-align: center;
padding: 10px 30px;
border: none; }
          .rnd_code{
              color:#0f66aa;
          }
          .rnd_code:hover{
              color:#e87e04;
          }
</style>
<div class="wrap">

<div class="icon32" id="icon-options-general"></div>
 <h2>Kudobuzz Testimonial Widget - Account Activation</h2> 
    <div id="kudobuzz_widget" style="width:100%;min-width:800px;margin-top:10px;"> 
   
    <div id="kudobuzz_header" style="width:100%;
	background-color:#d35400;
	-webkit-border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
    border-radius: 5px 5px 0px 0px;
	padding:10px 0px;">
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><img src="<?php echo plugins_url().'/kudobux-testimonial-widget/assets/img/kudo_head.png' ?>" alt="Kudobuzz Testimonial Widget" style="
    height: 70px;
    width: 70px;
    position: relative;
    top: -4px;
"/>
    <span style="top:-7px; position:relative;color: #FFFFFF;
    font-size: 1.5em;
    font-weight: bold;
    height: auto;
    line-height: 0.95em;
    margin-bottom: 5px;
    padding-left: 20px;
    width: auto;"><?php _e($conf_message); ?></span>
    </div>
    </div>
</div>
	<div class="wrap" style="background: #ECF0F1;
color: #8b99a3;
position: relative;
top: -17px;
padding: 10px;
height: 420px;"> 
    <form name="kudobuzz_form" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="kudobuzz_hidden" value="Y">
        <?php $message = '<p>'.'Paste confirmation code here and click on activate if you did not recieve it - '."<a class='rnd_code' href=\"admin.php?page=Resend\">Resend</a>"; ?>
        <?php echo "<h4 style='text-align: center;font-size: 20px;'>" . __($message, 'kudobuzz_conf') . "</h4>"; ?>
        <p style="text-align: center; font-size: 15px;"><?php _e("Confirmation Code "); ?><input type="text" name="kudobuzz_uid" id="kudobuzz_uid_input" value="" size="20"><?php _e(" ex: 1381968768322"); ?></p>
        <p class="submit" style="text-align: center;">
        <input type="submit" name="Submit" id="activate_btn" value="<?php _e('Activate', 'kudobuzz_conf') ?>" /></p>
    </form>
        
        </div>

<?php 

function validate_code($code){
    $url = 'https://kudobuzz.com/';
    $sent_to = $url ."activate-account?user_id=".$code;
    $result = wp_remote_fopen($sent_to);    
        return $result;
        }
        
function get_account_id($code){
    $url = 'https://kudobuzz.com/';
	$sent_to = $url ."get_account_id/".$code;
        $results = wp_remote_fopen($sent_to);
        $obj= json_decode($results);
        $message = $obj->message;
        if($message="Success"){
            $value= $obj->response;
        }else{
            $value=0;
        }
        return $value;
        }
        
        if($_GET['email'] !=""){
        $_SESSION['email']=$_GET["email"];
        $_SESSION['user_id']=$_GET["user_id"];
        
        }else{
            $_SESSION['email']=$_SESSION['email_1'];
            $_SESSION['user_id']=$_SESSION['user_id_1'];
            
        }
          
?>