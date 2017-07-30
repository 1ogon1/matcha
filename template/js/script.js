$('#sign_in').click(function () {
    $('#sign_in').attr('disabled', true);
    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-"
        + (currentdate.getMonth()+1)  + "-"
        + currentdate.getDate() + " "
        + currentdate.getHours() + ":"
        + currentdate.getMinutes() + ":"
        + currentdate.getSeconds();
    var params = {
        email: $('#log_email').val(),
        password: $('#log_pass').val(),
        time: datetime
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

$('.delete').click(function () {
    var parent = $(this).parent(),
        id = $(parent).children('img').data('text'),
        src = $(parent).children('img').attr('src');
    var params = {
        id: id,
        src: src
    };
    $.post('/delete', params, function () {
        $(location).attr('href', '/settings');
    });
}); //delete image

$('.set_avatar').click(function () {
    var parent = $(this).parent(),
        img = $(parent).children('img').attr('src');
    var params = {
        src: img
    };
    console.log(img);
    $.post('/set', params, function (data) {
        if (data == 'Аватар встановленно') {
            $('.msg_ava').text(data).css('color', 'green');
        } else {
            $('.msg_ava').text(data).css('color', 'red');
        }
    })
}); //set avatar

$(document).ready(function () {
    $(function () {
        $('#file').change(function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('style', 'height:100px;width:100px');
                $('#preview').attr('src', e.target.result);
                $('#cancel').css('display', 'inline-block')
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
}); //show upload image

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

$('.btn').on('click', function () {
    var input = $(this).data('text');

    $('#'+input).attr('disabled', false);
}); //settings input disable false