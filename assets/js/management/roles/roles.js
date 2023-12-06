$(document).ready(function(){
    //TODO: paginacion
    loadRoles();
});

function loadRoles(){
    const url = `tableroles?page=1`;
    $(`#results`).load(url,function(){
        $(`tbody tr`).each(function(index){
            let duration = index * 100;
            $(this).fadeIn(duration);
        });
    });
}



function deleteRole(id){
    // vm.loading(true);
    const data = {
        action: $(`#delconst`).val(),
        id: parseInt(id)
    };
    $.ajax({
        url: 'role-form',
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
            loadRoles();
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

function newRole(){
    vm.loading(true);
    $('#form-nr').submit();
}

function updateRole(id){
    vm.loading(true);
    $('#form-nr').find(`#idRole`).val(id);
    $('#form-nr').submit();
}