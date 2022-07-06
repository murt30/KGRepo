<?php

//require_once('includes/boot.php');
require_once('includes/session.php');

header("Content-Type: application/json");

$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);
//print_r($_GET);
//Check SKU
if(!isset($_GET['sku'])){
    echo '{"message":"No SKU passed"}';
    exit();
}

//set SKU
$SKU = $_GET['sku'];
//$SKU = "MLG/QOK130";
//echo $SKU;
// construct payload
$payload = array(
    "cartItem" => array(
            "sku" => $SKU,
            "qty" => 1,
            "quoteId" => $_SESSION['cart_id']
    )
);
/*foreach ($payload as $x=>$key){
foreach ($key as $y=>$value){
echo "$y=$value\n";
}
}*/
//$url = $_ENV['API_BASE_URL']."guest-carts/".$_SESSION['cart_id']."/items";
$url = "https://staging.kilkennyshop.com/rest/V1/guest-carts/".$_SESSION['cart_id']."/items";

//echo $url;

try {
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    // Payload -> json
    $oauth->fetch($url, json_encode($payload), OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json'));

    $response_info = $oauth->getLastResponseInfo();

    $items = $oauth->getLastResponse();
//echo $items;

} catch (OAuthException $E) {
    //echo "Exception caught!\n";
    echo $E->lastResponse;
}
?>