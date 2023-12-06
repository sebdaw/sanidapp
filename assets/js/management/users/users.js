$(document).ready(function(){
    //TODO: paginacion
    load();
});

function load(){
    const url = `tableusers?page=1`;
    $(`#results`).load(url,function(){
        $(`tbody tr`).each(function(index){
            let duration = index * 100;
            $(this).fadeIn(duration);
        });
    });
}



function deleteUser(id){
    // vm.loading(true);
    const data = {
        action: $(`#delconst`).val(),
        id: parseInt(id)
    };
    $.ajax({
        url: 'users',
        method: 'POST',
        data: JSON.stringify(data),
        processData: false,
        contentType: 'application/json'
      })
      .done(function(response) {
        // vm.loading(false);
        response = JSON.parse(response);
        setTimeout(()=>{
          vm.info(response.msg);
          setTimeout(function(){
            load();
          },1500);
        },500);
      })
      .fail(function(error) {
        // vm.loading(false,function(){
        //   let response = JSON.parse(error.responseText);
        //   vm.error(response.msg);
        // });
        // vm.loading(false);
      });
}

function newUser(){
    vm.loading(true);
    $('#form-nu').submit();
}

function updateUser(id){
    vm.loading(true);
    $('#form-nu').find(`#id`).val(id);
    $('#form-nu').submit();
}