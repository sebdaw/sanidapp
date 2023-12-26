$(document).ready(function(){
    vm.loading(false);
    SimpleSwitch.init();
});

function save(action,id){
  const ptypes = [];
  $(`tr[data-type]`).each(function(){
    const id = $(this).attr('id');
    const idtype = id.split('-')[1];
    const value = $(this).find('input').is(':checked');
    ptypes.push({type:idtype,enabled:value});
  });
  const data = {
    action: action,
    id: id,
    name: $(`#name`).val(),
    path: $(`#path`).val(),
    icon: $(`#icon`).val(),
    block: $(`#block`).val(),
    ptypes: ptypes
  };
  $.ajax({
    url: 'section-form',
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
        window.location.href = 'sections';
      },1500);
    },500);
  })
  .fail(function(error) {
  });
}
