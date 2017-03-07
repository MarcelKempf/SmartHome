<link href="ButtonApi/buttonstyle.css" rel="stylesheet">

<script type="text/javascript">

	function sendData(pFile, pDataObject, isAsnyc) {
	
		var jsonc = JSON.stringify(pDataObject);			
		$.ajax({
			method:     "POST",
			url:   	    pFile,
			data:       {DATA:pDataObject},
			cache:      false,
			async : 	isAsnyc,
				success: function(msg) {
					if(msg != '') console.log(msg);
				},
				error: function(msg) {
					console.log(msg);
				}
		});
	}

	function addClickEvent(btnID, pFile, pDataObject) {
	
		document.getElementById(btnID).onclick = function() {
			sendData(pFile, pDataObject, true);
		};
	}
</script>

<?php

$GLOBALS['btn_counter'] = 0;						//Ist für die Farbe der Buttonfelder zuständig (wechselt immer zum nächsten Button)

function createOnButton($btnId, $textInfo, $processingFile, $processingDataObject) {
	
	$GLOBALS['btn_counter']++;
	$divClass = "styleapi_button_1";
	if(($GLOBALS['btn_counter'] % 2) == 0) $divClass = "styleapi_button_2";
	
	echo '<div class="'.$divClass.'" id="'.$textInfo.'">'
					.$textInfo.
					'<input type="button" id="'.$btnId.'" class="default_button" value="ON" />
			   </div>';
	echo "<script type='text/javascript'> addClickEvent('$btnId','$processingFile','$processingDataObject'); </script>";
	
}

function createOffButton($btnId, $textInfo, $processingFile, $processingDataObject) {
	
	$GLOBALS['btn_counter']++;
	$divClass = "styleapi_button_1";
	if(($GLOBALS['btn_counter'] % 2) == 0) $divClass = "styleapi_button_2";
	
	echo '<div class="'.$divClass.'" id="'.$textInfo.'">'
					.$textInfo.
					'<input type="button" id="'.$btnId.'" class="default_button" value="OFF" />
			   </div>';
	echo "<script type='text/javascript'> addClickEvent('$btnId','$processingFile','$processingDataObject'); </script>";
	
}

?>

