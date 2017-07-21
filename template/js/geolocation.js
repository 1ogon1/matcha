var lat;
var lng;
var map;
var marker;
var myLatLng;

navigator.geolocation.getCurrentPosition(function (position) {
	lat = position.coords.latitude;
	lng = position.coords.longitude;
	myLatLng = {lat: lat, lng: lng};
	// $('.latitude').text(lat.toFixed(3));
	// $('.longitude').text(lng.toFixed(3));
	// $('.coordinates').addClass('visible');

	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: {lat: lat, lng: lng}
	});
	if (marker) {
		marker.setMap(null);
	}
	marker = new google.maps.Marker({
		position: myLatLng,
		map: map
	})

});

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: {lat: lat, lng: lng}
	});
	var geocoder = new google.maps.Geocoder();

	document.getElementById('submit').addEventListener('click', function () {
		geocodeAddress(geocoder, map);
	});
}

function geocodeAddress(geocoder, resultsMap) {
	var address = document.getElementById('address').value;
	geocoder.geocode({'address': address}, function (results, status) {
		if (status === 'OK') {
			// resultsMap.setCenter(results[0].geometry.location);
			lat = results[0].geometry.location.lat();
			lng = results[0].geometry.location.lng();
			myLatLng = {lat: lat, lng: lng};
			if (marker) {
				marker.setMap(null);
			}
			// marker = new google.maps.Marker({
			// 	map: resultsMap,
			// 	position: results[0].geometry.location
			// });
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 13,
				center: myLatLng
			});
			marker = new google.maps.Marker({
				position: myLatLng,
				map: map
			});
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}