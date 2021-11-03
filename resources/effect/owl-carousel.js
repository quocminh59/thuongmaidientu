$(document).ready(function(){
    $('#carousel-laptop.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        navText: ["<i class='fal fa-chevron-left'></i>","<i class='fal fa-chevron-right'></i>"],
        items: 5,
    })
});

$(document).ready(function(){
    $('#sub-image-carousel.owl-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        navText: ["<span class='material-icons-outlined'>chevron_left</span>","<span class='material-icons-outlined'>chevron_right</span>"],
        items: 5,
    })
});
    
