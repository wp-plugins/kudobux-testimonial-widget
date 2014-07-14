<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kudobuzzwp
 *
 * @author selomamouzou
 */
ini_set("display_errors", 1);

class Kudobuzzwp {
    /*
     * Run CURL
     */

    function __construct() {
        require_once 'config.php';
    }

    function run_curl($url, $method, $params = NULL) {

        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        if ($params != NULL) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        //Return result
        return $result;
    }

    /*
     * Get feeds
     */

    function get_feeds($type, $page, $category, $social_filter, $uid, $search = NULL) {



        $user_details_url = API_DOMAIN . "api/user/user_account?uid=" . $uid;

        $user_account_details = json_decode(file_get_contents($user_details_url));

        if (!empty($user_account_details->user) || !empty($user_account_details->user) || !empty($user_account_details->account)) {
            $user = $user_account_details->user;
            $account = $user_account_details->account;
            $user_id = $user->id;
            $account_id = $account->id;

            $data = array();

            $data['user_id'] = $user_id;
            $data['account_id'] = $account_id;
            $data["active_tab"] = 'suggested';

            $data['feed_category'] = $category;

            $is_kudos = $data['is_kudos'] = null;

            $url = API_DOMAIN . 'feed/inbox?uid=' . $uid . '&type=' . $type . '&page=' . $page . '&category=' . $category . '&social_filter=' . urlencode($social_filter) . '&is_kudos=' . $is_kudos;

            if (isset($search) && !empty($search)) {
                $url .= "&search=" . $search;
            }
            return json_decode(file_get_contents($url));
        }
    }

    /*
     * Publish fees
     */

    function publish_feed($params) {

        $url = API_DOMAIN . "api/kudos/add";
        $result = $this->run_curl($url, "POST", $params);
        return $result;
    }

    /*
     * Get social accounts
     */

    function get_social_accounts($kd_uid) {

        $user_details_url = API_DOMAIN . "api/user/user_account?uid=" . $kd_uid;

        $user_account_details = json_decode(@file_get_contents($user_details_url));

        $user_id = $user_account_details->user_id;
        $account_id = $user_account_details->account_id;

        $url = API_DOMAIN . "social_connected_accounts?user_id=" . $user_id . "&account_id=" . $account_id;
        return file_get_contents($url);
    }

    /*
     * get user account
     */

    function get_user($kd_uid) {
        
        $user_details_url = API_DOMAIN . "api/user/user_account?uid=" . $kd_uid;

        return json_decode(@file_get_contents($user_details_url));
    }

}
