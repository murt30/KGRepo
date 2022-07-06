<html>

  <head>
    <script src="https://static.matterport.com/showcase-sdk/latest.js"></script>
  </head>

  <body>
    <div id="text"></div>
    <button id="button" type="button">Get Position</button>
   <iframe
  width="853"
  height="480"
  src="https://my.matterport.com/show?m=hRGUfhBhQuD&play=1&applicationKey=8kuqzfci2mi4hyqug67zsr96c"
  frameborder="0"
  allow="fullscreen; vr"
  id="showcase-iframe">
</iframe>
<!--&applicationKey=8kuqzfci2mi4hyqug67zsr96c-->
<script>
const iframe = document.getElementById('showcase-iframe');

  
// connect the sdk; log an error and stop if there were any connection issues
(async function connectSdk() {
try {
  const mpSdk = await window.MP_SDK.connect(
    iframe, // Obtained earlier
    '8kuqzfci2mi4hyqug67zsr96c', // Your SDK key
    '' // Unused but needs to be a valid string
  );
  onshowcaseConnect(mpSdk);
} catch (e) {
  console.error(e);
}
})();
/**function onShowcaseConnect(mpSdk) {
  // start making calls on mpSdk as described in the reference docs
 
}*/

</script>
  </body>

</html>