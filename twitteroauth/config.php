<?php
$conf = json_decode(file_get_contents('../../conf.json'));
define ('CONSUMER_KEY', $conf->apiKey);
define ('CONSUMER_SECRET', $conf->apiSecretKey);
define ('OAUTH_TOKEN', $conf->accessToken);
define ('OAUTH_TOKEN_SECRET', $conf->accessSecret);
?>