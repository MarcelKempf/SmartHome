<?php

	createOnButton("Btn_ON_LedStripe", "Led anschalten", "modul/LED_Streifen/LED_Control.php", '{"red":"255","blue":"255","green":"255","fade":"0"}'); 
	createOffButton("Btn_OFF_LedStripe", "Led ausschalten", "modul/LED_Streifen/LED_Control.php", '{"red":"0","blue":"0","green":"0","fade":"0"}');
	createOnButton("Btn_Fade_LedStripe", "Led fading", "modul/LED_Streifen/LED_Control.php", '{"red":"255","blue":"0","green":"0","fade":"1"}'); 

?>

<img src="modul/LED_Streifen/colorwheel.png" id="colorwheel" onmousedown="mixColor(event)" style='position: relative;left: 50%;transform: translate(-50%, 0);'>


<script type="text/javascript">
	
	/* ########################################## */
	/* Color Picker */
	/* ########################################## */
		var canvas = document.createElement('canvas');
		var img = document.getElementById('colorwheel');
		canvas.width = img.width;
		canvas.height = img.height;
		context = canvas.getContext("2d");
		context.drawImage(img, 0, 0, img.width, img.height);
	
		function mixColor(e) {
			var imgData = context.getImageData(e.offsetX, e.offsetY, 1, 1).data;
			var red = imgData[0];
			var green = imgData[1];
			var blue = imgData[2];
			
			sendData("modul/LED_Streifen/LED_Control.php", '{"red":"'+red+'","green":"'+green+'","blue":"'+blue+'"}');
		}
</script>




