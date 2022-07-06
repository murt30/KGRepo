<?php

require_once('includes/boot.php');
require_once('includes/session.php');

#get cart items


$url = $_ENV['API_BASE_URL']."guest-carts/".$_SESSION['cart_id']."/items";

try {
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    $oauth->fetch($url, null, OAUTH_HTTP_METHOD_GET);

    $response_info = $oauth->getLastResponseInfo();

    $items = json_decode($oauth->getLastResponse());


} catch (OAuthException $E) {
    echo "Exception caught!\n";
    echo "Response: ". $E->lastResponse . "\n";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart demo</title>

</head>
<body>

<h2>Cart demo</h2>

<h4> Cart id: <?php echo $_SESSION['cart_id']; ?> </h4>

<h4> Cart Items:</h4>

<?php


if(!$items){
    echo "No items in cart";
}else{
    //todo
}
?>


</body>
</html>