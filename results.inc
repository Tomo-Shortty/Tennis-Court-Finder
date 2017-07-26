<?php
try
{
	//Query the items table to obtain the latitude and longitude of the selected suburb in the search form.
	$query = $pdo->query("SELECT items.Latitude, items.Longitude ".
	"FROM items ".
	"WHERE items.Suburb = '$search' ".
	"LIMIT 1; ");
}
catch (PDOException $e)
{
	echo $e->getMessage();
}
//Cycle through the query results.
foreach ($query as $coords)
{
	//Set the latitude and longitude to a variable each.
	$lat = $coords['Latitude'];
	$lon = $coords['Longitude'];
}

try
{
	//Query the items table to obtain the latitude and longitude of the closest venues to the selected suburb.
	$resultPlot = $pdo->query("SELECT items.Venue, items.Latitude, items.Longitude, ".
	"ROUND((6371 * acos(cos(radians('$lat')) * cos(radians(items.Latitude)) * cos(radians(items.Longitude) - radians('$lon')) + sin(radians('$lat')) * sin(radians(items.Latitude)) ".
	")),1) AS Distance ".
	"FROM items ".
	"HAVING Distance < 5 ".
	"ORDER BY Distance ");
}
catch (PDOException $e)
{
	echo $e->getMessage();
}

try
{
	//Query the items table to obtain the closest venues to the selected suburb.
	$result = $pdo->query("SELECT items.Venue, ".
	"ROUND((6371 * acos(cos(radians('$lat')) * cos(radians(items.Latitude)) * cos(radians(items.Longitude) - radians('$lon')) + sin(radians('$lat')) * sin(radians(items.Latitude)) ".
	")),1) AS Distance, items.Address, items.Booking_Details ".
	"FROM items ".
	"HAVING Distance < 5 ".
	"ORDER BY Distance ");
}
catch (PDOException $e)
{
	echo $e->getMessage();
}
?>