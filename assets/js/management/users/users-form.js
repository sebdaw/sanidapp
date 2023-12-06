$(document).ready(function(){
    vm.loading(false);
    SimpleSwitch.init();
});

function save(action,id){
  const data = {
    action: action,
    id: id,
    username: $(`#username`).val(),
    password: $(`#password`).val(),
    password_confirmation: $(`#password_confirmation`).val(),
    role: $(`#roles`).val(),
    active: ($(`#user-active`).length? $(`#user-active`).is(':checked') : null)
  };
  $.ajax({
    url: 'user-form',
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
        window.location.href = 'users';
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
