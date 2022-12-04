$(document).ready(function () {

    $("#usrteam").on("change", function (evn) {
        console.log("test" + $(this).val());
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
                $('#usrdep').empty();
                $('#usrdep').prepend($('<option >----Select dep----</option>').val(''));
                $.each(response, function (i, p) {
                    $('#usrdep').append($('<option ></option>').val(i).html(p));
                });
            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }
        });

    });

    $('#btn-userreport').on('click', function (evn) {
        var baseurl = $(this).data('url');
        console.log($('#usrteam').val());
        $('.frm').submit();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/showUserReport',
            data: {'team_id': $('#usrteam').val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                // var blob = new Blob([response], {type: 'application/pdf'});
                // var urls = URL.createObjectURL(blob);
                // document.getElementById("frame").src = URL.createObjectURL(blob);
                // document.write(" <iframe  id='frame' name='frame' src='" + url + "' width='600'  height='315'   allowfullscreen></iframe>");
                console.log(response);
            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }
        });

    });


    // $("#project").on("change", function (evn) {
    //     console.log("test"+$(this).val());
    //     var baseurl = $(this).data('url');
    //     $('#frmproject').submit();
    //
    //
    // });

    $("#ekraal_team").change(function (e) {
        e.preventDefault();
        var baseurl = $(this).data('url');
        // $("#frmleaves").submit();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/team-deps',
            data: {'team_id': $(this).val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                var len = 0;
                var len2 = 0;
                if (response.data != null) {
                    len = response.data.length;
                    console.log(len);
                }
                if (len > 0) {
                    $('#team_dep').empty();
                    $('#team_dep').prepend($('<option >----Select dep----</option>').val(''));
                    // $.each(response, function (i, p) {
                    //     $('#team_dep').append($('<option ></option>').val(i).html(p));
                    // });
                    for (var i = 0; i < len; i++) {
                        var did = response.data[i].id;
                        var dname = response.data[i].name;
                        var option = "<option value='" + did + "'>" + dname + "</option>";

                        $("#team_dep").append(option);
                    }
                }

                if (response.users != null) {
                    len2 = response.users.length;
                    console.log(len2);
                }
                if (len2 > 0) {
                    $('#team_users').empty();
                    $('#team_users').prepend($('<option >----Select members----</option>').val(''));
                    // $.each(response, function (i, p) {
                    //     $('#team_dep').append($('<option ></option>').val(i).html(p));
                    // });
                    for (var users = 0; users < len2; users++) {
                        var uid = response.users[users].id;
                        var uname = response.users[users].name;
                        var optionss = "<option value='" + uid + "'>" + uname + "</option>";

                        $("#team_users").append(optionss);
                    }
                }

            },
            error: function (errors) {
                console.log(errors);
                // location.reload();
                return errors;
            }
        });
    });

    $("#team_dep").change(function (e) {
        e.preventDefault();
        var baseurl = $(this).data('url');
        console.log($(this).val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/dep-users',
            data: {'dep_id': $(this).val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                var len3 = 0;
                if (response.users != null) {
                    len3 = response.users.length;
                    console.log(len3);
                }
                if (len3 > 0) {
                    $('#team_users').empty();
                    $('#team_users').prepend($('<option >----Select members----</option>').val(''));

                    for (var i = 0; i < len3; i++) {
                        var usid = response.users[i].id;
                        var usname = response.users[i].name;
                        var option = "<option value='" + usid + "'>" + usname + "</option>";
                        $("#team_users").append(option);
                    }
                }
            }, error: function (error) {
                console.log('error ' + error);
            }

        });
    });

    $("#equip_brands").change(function (e) {
        e.preventDefault();

        var brand_id = $(this).val();

        method = 'post';
        dataType = 'json';
        baseurl = $(this).data('url');
        $('#equip_models').empty();
        $('#equip_models').prepend($('<option >----Select Model----</option>').val(''));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/getModelType/' + brand_id,
            data: {'brand_id': $(this).val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                var len = 0;
                if (response.data != null) {
                    len = response.data.length;
                    console.log(len);
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var mid = response.data[i].id;
                        var mname = response.data[i].name;
                        var option = "<option value='" + mid + "'>" + mname + "</option>";

                        $("#equip_models").append(option);
                    }
                }
            }, error: function (err) {
                console.log('error ' + err);
            }
        });
    });

    $("#teams_ekraal").change(function (e) {
        e.preventDefault();

        var brand_id = $(this).val();

        method = 'post';
        dataType = 'json';
        baseurl = $(this).data('url');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/team-users',
            data: {'team_id': $(this).val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                $('#t_users').empty();
                $('#t_users').prepend($('<option >----Select User----</option>').val(''));
                var len = 0;
                if (response.data != null) {
                    len = response.data.length;
                    console.log(len);
                } else if (response.error != null) {
                    alert(response.error);
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var uid = response.data[i].id;
                        var uname = response.data[i].name;
                        var option = "<option value='" + uid + "'>" + uname + "</option>";
                        $("#t_users").append(option);
                    }
                }
            }, error: function (err) {
                console.log('error ' + err);
            }
        });
    });
});
