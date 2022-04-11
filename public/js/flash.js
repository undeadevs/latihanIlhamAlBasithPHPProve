$(document).ready(e=>{
    setTimeout(() => {
        $('.flash-msg').addClass('show');
    }, 100);
    $(document.body).click(e=>{
        $('.flash-msg').removeClass('show');
    })
})