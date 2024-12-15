jQuery(document).ready(function($){

    var archive_selected_name = $('.archive_opt').val();
    if(archive_selected_name == 'archive-layout-list'){
        $('.archive-list-alignment').toggle();
        $('.archive-grid-alignment').hide();
        $('.archive-layout-masonry').hide();
        $('.archive-layout-full').hide();
    }
    if(archive_selected_name == 'archive-layout-grid') {
        $('.archive-grid-alignment').toggle();
        $('.archive-list-alignment').hide();
        $('.archive-layout-masonry').hide();
        $('.archive-layout-full').hide();

    }

    if(archive_selected_name == 'archive-layout-masonry') {
        $('.archive-layout-masonry').toggle();
        $('.archive-grid-alignment').hide();
        $('.archive-list-alignment').hide();
        $('.archive-layout-full').hide();

    }

    if(archive_selected_name == 'archive-layout-full') {
        $('.archive-layout-full').toggle();
        $('.archive-layout-masonry').hide();
        $('.archive-grid-alignment').hide();
        $('.archive-list-alignment').hide();

    }


    $('.archive_opt').on('change',function () {
        var archive_layout_name = $(this).val();

        if(archive_layout_name == 'archive-layout-list'){
            $('.archive-list-alignment').toggle();
            $('.archive-grid-alignment').hide();
            $('.archive-layout-masonry').hide();
            $('.archive-layout-full').hide();

        }
        else if(archive_layout_name == 'archive-layout-grid'){
            $('.archive-grid-alignment').toggle();
            $('.archive-list-alignment').hide();
            $('.archive-layout-masonry').hide();
            $('.archive-layout-full').hide();

        }
        else if(archive_layout_name == 'archive-layout-masonry'){
            $('.archive-layout-masonry').toggle();
            $('.archive-layout-full').hide();
            $('.archive-list-alignment').hide();
            $('.archive-grid-alignment').hide();
        }
        else if(archive_layout_name == 'archive-layout-full'){
            $('.archive-layout-full').toggle();
            $('.archive-list-alignment').hide();
            $('.archive-grid-alignment').hide();
            $('.archive-layout-masonry').hide();
        }
        else{
            $('.archive-list-alignment').hide();
            $('.archive-grid-alignment').hide();
            $('.archive-layout-masonry').hide();
            $('.archive-layout-full').hide();
        }
    });


});