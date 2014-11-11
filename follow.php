<?php
session_start();
include './twitteroauth/twitteroauth/config.php';
include ('./twitteroauth/twitteroauth/twitteroauth.php');

if(!isset($_GET['twitter_id']) || !is_numeric($_GET['twitter_id'])){
    die('Invalid Twitter Id');
}

$_SESSION['state'] = 'follow';
$_SESSION['owner_id'] = intval($_GET['twitter_id']);

header('Location: ./twitteroauth/redirect.php');
?>