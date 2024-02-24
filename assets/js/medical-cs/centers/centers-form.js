const files = [];
$(document).ready(function(){
    vm.loading(false);
    SimpleSwitch.init();
    const description = $(`#tmp_desc`).val();
    editor = new Editor('editor',description);
    if ($(`.center-gallery`).children().length!=0){
      $(`.center-gallery`).css('display','flex');
    }
});

function findProvinces(){
  const combo = $(`#provinces`);
  const id_community = $('#communities').val();
  $(`#provinces`).empty();
  $(`#towns`).empty();
  $.ajax({
    url: `api/communities/${id_community}/provinces`,
    method: 'GET',
    processData: false,
    contentType: 'application/json'
  })
  .done(function(response) {
    // const items = JSON.parse(response);
    let items = response;
    $(combo).append(`<option value="-1"></option>`);
    for(let item of items){
      $(combo).append(`<option value="${item['id']}">${item['name']}</option>`);
    }
  })
  .fail(function(error) {
    $(`#provinces`).empty();
    // console.log(error);
  });
}

function findTowns(){
  const combo = $(`#towns`);
  const id_community = $('#communities').val();
  const id_province = $('#provinces').val();
  $(`#towns`).empty();
  $.ajax({
    url: `api/communities/${id_community}/provinces/${id_province}/towns`,
    method: 'GET',
    processData: false,
    contentType: 'application/json'
  })
  .done(function(response) {
    // const items = JSON.parse(response);
    let items = response;
    for(let item of items){
      $(combo).append(`<option value="${item['id']}">${item['name']}</option>`);
    }
  })
  .fail(function(error) {
  $(`#towns`).empty();
    // console.log(error);
  });
}

function save(action,id){
  
  const data = {
    action: action,
    id: id,
    name: $(`#name`).val(),
    address: $(`#address`).val(),
    email: $(`#email`).val(),
    phone: $(`#phone`).val(),
    cp:$(`#cp`).val(),
    town: $(`#towns`).val(),
    membership: $(`#memberships`).val(),
    description: (editor!=null? editor.getData() : null)
  };

  const formData = new FormData();
  formData.append('data',JSON.stringify(data));
  for (let file of files)
    formData.append('images[]',file);
  $.ajax({
    url: 'center-form',
    method: 'POST',
    data: formData,
    contentType:false,
    processData: false,
  })
  .done(function(response) {
    // vm.loading(false);
    response = JSON.parse(response);
    setTimeout(()=>{
      vm.info(response.msg);
      setTimeout(function(){
        window.location.href = 'centers';
      },1500);
    },500);
  })
  .fail(function(error) {
  });
}

function selectFiles(){
    $(`#file-selector`).click();
}

function readFiles(event){
  const gallery = $(`.image-gallery`);
    $(gallery).empty();
    files.splice(0,files.length);
    for(let file of event.target.files)
      files.push(file);

    if (files.length==0){
      $(gallery).slideUp();
      return;
    }

    for (let file of files){
      let reader = new FileReader(); 
      reader.onload = function(event) {
          const imgurl = event.target.result; 
          $(gallery).css('display','flex');
          $(gallery).append(`<img src="${imgurl}" title="${file.name}">`);
      };
      reader.readAsDataURL(file);
    }
}


