$('#search').click(function () {
	var params;

	if ($('input:checked').val()) {
		params = {
			name: $('#s_name').val(),
			surname: $('#s_surname').val(),
			gender: $('#s_gender option:selected').val(),
			sex_pref: $('#s_sex_pref option:selected').val(),
			age1: $('#s_age1').val(),
			age2: $('#s_age2').val(),
			reit1: $('#s_reit1').val(),
			reit2: $('#s_reit2').val(),
			sort: $('input:checked').val()
		};
	} else {
		params = {
			name: $('#s_name').val(),
			surname: $('#s_surname').val(),
			gender: $('#s_gender option:selected').val(),
			sex_pref: $('#s_sex_pref option:selected').val(),
			age1: $('#s_age1').val(),
			age2: $('#s_age2').val(),
			reit1: $('#s_reit1').val(),
			reit2: $('#s_reit2').val(),
			sort: 0
		};
	}

	$.post('/searchParams', params, function (data) {
		// var res = $.parseJSON(data);
		$('#search_result').empty();
		$('#search_result').append(data);
	});
	console.log(params);
});

$('#add-tag').click(function () {
	var param = {
		tag: $('#s_tag').val()
	};
	$.post('/addSearchTag', param, function () {
	});
	// console.log('тег додано');
	$('#s_tag').parent().addClass('has-success');
	$('.glyphicon').addClass('glyphicon-ok');
});

$('#s_tag').focus(function () {
	$('#s_tag').parent().removeClass('has-success');
	$('.glyphicon').removeClass('glyphicon-ok');
});