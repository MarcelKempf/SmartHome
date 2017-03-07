<form id="LoginBox" name="LoginBox" action="checkLogin.php" method="post">

	<h1>LoginScreen</h1>
	<h4>Bitte geben Sie ihre Benutzerdaten ein!</h4>
	
	<?php
	session_start();
	if($_SESSION['username'] == null && $_SESSION['login_success'] == false) {
		$_SESSION['login_attempt'] += 1;
		if($_SESSION['login_1ban_date'] != null && $_SESSION['login_1ban_date'] + 60 - time() <= 0) {
			session_destroy();
		}
		if($_SESSION['login_attempt'] >= 4) {
			
			if($_SESSION['login_1ban_date'] == null) {
				//Unix TimeStap in seconds since 01.01.1970
				$_SESSION['login_1ban_date'] = time();     
			}
			$waitingTime = $_SESSION['login_1ban_date'] + 60 - time();
			if($waitingTime > 0) {
				if($waitingTime == 1) {
					echo "<p id='red'>Versuche es in 1 Sekunde nochmal!</p><br><br>";	
					return;
				} else 
					echo "<p id='red'>Versuche es in $waitingTime Sekunden nochmal!</p><br><br>";	
					return;
			}
		} else {
			if($_SESSION['login_attempt'] != 1) {
				$leftLoginAttempt = 4 - $_SESSION['login_attempt'];
				echo "<p id='red'>Der Benutzername oder das Passwort ist falsch!<br>Du hast noch $leftLoginAttempt/3 Versuche</p>";
			}
		}		
	}
	
	echo "<p><label>Benutzer: </label> <input type='text' name='benutzer' placeholder='Benutzername'/></p>
			<p><label>Passwort: </label><input type='password' name='passwort' placeholder='Passwort'/></p>
			<input type='submit' name='submit' value='Einloggen!'/><br></br>";
		
	?>
	
	
	
</form>
