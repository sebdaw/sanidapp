$(document).ready(function(){
    //TODO: paginacion
    const url = `tableroles?page=1`;
    $(`#results`).load(url);
});