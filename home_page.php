<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	//Start the session.
	session_start();
	
	include 'login_button.inc';
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<!--Obtain the Google Maps api.-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuyy2DOoRcIcweg9n2i8cg2tbCCgSZzBU"></script>
		<!--Initialise the map.-->
		<script>
			google.maps.event.addDomListener(window, 'load', initialise);
		</script>
		<title>Home</title>
	</head>
	<body>
		<!--Create the header.-->
		<div id="Header">
			<h1> Tennis Court Finder </h1>
		</div>
		<!--Create the menu.-->
		<div id="Menu">
			<?php
				include 'menu.inc';
			?>
		</div>
		<!--Place the welcome message and search form into the LeftContent div which is positioned on the left of the page.-->
		<div id="LeftContent">
			<h1> Welcome to the Tennis Court Finder! </h1>
			<p> Select your suburb to get started! Or use the links above to navigate the page. </p>
			<div id="Options">
				<!--Create the search form.-->
				<form action="results_page.php" method="POST" name="locationForm">
					<?php
						try
						{
							//Query the database to select data from the Suburbs column in 'items'.
							$result = $pdo->query('SELECT items.Suburb '.
							'FROM items '.
							'GROUP BY Suburb ');
						}
						//Stop any errors from crashing the website. If an error occurs it will be displayed and the user can try using the search form again.
						catch (PDOException $e)
						{
							echo $e->getMessage();
						}
					?>
					<select name="suburb">
					<?php
						//Cycle through the query results and display them in the select form.
						foreach ($result as $item)
						{
							echo '<option value="',$item['Suburb'],'">',$item['Suburb'],'</option>';
						}
					?>
					</select>
					<br><br>
					<!--Create the submit button. Will execute the form action when clicked.-->
					<input type="submit" name="FindResults" value="Find nearest courts.">
				</form>
				<!--Create the geolocation button. Will call the geolocation function to obtain the users current location and display it below the button and on the map.-->
				<p><button onclick="getLocation()">Get location!</button></p>
				<p id="status"> </p>
			</div>
		</div>
		<!--Create the map.-->
		<div id="Map"></div>
		<!--Create the footer.-->
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>