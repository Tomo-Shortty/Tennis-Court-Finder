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
		<title>Court</title>
	</head>
	<body>
		<!--Create the header-->
		<div id="Header">
			<h1>Tennis Court Finder</h1>
		</div>
		<!--Create the menu-->
		<div id="Menu">
			<?php
				include 'menu.inc';
			?>
		</div>
		<!--Place all court information into the CourtContent div which is positioned on the left of the page.-->
		<div id="CourtContent">
			<?php
				//Get the venue that was selected.
				$court = $_GET['court'];
				try
				{
					//Query the items table to get the information required for the page.
					$result = $pdo->query("SELECT items.Venue, items.Latitude, items.Longitude, items.Address, items.Number_Of_Tennis_Courts, items.Booking_Details, ROUND(AVG(reviews.Rating),1) AS RatingAverage ".
					"FROM items ".
					"LEFT JOIN reviews ON (items.Venue = reviews.Venue) ".
					"WHERE items.Venue = '$court' ".
					"GROUP BY Venue ");
				}
				//Catch any errors that may occur to stop them from crashing the website.
				catch (PDOException $e)
				{
					echo $e->getMessage();
				}
				//Cycle through the query results and display the collected data on the page.
				foreach ($result as $item)
				{
					echo '<h1>', $item['Venue'],'</h1>
					<h3>Address</h3>
					<p>', $item['Address'],'</p>
					<h3>Rating</h3>
					<p>', $item['RatingAverage'],'</p>
					<h3>Number of Courts</h3>
					<p>', $item['Number_Of_Tennis_Courts'],'</p>
					<h3>Booking Details</h3>
					<p>', $item['Booking_Details'],'</p>
					<h3>Recent Reviews</h3>';
				}
			?>
		</div>
		<!--Create the map-->
		<div id="Map"></div>
		<!--Initialise the map and create a marker showing where the court is located.-->
		<script>
			var coordinates = [<?php echo '["', $item['Venue'],'", ', $item['Latitude'],', ', $item['Longitude'],']'; ?>];
			
			var map = new google.maps.Map(document.getElementById('Map'), {
				zoom: 14,
				center: new google.maps.LatLng(<?php echo $item['Latitude'] ?>, <?php echo $item['Longitude'] ?>),
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
		<!--Create the review table.-->
		<div id="ReviewTable">
			<table>
			<?php
				try
				{
					//Query the reviews table to obtain all the reviews associated with this court.
					$result = $pdo->query('SELECT reviews.User, reviews.Venue, reviews.Date, reviews.Comments, reviews.Rating '.
					'FROM reviews '.
					"WHERE reviews.Venue = '$court' ".
					'ORDER BY Date DESC ');
				}
				//Catch any errors that may occur to stop the website from crashing.
				catch (PDOException $e)
				{
					echo $e->getMessage();
				}
				//Cycle through the collected data and post it into the table.
				foreach ($result as $review)
				{
					echo '<tr>
						<th>Posted by: ', $review['User'],'</th>
						<th>Date: ', $review['Date'],'</th>
						</tr>';
					echo '<tr>
						<td>Venue: ', $review['Venue'],'</td>
						<td>Rating: ', $review['Rating'],'/5</td>
					</tr>';
					echo '<tr>
						<td colspan="2">', $review['Comments'],'</td>
						</tr>';
				}
			?>
			</table>
			<!--Create the hyperlink that will direct the user back to the results page.-->
			<div id="Hyperlinks">
				<p><a href="results_page.php">Back to results</a></p>
			</div>
		</div>
		<!--Create the footer.-->
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>