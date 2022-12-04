$(document).ready(function(){
    $("#btn-login").click(function(){
        $email = $('#email').val();
        $pass = $('#password').val();
        var baseurl =  $('#frmlogin').data('url');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl+'/otp',
            data: {'email': $email,
                'password': $pass},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                if(typeof response == "undefined"){
                    location.reload();
                }else if(response.statusCode === 400){
                    $('#error').html(response.msg);

                    $('#otpdiv').modal('show');
                    $('#modal-error').slideDown(2000).show();
                    console.log(response);

                }else {
                    // location.reload();
                }

            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }
        });
    });

    $("#otpSubmit").click(function () {
        $email = $('#email').val();
        $pass = $('#password').val();
        $otp = $('#otp').val();
        var baseurl =  $('#frmlogin').data('url');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl+'/login',
            data: {'email': $email,
            'password': $pass,
            'otp':$otp},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                if(typeof response == "undefined"){
                    location.reload();
                }else if(response.statusCode === 400){

                    $('#error').html(response.msg);
                    $('#modal-error').slideDown(2000).show();
                }

            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }
        });

    });
});
