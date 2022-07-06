<?php

/*require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
*/
/*$_ENV['API_BASE_URL']=
$config = array(
    'consumer_key' => $_ENV['CONSUMER_KEY'],
    'consumer_secret' => $_ENV['CONSUMER_SECRET'],
    "access_token" => $_ENV['ACCESS_TOKEN'],
    "access_token_secret" => $_ENV['ACCESS_TOKEN_SECRET']
);*/
$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);

//$url = $_ENV['API_BASE_URL']."products?searchCriteria[page_size]=5";
//$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[page_size]=3";
$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[filter_groups][0][filters][0][field]=sku&searchCriteria[filter_groups][0][filters][0][value]=FF4012/B2&searchCriteria[filter_groups][0][filters][0][condition_type]=eq";


try {
	
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    $oauth->fetch($url);
    
    $response_info = $oauth->getLastResponseInfo();
    header("Content-Type: {$response_info["content_type"]}");
    $res = json_decode($oauth->getLastResponse(), true);

    /*foreach($res['items'] as $k => $v){
        $res['items'][$k]['hotspot'] = ['x' => rand(0,2), 'y' => rand(0,2), 'z' => rand(0,2), 'h' => rand(1,5)];
    }*/

    header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($res);
	//echo json_encode($res['items'][0]['hotspot']);
	$newRes=json_encode($res);
    echo $newRes;
} catch (OAuthException $E) {
    echo "Exception caught!\n";
    echo "Response: ". $E->lastResponse . "\n";
}


?>