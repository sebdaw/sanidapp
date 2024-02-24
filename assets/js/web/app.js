
$(document).ready(function(){
    var splide = new Splide('.splide',{
        type:'loop',
        autoplay: true,
        perPage: 1,
        pauseOnHover: true,
        interval: 4000,
        speed:2000
    });
    splide.on('autoplay:playing',function(rate){
        // console.log(rate);
    });
    splide.mount();
});