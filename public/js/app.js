Dropzone.autoDiscover = false;

$(function() {

    var $grid = $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });

    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });

    var dropzone = new Dropzone("#dropzone", {
        url: "/upload",
        acceptedFiles: "image/*",
        autoProcessQueue: false,
        maxFiles: 20,
        parallelUploads: 10
    });

    dropzone.on('queuecomplete', function(){
        window.location.reload();
    });

    $('#uploadModal').find('button.btn-primary').on('click', function(){
        dropzone.processQueue();
    });

    $('.grid-item').on('click', function(){

        var id = $(this).data('id');
        var preview = $(this).data('preview');
        var status = $(this).data('status');

        if (status == 'complete') {
            $('#imagePreview').html('<img src="' + preview + '" />');

            $.get('/text?id=' + id, function(response){
                $('#imageText').find('textarea').data('id', id).val(response);
                $('#viewModal').modal();
            });
        } else {
            alert("This file has not been processed yet. Please check back soon.");
        }

    });

    $('#viewModal').find('button.btn-primary').on('click', function(){
        var id = $('#imageText').find('textarea').data('id');
        $.post('/text?id=' + id, {text: $('#imageText').find('textarea').val()}, function(response){
            $('#viewModal').modal('hide');
        });
    });

});