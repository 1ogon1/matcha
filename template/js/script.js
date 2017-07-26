$('.btn').on('click', function () {
    var input = $(this).data('text');

    $('#'+input).attr('disabled', false);
}); //settings input disable false

$('#save').click(function () {
    $('#save').attr('disabled', true);
    var params = {
        login: $('#input1').val(),
        name: $('#input2').val(),
        surname: $('#input3').val(),
        email: $('#input4').val(),
        birthday: $('#input5').val(),
        info: $('#input6').val()
    };
    $.post("/save", params, function (data) {
        if (data === "Зміни збережено") {
            $('.message').text(data).show().fadeOut(2000);
            $('.message').css('color', 'green');
            for (var i = 1; i <= 6; i++) {
                $('#input' + i).attr('disabled', true);
            }
        } else {
            $('.message').text(data).show().fadeOut(5000);
            $('.mesage').css('color', 'red');
        }
        $('#save').attr('disabled', false);
    });
}); //save user information

$('#sign_up').click(function () {
    $('#sign_up').attr('disabled', true);
    var params = {
        login: $('#login').val(),
        name: $('#name').val(),
        surname: $('#surname').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        c_password: $('#c_password').val()
    };
    $.post("/register", params, function (data) {
        if (data === "Email відправлено") {
            $('.mes').text(data).show().fadeOut(2000);
            $('.mes').css('color', 'green');
        } else {
            $('.mes').text(data).show();
            $('.mes').css('color', 'red');
        }
        $('#sign_up').attr('disabled', false);
    });
}); //register function

$('#sign_in').click(function () {
    $('#sign_in').attr('disabled', true);
    var params = {
        email: $('#log_email').val(),
        password: $('#log_pass').val()
    };
    $.post('/login', params, function (data) {
        if ($.isNumeric(data)) {
            $(location).attr('href', '/profile/'+data);
        } else {
            $('.log_mes').text(data).show();
            $('.log_mes').css('color', 'red');
        }
    });
    $('#sign_in').attr('disabled', false);
}); //login form

$('#activate').click(function () {
    $('#activate').attr('disabled', true);
    var params = {
        code: $('#code').val()
    };
    $.post('/send_code', params, function (data) {
        if (data === 'Аккаунт активовано!') {
            $('.mes').text(data).show();
            $('.mes').css('color', 'green');
        } else {
            $('.mes').text(data).show();
            $('.mes').css('color', 'red');
        }
    });
    $('#activate').attr('disabled', false);
}); //activate account

$(document).ready(function () {
    $(function () {
        $('#file').change(function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('style', 'height:100px;width:100px');
                $('#preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
}); //show upload image