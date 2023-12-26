$(document).ready(function(){
    //TODO: paginacion
    load();
});

function load(block=0){
    const url = `tablesections?page=0&block=${block}`;
    $(`#results`).empty();
    $(`#results`).load(url,function(){
        $(`tbody tr`).each(function(index){
            let duration = index * 100;
            $(this).fadeIn(duration);
        });
    });
}


function search(){
  const id = $(`#search_block`).val();
  load(id);
}



function deleteSection(id){
    // vm.loading(true);
    const search_block = $(`#block`).val();
    const data = {
        action: $(`#delconst`).val(),
        id: parseInt(id)
    };
    $.ajax({
        url: 'sections',
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
            load(search_block);
          },1500);
        },500);
      })
      .fail(function(error) {
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
    url: 'sections',
    method: 'POST',
    data: JSON.stringify(data),
    processData: false,
    contentType: 'application/json'
  })
  .done(function(response) {
    vm.loading(false,()=>{load()});
  })
  .fail(function(error) {
  });
}

function newSection(idBlock=null){
    vm.loading(true);
    $(`#form-ns`).find(`#block`).val((idBlock!=null? idBlock:''));
    $('#form-ns').submit();
}

function updateSection(id){
    vm.loading(true);
    $('#form-ns').find(`#id`).val(id);
    $('#form-ns').submit();
}