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
$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[page_size]=1";



try {
	
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    $oauth->fetch($url);
    
    $response_info = $oauth->getLastResponseInfo();
   // header("Content-Type: {$response_info["content_type"]}");
    $res = json_decode($oauth->getLastResponse(), true);

    foreach($res['items'] as $k => $v){
        $res['items'][$k]['hotspot'] = ['x' => rand(0,2), 'y' => rand(0,2), 'z' => rand(0,2), 'h' => rand(1,5)];
    }

 //   header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($res);
	//echo json_encode($res['items'][0]['hotspot']);
	$newRes=json_encode($res);
   // echo $newRes;
} catch (OAuthException $E) {
    echo "Exception caught!\n";
    echo "Response: ". $E->lastResponse . "\n";
}


//header('Content-Type: text/plain; charset=utf-8');
//echo "here";
//echo $res['items'][0]['hotspot']['x'];
//$resH=json_encode($res['items'][0]['hotspot']);
//echo nl2br($resH);

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tag location demo</title>
    <script src='https://static.matterport.com/showcase-sdk/latest.js'></script>
	<style>
	.overlay {
  z-index: 1;  
  background-color: transparent;
  height: 144px;
  left: 450px;
  overflow: hidden;
  position: absolute;
  top: 100px;
  width:306px;
  border:solid red 1px;
}
.overlay a{
	text-decoration:none;
	color:white;
}
.overlay img{
	margin-top:30px;
	width:90px;
}
#showcase-iframe {
  position: relative; 
  z-index: 0;
}
	</style>
</head>
<body>
<h2>Tag location demo</h2>
<!--&applicationKey=8kuqzfci2mi4hyqug67zsr96c-->
<iframe
        width="853"
        height="480"
       
	   src="https://my.matterport.com/show?m=hRGUfhBhQuD&play=1"
        allow="fullscreen; vr"
        id="showcase-iframe">
		
		
</iframe>
<div class="overlay"><a href="">View Cart</a><img src=image.png></div>
<label>x:
    <input type="text" id="x">
</label>
<label>y:
    <input type="text" id="y">
</label>
<label>z:
    <input type="text" id="z">
</label>
<script>
    (async function connectSdk() {
        const sdkKey = '8kuqzfci2mi4hyqug67zsr96c';
		<!--const sdkKey = '<?php echo $_ENV['MP_SDK_KEY']; ?>';-->
        const iframe = document.getElementById('showcase-iframe');

        // connect the sdk; log an error and stop if there were any connection issues
        try {
            const mpSdk = await window.MP_SDK.connect(
                iframe,
                sdkKey,
                '' // Unused but needs to be a valid string
            );
            onShowcaseConnect(mpSdk);
			//alert("connected");
        } catch (e) {
            console.error(e);
        }
    })();



	 
    async function onShowcaseConnect(mpSdk) { 
	
	console.log('SDK Connected!');
	
/*
        try {

            mpSdk.Pointer.intersection.subscribe(function(intersection) {
                document.getElementById("x").value=intersection.position.x;
                document.getElementById("y").value=intersection.position.y;
                document.getElementById("z").value=intersection.position.z;
            });


        } catch (e) {
            console.error(e);
        }*/
		var mattertagDesc =[{
		"sid": "fFh82H8T9ir"}];
		//console.log(mattertagDesc);
	/* var mattertagDesc =[{
	 "sid": "fFh82H8T9ir","anchorPosition": {
      "x": 2.052015948893196,
      "y": 0.004941925699249783,
      "z": -1.3469546836959627
	 }
	 }];*/
	mpSdk.Mattertag.add(mattertagDesc).then(function(mattertagId) {
    console.log(mattertagDesc);
	  });
		
	 /*try {
            var mattertagDesc =[{
	 "sid": "fFh82H8T9ir"/*,"anchorPosition": {
      "x": 2.052015948893196,
      "y": 0.004941925699249783,
      "z": -1.3469546836959627
	 }
	 }]
	 
            mpSdk.Mattertag.add(mattertagDesc).then(function(mattertagId) {
    console.log(mattertagDesc);
    // output: TODO
  });

        } catch (e) {
            console.error(e);
        }*/
	 
    }
	 
</script>

</body>
</html>