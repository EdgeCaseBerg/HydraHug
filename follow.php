<?php
session_start();
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

        $followed = $twitter->post('friendships/create', $params);
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
        <noscript>You need to turn on Javascript for this whole thing to work</noscript>
        <form method="POST">
            <textarea name="user_id"></textarea>
        </form>
        <input id="submit" type="submit" value="Submit"/>
        <div id="followed"></div>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js"></script>
        <script type="text/javascript">
            var textArea = document.getElementsByTagName('textarea')[0]
            

            function processlist(){
                var user_ids = textArea.value.split(',') //we're not really going crazy here with validaton.
                var handlePost = function(error, text) { 
                    d3.select("#followed").append(text)
                    textArea.value = user_ids.join(',')

                    if(user_ids.length > 0){
                        initiateFollowing()//process next id
                    }
                }

                function initiateFollowing(){
                    var id = user_ids.pop()
                    d3.text("/follow.php")
                        .header("Content-type", "application/x-www-form-urlencoded")
                        .post("user_id=" + id, handlePost);
                }
                initiateFollowing()
            }
            document.getElementById('submit').onclick=processlist
        </script>
        <?php
        break;
}
?>