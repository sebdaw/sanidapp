$(document).ready(function(){
    //TODO: paginacion
    load();
});

function load(){
    const url = `tableblocks?page=1`;
    $(`#results`).load(url,function(){
        $(`tbody tr`).each(function(index){
            let duration = index * 100;
            $(this).fadeIn(duration);
        });
    });
}



function deleteBlock(id){
    // vm.loading(true);
    const data = {
        action: $(`#delconst`).val(),
        id: parseInt(id)
    };
    $.ajax({
        url: 'blocks',
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

function changePosition(id,order){
  vm.loading(true);
  const data = {
    action: $(`#ordconst`).val(),
    id: parseInt(id),
    order: order
};
$.ajax({
    url: 'blocks',
    method: 'POST',
    data: JSON.stringify(data),
    processData: false,
    contentType: 'application/json'
  })
  .done(function(response) {
    vm.loading(false,()=>{load()});
  })
  .fail(function(error) {
    // vm.loading(false,function(){
    //   let response = JSON.parse(error.responseText);
    //   vm.error(response.msg);
    // });
    // vm.loading(false);
  });
}

function newBlock(){
    vm.loading(true);
    $('#form-nb').submit();
}

function updateBlock(id){
    vm.loading(true);
    $('#form-nb').find(`#id`).val(id);
    $('#form-nb').submit();
}