$(document).on('click', function () {
	$.post('/online', function () {
	});
});

setInterval(function () {
	$.post('/visitor', function (data) {
		if (data) {
			$('#visitor').empty();
			$('#visitor').append(data);
			$('.user').children('a').css('color', 'black');
		}
	});
	$.post('/seeNew', function (data) {
		if (data) {
			$('.link').children('a').css('color', 'greenyellow');
		}
	})
}, 3000);

$(document).ready(function () {
	$.post('/visitorload', function (data) {
		if (data) {
			$('.link').css('color', 'greenyellow');
			$('#visitor').append(data);
			$('.user').children('a').css('color', 'black');
		}
	});
	$.post('/seeNew', function (data) {
		if (data) {
			$('.link').children('a').css('color', 'greenyellow');
		}
	})
});

$('.link').mouseleave(function () {
	$.post('/delvisit', function () {});
	$('.user').css({'background-color' : ''});
	$('.link').children('a').css('color', '');
});

$('#visitor')
	.mouseenter(function () {
		$('.link').css('background-color', 'white');
		$('.link').css('border-radius', '5px');
		$('.link').children('a').css('color', 'black');
	})
	.mouseleave(function () {
		$('.link').css('background-color', '');
		$('.link').children('a').css('color', 'white');
	});