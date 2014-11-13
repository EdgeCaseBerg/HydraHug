<?php
$conf = json_decode(file_get_contents( dirname(__FILE__) . './../../conf.json'));
define ('CONSUMER_KEY', $conf->apiKey);
define ('CONSUMER_SECRET', $conf->apiSecretKey);
define ('OAUTH_TOKEN', $conf->accessToken);
define ('OAUTH_TOKEN_SECRET', $conf->accessSecret);
if(isset($_SERVER['SERVER_NAME'])){
	define ('OAUTH_CALLBACK', 'http://' . $_SERVER['SERVER_NAME'] . '/twitteroauth/callback.php' );
}
define ('DB_NAME', $conf->dbname);
define ('DB_USER',$conf->dbuser);
define ('DB_PASS',$conf->dbpass);
define ('DB_HOST',$conf->dbhost);

?>