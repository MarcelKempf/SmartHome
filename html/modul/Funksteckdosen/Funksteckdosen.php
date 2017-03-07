<?php 

$socketFile = '/var/www/html/modul/Funksteckdosen/Funksteckdosen.json';
$data = file_get_contents($socketFile);
$jsonObjects = json_decode($data, true);

$socketArray = $jsonObjects['SOCKETS'];
$sockets = count($socketArray);

for($i = 0; $i<$sockets; $i++) {
	
	$socketName = $socketArray[$i]['socket'];
	$socketArray[$i]['status'] = 1;
	createOnButton("Btn_ON_Socket_".$socketName,
			$socketName." anschalten",
			"modul/Funksteckdosen/Funksteckdosen_Control.php",
			json_encode($socketArray[$i]));
	$socketArray[$i]['status'] = 0;
	createOffButton("Btn_OFF_Socket_".$socketName,
			$socketName." ausschalten",
			"modul/Funksteckdosen/Funksteckdosen_Control.php",
			json_encode($socketArray[$i]));

}


?>



<div id='Tool_Bar'>
	<div id='Btn_ADD_Socket' class='single_button' style='background-color: rgba(144, 238, 144, 0.74)'>
		<img src='images/Plus Math-52.png' class='icon_plus'/>
	</div>
	<div id='Btn_DELETE_Socket' class='single_button' style='background-color: rgba(255, 0, 0, 0.15)'>
		<img src='images/Trash-52.png' class='icon_trash'/>
	</div>
</div>

<script type="text/javascript">

	document.getElementById('Btn_ADD_Socket').onclick = function() {
		var socketname = prompt("Steckdosennamen:", "Beschreibung eingeben");
		var systemcode = prompt("System Code:", "SystemCode[Oben=1, Unten=0]");
		var unitcode = prompt("Unit Code ", "UnitCode[A=>Oben=1,..,E=>Oben=5]");
		if(socketname != null) {
			sendData("modul/Funksteckdosen/Funksteckdosen_AddRemove.php", '{"operation":"add","socketname":"'+socketname+'","systemcode":"'+systemcode+'","unitcode":"'+unitcode+'"}', true);
				   $('<div class="styleapi_button_2" id="'+socketname+' anschalten">'+socketname+' anschalten'
					+'<input type="button" id="Btn_ON_Socket_'+socketname+'" class="default_button" value="ON" />'
					+'</div> '
					+'<div class="styleapi_button_1" id="'+socketname+' ausschalten">'+socketname+' ausschalten'
					+'<input type="button" id="Btn_OFF_Socket_'+socketname+'" class="default_button" value="OFF" />'
					+'</div> ')
				.insertBefore("#Tool_Bar");
			addClickEvent("Btn_ON_Socket_"+socketname,"modul/Funksteckdosen/Funksteckdosen_Control.php",'{"socket":"'+socketname+'","systemcode":"'+systemcode+'","unitcode":"'+unitcode+'","status":1}');
			addClickEvent("Btn_OFF_Socket_"+socketname,"modul/Funksteckdosen/Funksteckdosen_Control.php",'{"socket":"'+socketname+'","systemcode":"'+systemcode+'","unitcode":"'+unitcode+'","status":0}');
		
		}
	};
	
	document.getElementById('Btn_DELETE_Socket').onclick = function() {
		var socketname = prompt("LÖSCHEN!\nSteckdosennamen:", "Beschreibung eingeben");
		var delete_access = confirm("Willst du wirklich die " + socketname + " Funksteckdose löschen?");
		if(delete_access == true) {
			document.getElementById(socketname+' anschalten').remove();
			document.getElementById(socketname+' ausschalten').remove();
			sendData("modul/Funksteckdosen/Funksteckdosen_AddRemove.php", '{"operation":"delete","socketname":"'+socketname+'"}', true);
		}
	};

</script>
