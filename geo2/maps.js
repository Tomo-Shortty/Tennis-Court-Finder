// Gets the user's coordinates.
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
	}
}

// Displays the user's location in the designated area on the page, (id="status").
function showPosition(position) {
	
	document.getElementById("status").innerHTML = "Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude + ".";
	
	
	/*
	for ( i = 0; i<10; i++){
		document.getElementById("status").innerHTML = data[i];
	}
	*/
	
	// display on a map
	var latlon = position.coords.latitude + "," + position.coords.longitude;
	var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	var mapOptions = {
		zoom: 10,
		center: myLatlng
	};
	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	/*
	var courts = [
	['Algester State School',	'-27.615549,153.030034'],
	['Ascot State School', '-27.427997,153.053968'],
	['Ashgrove State School',	'-27.447186,152.976894']
	];
	for(i = 0; i < courts.length; i++){
		dropMarker(courts[i]);
	}
	*/
	dropMarker('Bardon State School','-27.46076,152.972214');
	dropMarker('Benbek Circuit Park','-27.601378,153.042566');
	dropMarker('Brisbane Girls Grammar School',	'-27.45843,153.020306');
	dropMarker('Carina State School','-27.492298,153.102293');
	dropMarker('Chapel Hill State School','-27.499801,152.94584');
	dropMarker('Christian Brothers Queensland (St Josephs College)','-27.455931,153.024434');
	dropMarker('Coorparoo State School,	-27.493904,153.062009');
	dropMarker('Corinda State School, -27.547731,152.981792');
	dropMarker('Corporation of the Synod of the Diocese of Brisbane (Anglican Church Grammar School)', '-27.478554,153.051599');
	dropMarker('Craigslea State School', '-27.383731,153.018098');
	dropMarker('Darra State School', '-27.570768,152.953192');
	dropMarker('Dutton Park State School', '-27.493764,153.028125');
	dropMarker('Enoggera State School', '-27.417407,152.994653');
	dropMarker('Ferny Grove State School', '-27.4047,152.929301');
	dropMarker('Geebung State School', '-27.373968,153.045318');
	dropMarker('Greenslopes State School', '-27.506385,153.049411');
	dropMarker('Gumdale State School', '-27.491527,153.151646');
	dropMarker('Hamilton State School', '-27.432411,153.0741');
	dropMarker('Hendra State School', '-27.421717,153.074521');
	dropMarker('Hilder Road State School', '-27.437889,152.936436');
	dropMarker('Holland Park State School', '-27.513762,153.06206');
	dropMarker('Jamboree Heights State School', '-27.554276,152.930428');
	dropMarker('Jimbour Close Park', '-27.607675,152.957416');
	dropMarker('Junction Park State School', '-27.509708,153.034015');
	dropMarker('Kalinga Park', '-27.407535,153.05177');
	dropMarker('Kedron State High School', '-27.414129,153.039301');
	dropMarker('Kenmore South State School', '-27.516945,152.943109');
	dropMarker('Kenmore State High School', '-27.506216,152.929902');
	dropMarker('Kenmore State School', '-27.508157,152.939483');
	dropMarker('Killarney Street Park', '-27.607092,152.947948');
	dropMarker('Lakeside Village Tennis Court', '-27.621592,152.960257');
	dropMarker('Mansfield State High School', '-27.543184,153.106477');
	dropMarker('Marshall Road State School', '-27.525777,153.059005');
	dropMarker('McDowall State School', '-27.387899,152.988195');
	dropMarker('Middle Park State School', '-27.559683,152.919844');
	dropMarker('Mitchelton State High School', '-27.410805,152.968306');
	dropMarker('Mitchelton State School', '-27.412471,152.969974');
	dropMarker('Moorooka State School', '-27.537053,153.024337');
	dropMarker('Morningside State School', '-27.464161,153.065292');
	dropMarker('Murarrie State School', '-27.461738,153.100185');
	dropMarker('New Farm Park', '-27.468126,153.051771');
	dropMarker('Nundah State School', '-27.40199,153.057055');
	dropMarker('Oakleigh State School', '-27.436196,152.985612');
	dropMarker('Payne Road State School', '-27.447515,152.951424');
	dropMarker('Rainworth State School', '-27.468626,152.985091');
	dropMarker('Runcorn State Primary School', '-27.587396,153.061502');
	dropMarker('Salisbury State School', '-27.554304,153.032282');
	dropMarker('Sandgate District Youth Tennis Association', '-27.322629,153.061526');
	dropMarker('Serivceton South State School', '-27.606793,152.977503');
	dropMarker('Seville Road State School', '-27.524932,153.071799');
	dropMarker('Shaw Park Tennis Centre', '-27.406338,153.043445');
	dropMarker('Stafford Heights State School', '-27.401118,153.003008');
	dropMarker('Sunnybank Hills State School', '-27.594347,153.054689');
	dropMarker('The Gap State School', '-27.441007,152.944397');
	dropMarker('Toowong State School', '-27.480267,152.988286');
	dropMarker('Wellers Hill State School', '-27.526307,153.046401');
	dropMarker('West End State School', '-27.480213,153.008421');
	dropMarker('Wilston State School', '-27.427566,153.014703');
	dropMarker('Wishart State School', '-27.550714,153.095365');
	dropMarker('Wynnum District Lawn Tennis Association', '-27.444849,153.167084');
	dropMarker('Wynnum State High School', '-27.454813,153.175332');
	dropMarker('Yeronga Tennis Club', '-27.518196,153.022594');
	
}

// If geolocation does not work, the proper error message will be displayed.
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

// Creates the initial map before finding location
function initialise() {
	var myLatlng = new google.maps.LatLng(-27.4667, 153.0333);
	var mapOptions = {
    center: myLatlng,
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	
    
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions)
	
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: 'Brisbane'
	});
}

// Drops the marker on a specific location, the name of this place will appear when 
// the mouse is hovered over the marker.
function dropMarker(a, b, courtname){
	var lat = a;
	var lon = b;
	myLatlng = new google.maps.LatLng(lat, lon);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: courtname
	});
	marker.setMap(map);
}