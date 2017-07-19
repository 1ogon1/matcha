var findMeButton = $('.find-me');

// Check if the browser has support for the Geolocation API
if (!navigator.geolocation) {

	findMeButton.addClass("disabled");
	$('.no-browser-support').addClass("visible");

} else {

	findMeButton.on('click', function (e) {

		e.preventDefault();

		navigator.geolocation.getCurrentPosition(function (position) {
			//
			// Get the coordinates of the current possition.
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;

			$('.latitude').text(lat.toFixed(3));
			$('.longitude').text(lng.toFixed(3));
			$('.coordinates').addClass('visible');

			// Create a new map and place a marker at the device location.
			var map = new GMaps({
				el: '#map',
				lat: lat,
				lng: lng
			});

			map.addMarker({
				lat: lat,
				lng: lng
			});

		});

	});

}

// var x = document.getElementById("demo");
//
// function getLocation() {
// 	if (navigator.geolocation) {
// 		navigator.geolocation.getCurrentPosition(showPosition, showError);
// 	} else {
// 		x.innerHTML = "Geolocation is not supported by this browser.";
// 	}
// }
//
// function showPosition(position) {
// 	var latlon = position.coords.latitude + "," + position.coords.longitude;
//
// 	var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="
// 		+latlon+"&zoom=14&size=400x300&sensor=false&key=AIzaSyCQilzegM8ynJ47loUVsKUzDv8WRTy2FNY";
// 	document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
// }
// To use this code on your website, get a free API key from Google.
// Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
//
// function showError(error) {
// 	switch(error.code) {
// 		case error.PERMISSION_DENIED:
// 			x.innerHTML = "User denied the request for Geolocation."
// 			break;
// 		case error.POSITION_UNAVAILABLE:
// 			x.innerHTML = "Location information is unavailable."
// 			break;
// 		case error.TIMEOUT:
// 			x.innerHTML = "The request to get user location timed out."
// 			break;
// 		case error.UNKNOWN_ERROR:
// 			x.innerHTML = "An unknown error occurred."
// 			break;
// 	}
// }

// https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCl8iCKbdFASljSOeGvzVuTu0lp_j3Grl8
