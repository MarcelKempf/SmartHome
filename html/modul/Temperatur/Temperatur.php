<div class='Temperatur'>
	<p id='temp_01'style='text-align:center'>-°C</p>
</div>

<script type="text/javascript">

	queryTemp();							//display immediately the temp of the ajax query
	setInterval(function() {				//send a query every 30seconds to the ajax file getTemp.php 
		queryTemp();
	}, 30*1000);


	function queryTemp() {
		$.ajax({
				method:     "POST",
				url:   	    "modul/Temperatur/getTemp.php",
				success: function(temp) {
					document.getElementById('temp_01').innerHTML = temp/1000 + "°C";
				},
		});
	}
	
</script>

