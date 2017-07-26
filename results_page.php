<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	//Start the session.
	session_start();
	
	include 'login_button.inc';
	
	//Determine that the search form was used. If true display the results relating to the users search.
	if (isset($_POST['FindResults']))
	{
		//Set the selected suburb to a variable.
		$search = $_POST['suburb'];
		
		include 'results.inc';
	}
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<!--Obtain the Google Maps api.-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuyy2DOoRcIcweg9n2i8cg2tbCCgSZzBU"></script>
		<title>Results</title>
	</head>
	<body>
		<!--Create the header.-->
		<div id="Header">
			<h1>Tennis Court Finder</h1>
		</div>
		<!--Create the menu.-->
		<div id="Menu">
			<?php
				include 'menu.inc';
			?>
		</div>
		<!--Place the results into the LeftContent div to position them on the left of the page.-->
		<div id="LeftContent">
			<h1>Results</h1>
			<!--Create the table that displays the results.-->
			<div id="Table">
				<table>
				<?php
					echo '<tr>
						<th>Venue</th>
						<th>Address</th>
						<th>Distance to Court</th>
						<th>Booking Details</th>
					</tr>';
					//Cycle through the query results and place them into the table.
					foreach ($result as $item)
					{
						echo '<tr>
							<td><a href="court_layout_page.php?court=', $item['Venue'],'">', $item['Venue'],'</a></td>
							<td>', $item['Address'],'</td>
							<td>', $item['Distance'],' km</td>
							<td>', $item['Booking_Details'],'</td>
						</tr>';
					}
				?>
				</table>
			</div>
			<!--Recreate the search form to allow the user to quickly make another search.-->
			<p>Another Search?</p>
			<div id="Options">
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
			</div>
		</div>
		<!--Create the map.-->
		<div id="Map"></div>
		<!--Initialise the map and create markers showing where the results of the search are located.-->
		<script>
			<?php
				foreach ($resultPlot as $position)
				{ ?>
					var coordinates = [<?php echo '["', $position['Venue'],'", ', $position['Latitude'],', ', $position['Longitude'],']'; ?>];
					//var coordinates = [['Algester', -27.615549, 153.030029]];
				<?php
				}
			?>
			
			
			var map = new google.maps.Map(document.getElementById('Map'), {
				zoom: 11,
				center: new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lon ?>),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			var marker;
			var i;
			
			for (i = 0; i < coordinates.length; i++) {
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(coordinates[i][1], coordinates[i][2]),
					map: map,
					title: coordinates[i][0]
				});
				
				
			}
		</script>
		<!--Create the footer-->
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>