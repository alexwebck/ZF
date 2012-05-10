$(function() {
    $('.waiting .join_to_game').click(function() {
        $('#waiting_game').val($(this).attr('id')); 
    });
});    