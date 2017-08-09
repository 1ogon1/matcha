$(document).on('click', function () {
	$.post('/online', function () {
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