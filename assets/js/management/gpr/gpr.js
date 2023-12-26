$(document).ready(function(){
    load();
});

function load(section='',role=''){
    const url = `table-gpr?section=${section}&role=${role}`;
    $(`#results`).load(url,function(){
        if ($(`#results`).children().length){
          SimpleSwitch.init();
          $(`.button-box`).find(`.btn-save`).show();
        }else{
          $(`.button-box`).find(`.btn-save`).hide();
        }
        $(`tbody tr`).each(function(index){
            let duration = index * 100;
            $(this).fadeIn(duration);
        });
    });
}

function loadSections(){
    const idBlock = $(`#search_block`).val();
    const data = {
      action: $(`#apiconst`).val(),
      id_block: idBlock
    };
    $.ajax({
      url: 'gpr',
      method: 'POST',
      data: JSON.stringify(data),
      processData: false,
      contentType: 'application/json'
    })
    .done(function(response) {
      response = JSON.parse(response);
      $(`#search_section`).empty();
      $(`#search_section`).append(`<option value="-1"></option>`);
      for(let section of response){
        $(`#search_section`).append(`<option value="${section[0]}">${section[1]}</option>`);
      }
    })
    .fail(function(error) {
      $(`#search_section`).empty();
      $(`#search_section`).append(`<option value="-1"></option>`);
    });
}

function search(){
    const section = $(`#search_section`).val();
    const role = $(`#search_roles`).val();
    load(section,role);
}

function save(){
    vm.loading(true);
    const permissions = [];
    $(`td input[type='checkbox']`).each(function(){
      let type = $(this).data('ptype');
      let pid = $(this).data('pid');
      let enabled = $(this).is(':checked');
      permissions.push({
        type: type,
        pid: pid,
        enabled: enabled
      });
    });
    const section = $(`td[data-section]`).data('section');
    const role = $(`td[data-role]`).data('role');
    const data = {
        action: $(`#updconst`).val(),
        role: role,
        section: section,
        permissions: permissions
    };
    $.ajax({
        url: 'gpr',
        method: 'POST',
        data: JSON.stringify(data),
        processData: false,
        contentType: 'application/json'
      })
      .done(function(response) {
        vm.loading(false);
      })
      .fail(function(error) {        
        vm.loading(false);
      });
}
