$(document)
	.on('click', function () {
		var currentdate = new Date();
		var datetime = currentdate.getFullYear() + "-"
			+ (currentdate.getMonth() + 1) + "-"
			+ currentdate.getDate() + " "
			+ currentdate.getHours() + ":"
			+ currentdate.getMinutes() + ":"
			+ currentdate.getSeconds();
		var params = {
			time: datetime
		};
		$.post('/online', params, function () {

		});
	})
	.ready(function () {
		var currentdate = new Date();
		var datetime = currentdate.getFullYear() + "-"
			+ (currentdate.getMonth() + 1) + "-"
			+ currentdate.getDate() + " "
			+ currentdate.getHours() + ":"
			+ currentdate.getMinutes() + ":"
			+ currentdate.getSeconds();
		var params = {
			time: datetime
		};
		$.post('/online', params, function () {
		});
	});

setInterval(function () {
	$.post('/visitor', function (data) {
		if (data) {
			$('.link').children('a').css('color', 'greenyellow');
			$('#visitor').append(data);
			$('.user').children('a').css('color', 'black');
		}
	});
}, 3000);

$(document).ready(function () {
	$.post('/visitorload', function (data) {
		if (data) {
			// console.log(data);
			$('.link').children('a').css('color', 'greenyellow');
			$('.link').css('color', 'greenyellow');
			$('#visitor').append(data);
			$('.user').children('a').css('color', 'black');
		}
	});
});

$('#visitor')
	.mouseenter(function () {
		$('.link').css('background-color', 'white');
		$('.link').css('border-radius', '5px');
		$('.link').css('color', 'black');
	})
	.mouseleave(function () {
		$('.link').css('background-color', '');
		$('.link').css('color', 'white');
	});


function user_ifo(id) {
	var param = {
		id_visitor: id
	};
	$.post('/delvisit', param, function (data) {
		if (data === 'ok') {
			$(location).attr('href', '/profile/' + id);
			$('.link').css('color', 'white');
		}
	});
}