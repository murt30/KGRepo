<?php
$config = array(
    'consumer_key' => '8ics7abf6du66yombm6e9vz28ngy197l',
    'consumer_secret' => 'w061vggb8zwe29zlbt38dgwca48cqcr0',
    "access_token" => 'ugpgj6q6i34qjfbjxxtr2q14hhegq0ju',
    "access_token_secret" => 'hva84obl345escticpw8yu5aiz66xrk6'
);

//$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[page_size]=5";
$url = "https://staging.kilkennyshop.com/rest/V1/products?searchCriteria[filter_groups][0][filters][0][field]=sku&searchCriteria[filter_groups][0][filters][0][value]=MLG/QOK130&searchCriteria[filter_groups][0][filters][0][condition_type]=eq";

try {
	
    $oauth = new OAuth($config['consumer_key'], $config['consumer_secret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);

    $oauth->setToken($config['access_token'], $config['access_token_secret']);

    $oauth->fetch($url);
    
    $response_info = $oauth->getLastResponseInfo();
   //header("Content-Type: {$response_info["content_type"]}");
    $res = json_decode($oauth->getLastResponse(), true);

    foreach($res['items'] as $k => $v){
        $res['items'][$k]['hotspot'] = ['x' => rand(-2,2), 'y' => rand(0,0), 'z' => rand(-4,.1), 'h' => rand(0,1)];
    }
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
	<script src="https://static.matterport.com/showcase-sdk/latest.js"></script>
  </head>

  <body>
    <div id="text"></div>
    <button id="button" type="button">Get Position</button>
    <!--<iframe id="showcase" title="test" frameBorder="0" allowFullScreen allow="xr-spatial-tracking"></iframe>-->
	<iframe
  width="853"
  height="480"
  src="https://my.matterport.com/show?m=hRGUfhBhQuD&play=1"
  frameborder="0"
  allow="fullscreen; vr"
  id="showcase-iframe">
</iframe>
<label>x:
    <input type="text" id="x">
</label>
<label>y:
    <input type="text" id="y">
</label>
<label>z:
    <input type="text" id="z">
</label>
  </body>
  <script>

var iframe = document.getElementById('showcase-iframe');
var text = document.getElementById('text');
var button = document.getElementById('button');


// this key only works from jsfiddle.
//var jsFiddleKey = "6eb9607db19546aebe10dce90aa001fa";
var sdkVersion = "3.5";
var modelSid = "hRGUfhBhQuD";
var sdkKey = '8kuqzfci2mi4hyqug67zsr96c';
/*
const getOAuthData = ({ consumer_key: key, consumer_secret: secret }) => {
 return OAuth({
  consumer: { key, secret },
  signature_method: 'HMAC-SHA1',
  hash_function: hashFunction
 })
}*/

function pointToString(point) {
  var x = point.x.toFixed(3);
  var y = point.y.toFixed(3);
  var z = point.z.toFixed(3);

  return `{ x: ${x}, y: ${y}, z: ${z} }`;
}

//iframe.src = `https://my.matterport.com/show?m=hRGUfhBhQuD&play=1`;

window.MP_SDK.connect(iframe, sdkKey,'').then(async function(theSdk) {
  var sdk = theSdk;
  console.log('SDK Connected!');


 // murt code
 let desc = "gdfg";
 
//end murt code
var coordinates= <?php echo $newRes; ?>;
const obj = <?php echo $newRes; ?>;    // json encoded
const jsobj = <?php echo $res; ?>;     // json decoded
/*console.log(obj["items"][0]["hotspot"]);
console.log(obj["items"][1]["hotspot"]);
console.log(obj["items"][2]["hotspot"]);
const hs0x=obj["items"][0]["hotspot"]["x"];
const hs0y=obj["items"][0]["hotspot"]["y"];
const hs0z=obj["items"][0]["hotspot"]["z"];
const hs1x=obj["items"][1]["hotspot"]["x"];
const hs1y=obj["items"][1]["hotspot"]["y"];
const hs1z=obj["items"][1]["hotspot"]["z"];
const hs2x=obj["items"][2]["hotspot"]["x"];
const hs2y=obj["items"][2]["hotspot"]["y"];
const hs2z=obj["items"][2]["hotspot"]["z"];*/

/*const test = "<?php echo  ($res['items'][0]['custom_attributes'][7]['value'])+($res['items'][0]['custom_attributes'][11]['value'])+($res['items'][0]['custom_attributes'][16]['value']);?>";*/

const test = <?php echo  ($res['items'][0]['custom_attributes'][7]['value']/*/**/);?>;
console.log("obj is a "+typeof obj);

 obj.items.forEach(function (item, index) {
	 console.log(typeof item);
	 console.log(index);
	 //console.log("item id ="+item.extension_attributes.website_ids);
     //console.log("item id ="+item.custom_attributes[0]);
	 const xval = item.custom_attributes.find(element=>element.attribute_code=='attr_x').value;
	 const yval = item.custom_attributes.find(element=>element.attribute_code=='attr_y').value;
	 const zval = item.custom_attributes.find(element=>element.attribute_code=='attr_z').value;
	 console.log("xval= "+xval+" yval= "+yval+" zval= "+zval);
	 item.custom_attributes.forEach(function(item,index){
		 //console.log(item);
		 //console.log("attribute_code = "+item.attribute_code);
		 if (item.attribute_code == "attr_x" ){
			
			//const image = item['custom_attributes'].find(element => element.attribute_code == 'image').value;
			 
		 }
		
	 });
 });
 
 obj.items.forEach(function (item,index){
	 
 });
	 //[items]['custom_attributes'].find(element => element.attribute_code == 'attr_x').value;
 

 /*test.items.forEach(function (item, index) {

                // Get the image from custom_attributes
                const x = item['custom_attributes'].find(element => element.attribute_code == 'attr_x').value;
				
				//console.log(x);
 });
console.log(test);*/
//console.log("array length="+test.length);
/*for (var i = 0; i < test.length; i++){
    console.log(test[i]);
}*/
//console.log("This is a type of "+typeof test);
//console.log(test);
//console.log("obj is a type of "+typeof obj);
/*Object.keys(obj).forEach(key => {
  console.log(key); // 👉️ name, country
  console.log(obj[key]); // 👉️ James, Chile
const x = [items]['custom_attributes'].find(element => element.attribute_code == 'attr_x').value;
				
				console.log("x"+x);
});*/

Object.entries(obj).forEach(([key, value]) => {
	//console.log(key); // 👉️ name, country
	//console.log(value); // 👉️ James, Chile
	//console.log("This is a type of "+typeof value);
		Object.entries(value).forEach(([key, value1]) => {
		//console.log(key); // 👉️ name, country
		//console.log(value); // 👉️ James, Chile
		//console.log("This is a type of "+typeof value);
			Object.entries(value1).forEach(([key, value2]) => {
				//console.log("value2 is a type of "+typeof value2);
			//console.log(key); // 👉️ name, country
			//console.log(value2); // 👉️ James, Chile
			//console.log("Value2 is a type of "+typeof value2);
			});
		//	console.log("value2 end");
			if ((typeof value2 === "object")|| (typeof value2 === "array") || (typeof value2 != "")) { 
			//console.log("VALUE2");
			if (typeof value2 === "object"){
				value2.forEach(([key, value3]) => {
					//console.log("Value3 is a type of "+typeof value3);
				//console.log(key); // 👉️ name, country
				//console.log(value3); // 👉️ James, Chile
				
			});}}
			if (typeof value3 === "array"){ 
				value3.forEach(([key, value4]) => {
				console.log(key); // 👉️ name, country
				console.log(value4); // 👉️ James, Chile
				console.log("This is a type of "+typeof value);
			});}
		});
	});
/*const john = Object.values(obj);
const joe = john.find(element => element.attr_x);
console.log(john);*/
//console.log(joe);
//const newArray = john.filter(element => element.attr_x );
//console.log(newArray);

//const x = john.find(element => element.attribute_code == 'attr_x');
//console.log(x);
/*obj.foreach(function (item, index) {

                // Get the image from custom_attributes
                const x = item['custom_attributes'].find(element => element.attribute_code == 'attr_x').value;
				
				console.log(x);
});*/


/*const coordinates2=<?php foreach($res['items'] as $k => $v){

echo $newres['items'][$k]['hotspot']; }?>;
*/
//console.log(coordinates['items'][0]['sku']);

 const API = {"tag1":{"sid":"FKBR8cR1iR8",
 "label":"Guess Handbags and Accessories",
 "description": "Such a sophisticated staple, the Guess Hensely shoulder bag has a coated exterior with 4g logo detail and plenty of internal space for all your necessities. 100% polyurethane  Measurements: 27.5cm x 17.5cm x 8cm Handle length: 45cm approx. ",
 "price":"€105"},
 "tag2":{"sid":"FKBR8cR1iR9",
 "label":"Paul Maloney Pottery Teal Carafe",
 "description": "A beautiful addition to your table. Serve water or even wine from this carafe. Cool white glaze with a matt grey slip and a unique linear white surface treatment. As it is handmade, slight variations may occur in size and colour. \n Information:  Handmade in Ireland \nCapacity: 660ml \nCare Instructions: All pieces are dishwasher safe  \nAdditional Information:  Handmade in Ireland",
 "price":"€52"}
 };
 
  // Murt tag code
  var mattertagDesc =[{
    "sid": "fFh82H8T9ir",
    "label": "<?php echo ($res['items'][0]['name']);?>",
    "description": "<?php echo ($res['items'][0]['custom_attributes'][19]['value']);?>",
    "parsedDescription": [],
    "mediaSrc": "",
    "mediaType": "mattertag.media.none",
    "media": {
      "type": "mattertag.media.none",
      "src": ""
    },
    "anchorPosition": {
      "x": "hs0x",  //Added quotes to supress errors
      "y": "hs0y",
      "z": "hs0z"
    },
    "anchorNormal": {
      "x": 0,
      "y": 1,
      "z": 0
    },
    "color": {
      "r": .5,
      "g": .5,
      "b": 0
    },
    "enabled": true,
    "floorId": 0,
    "floorIndex": 0,
    "floorInfo": {
      "id": "0",
      "sequence": 0
    },
    "stemVector": {
      "x": 0,
      "y": 0.9,
      "z": 0
    },
    "stemHeight": 0.33,
    "stemVisible": true
  },
  {
    "sid": "gFh82H8T9ir",
    "label": API.tag2.label,
    "description": API.tag2.price +"\n"+ API.tag2.description,
    "parsedDescription": ["sdfsdfdsfs"],
    "mediaSrc": "",
    "mediaType": "mattertag.media.none",
    "media": {
      "type": "mattertag.media.none",
      "src": ""
    },
    "anchorPosition": {
      "x": "hs1x",
      "y": "hs1y",
      "z": "hs1z"
    },
    "anchorNormal": {
      "x": 0,
      "y": 1,
      "z": 0
    },
    "color": {
      "r": 0.5,
      "g": 0.5,
      "b": 0
    },
    "enabled": true,
    "floorId": 0,
    "floorIndex": 0,
    "floorInfo": {
      "id": "0",
      "sequence": 0
    },
    "stemVector": {
      "x": 0,
      "y": 0.9,
      "z": 0
    },
    "stemHeight": 0.00,
    "stemVisible": true
  },
  {
    "sid": "pFh82H8T9ir",
    "label": "hotspot1",
    "description": desc,
    "parsedDescription": ["sdfsdfdsfs"],
    "mediaSrc": "",
    "mediaType": "mattertag.media.none",
    "media": {
      "type": "mattertag.media.none",
      "src": ""
    },
    "anchorPosition": {
      "x": "hs2x",
      "y": "hs2y",
      "z": "hs2z"
    },
    "anchorNormal": {
      "x": 0,
      "y": 1,
      "z": 0
    },
    "color": {
      "r": 0.5,
      "g": 0.5,
      "b": 0
    },
    "enabled": true,
    "floorId": 0,
    "floorIndex": 0,
    "floorInfo": {
      "id": "0",
      "sequence": 0
    },
    "stemVector": {
      "x": 0,
      "y": 0.9,
      "z": 0
    },
    "stemHeight": 0.00,
    "stemVisible": true
  },
  {
    "sid": "gFh82H8T9ip",
    "label": "test",
    "description": "test",
    "parsedDescription": ["sdfsdfdsfs"],
    "mediaSrc": "",
    "mediaType": "mattertag.media.none",
    "media": {
      "type": "mattertag.media.none",
      "src": ""
    },
    "anchorPosition": {
      "x": 18.222015948893196,
      "y": 0.004941925699249783,
      "z": -14.7469546836959627
    },
    "anchorNormal": {
      "x": 0,
      "y": 1,
      "z": 0
    },
    "color": {
      "r": 0.5,
      "g": 0.5,
      "b": 0
    },
    "enabled": true,
    "floorId": 0,
    "floorIndex": 0,
    "floorInfo": {
      "id": "0",
      "sequence": 0
    },
    "stemVector": {
      "x": 0,
      "y": 0.9,
      "z": 0
    },
    "stemHeight": 0.00,
    "stemVisible": true
  },
  {
    "sid": "gFh82H8T9ir",
    "label": "Another tag",
    "description": "Tag description",
    "parsedDescription": ["sdfsdfdsfs"],
    "mediaSrc": "",
    "mediaType": "mattertag.media.none",
    "media": {
      "type": "mattertag.media.none",
      "src": ""
    },
    "anchorPosition": {
      "x": -9.222015948893196,
      "y": 0.004941925699249783,
      "z": 0.5469546836959627
    },
    "anchorNormal": {
      "x": 0,
      "y": 1,
      "z": 0
    },
    "color": {
      "r": 0.5,
      "g": 0.5,
      "b": 0
    },
    "enabled": true,
    "floorId": 0,
    "floorIndex": 0,
    "floorInfo": {
      "id": "0",
      "sequence": 0
    },
    "stemVector": {
      "x": 0,
      "y": 0.9,
      "z": 0
    },
    "stemHeight": 0.00,
    "stemVisible": true
  }
]

  /*sdk.Mattertag.editBillboard(mattertagId, {
  description:"[Link to Matterport site!](https://www.matterport.com)",
});*/

  sdk.Mattertag.add(mattertagDesc).then(function(mattertagId) {
   // console.log(mattertagDesc);
    // output: TODO
  });
  
  
 

  // End tag code

  var poseCache;
  sdk.Camera.pose.subscribe(function(pose) {
    poseCache = pose;
  });

  var intersectionCache;
  sdk.Pointer.intersection.subscribe(function(intersection) {
   // console.log(intersection);
    intersectionCache = intersection;
    intersectionCache.time = new Date().getTime();
    button.style.display = 'none';
    buttonDisplayed = false;
  });

  var delayBeforeShow = 1000;
  var buttonDisplayed = false;
  setInterval(() => {
    if (!intersectionCache || !poseCache) {
      return;
    }

    const nextShow = intersectionCache.time + delayBeforeShow;
    if (new Date().getTime() > nextShow) {
      if (buttonDisplayed) {
        return;
      }

      var size = {
        w: iframe.clientWidth,
        h: iframe.clientHeight,
      };
      var coord = sdk.Conversion.worldToScreen(intersectionCache.position, poseCache, size);
      button.style.left = `${coord.x - 25}px`;
      button.style.top = `${coord.y - 22}px`;
      button.style.display = 'block';
      buttonDisplayed = true;
    }
  }, 16);

  button.addEventListener('click', function() {
    text.innerHTML = `position: ${pointToString(intersectionCache.position)}\nnormal: ${pointToString(intersectionCache.normal)}\nfloorId: ${intersectionCache.floorId}`;
    button.style.display = 'none';
    iframe.focus();
  });
});


</script>

</html>







