<?php
$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);

$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[page_size]=20";
/*$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[filter_groups][0][filters][0][field]=sku&searchCriteria[filter_groups][0][filters][0][value]=MLG/QOK130&searchCriteria[filter_groups][0][filters][0][condition_type]=eq";
*/
/*$url="https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[filter_groups][0][filters][0][field]=sku&searchCriteria[filter_groups][0][filters][0][value]=MLG/QOK130&searchCriteria[filter_groups][0][filters][0][condition_type]=eq"
*/
try {
	
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    $oauth->fetch($url);
    
    $response_info = $oauth->getLastResponseInfo();
   //header("Content-Type: {$response_info["content_type"]}");
    $res = json_decode($oauth->getLastResponse(), true);
// ??????????????????????????
    /*foreach($res['items'] as $k => $v){
        $res['items'][$k]['hotspot'] = ['x' => rand(-2,2), 'y' => rand(0,0), 'z' => rand(-4,.1), 'h' => rand(0,1)];
    }*/
//$res['items'][0]['hotspot']=['x' => 2.05201, 'y' => 0.004941, 'z' =>-1.3469 , 'h' => 1];
 //   header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($res);
	//echo json_encode($res['items'][0]['hotspot']);
	$newRes=json_encode($res);
	
	//echo ($res['items'][0]['sku']);
   // echo $newRes;
} catch (OAuthException $E) {
    echo "Exception caught!\n";
    echo "Response: ". $E->lastResponse . "\n";
}
 ?>

<html>

  <head>
    <!--<script src="https://static.matterport.com/showcase-sdk/2.0.1-0-g64e7e88/sdk.js"></script>-->
	<!--<script src="https://static.matterport.com/showcase-sdk/latest.js"></script>-->
  </head>

  <body>
    <div id="text"></div>
    <button id="button" type="button">Get Position</button>
    <!--<iframe id="showcase" title="test" frameBorder="0" allowFullScreen allow="xr-spatial-tracking"></iframe>-->
	<iframe id="showcase" width="740" height="480" src="/bundle/showcase.html?m=hRGUfhBhQuD&play=1&applicationKey=8kuqzfci2mi4hyqug67zsr96c" frameborder=”0” allowfullscreen allow="vr"'></iframe>

	<!--<iframe
  width="853"
  height="480"
  src="https://my.matterport.com/show?m=hRGUfhBhQuD&play=1"
  frameborder="0"
  allow="fullscreen; vr"
  id="showcase-iframe">
</iframe>-->
<label>x:
    <input type="text" id="x">
</label>
<label>y:
    <input type="text" id="y">
</label>
<label>z:
    <input type="text" id="z">
</label>
<button onclick="myFunction()">Test</button>
  
  
  <script>
	const showcase = document.getElementById('showcase');
	const showcaseWindow = showcase.contentWindow;
	showcase.addEventListener('load', async function() {
	let sdk;
	try {
		sdk = await showcaseWindow.MP_SDK.connect(showcaseWindow);
	}
	catch(e) {
		console.error(e);
		return;
	}

	console.log('Hello Bundle SDK', sdk);
});

  </script>
  
  
  <script>




/*
var iframe = document.getElementById('showcase-iframe');
var text = document.getElementById('text');
var button = document.getElementById('button');
*/

// this key only works from jsfiddle.
//var jsFiddleKey = "6eb9607db19546aebe10dce90aa001fa";
/*var sdkVersion = "3.5";
var modelSid = "hRGUfhBhQuD";
var sdkKey = '8kuqzfci2mi4hyqug67zsr96c';*/
/*
const getOAuthData = ({ consumer_key: key, consumer_secret: secret }) => {
 return OAuth({
  consumer: { key, secret },
  signature_method: 'HMAC-SHA1',
  hash_function: hashFunction
 })
}*/

/*var coordinates;
var coordArray;
function pointToString(point) {
  var x = point.x.toFixed(3);
  var y = point.y.toFixed(3);
  var z = point.z.toFixed(3);

  return `{ x: ${x}, y: ${y}, z: ${z} }`;
}*/

//iframe.src = `https://my.matterport.com/show?m=hRGUfhBhQuD&play=1`;

/*window.MP_SDK.connect(iframe, sdkKey,'').then(async function(theSdk) {
  var sdk = theSdk;
  console.log('SDK Connected!');*/
 // murt code
 //let desc = "gdfg";
//end murt code
//coordinates = <?php echo $newRes; ?>;
//coordArray=Array.from(coordinates);
//const obj = <?php echo $newRes; ?>;
//console.log(obj);
//console.log(coordinates['items'].length);
//const test = "<?php echo ($res['items'][0]['custom_attributes'][19]['value']);?>";
///console.log(test);

/*const coordinates2=<?php foreach($res['items'] as $k => $v){

echo $newres['items'][$k]['hotspot']; }?>;
*/
//console.log(coordinates['items'][0]['sku']);


  // Murt tag code


//            var mattertags = [];
//console.log(Array.isArray(coordinates));
  /*          coordinates.items.forEach(function (item, index) {

                // Get the desc from custom_attributes
                const desc = item['custom_attributes'].find(element => element.attribute_code == 'short_description').value;
				var x = (Math.random() * 2)+1;
				var y = 1;
				var z = (Math.random() * 1.5);*/
				//const sku = item.find(element => element.sku == 'short_description').value;
				//MLG/QOK130
				/*if (item.sku=="JSY/LM009"){
				console.log("id="+item.id);
				}
else 
{//console.log("not found yet");
}*/
//console.log("sku = " + item.sku);
                // Get the image from custom_attributes
               // const image = item['custom_attributes'].find(element => element.attribute_code == 'image').value;

               // console.log("Added " + item);

               // console.log(mpSdk.Mattertag.MediaType.PHOTO);


/*anchorPosition: {x: item.hotspot.x, y: item.hotspot.y, z: item.hotspot.z}*/
                /*mattertags.push({
                        label: item.name,
                        description: desc,
                        anchorPosition: {x: x, y: y, z: -z},
                        stemVector: {x: 0, y: .5, z: 0},
                        media: {
                            src: '<?php echo $_ENV['BASE_URL']; ?>media/catalog/product/' + image,
                            type: mpSdk.Mattertag.MediaType.PHOTO,
                        }
                    }
                );*/
 /*           });
			

                sdk.Mattertag.add(mattertags).then(function (mattertagIds) {
                console.log(mattertags);
                });

            

        
});
*/
</script>
</body>
</html>







