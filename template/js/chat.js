$('#send').click(function () {
	var currentdate = new Date();
	var datetime = currentdate.getDate() + "."
		+ (currentdate.getMonth() + 1) + "."
		+ currentdate.getFullYear() + " "
		+ currentdate.getHours() + ":"
		+ currentdate.getMinutes();
	var params = {
		msg: $('#message').val(),
		id: $('.msg-wrap').attr('id'),
		date: datetime
	};
	if ($('#message').val() !== '') {
		$.post('/sendmessage', params, function (data) {
			if (data) {
				$('.msg-wrap').prepend(data);
				$('#message').val('');
			}
		});
	}
}); //send message

$('.media').click(function () {
	$('.msg-wrap').empty();
	$('.newmsg-' + $(this).data('text')).empty();
	$('.msg-wrap').attr('id', $(this).data('text')); //set id
	var param = {
		id: $(this).data('text')
	};
	$.post('/showMessage', param, function (data) {
		if (data) {
			$('.msg-wrap').prepend(data);
		}
	});

	$('.message-wrap').css('display', 'block');
}); //show on load page

setInterval(function () {
	if ($('.msg-wrap').attr('id')) {
		var param = {
			id: $('.msg-wrap').attr('id')
		};
		$.post('/checkmessage', param, function (data) {
			if (data) {
				$('.msg-wrap').prepend(data);
			}
		});
	}
	$.post('/checkNew', function (data) {
		if (data) {
			var array = $.parseJSON(data);
			// console.log(array);
			$('.newmsg-' + array['id']).text(array['count']);
		}
	});
}, 2000); //show in real time