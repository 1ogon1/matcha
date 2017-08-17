setInterval(function () {
	$.post('/msgNotification', function (data) {
		if (data > 0) {
			$('.badge').text(data);
			console.log(data);
		}
	});
}, 2000);