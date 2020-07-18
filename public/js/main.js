$(function(){

    'use strict';

    $('.del').click(function() {

        if( confirm('削除してもよろしいですか？') ) {

            var id = $(this).data('id');

            $('#del-' + id).submit();
        }
    });
});