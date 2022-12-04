

$(function () {
    var ashtrayCol = $('.box-body');
    // ashtrayCol.css('max-height', (window.innerHeight - 150) + 'px');

    var ashtrayColCount = parseInt(ashtrayCol.length);
    $('.container-fluid').css('min-width', (ashtrayColCount * 350) + 'px');

    draggableInit();

    $('.scrum-card-header').click(function() {
        var $panelBody = $(this).parent().children('.box-body');
        $panelBody.slideToggle();
    });
});

function draggableInit() {
    var sourceId;

    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.box-body').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.box-body').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');
        var targetStatusId = children.data('id');
        var rootUrl = $(".grab").attr('url');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle'); //before post


            // Post data
            setTimeout(function () {
                var element = document.getElementById(elementId);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: rootUrl+"/moveTask/"+elementId,
                    type:"POST",
                    data:{
                        id:elementId,
                        status_id:targetStatusId,
                        status_id_from:sourceId,
                        status_id_to:targetId,
                    },
                    success:function(response){
                        console.log("resp"+response);
                        if(response) {
                            alert(response);
                            // $('.error').text(response);
                            location.reload();
                        }
                    },
                });
                children.prepend(element);
                $('#processing-modal').modal('toggle'); // after post
            }, 1000);

        }

        event.preventDefault();
    });



    $('.btn-approve').on('click', function (evn) { // this is the "a" tag
        var rootUrl = $(".grab").attr('url');
        var taskId = $(this).data('taskid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: rootUrl+"/approveTask/"+taskId,
            type:"POST",
            data:{
                id:taskId,
                status_name:'backlog'
            },
            success:function(response){
                console.log(response);
                if(response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },

        });

    });


    $('.btn-request').on('click', function (evn) { // this is the "a" tag
        var rootUrl = $(".grab").attr('url');
        var taskId = $(this).data('taskid');
        var statusName = $(this).data('statusname');
        console.log(statusName);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: rootUrl+"/requestTask/"+taskId,
            type:"POST",
            data:{
                id:taskId,
                status_name:statusName
            },
            success:function(response){
                console.log(response);
                if(response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },

        });

    });


    $('.ashtray-entry').dblclick(function() {
        var rootUrl = $(".grab").attr('url');
        var taskId = $(this).attr('id');
        $('#modal-content').empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: rootUrl+"/scrum_modal/"+taskId,
            type:"POST",
            data:{
                id:taskId
            },
            success:function(response){
                if(response) {
                    $('#modal-content').append(response);

                }
                $("#saveComment").on('click', function(evn){
                    var task_id = $(this).data('id');
                    var comment = CKEDITOR.instances.task_comments.getData();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: rootUrl+"/add_task_comment/"+task_id,
                        type:"POST",
                        data:{
                            id:task_id,
                            details: comment
                        },
                        success:function(response){
                            location.reload();
                            var html = '<div class="col-md-8">\n' +
                                '                                            <a href="">{{$comment->user->firstName}} {{ $comment->user->lastName}}</a>\n' +
                                '                                        </div>\n' +
                                '                                        <div class="col-md-8">\n' +
                                '                                            <span>{!! $comment->details !!}</span>\n' +
                                '                                        </div>';
                            // $("#comments").append(html);
                            console.log(response);
                        }

                    });

                });
            },
        });
        $('#srumModal').modal('show');
        // alert('The item was double-clicked!'+ $taskId);
    });



}

