<?php

//require_once('includes/boot.php');
require_once('includes/session.php');
require_once('includes/jwt_utils.php');


$headers = array('alg'=>'HS256','typ'=>'JWT');
$payload = array('apiCartId'=>$_SESSION['cart_id']);


$jwt = generate_jwt($headers, $payload);

//echo $jwt;

#get cart items
$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);

//$url = $_ENV['API_BASE_URL']."guest-carts/".$_SESSION['cart_id']."/items";


$url = "https://staging.kilkennyshop.com/rest/V1/guest-carts/".$_SESSION['cart_id']."/items";

//echo $_SESSION['cart_id'];

try {
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    $oauth->fetch($url, null, OAUTH_HTTP_METHOD_GET);

    $response_info = $oauth->getLastResponseInfo();

    $items = json_decode($oauth->getLastResponse());
    $itemsTest = json_encode($oauth->getLastResponse());

} catch (OAuthException $E) {
    echo "Exception caught!\n";
    echo "Response: ". $E->lastResponse . "\n";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
<style> 
	h2 
	{
		color:black;
		font: bold 16px verdana;
		background-color:grey;
		padding:4px;
	} 
	p
	{
		font: 12px  verdana;
	}
	h4 
	{
		
		font: verdana;
	} 
	a
	{
		color:black;
		text-decoration: none;
	}
	
	</style>
</head>
<body>
<div style="margin:0px; position:absolute;">
<div style="height:300px;">
<h2>Cart Contents</h2>
<!--<h4> Cart id: <?php echo $_SESSION['cart_id']; ?> </h4>-->
<!--<h4> Cart Items:</h4>-->
<!--<button id="cartButton"><a id="cart"></a>Add</button>-->


<?php


if(!$items){
    echo "No items in cart";
  }
  else
  {    
	if ($items!=null){
		echo "<br>";
		//echo is_array($items) ? 'Array' : 'not an Array';
		
		foreach($items as $val) {
           foreach ($val as $key=>$value){
			   //echo ($key."=".$value);
			   ///echo "<br>";
			   if ($key=="item_id" ){
				  $item_id = $value;
			   }
			   if ($key=="price" ){
				  $price = $value;
			   }
			   if ($key=="qty" ){
				  $qty = $value;
			   }
			   if ($key=="name" ){
				  $name = $value;
			   }
		   }
        }
		echo ($name);
		echo (" : ".$qty." ");
		echo (" Total: ".$qty*$price." ");
		print "<button id=\"cartRemove\" > Remove</button>";
		
	}	
  }
?>
</div>
<div>

<button id="checkout" > Checkout</button>
</div>
<script>

 /*document.getElementById("cartButton").onclick = function() {myAddFunction()};

async function myAddFunction() {
	console.log(<?php echo $item_id; ?>);
	//const response = await fetch('addtocartmurt.php');
    //data = await response.json();
    //console.log("data = "+data);  
}
*/

document.getElementById("cartRemove").onclick = function() {myRemoveFunction()};

async function myRemoveFunction() {
	
	const response = await fetch('removefromcartmurt.php?item_id=<?php echo $item_id; ?>');
    
}

document.getElementById("checkout").onclick = function() {checkoutFunc(event)};

async function checkoutFunc(event) {
	
	url="https://staging.kilkennyshop.com/checkout/?sk=<?php echo $jwt;?>#shipping";
    event.preventDefault();
	window.open(url,'_blank');
    /*fetch(url, {method: "POST"}).then(() => {
        window.location.href = url; //event.target.href;
    });*/
}

        
</script>

</body>
</html>