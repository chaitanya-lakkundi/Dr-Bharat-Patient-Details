<?php include 'base_head.php'; ?>

<?php
/*  
	$data = $_POST['logoImage'];
	$encodedData = str_replace(' ','+',$encodedData);
  	$decodedData = base64_decode($encodedData);
  	file_put_contents($_POST['logoFilename'], $decodedData);
*/
?>

<body>
<script>
	
// Put event listeners into place
window.addEventListener("DOMContentLoaded", function() {
	// Grab elements, create settings, etc.
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    var mediaConfig =  { video: true };
    var errBack = function(e) {
    	console.log('An error has occurred!', e)
    };

	// Put video listeners into place
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    /* Legacy code below! */
    else if(navigator.getUserMedia) { // Standard
		navigator.getUserMedia(mediaConfig, function(stream) {
			video.src = stream;
			video.play();
		}, errBack);
	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
		navigator.webkitGetUserMedia(mediaConfig, function(stream){
			video.src = window.webkitURL.createObjectURL(stream);
			video.play();
		}, errBack);
	} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
		navigator.mozGetUserMedia(mediaConfig, function(stream){
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}

	// Trigger photo take
	document.getElementById('snap').addEventListener('click', function() {
		context.drawImage(video, 0, 0, 320,240);
		document.getElementById("patient_photo").value=canvas.toDataURL("image/png");
	});
}, false);

</script>

<div class="container well">
	<legend><center>Take photo</center></legend>
	<center>
	
		<div class="row">
		<video id="video" width="320" height="240" autoplay></video>
		<br/>
		</div>
	<form action="index.php" method="POST">
		<div class="row">
		<button id="snap" type="submit" class="btn btn-info snapButton">Snap Photo</button>	
		<input name="patient_photo"	id="patient_photo" type="hidden" />
		<br/>
		</div>
	</form>
		<div class="row">
		<canvas id="canvas" width="320" height="240"></canvas>	
		</div>
		</center>
		
	
</div>

</body>
<?php include 'base_tail.php'; ?>