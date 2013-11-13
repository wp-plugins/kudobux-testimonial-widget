<?php
@session_start();
$to = $_SESSION['email'];
$user_id= $_SESSION['user_id'];

if ($to !=""){
$result = send_confirmation_code($to,$user_id);
    if($result==1){
        $conf_message = '<p>'.'The confirmation code has been sent to this email : '.$_SESSION['email'].'.</p><p>'.'Remember to check your spam box'.'</p>'."<br />"."<p><a class='pro_btn' href=\"admin.php?page=Activate\">Proceed</a> ";
    }else{
        $conf_message = 'Error : Enter email address';
    }
    }else{
        $conf_message = 'Send an email to "hello@kudobuzz.com" to look into this for you ASAP';
    }
$_SESSION['email_1']=$to;
$_SESSION['user_id_1']=$user_id;
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
   .pro_btn:hover{
             color: #fff !important;
background: #e87e04 !important;
          }
          .pro_btn{
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
          .wrap p{
              text-align: center;
          }
          .wrap p a{
              text-align: center;
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
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><img src="<?php echo plugins_url().'/kudobux-testimonial-widget/assets/img/kudo_head.png' ?>"  alt="Kudobuzz Testimonial Widget" style="
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
    width: auto;"></span>
    </div>
    </div>
</div>
	<div class="wrap" style="background: #ECF0F1;
color: #8b99a3;
position: relative;
top: -17px;
padding: 10px;
height: 420px;font-size:20px "> 
            <?php _e($conf_message); ?>
        </div>   

<?php 
        
function send_confirmation_code($to,$user_id){  
   $subject = "Confirmation Code";
   $message = 'Thank you for signing up on Kudobuzz.'."\n".'Your Confirmation Code is '.$user_id."\n".'The Kudobuzz Team';
   $headers = 'From: Kudobuzz <hello@kudobuzz.com>' . "\r\n";
   $results = wp_mail($to, $subject, $message, $headers);
   return $results;
   }
        
<<<<<<< .mine
?>=======
?>
>>>>>>> .r804080
