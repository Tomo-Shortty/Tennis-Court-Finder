<!DOCTYPE html>
<?php
	include 'selectDB.inc';
?>
<html>
  <head>
	<script type="text/javascript" src="maps.js"></script>
    <style>
      #map-canvas {
        width: 500px;
        height: 500px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuyy2DOoRcIcweg9n2i8cg2tbCCgSZzBU"></script>
    <script>
		google.maps.event.addDomListener(window, 'load', initialise);
    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
	<p><button onclick="getLocation()">Get location!</button></p>
	<p id="status"> </p>
	<?php
		try
		{
			$result = $pdo->query('SELECT items.Venue, items.Latitude, items.Longitude '.
			'FROM items ');
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
		foreach ($result as $item)
		{
			$lat = $item['Latitude'];
			$lon = $item['Longitude'];
			$name = $item['Venue'];
		}
	?>
	<p><button onclick="dropMarker(<?php $lat ?>, <?php $lon ?>, <?php $name ?>);">Show courts!</button></p>
	
	
	
	<!-- TRYING TO SEND THE PHP $result DIRECTLY TO JAVASCRIPT
	<script>
		data = <?php echo json_encode($result); ?>;
	</script>
	-->
	
	
	
	<!--
		echo '<p><button onclick="';
		foreach ($result as $item){			
			echo 'dropMarker(\'-27.630344, 153.098399\');';
			echo 'dropMarker(\'-27.600344, 153.098399\');';
			echo 'dropMarker(\'-27.630344, 153.008399\');';
		}
		echo '">Show all courts!</button></p>';
	-->
	
	<?php
		
		//Generate random 10 characters for salt
		$chars = '0123456789abcdefghijklmnopABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charsLength = strlen($chars);
		$randomSalt = "";
		for($i = 0; $i < 10; $i++){
			$randomSalt .= $chars[rand(0, $charsLength - 1)];
		}
		echo '<p>', $randomSalt, '</p>';
		
	?>
  </body>
</html>