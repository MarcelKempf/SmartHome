<?php

$deviceID = '10-000802e843d1';
$tempread = file_get_contents('/sys/bus/w1/devices/'.$deviceID.'/w1_slave');

if(preg_match('/(?<!\w)t=(\w+)/', $tempread, $temp)) {
	echo $temp[1];														//temp[0] >> t=22500
}																		//temp[1] >> 22500

?>
