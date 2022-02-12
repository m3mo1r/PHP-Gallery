$(document).ready(function () {
    // PHOTO LIBRARY
    var user_href, user_id;
    var img_href, img_name;
    var photo_id;
    $('.modal_thumbnails').click(function () {
        $('#set_user_image').prop('disabled', false);
        $(this).addClass('selected');
        
        user_href = $('#user_id').prop('href');
        user_id   = user_href.split('=').pop();
        
        img_href  = $(this).prop('src');
        img_name  = img_href.split('/').pop();
        
        photo_id = $(this).attr('data');
        
        $.ajax({
            url: 'includes/ajax.php',
            data: {photo_id},
            type: 'POST',
            success: function (data) {
                if(!data.error)
                    $('#modal_sidebar').html(data);
            }
        });
    });
    
    $('#set_user_image').click(function () {
        $.ajax({
            url: 'includes/ajax.php',
            data: {img_name: img_name, user_id: user_id},
            type: 'POST',
            success: function (data) {
                if(!data.error)
                    $('a.user_image_box img').prop('src', data);
            }
        });
    });
    
    // PHOTO BOX
    $('.info-box-header').click(function () {
        $('.inside').slideToggle('slow');
        $('#toggle').toggleClass('glyphicon-menu-down');
        $('#toggle').toggleClass('glyphicon-menu-up');
    });
    
    // DELETE LINK
    $('.delete-link').click(function () { return confirm('Are you sure to delete this ?');});
});
