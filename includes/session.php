<?php

session_start();

$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);

if (!isset($_SESSION['cart_id']) || $_SESSION['cart_id'] == ''){

   // $url = $_ENV['API_BASE_URL']."guest-carts";
	    $url = "https://staging.kilkennyshop.com/rest/V1/guest-carts";

    // set session cart
//echo "cart id not set\n";
    try {
        $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

        $oauth->setToken($config['access_token'], $config['access_token_secret']);

        $oauth->fetch($url, null, OAUTH_HTTP_METHOD_POST);
		

        $response_info = $oauth->getLastResponseInfo();

        $_SESSION['cart_id'] = trim($oauth->getLastResponse(), "\""); // TODO error checkin

        echo "Session cart ID set ".$_SESSION['cart_id'];

    } catch (OAuthException $E) {
        echo "Session fetch Exception caught!\n";
        echo "Response: ". $E->lastResponse . "\n";
    }

}
else{
    //echo "Session  cart already set".$_SESSION['cart_id'];
}
?>