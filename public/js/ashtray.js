$(document).ready(function () {

    $("#issuesModal-btn").click(function () {
        var url = $(this).data('url');
        // window.location.href = url + "/tasks#myModal";
        $("#issuesModal").modal('show');


    });

    window.onload = function () {
        $ekraal = $('#ekraal_team').val();
        $teams = $('#teams').val();
        if ($ekraal != null && $teams == null) {


            var baseurl = $('#ekraal_team').data('url');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: baseurl + '/team-dep',
                data: {'team_id': $('#ekraal_team').val()},
                dataType: 'json',
                type: 'POST',
                success: function (response) {
                    $('#teams').empty();
                    $.each(response, function (i, p) {
                        $('#teams').append($('<option ></option>').val(i).html(p));
                    });
                },
                error: function (errors) {
                    console.log(errors);
                    // location.reload();
                    return errors;
                }
            });
        }

    };

    $('#expense-btn-reset').click(function (e) {
        e.preventDefault();
        $('#chooseExpenseFile').val(function () {
            return this.defaultValue;
        });
        $(".iframe").remove();
    });
    $('#budget-btn-reset').click(function (e) {
        e.preventDefault();
        $('#chooseBudgetFile').val(function () {
            return this.defaultValue;
        });
        $(".iframe").remove();
    });

    $("#ekraal_team").on("change", function (evn) {
        var baseurl = $(this).data('url');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/team-dep',
            data: {'team_id': $(this).val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                $('#teams').empty();
                $.each(response, function (i, p) {
                    $('#teams').append($('<option ></option>').val(i).html(p));
                });
            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }
        });

    });


    $('#dataTableBuilder').on("change", ".userCheckBox", function (event) {
        console.log("test deactivate");
        var checkBoxes = $('input[type=checkbox]');
        $('#deactivate-user').prop('disabled', !checkBoxes.filter(':checked').length);

    });


    $("#deactivate-user").on('click', function (evn) {
        var baseurl = $(this).data('url');
        var $boxes = $('input[name=users]:checked');
        var selected = new Array();
        $("input[type=checkbox]:checked").each(function () {

            selected.push(this.value);

        });


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/deactivate-user',
            data: {'ids': selected},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                if (response) {
                    location.reload();
                }
            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }

        });

    });


    $('#dataTableBuilder').on("change", ".teamCheckBox", function (event) {
        console.log("test team deactivate");
        var checkBoxes = $('input[type=checkbox]');
        $('#deactivate-team').prop('disabled', !checkBoxes.filter(':checked').length);

    });

    $("#deactivate-team").on('click', function (evn) {
        var baseurl = $(this).data('url');
        var selected = new Array();
        $("input[type=checkbox]:checked").each(function () {

            selected.push(this.value);

        });


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/deactivate-team',
            data: {'ids': selected},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                if (response) {
                    location.reload();
                }
            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }

        });

    });


    $('#frmdash').on('change', function () {
        $(this).submit();
    });

    $('#frmdashboard').on('change', function () {
        $(this).submit();
    });

    $('#frmissue').on('change', function () {
        $(this).submit();
    });


    $("#UserUpload").click(function () {
        var formData = new FormData();

        let file = $('#usersfile')[0].files[0];
        if (file == undefined) {
            alert('File should not be null');
            return null;
        } else {
            $("#processing-upload-users").modal('show');
            formData.append('file', $('#usersfile')[0].files[0]);
            formData.set('team_id', $('#teams_id').val());

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'upload-users',
                type: 'POST',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (data) {

                    alert(data.errormsg);
                    if(data.status===500){
                        console.log(data);

                        $('#processing-upload-users').modal('hide'); // after post
                    }

                    $('#processing-upload-users').modal('hide'); // after post
                    // $('#processing-upload-users').modal('hide');
                    $('#usersfile').val(null);
                },
                error:function (error) {
                    $('#processing-upload-users').modal('hide'); // after post
                }
            });
        }


        // $('#frmUserImport').slideDown(2000).show();
    });


    $("#passresend").click(function () {
        $email = $('#reset_email').val();
        // setTimeout(function(){ $('#processing-upload-users').modal('show'); }, 3000);

        console.log($email);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'resend-pass',
            type: 'POST',
            data: {'reset_email': $email},
            async: false,
            dataType: 'json',
            success: function (data) {
                if(data.code == 404){
                    alert(data.err);

                }

                if(data.code == 201){
                    alert(data.msg);
                    $('#reset_email').val('');

                }

                if(data.code == 403){
                    alert(data.msg);
                    $('#reset_email').val('');

                }


            },
            error: function(xhr, status, error) {
                var err = eval( xhr.responseText );

                $('#modal-resetpass').modal('hide'); // after post
            }



        });


    });


    $(document).on('change', '.file-input', function() {


        var filesCount = $(this)[0].files.length;

        var textbox = $(this).prev();

        if (filesCount === 1) {
            var fileName = $(this).val().split('\\').pop();
            textbox.text(fileName);
        } else {
            textbox.text(filesCount + ' files selected');
        }



        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#divImageMediaPreview");
            dvPreview.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var ext = file[0].type;
                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = '';
                    console.log(ext);
                    switch (ext) {
                        case 'application/pdf':
                            html = '<div class="col-md-3 iframe">' +
                                // '<button  class="back-buttons iframeremove" onclick="removePrv(this);" type="button">' +
                                // '<i class="fa fa-close"></i>' +
                                // ' </button>' +
                                '<iframe  src="' + reader.result + '"  height="100" width="200"/>' +
                                '</div>';
                            dvPreview.append(html);
                            break;
                        default:
                            var img = $("<img />");
                            img.attr("style", "width: 150px; height:100px; padding: 10px");
                            img.attr("src", e.target.result);
                            dvPreview.append(img);
                    }

                }
                reader.readAsDataURL(file[0]);
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }


    });
});


