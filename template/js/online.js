$(document)
    .on('click', function () {
    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-"
        + (currentdate.getMonth()+1)  + "-"
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
        + (currentdate.getMonth()+1)  + "-"
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
            // console.log(data);
            $('#visitor').append(data);
            $('.user').children('a').css('color', 'black');
            // $('.link').css('color', 'greenyellow');
        }// else {
            // console.log('yes');
        // }
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

$('.user').click(function () {
    var div = $(this).data('text');
    // var id = div.data('text');

    console.log('aasasas');
});