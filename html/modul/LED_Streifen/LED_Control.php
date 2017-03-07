<?php 
	
	/* ################################################ */
	/*     LED GPIO PINS: Green=16; Red=20; Blue=26 	*/
	/* ################################################ */

$data = json_decode($_POST["DATA"]);
		
$redValue = $data->{'red'};
$greenValue = $data->{'green'};
$blueValue = $data->{'blue'};
		
	$fadeEnable = $data->{'fade'};
	if($fadeEnable == '1') {
		if(file_get_contents('/var/www/html/modul/LED_Streifen/Fade.txt') != '0') {
			echo '[INFO] Fading is activ! If you can\'t take it off change the 1 to 0 in the file [/var/www/html/modul/LED_Streifen/Fade.txt]';
			return;
		}
			file_put_contents('/var/www/html/modul/LED_Streifen/Fade.txt', '1');
			$var = '1';
			while($var == '1') {
				
				if($redValue > 0 && $blueValue == 0) {
					$redValue--;
					$greenValue++;
					exec("pigs p 20 ".$redValue);
					exec("pigs p 16 ".$greenValue);
				}
				if($greenValue > 0 && $redValue == 0) {
					$greenValue--;
					$blueValue++;
					exec("pigs p 16 ".$greenValue);
					exec("pigs p 26 ".$blueValue);
				}
				if($blueValue > 0 && $greenValue == 0) {
					$redValue++;
					$blueValue--;
					exec("pigs p 26 ".$blueValue);
					exec("pigs p 20 ".$redValue);
				}
				$var = file_get_contents('/var/www/html/modul/LED_Streifen/Fade.txt');
			}
	} else {
		file_put_contents('/var/www/html/modul/LED_Streifen/Fade.txt', '0');
	}
	
setLEDColor($redValue, $greenValue, $blueValue);
	
	
function setLEDColor($rValue, $gValue, $bValue) {	
	if($rValue < 0 or $rValue > 255) return;
	if($gValue < 0 or $gValue > 255) return;
	if($bValue < 0 or $bValue > 255) return;
		$gpioPinRed = 20;
		$gpioPinGreen = 16;
		$gpioPinBlue = 26;
		exec("pigs p ".$gpioPinRed." ".$rValue);
		exec("pigs p ".$gpioPinGreen." ".$gValue);
		exec("pigs p ".$gpioPinBlue." ".$bValue);
}
	
	
?>
