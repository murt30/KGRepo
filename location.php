<?php

/*require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tag location demo</title>
    <script src='https://static.matterport.com/showcase-sdk/latest.js'></script>
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

        try {

            mpSdk.Pointer.intersection.subscribe(function(intersection) {
                document.getElementById("x").value=intersection.position.x;
                document.getElementById("y").value=intersection.position.y;
                document.getElementById("z").value=intersection.position.z;
            });


        } catch (e) {
            console.error(e);
        }
    }
</script>

</body>
</html>