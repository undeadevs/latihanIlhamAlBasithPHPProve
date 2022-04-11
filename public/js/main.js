$(document).ready(e=>{
    $('.nav-links a').each((i, link)=>{
        if(link.href===window.location.href) $(link).toggleClass('active');
    })
    $('button.burger-menu').on('click',e=>{
        $('.nav-links').toggleClass('active');
        $(e.target).toggleClass('fa-bars');
        $(e.target).toggleClass('fa-close');
    })

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:16,
        responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            }
        }
    })
})