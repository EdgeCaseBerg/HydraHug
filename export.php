<?php
include './twitteroauth/config.php';
include ('./twitteroauth/twitteroauth/twitteroauth.php');

if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./twitteroauth/clearsessions.php');
}

$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
if (!is_object($twitter)) {
    error_log('Error creating TwitterOAuth object');
    exit (-1);
}
$twitter->host = 'https://api.twitter.com/1.1/';

$cursor = -1; // first page
$follower_total = 0;
$followerIds = array();
while ($cursor != 0) {
	$params = array(
        'stringify_ids' => true,
        'count' => 100,
        'cursor' => $cursor,
    );

    $followers = $twitter->get('followers/ids', $params);
    if (!is_object($followers) || isset($followers->errors)) {
        error_log ("Error retrieving followers");
        print_r($followers);
        exit (-1);
    }

   
    $followerIds = array_merge($followerIds, $followers->ids);
    $cursor = $followers->next_cursor_str;
    $follower_total += count($followers->ids);
}

$strIds = implode(',', $followerIds);
?>
<h1>Your follower Ids:</h1>
<p>
	Simply copy and paste this list into a txt file. Then you'll be able
	to share your followers with your friends!
</p>
<code><?php echo $strIds  ?></code>
