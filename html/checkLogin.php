<?php

	session_start();
	$_SESSION['login_success'] = false;
	
	if(isset($_POST['submit'])) {
		
		$username = $_POST['benutzer'];
		$password = $_POST['passwort'];
		$userlist = file('Login/Benutzer.txt');
		
		foreach($userlist as $user) {
			$user_details = explode('|', $user);
			
			if($user_details[0] == $username && $user_details[1] == $password) {
				$_SESSION['username'] = $username;
				$_SESSION['login_success'] = true;
				$_SESSION['login_attempt'] = 0;
				break;
			} 
		}
	}
	
	if($_SESSION['login_success'] == true) {
		header("location: SmartControl.php");
	} else {
		header("location: index.php");
	}

	
?>
