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
    // console.log(params['time']);
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
    // console.log(img);
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

$('.block_img')
    .mouseenter(function () {
        // console.log('eee boy');
        var src = $(this).children('img').attr('src');
        $('#image').attr('src', src);
        $('#image').attr('display', 'block').fadeIn(500);
        // console.log(src);
    })
    .mouseleave(function () {
        // console.log('eee bitch');
        var src = $(this).children('img').attr('src');
        $('#image').attr('display', 'none').fadeOut(10);
        // $('#image').attr('src', '');
    });

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
        gender: $('#input5').val(),
        sex_pref: $('#input6').val(),
        address: $('#input7').val(),
        birthday: $('#input8').val(),
        biography: $('#input9').val()
    };
    $.post("/save", params, function (data) {
        // console.log(data);
        if (data === "Зміни збережено") {
            $('.message').text(data).show().fadeOut(2000);
            $('.message').css('color', 'green');
            for (var i = 1; i <= 9; i++) {
                $('#input' + i).attr('disabled', true);
            }
        } else {
            $('.message').text(data).show().fadeOut(5000);
            $('.message').css('color', 'red');
        }
        $('#save').attr('disabled', false);
    });
}); //save user information

$('.btn').on('click', function () {
    var input = $(this).data('text');
    if (input !== 'input10') {
        $('#'+input).attr('disabled', false);
    }
    else {
        var id = $('#input10').val();
        // console.log(param);
        if (id === '') {
            $('#input10').parent().addClass('has-error');
            $('.glyphicon').addClass('glyphicon-remove');
        } else {
            var param = {
                tag: $('#input10').val()
            };
            $('#input10').parent().addClass('has-success');
            $('.glyphicon').addClass('glyphicon-ok');
            $.post('/addtag', param, function (data) {
                if (data) {
                    $('#tag').append(data);
                    $(location).attr('href', '/more');
                } else{
                    $('#tag').append('<li>error</li>').css('color', 'red').fadeOut(3000);
                }
            });
        }
    }
}); //settings input disable false, add tag

$('#input10').focus(function () {
    $('#input10').parent().removeClass('has-error');
    $('#input10').parent().removeClass('has-success');
    $('.glyphicon').removeClass('glyphicon-remove');
    $('.glyphicon').removeClass('glyphicon-ok');
}); //remove classes

$('.tag_gel').click(function () {
    var li = $(this);
    var param = {
        tag: $(this).attr('value')
    };
    $.post('/deletetag', param, function () {
        li.fadeOut(500, function () {$(this).remove();});
    });
}); //delete tag