if (typeof(Number.prototype.toRad) === "undefined") {
	Number.prototype.toRad = function() {
	return this * Math.PI / 180;
	}
}

 
 
if (typeof(Number.prototype.toRad) === "undefined") {
  Number.prototype.toRad = function() {
    return this * Math.PI / 180;
  }
}
/**
 * Calculate distance between two points on a sphere.
 */
function distance(lat1,lon1,lat2,lon2) {
	var R = 6371; // km
	var dLat = (lat2-lat1).toRad();
	var dLon = (lon2-lon1).toRad();
	var lat1 = lat1.toRad();
	var lat2 = lat2.toRad();
	var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    	    Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	var d = R * c;
	return d;
}
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
	}
}
function showPosition(position) {
	document.getElementById("status").innerHTML = "Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude + ".";
	
	var dist1 = distance(position.coords.latitude, position.coords.longitude, -27.615549, 153.030034);
	var dist2 = distance(position.coords.latitude, position.coords.longitude, -27.509708, 153.034015);
	var dist3 = distance(position.coords.latitude, position.coords.longitude, -27.427997, 153.053968);
	var dist4 = distance(position.coords.latitude, position.coords.longitude, -27.447186, 152.976894);
	
	if (dist1 <= 30) {
		document.getElementById("status").innerHTML += "<br><br> Distance to tennis court at Algester State School: " + dist1 + ".";
	} 
	if (dist2 <= 30) {
		document.getElementById("status").innerHTML += "<br><br> Distance to tennis court at Junction Park State School: " + dist2 + ".";
	}
	if (dist3 <= 30) {
		document.getElementById("status").innerHTML += "<br><br> Distance to tennis court at Ascot State School: " + dist3 + ".";
	}
	if (dist4 <= 30) {
		document.getElementById("status").innerHTML += "<br><br> Distance to tennis court at Ashgrove State School: " + dist4 + ".";
	}
	
	// display on a map
	var latlon = position.coords.latitude + "," + position.coords.longitude;
	var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=400x300&sensor=false";
	document.getElementById("Map").innerHTML = "<img src='"+img_url+"'>";
	
}
function showError(error) {
	var msg = "";
	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("status").innerHTML = msg;
}