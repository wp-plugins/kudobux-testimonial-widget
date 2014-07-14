<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$kdwp = new Kudobuzzwp();

//Get user account details
$user_account = $kdwp->get_user($kd_uid);
$user_id = $user_account->user_id;
$account_id = $user_account->account_id;
$email = $user_account->user->email;
$account_name = $user_account->account->account_name;
$cname = $user_account->account->cname;
$plan = $user_account->user->plan;

//Get connected social accounts
$social_accounts = json_decode($kdwp->get_social_accounts($kd_uid));

//Check the number of connected accounts
$connected_accounts_url = API_DOMAIN . 'social_connected_accounts?user_id=' . $user_id . '&account_id=' . $account_id;
$connected_accounts = json_decode(file_get_contents($connected_accounts_url));

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
$total_kudos = json_decode(file_get_contents(API_DOMAIN . 'api/kudos/count?account_id=' . $account_id))[0]->total_kudos;
