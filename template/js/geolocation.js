var geocoder;
var map;
var marker;

navigator.geolocation.getCurrentPosition(function (position) {
	geocoder = new google.maps.Geocoder();

	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	var myLatLng = {lat: lat, lng: lng};
	console.log(myLatLng);
	console.log($('#map').data('text'));
	$.ajax({
		url: "/setAddress",
		type: "POST",
		data: ({
			id: $('#map').data('text'),
			lat: lat,
			lng: lng
		}),
		dataType: "html",
		success: function (data) {
			var result = $.parseJSON(data);
			if (result['lat'] && result['lng']) {
				lat = Number(result['lat']);
				lng = Number(result['lng']);
			}
			myLatLng = {lat: lat, lng: lng};
			showMap(myLatLng);
		}
	});

	showMap(myLatLng);
});

function codeAddress() {
	var address = document.getElementById('address').value;
	geocoder.geocode({'address': address}, function (results, status) {
		if (status == 'OK') {

			var lat = results[0].geometry.location.lat();
			var lng = results[0].geometry.location.lng();
			var myLatLng = {lat: lat, lng: lng};

			$.ajax({
				url: "/setAddress",
				type: "POST",
				data: ({
					id: $('#map').data('text'),
					change_loc: true,
					lat: lat,
					lng: lng
				}),
				dataType: "html",
				success: function (data) {
					var result = $.parseJSON(data);
					lat = Number(result['lat']);
					lng = Number(result['lng']);
					myLatLng = {lat: lat, lng: lng};
					showMap(myLatLng);
				}
			});
			showMap(myLatLng);
		}
	});
}

function showMap(myLatLng) {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 13,
		center: myLatLng
	});

	marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: 'I am here ;)'
	});
}