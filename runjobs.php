<?php

include './twitteroauth/twitteroauth/config.php';
include ('./twitteroauth/twitteroauth/twitteroauth.php');

$dblink = mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $dblink);

/* Get unfinished jobs */

/* Retrieve credentials for users */

/* Iterate through "to follows" from database */

        $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        if (!is_object($twitter)) {
            error_log('Error creating TwitterOAuth object');
            exit (-1);
        }       
        $twitter->host = 'https://api.twitter.com/1.1/';

        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        if(is_null($userId) || !is_numeric($userId)){
            die('Invalid Id');
        }
        $params = array(
            'user_id' => $userId,
            'follow' => true
        );

        $followed = $twitter->post('friendships/create', $params);
        if (!is_object($followed) || isset($followed->errors)) {
            //err
        } else {

        }

mysql_close($dblink);
?>