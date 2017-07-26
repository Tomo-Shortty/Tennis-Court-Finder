<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	session_start();
	
	include 'login_button.inc';
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<title>Highest Rated</title>
	</head>
	<body>
		<div id="Header">
			<h1>Tennis Court Finder</h1>
		</div>
		<div id="Menu">
			<?php
				include 'menu.inc';
			?>
		</div>
		<div id="TableContent">
			<h1>Highest Rated Courts</h1>
			<div id="Table">
				<table>
				<?php
					try
					{
						$result = $pdo->query('SELECT items.Venue, items.Address, items.Booking_Details, ROUND(AVG(reviews.Rating),1) AS RatingAverage '.
						'FROM items '.
						'LEFT JOIN reviews ON (items.Venue = reviews.Venue) '.
						'WHERE reviews.Rating >= 3 '.
						'GROUP BY Venue '.
						'ORDER BY Rating DESC ');
					}
					catch (PDOException $e)
					{
						echo $e->getMessage();
					}
					echo '<tr>
						<th>Venue</th>
						<th>Address</th>
						<th>Rating</th> 
						<th>Booking Details</th>
					</tr>';
					foreach ($result as $item)
					{
						echo '<tr>
							<td><a href="court_layout_page.php?court=', $item['Venue'],'">', $item['Venue'],'</a></td>
							<td>', $item['Address'],'</td>
							<td>', $item['RatingAverage'],'/5.0</td>
							<td>', $item['Booking_Details'],'</td>
						</tr>';
					}
				?>
				</table>
			</div>
		</div>
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>