function previewFile(input) {
    var file = input.files[0];
    var ext = file.type;
    var id = $(input).parent('.clonefile').attr('id');
    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            var html = '';
            switch (ext) {
                case 'application/pdf':
                    html = '<div class="col-md-3 iframe">' +
                        '<button data-id="' + id + '" class="back-buttons iframeremove" onclick="removePrv(this);" type="button">' +
                        '<i class="fa fa-close"></i>' +
                        ' </button><iframe  src="' + reader.result + '"  height="100" width="200"/>' +
                        '</div>';
                    break;
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/png':
                    html = '<div class="col-md-3 iframe">' +
                        '<button data-id="' + id + '" class="back-buttons iframeremove" onclick="removePrv(this);" type="button">' +
                        '<i class="fa fa-close"></i> </button>' +
                        '<img  src="' + reader.result + '"  height="100" width="200"/>' +
                        '</div>';
                    break;

            }
            // $("#expensepreviewImg").append(html);
            $(".previewFile").append(html);
        }

        reader.readAsDataURL(file);
    }
}

function removePrv(input) {
    $(input).parents(".iframe").remove();
}


function issuePreviewFile(input) {
    var file = input.files[0];
    var ext = file.type;
    var id = $(input).parent('.clonefile').attr('id');
    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            var html = '';
            switch (ext) {
                case 'application/pdf':
                    html = '<div class="col-md-3 iframe"><button data-id="' + id + '" class="back-buttons iframeremove" type="button">' +
                        '<i class="fa fa-close"></i> </button>' +
                        '<iframe  src="' + reader.result + '"  height="100" width="200"/></div>';
                    break;
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/png':
                    html = '<div class="col-md-3 iframe">' +
                        '<button data-id="' + id + '" class="back-buttons iframeremove" type="button">' +
                        '<i class="fa fa-close"></i> </button>' +
                        '<img  src="' + reader.result + '"  height="100" width="200"/></div>';
                    break;

            }
            $("#issuePreviewImg").append(html);
        }

        reader.readAsDataURL(file);
    }
}


function issuemodalPreviewFile(input) {
    var file = input.files[0];
    var ext = file.type;
    var id = $(input).parent('.clonefile').attr('id');

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            var html = '';
            switch (ext) {
                case 'application/pdf':
                    html = '<div class="col-md-3 iframe"><button data-id="' + id + '" class="back-buttons iframeremove" type="button">' +
                        '<i class="fa fa-close"></i> </button><iframe  src="' + reader.result + '"  height="100" width="200"></iframe></div> ';
                    break;
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/png':
                    html = '<div class="col-md-3 iframe"><button data-id="' + id + '" class="back-buttons iframeremove" type="button"><i class="fa fa-close"></i> </button><img  src="' + reader.result + '"  height="100" width="200"/></div>';
                    break;

            }
            $("#issuemodalPreviewImg").append(html);

            // var html = '<iframe  src="'+reader.result+'"  height="100" width="200"></iframe>';
            // $("#issuemodalPreviewImg").append(html);
        }

        reader.readAsDataURL(file);
    }
}

function workFlowPreviewFile(input) {
    var file = input.files[0];
    var ext = file.type;
    var id = $(input).parent('.clonefile').attr('id');
    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            var html = '';
            switch (ext) {
                case 'application/pdf':
                    html = '<div class="col-md-3 iframe" >' +
                        '<button data-id="' + id + '" class="back-buttons  iframeremove" type="button">' +
                        '<i class="fa fa-close"></i> ' +
                        '</button><iframe  src="' + reader.result + '"  height="100" width="200">' +
                        '</iframe></div> ';
                    break;
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/png':
                    html = '<div class="col-md-3 iframe">' +
                        '<button data-id="' + id + '" class="back-buttons iframeremove" type="button">' +
                        '<i class="fa fa-close"></i> </button>' +
                        '<img  src="' + reader.result + '"  height="100" width="200"/></div>';
                    break;
            }
            $("#workFlowPreviewImg").append(html);
            // $("#").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }




}


