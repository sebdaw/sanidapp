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

function save(id){
    // vm.loading(true);
    const data = {
        action: $(`#updconst`).val(),
        id: parseInt(id),
        permissions: []
    };
    $.ajax({
        url: 'gpr',
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
