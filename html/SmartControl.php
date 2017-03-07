<?php
	session_start();
	if(!(isset($_SESSION['login_success']) && $_SESSION['login_success'] == true)) {
		header("location: index.php");
	}
	session_destroy();
	session_start();
?>

<script type="text/javascript">

	function displayContent(modulname) {
	
		var deg = 0;
		var e = document.getElementById(modulname.id);
	    if(e.style.display == "block") {
			e.style.display = "none";
			deg = 0;
		} else {
			e.style.display = "block";
			deg = -90;
		}
		var rotate = 'rotate(' + deg + 'deg)';
		$('#img_' + modulname.id).css({ 
        '-webkit-transform': rotate,
        '-moz-transform': rotate,
        '-o-transform': rotate,
        '-ms-transform': rotate,
        'transform': rotate 
		});
		
	}
</script>

<html>
	<head>
		<title>SMARTHOME</title>
		<meta http-equiv="content-type" content="charset=utf-8" />
		<link rel="shortcut icon" href="favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="style.css" rel="stylesheet" media="all">
		<script src="JQuery/jquery-3.1.1.min.js"></script> <!-- alt: src="http://code.jquery.com/jquery-1.7.2.min.js" !-->
	</head>

	<body>
		<?php 
		    include('header.php'); 
			require_once('ButtonApi/ButtonAPI.php');
		?>
			<div class="Moduls">
				<?php 
					if(!is_dir("modul")) {
						echo "Es konnten keine Module gefunden werden, weil der Ordner 'modul' im Webserver-Verzeichnis nicht vorhanden ist!";
					} else {				
						$scan = scandir("modul");
						foreach($scan as $modul) {
							if (!($modul == '.' || $modul == '..')) {
								if(is_dir('modul/' . $modul)) {
									$modulTextInfo = str_replace('_', '', $modul);
									echo "<div class='ModulHeader' onclick='displayContent($modul)'>
												<p>$modulTextInfo
												<img src='images/Back-96.png' id='img_$modul'/>
										   </div>";
													
									echo "<div id='$modul' class='Modul_Content'>";	
												include('modul/'.$modul.'/'.$modul.'.php');
										echo "</div>";
								}
							}
						}
					}
				?>
	
			</div>
		
	</body>
</html>
