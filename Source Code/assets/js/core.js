$(function() {

    var cc = $.cookie('list_grid');
    if (cc == 'g') {
        $('#products').removeClass('listSmall list').addClass('grid');
        $('#grid').addClass('active');
    } else if (cc == 'l') {
        $('#products').removeClass('listSmall grid').addClass('list');
        $('#list').addClass('active');
    } else if (cc == 's'){
        $('#products').removeClass('list grid').addClass('listSmall');
        $('#listSmall').addClass('active');
    } else {
        $('#list').addClass('active');
    }
    
    $('#grid').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#products').fadeOut(300, function() {
            $(this).addClass('grid').fadeIn(300);
            $(this).removeClass('list listSmall').fadeIn(300);
            $.cookie('list_grid', 'g', { expires: 7 });
        });
        return false;
    });

    $('#list').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#products').fadeOut(300, function() {
            $(this).removeClass('grid listSmall').fadeIn(300);
            $(this).addClass('list').fadeIn(300);
            $.cookie('list_grid', 'l', { expires: 7 });
        });
        return false;
    });
    
    $('#listSmall').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#products').fadeOut(300, function() {
            $(this).removeClass('grid list').fadeIn(300);
            $(this).addClass('listSmall').fadeIn(300);
            $.cookie('list_grid', 's', { expires: 7 });
        });
        return false;
    });
    
});