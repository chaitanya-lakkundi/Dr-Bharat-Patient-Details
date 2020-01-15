<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<script src="js/convert-to-blob.js"></script>
<script>
	wo = window.onload;
	window.onload = function() {
		wo && wo.call(null);
		
		// Get the image
		var sampleImage = document.getElementById("ringoImage"),
			canvas = convertImageToCanvas(sampleImage);
		
		// Actions
		document.getElementById("canvasHolder").appendChild(canvas);
		document.getElementById("pngHolder").appendChild(convertCanvasToImage(canvas));
		
		// Converts image to canvas; returns new canvas element
		function convertImageToCanvas(image) {
			var canvas = document.createElement("canvas");
			canvas.width = image.width;
			canvas.height = image.height;
			canvas.getContext("2d").drawImage(image, 0, 0);

			return canvas;
		}

		// Converts canvas to an image
		function convertCanvasToImage(canvas) {
			var image = new Image();
			image.src = canvas.toDataURL("image/png");				
			
			canvas.toBlob(function(blob){
            var form = new FormData(),
                request = new XMLHttpRequest();

            form.append("image", blob, "filename.png");
            request.open("POST", "index.php", true);
            request.send(form);
        }, "image/png");
            return image;
		}
	};
</script>
</head>
<body>

<script>
window.ORIGINAL_JSON=window.JSON;
</script>


<div id="promoNode"></div>
	
	<h2>Original Image</h2>
	<p>
		<img src="kupfer.png" id="ringoImage" />
	</p>
	
	<h2>Canvas Image</h2>
	<p id="canvasHolder">
		
	</p>
	
	<h2>Canvas -&gt; PNG Image</h2>
	<p id="pngHolder">
		
	</p>
	
		
</div>

</main>
	<script>
	window.TEMP_JSON = window.JSON;
	window.JSON = window.ORIGINAL_JSON;
	</script>
</body>
</html>
