$(document).ready(function(){
    $(`#btn_login`).on('click',login);
    $('input').on('keydown',send);
});

function send(event){
    if (event.key === 'Enter')
        login();
}

function login(){
    const url = $(`#form_login`).attr('action');
    const data = {
        username : $(`#username`).val(),
        password : $(`#password`).val()
    };
    $(`#spinner`).show();
    $.ajax({
        type: 'POST',
        url: url,
        data: JSON.stringify(data)
    })
    .done(function(response) {
        response = JSON.parse(response);
        setTimeout(() => {
            window.location.href = response.url;
        }, 1000);
    })
    .fail(function(error) {
        $(`#spinner`).hide();
        let response = JSON.parse(error.responseText).msg;
        $(`#error-log`).find('p').text(response);
        $(`#error-log`).slideDown(function(){
            setTimeout(() => {
                $(this).fadeOut();
            }, 3000);
        });
    });
}
