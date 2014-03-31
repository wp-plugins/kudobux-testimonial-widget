<?php
ini_set('display_errors', 1);
/*
 * After create a user account
 * insert the kudobuzz javascript in the front head
 */

$user_id = $_GET['user_id'];

$url = MAIN_HOST . 'user/get_user?user_id=' . $user_id . '&include_entities=1';

//Get the user account id
$user_account_details = json_decode(file_get_contents($url));

$account_id = $user_account_details->account_id;

//Get uid
$url_uid = MAIN_HOST . 'user/get_uid?user_id=' . $user_id . '&account_id=' . $account_id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_uid);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSLVERSION, 3);

$uid = json_decode(curl_exec($ch));
curl_close($ch);

//$uid = json_decode(file_get_contents($url_uid));

update_option('kudobuzz_uid', $uid);
?>

<div class="main-wrapper" style="padding-top: 30px">
    <p class="main-title">Success</p>
    <p>Your registration has been successfull. Please login to the dashboard now.</p>
    <a href="<?php echo MAIN_HOST ?>login" class="btn btn-info">Login to Dashboard</a>
</div>
