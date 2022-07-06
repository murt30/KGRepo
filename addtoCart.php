<?php

require_once('includes/boot.php');
require_once('includes/session.php');

header("Content-Type: application/json");

//Check SKU
if(!isset($_GET['sku'])){
    echo '{"message":"No SKU passed"}';
    exit();
}

//set SKU
$SKU = $_GET['sku'];

// construct payload
$payload = array(
    "cartItem" => array(
            "sku" => $SKU,
            "qty" => 1,
            "quoteId" => $_SESSION['cart_id']
    )
);

$url = $_ENV['API_BASE_URL']."guest-carts/".$_SESSION['cart_id']."/items";

try {
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    // Payload -> json
    $oauth->fetch($url, json_encode($payload), OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json'));

    $response_info = $oauth->getLastResponseInfo();

    $items = $oauth->getLastResponse();


} catch (OAuthException $E) {
    //echo "Exception caught!\n";
    echo $E->lastResponse;
}
?>