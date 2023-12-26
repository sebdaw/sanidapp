$(document).ready(function(){
    load();
});

function load(section='',user=''){
    const url = `table-gpu?section=${section}&user=${user}`;
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
      id_block: idBlock,
      type: 'block'
    };
    $.ajax({
      url: 'gpu',
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

function loadUsers(){
    const idRole = $(`#search_roles`).val();
    const data = {
      action: $(`#apiconst`).val(),
      id_role: idRole,
      type: 'role'
    };
    $.ajax({
      url: 'gpu',
      method: 'POST',
      data: JSON.stringify(data),
      processData: false,
      contentType: 'application/json'
    })
    .done(function(response) {
      response = JSON.parse(response);
      $(`#search_users`).empty();
      $(`#search_users`).append(`<option value="-1"></option>`);
      for(let user of response){
        $(`#search_users`).append(`<option value="${user[0]}">${user[1]}</option>`);
      }
    })
    .fail(function(error) {
      $(`#search_users`).empty();
      $(`#search_users`).append(`<option value="-1"></option>`);
    });
}

function search(){
    const section = $(`#search_section`).val();
    const user = $(`#search_users`).val();
    load(section,user);
}

function save(){
    vm.loading(true);
    const permissions = [];
    $(`td div[data-pid]`).each(function(){
        const type = $(this).data('type');
        const selected = parseInt($(this).data('selected'));
        let permission;
        switch(selected){
        case 1:
            permission = true;
            break;
        case 2:
            permission = false;
            break;
        case 3:
            permission = null;
            break;
        }
        permissions.push({
            type: type,
            permission: permission
        });
    });
    const section = $(`td[data-current-section]`).data('current-section');
    const user = $(`td[data-current-user]`).data('current-user');
    const data = {
        action: $(`#updconst`).val(),
        user: user,
        section: section,
        permissions: permissions
    };
    $.ajax({
        url: 'gpu',
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

function changePermission(event){
    const id = $(event.currentTarget).attr('id');
    const container = $(`#${id}`) ;
    const selected = $(container).data('selected');
    $(container).find(`img[data-tp="${selected}"]`).hide();
    const next = ((3 + selected)%3)+1;
    $(container).find(`img[data-tp="${next}"]`).show();
    $(container).data('selected',next);
    $(container).attr('data-selected',next);
}
