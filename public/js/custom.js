$(document).ready(function () {
    // $('select').select2();
    $('.approve_leave').click(function (e) {
        e.preventDefault();
        var urlx = $(this).attr('href');
        var data = $(this).attr('approve_value');
        var leave_id = $(this).attr('leave_id');
        var url = urlx + "/" + leave_id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: {'leave_status': data},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                location.reload();
                return response;
            },
            error: function (errors) {
                console.log(errors);
                location.reload();
                return errors;
            }
        });

    });

    $('.reject_leave').click(function (e) {
        e.preventDefault();
        var urlc = $(this).attr('href');
        var data = $(this).attr('reject_value');
        var leave_i = $(this).attr('leave_id');
        var url = urlc + "/" + leave_i;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: {'leave_status': data},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                alert(response);
                console.log(response);
                location.reload();
                return response;
            },
            error: function (errors) {
                location.reload();
                return errors;
                console.log('error ' + errors);
            }
        });

    });

    $('.accept').click(function (e) {

        e.preventDefault();
        var equip_id = $(this).attr('val');
        var data = 1;
        var urlc = $(this).attr('urc');
        var url = urlc;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: {'status': data, 'equip_id': equip_id},
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                location.reload();
                return response;
            },
            error: function (errors) {
                location.reload();
                return errors;
                console.log('error ' + errors);
            }
        });
    });


    $(".expense_user").change(function (e) {
        e.preventDefault();
        var user_id = $(this).val();
        var url = $(this).attr('uri');
        var url2 = url + '/' + user_id;
        var method = "post";

        var baseUrl = $('.receiptNo').empty();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url2,
            type: method,
            dataType: 'json',
            success: function (response) {

                var len = 0;
                if (response.data != null) {
                    len = response.data.length;
                }
                if (len > 0) {
                    $(".receiptNo").prepend("<option value='0' selected='selected'>Select Receipt No ...</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response.data[i].receiptNumber;
                        var name = response.data[i].receiptNumber;

                        var option = "<option value='" + id + "'>" + name + "</option>";
                        // $(".receiptNo").append(option);
                        // $(".receiptNo option:first").after(option);
                        $(".receiptNo").append(option);
                    }
                }
            }, error: function (error) {
                console.log(error);
                alert(error);
            }
        });
    });


    $(".receiptNo").change(function (e) {
        e.preventDefault();
        var data = $(this).val();
        if (data != 0) {
            var uri = $(this).attr('uri');
            var method = 'post';
            var url = uri + '/getBalance/' + data;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: method,
                dataType: 'json',
                success: function (response) {
                    $(".balacediv").fadeIn(2000);
                    $(".receiptLabel").html(data);
                    $(".balanceLabel").html(response);
                    $(".price").val(response);
                }, error: function (error) {
                    console.log(error);
                }
            });
        } else {
            alert("Please Select receipt Number");
        }
    });


    $(".equipmentBrandModel").change(function (e) {
        e.preventDefault();
        var data = $(this).val();
        if (data != 0) {
            var uri = $(this).attr('uri');
            var method = 'post';
            var url = uri + '/getEquipmentData/' + data;
            $(".eCondition").fadeIn(2000);
            $(".eBrand").fadeIn(2000);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: method,
                dataType: 'json',
                success: function (response) {
                    var len = 0;
                    console.log(response);
                    if (response.data != null) {
                        var eid = response.data.conditions.id;
                        var ename = response.data.conditions.name;
                        var bid = response.data.brands.id;
                        var bname = response.data.brands.name;
                        var option = "<option value='" + eid + "'>" + ename + "</option>";
                        $(".cond").append(option);

                        var options2 = "<option value='" + bid + "'>" + bname + "</option>";
                        $(".eBrands").empty();
                        $(".eBrands").append(options2);

                        $(".serialNumber").val(response.data.serial_number);
                    }
                }
                , error: function (error) {
                    console.log(error);
                }
            })
        } else {
            alert("Please Select receipt Number");
        }

    });

    // $('#btn-user').modal('toggle');


    $('#btn-user').on("click", function (evn) {
        $(this).prop('disabled', true);
        $('#processing-users').modal('toggle');
        var times = +new Date() / 1000;
        setTimeout(function () {
            $('.frm').submit();
        }, 1500);
        // $('#frm-user').submit();
    });

    $('.brandS').change(function (e) {
        e.preventDefault();
        var brandID = $(this).val();
        $("#equipID").val(brandID);
        var uri = $("#equipID").attr('uri');

        var url = uri + '/' + brandID;

        var method = 'post';
        $(".eType").empty();
        $(".eModels").empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            dataType: 'json',
            success: function (response) {
                if (response.data != null) {

                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    if (len > 0) {
                        $(".eModels").prepend("<option value='0' selected='selected'>Select Model</option>");
                        for (var i = 0; i < len; i++) {
                            var mid = response.data[i].id;
                            var mname = response.data[i].name;
                            var option = "<option value='" + mid + "'>" + mname + "</option>";

                            $(".eModels").append(option);
                        }
                    }
                    // var tid = response.data[i].types.id;
                    // var tname = response.data[i].types.name;
                    //
                    // var option = "<option value='" + tid + "'>" + tname + "</option>";
                    //
                    // $(".eType").append(option);
                }

            }, error: function (error) {
                console.log(error);
            }
        });

    });

    $(".addNewRow").click(function (e) {
        e.preventDefault();
        var url = $(this).attr('uri');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.data != null) {
                    var lenb = 0;
                    if (response.data != null) {
                        lenb = response.data.length;
                    }
                    if (lenb > 0) {
                        var bid = '';
                        var bname = '';
                        var options = '';


                        var newRowContent = ' <tr> ' +
                            '<td style="width: 6px;">' +
                            '<a href="#" class="btn btn-danger delete_row"><i class="fa fa-minus-circle"></i></a>' +
                            '</td>\n' +
                            '<td class="indexTd"> ' +
                            '<select class="form-control" name="type[]" style="width: 100px;">' +
                            '<option>Select Budget Type</option>';
                        for (var i = 0; i < lenb; i++) {
                            var bid = response.data[i].id;
                            var bname = response.data[i].name;
                            newRowContent += '<option value="' + bid + '">' + bname + '</option>';
                        }
                        newRowContent += '</select> ' +
                            '</td>' +
                            ' <td>\n' +
                            '        <input name="budget_item[]" type="text" style="width: 100px;" required>\n' +
                            '        </td>\n' +
                            '        <td>\n' +
                            '         <input type="text" name="budget_from[]" required style="width:100px;" class="budget_froms" placeholder="YYYY-mm-dd"/>\n' +
                            '        </td>\n' +
                            '        <td>\n' +
                            '            <input name="budget_to[]" class="budget_tos" type="text" style="width:100px;" required placeholder="YYYY-mm-dd">\n' +
                            '        </td>\n' +
                            '        <td>\n' +
                            '            <textarea name="description[]" type="text" required cols="15"></textarea>\n' +
                            '        </td>\n' +
                            '        <td>\n' +
                            '            <input name="estimated_amount[]" type="number" required class="estimate_amount" style="width: 80px;">\n' +
                            '        </td>\n' +
                            '    </tr>';

                        newRowContent += '<script>' +
                            ' $(\'.budget_froms\').datepicker({\n' +
                            '        format: \'yyyy-mm-dd\',\n' +
                            '        useCurrent: true,\n' +
                            '        sideBySide: true,\n' +
                            '        autoclose: true,\n' +
                            '    }).on(\'changeDate\', function (selected) {\n' +
                            '        console.log($(this).val());\n' +
                            '        var minDate = new Date(selected.date.valueOf());\n' +
                            '        $(".budget_tos").datepicker(\'setStartDate\', minDate);\n' +
                            '    });</script>';
                        newRowContent += '<script>' +
                            '$(\'.budget_tos\').datepicker({\n' +
                            '        format: \'yyyy-mm-dd\',\n' +
                            '        useCurrent: true,\n' +
                            '        sideBySide: true,\n' +
                            '    });</script>';

                        $(".budget_form .bodyT").append(newRowContent);

                    }
                }
            }
        });
    });


    $(".bodyT").on('blur', '.actual_amount', function (e) {
        e.preventDefault();
        var actual_amount = $(this).val();
        ;
        var existing_total = $("#total_request").val();
        var total_total = Number(existing_total) + Number(actual_amount);
        $("#total_request").val(total_total);
    });

    $(".bodyT").on('blur', '.estimate_amount', function (e) {
        e.preventDefault();
        var estimate_amount = $(this).val();
        var existing_value = $("#total_estimate_request").val();
        var totalEst = Number(existing_value) + Number(estimate_amount);
        $("#total_estimate_request").val(totalEst);

    });
    $(document).on('click', ".delete_row", function () {
        $(this).parents("tr").remove();
    });

    $(".view_claims").click(function (e) {
        e.preventDefault();
        $(".expense_icons").slideDown(2000).hide();
        $(".expenses_table").slideUp(2000).show();

    });

    $('#employee').change(function (e) {
        e.preventDefault();

        var employee_id = $(this).val();
        var url = $(this).data('url');
        var method = 'post';
        var dataType = 'json';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url + '/getSerialNo',
            data: {'employee': employee_id},
            type: method,
            dataType: dataType,
            success: function (response) {
                $("#serial").empty();
                $.each(response, function (i, p) {
                    $('#serial').append($('<option ></option>').val(p).html(p));
                });

            }, error: function (error) {
                console.log("error " + error);
            }
        });
    });

    $(".project_team").on("change", function (evn) {
        var baseurl = $(this).data('url');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseurl + '/team_dep_project',
            data: {'team_id': $(this).val()},
            dataType: 'json',
            type: 'POST',
            success: function (response) {

                $('.departments').empty();
                $('.departments').prepend('<option value="" >Select Department</option>');
                $.each(response.dep, function (i, p) {
                    $('.departments').append($('<option ></option>').val(i).html(p));
                });


                $('.projects').empty();
                $('.projects').prepend('<option value="" >Select Project</option>');
                $.each(response.projects, function (i, p) {
                    $('.projects').append($('<option ></option>').val(i).html(p));
                });


            },
            error: function (errors) {
                console.log(errors);
                return errors;
            }
        });

    });

});
