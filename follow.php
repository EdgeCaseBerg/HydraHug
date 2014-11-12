<?php
session_start();
include dirname(__FILE__) . '/twitteroauth/config.php';
include dirname(__FILE__) . '/twitteroauth/twitteroauth/twitteroauth.php';

if(!isset($_GET['twitter_id']) || !is_numeric($_GET['twitter_id'])){
    die('Invalid Twitter Id');
}

$_SESSION['state'] = 'follow';
$_SESSION['owner_id'] = intval($_GET['twitter_id']);

header('Location: ./twitteroauth/redirect.php');
?>