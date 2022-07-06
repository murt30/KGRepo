<?php

//require_once('includes/boot.php');


$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);

//$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[page_size]=1";

$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[filter_groups][0][filters][0][field]=sku&searchCriteria[filter_groups][0][filters][0][value]=EJ/BH7&searchCriteria[filter_groups][0][filters][0][condition_type]=eq";

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
    echo json_encode($res);
	//echo json_encode($res['items'][0]['hotspot']);
	$newRes=json_encode($res);
	
	//echo ($res['items'][0]['sku']);
   // echo $newRes;
} catch (OAuthException $E) {
    echo "Exception caught!\n";
    echo "Response: ". $E->lastResponse . "\n";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store product lightbox demo</title>
    <script src='https://static.matterport.com/showcase-sdk/latest.js'></script>
    <link
            rel="stylesheet"
            href="fancybox/fancybox.css"
    />
	<!-- href="@fancyapps/ui/dist/fancybox.css"-->
	<style> 
	h2 
	{
		color:black;
		font: 13px verdana ;
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

<h2> Store product lightbox demo</h2>
<!--<iframe
        width="853"
        height="480"
        src="https://my.matterport.com/show?m=<?php echo $_ENV['MP_MODEL_SID']; ?>&play=1&applicationKey=<?php echo $_ENV['MP_SDK_KEY']; ?>"
        allow="fullscreen; vr"
        id="showcase-iframe">
</iframe>
-->

<!--allow="fullscreen; vr"-->

<!--Move the iframe below outside the first div-->
<div >
<div id="cartContents" style ="border:solid red 1px; width:10%; float:left; display:none; ">sdfsdfsdfsd</div>
<div>
	<iframe
  width="853"
  height="480" 
  src="https://my.matterport.com/show?m=hRGUfhBhQuD&qs=1&play=1"
  frameborder="0"
  
  id="showcase-iframe"
  donotallowfullscreen>
</iframe></div>
<!-- Cart Modal Contents -->
<div id="cart-modal" style="display:none; width:400px; max-width:600px; height:500px;">

 <iframe src="cartmurt.php" frameborder="0" width="400" height="500"></iframe>
    
</div>
<!-- END Cart Modal Contents -->
<!-- Product Modal Contents -->
<div id="product-modal" style="display:none; width:360px; max-width:600px; height:800px;">

   
    <img id="product_image" src="" width="200px" align="center">
    <h2 id="title"></h2>
    <p id="description"></p>
    <h4 id="price" ></h4>
    <p>
		<button ><a id="cart"></a></button> <button > <a id="viewcart"> </a></button>
    </p>
</div>
<!-- END Product Modal Contents -->

<!--<script src="@fancyapps/ui/dist/fancybox.umd.js"></script>-->
<script src="fancybox/fancybox.umd.js"></script>
<script>
    (async function connectSdk() {
        var sdkKey = '8kuqzfci2mi4hyqug67zsr96c';
        var iframe = document.getElementById('showcase-iframe');
        var data;

        // connect the sdk; log an error and stop if there were any connection issues
        try {
            const mpSdk = await window.MP_SDK.connect(
                iframe,
                sdkKey,
                '' // Unused but needs to be a valid string
            );
            onShowcaseConnect(mpSdk);
        } catch (e) {
            console.error(e);
        }
    })();

    async function onShowcaseConnect(mpSdk) {

        async function doModal(sid) {

            // TODO clear all fields on close/launch

            const tags = await mpSdk.Mattertag.getData();
            const tag = tags.find((tag) => {
                return tag.sid === sid;
            });

            console.log("Clicked " + tag.label + ' | ' + tag.description);

            const selected_product = data.items.find((item) => {
                return item.sku === tag.description;
            });

            // add data to modal

            // name
            document.getElementById("title").innerHTML = selected_product.name;

            // price
            document.getElementById("price").innerHTML = "€"+selected_product.price;
			
			// add to cart
            document.getElementById("cart").innerHTML = "Add to Cart";
			
			
			/*document.getElementById("cart").href ="http://kgoauth.eu-west-1.elasticbeanstalk.com/addtocartmurt.php?sku="+tag.description;
			*/
			document.getElementById("cart").onclick = function() {myAddFunction()};
			
			// show cart contents
            document.getElementById("viewcart").innerHTML = "View Cart";
			document.getElementById("viewcart").onclick = function() {myViewFunction()};

			async function myAddFunction() {
				//console.log("sku="+tag.description);
				const response = await fetch('addtocartmurt.php?sku='+tag.description);
				//console.log("response = "+response);
			//	data = await response.json();
				//console.log("data = "+data); 
				 /*response.json().then((data) => {
                 //console.log(data);
    });*/
			}
            async function myViewFunction() {
				Fancybox.show([
                {
                    
					src: "#cart-modal",
                    modal: true,
					
                },
            ]);
			document.getElementById("cartContents").style.visibility='visible';
			}
            
            // Get the desc from custom_attributes
            document.getElementById("description").innerHTML = selected_product['custom_attributes'].find(element => element.attribute_code == 'short_description').value;//.replace(/(<([^>]+)>)/gi, "");

            // Get the image from custom_attributes

            const image = selected_product['custom_attributes'].find(element => element.attribute_code == 'image').value;
            document.getElementById("product_image").src = 'https://www.kilkennyshop.com/media/catalog/product/' + image;
			/*document.getElementById("product_image").src = '<?php echo $_ENV['BASE_URL']; ?>/media/catalog/product/' + image;*/


            //show modal
            Fancybox.show([
                {
                    src: "#product-modal",
                    modal: true,
					
                },
            ]);

        }

        try {

            // on add prevent open (navigation ??)
            mpSdk.Mattertag.data.subscribe({
                onAdded: (index, item, collection) => {

                    // Prevent the default opening behavior
                    mpSdk.Mattertag.preventAction(item.sid, {
                        //navigating: true,
                        opening: true
                    });
                }
            });

            // add on click modal open
            mpSdk.on(mpSdk.Mattertag.Event.CLICK, doModal);

            const response = await fetch('getdata.php');

            data = await response.json();

            var mattertags = [];

            data.items.forEach(function (item, index) {

                console.log("Added " + item);

                mattertags.push({
                        label: item.name,
                        description: item.sku, // hacky AF - storing the SKU in the description field
                        anchorPosition: {x: 2, y: .5, z: -1},
                        stemVector: {x: 0, y: 0, z: 0}
                    }
                );
            });

            if (response) {

                mpSdk.Mattertag.add(mattertags).then(function (mattertagIds) {
					
                    //console.log(mattertagIds);
					
                });

            }

        } catch (e) {
            console.error(e);
        }
    }

</script>

</body>
</html>