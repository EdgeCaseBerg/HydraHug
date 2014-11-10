<?php
include './twitteroauth/config.php';
include ('./twitteroauth/twitteroauth/twitteroauth.php');

if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./twitteroauth/clearsessions.php');
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
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

        $followed = $twitter->get('friendships/create', $params);
        if (!is_object($followed) || isset($followed->errors)) {
            echo json_encode($followed);
            exit();
        }
        echo '<img src="'.$followed->profile_image_url.'">';
        break;
    default:
        ?>
        <h1>Follow a list</h1>
        <p>
        Use the list a friend has exported to follow each friend!
        </p>
        <form>
            <input name="user_id">
        </form><?php
        break;
}
?>