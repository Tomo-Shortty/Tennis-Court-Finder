function passwordMatch(form){
	if (form.usernamer.value == ""){
		return false;
	}
	if (form.usernamer.value.length < 4){
		alert("Username must be at least 4 characters");
		form.usernamer.focus();
		return false;
	}
	if (form.usernamer.value.length > 13){
		alert("Username must be no more than 12 characters");
		form.usernamer.focus();
		return false;
	}
	//check username hasn't already been chosen
	
	if (form.userpwr.value != form.checkpwr.value){
		alert("Passwords do not match");
		form.userpwr.focus();
		return false;
	}
	if (form.userpwr.value.length < 6){
		alert("Password must be at least 6 characters");
		form.userpwr.focus();
		return false;
	}
	if (form.userpwr.value.length > 21){
		alert("Password must be no more than 20 characters");
		form.userpwr.focus();
		return false;
	}
	if(form.age.value == "--Select age range--"){
		alert("Please select your age range");
		form.age.focus();
		return false;
	}
	
	return true;
}

// Creates the initial map before finding location
function initialise() {
	var myLatlng = new google.maps.LatLng(-27.4667, 153.0333);
	var mapOptions = {
    center: myLatlng,
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	
	var map = new google.maps.Map(document.getElementById('Map'), mapOptions)
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
	
	// display on a map
	var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	var mapOptions = {
	center: myLatlng,
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	
	var map = new google.maps.Map(document.getElementById('Map'), mapOptions)
	
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: 'Your location'
	});
	
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