<?php

	/* ################################################ */
	/*  Funksteckdosen Functions: Add/Remove Sockets	*/
	/* ################################################ */
	
$data = json_decode($_POST["DATA"]);
		
$operation = $data->{'operation'};
$socketName = $data->{'socketname'};

$socketFile = '/var/www/html/modul/Funksteckdosen/Funksteckdosen.json';
$fileResult = file_get_contents($socketFile);
$jsonObject = json_decode($fileResult, true);	
$socket = $jsonObject['SOCKETS'];

	/* ################################################ */
	/*  ADD new Wireless SOCKET							*/
	/* ################################################ */
	if($operation == 'add') {
		if($jsonObject['SOCKETS'] == null) {
			$emptyarray = [];
			$jsonObject['SOCKETS'] = $emptyarray;
			$socket = $jsonObject['SOCKETS'];
		}
			$newSocket['socket'] = $socketName;
			$newSocket['systemcode'] = $data->{'systemcode'};
			$newSocket['unitcode'] = $data->{'unitcode'};
			array_push($socket, $newSocket);
			$jsonObject['SOCKETS'] = $socket;
			$newJSON = json_encode($jsonObject);
			file_put_contents($socketFile, $newJSON);		
		
	/* ################################################ */
	/*  Delete one Wireless SOCKET						*/
	/* ################################################ */
	} else if($operation == 'delete') {
		$arr = [];
		foreach ($socket as $key => $value) {
			if($value['socket'] != $socketName) {
				array_push($arr, $socket[$key]);
			}
		}
		$jsonObject['SOCKETS'] = $arr;
		file_put_contents($socketFile, json_encode($jsonObject));
	}
?>
