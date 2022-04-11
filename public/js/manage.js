$(document).ready(e=>{
    $('.nav-links a').each((i, link)=>{
        if(window.location.href.includes(link.href)) $(link).toggleClass('active');
    })

    $('.toggle-sidebar').click(e=>{
        $(e.target).toggleClass('active');
        $('.toggle-sidebar').text('=');
        $('.toggle-sidebar.active').text('x');
    })
    
    $('.logout-btn').click(e=>{
        $('#logout-form').submit();
    })

    $('.image-item').click(e=>{
        $('.image-item').removeClass('selected');
        $(e.target).addClass('selected');
    })

    $('.delete-selected-btn').click(e=>{
        const selectedImage = $('.image-item.selected');
        if(selectedImage.length===0) return alert('First, you need to to click an image')
        const deleteForm = $('#delete-form');
        deleteForm.attr('action', deleteForm.attr('action').replace('_filename',$(selectedImage).attr('src').replace('images/gallery/','')));
        deleteForm.submit();
    })

    $('.delete-btn').click(e=>{
        const deleteForm = $('#delete-form');
        deleteForm.attr('action', deleteForm.attr('action').replace('_id',$(e.target).data('id')));
        deleteForm.submit();
    })

    const tableContainer = $('.table-container');
    const table = $('table');
    if(tableContainer){
        if(table.width()>tableContainer.width()){
            table.width('max-content');
        }else{
            table.width('100%');
        }
    }
})