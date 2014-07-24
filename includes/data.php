<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('allow_url_fopen', 1);

$kdwp = new Kudobuzzwp();

//Get user account details
$user_account = $kdwp->get_user($kd_uid);

if(isset($user_account->success) && $user_account->success == 0){
    include( plugin_dir_path(__FILE__) . 'new-user-form.php'); exit();
    //die("<div class='alert alert-danger' style='margin-top: 30px; width: 450px;'><h3>Error!</h3>Error message: UID (".$kd_uid.") is invalid. Please contact hello@kudobuzz.com for support.</div>");
}

$user_id = $user_account->user_id;
$account_id = $user_account->account_id;
$email = $user_account->user->email;
$account_name = $user_account->account->account_name;
$cname = $user_account->account->cname;
$plan = $user_account->user->plan;

//Update the site review data
$site_review_data_url = API_DOMAIN.'api/kudos/site-review-data?uid='.$kd_uid;
$site_review_data = json_decode($kdwp->run_curl($site_review_data_url, "GET", NULL));

$site_review_url = get_option('site_review_url');
$site_review_domain = get_option('site_review_domain');
$site_review_logo = get_option('site_review_logo');
$site_review_rating = get_option('site_review_rating');
$site_review_count = get_option('site_review_count');
    
//site_review_url
if(isset($site_review_url)){
	update_option('site_review_url', $site_review_data->url);
}
else{
	add_option('site_review_url', $site_review_data->url);
}

//site_review_domain
if(isset($site_review_domain)){
	update_option('site_review_domain', $site_review_data->domain);
}
else{
	add_option('site_review_domain', $site_review_data->domain);
}

//site_review_logo
if(isset($site_review_logo)){
	update_option('site_review_logo', $site_review_data->site_logo);
}
else{
	add_option('site_review_logo', $site_review_data->site_logo);
}

//site_review_rating
if(isset($site_review_rating)){
	update_option('site_review_rating', $site_review_data->site_review_rating);
}
else{
	add_option('site_review_rating', $site_review_data->site_review_rating);
}

//site_review_count
if(isset($site_review_count)){
	update_option('site_review_count', $site_review_data->site_review_count);
}
else{
	add_option('site_review_count', $site_review_data->site_review_count);
}

//Get connected social accounts
$social_accounts = json_decode($kdwp->get_social_accounts($kd_uid));

//Check the number of connected accounts
$connected_accounts_url = API_DOMAIN . 'social_connected_accounts?user_id=' . $user_id . '&account_id=' . $account_id;

$connected_accounts = $kdwp->run_curl($connected_accounts_url, "GET", NULL);

//number of connected facebook accounts
$fb_num_accounts = $connected_accounts->facebook_accounts;

//number of connected twitter accounts
$tw_num_accounts = $connected_accounts->twitter_accounts;

//number of connected inst accounts
$ins_num_accounts = $connected_accounts->instagram_accounts;

//Total connected accounts
$total_connected = count($fb_num_accounts) + count($tw_num_accounts) + count($ins_num_accounts);

$total_connected = (int) $total_connected;
//Kudos
 $result = json_decode($kdwp->run_curl(API_DOMAIN . 'api/kudos/count?account_id=' . $account_id, "GET"));
 
 $total_kudos = $result[0]->total_kudos;