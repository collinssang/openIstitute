
//Dropzone Configuration


Dropzone.autoDiscover = false;

$(document).ready(function () {


    // $('.last-step').on('click', new Form(formEl));

    save = function()
    {
        var formEl = document.querySelector('.content.active');


        var appraisal = new Form(formEl);
        appraisal.save();

    };

    submit = function(){
        var formEl = document.querySelector('.content.active');
        var appraisal = new Form(formEl);
        appraisal.submit();

    };



    $(".add").click(function() {
        $(".cloneDefault").clone(true).insertBefore(".objrow > div:last-child");
        $(".objrow > .cloneDefault").removeClass("cloneDefault");
        return false;
    });

    $(document).on('click', '.remove', function() {
        $(this).parent().remove();
    });

    var myDropzone = new Dropzone(signature, {
        url: '/upload-emp-signature',
        paramName: "file", //the parameter name containing the uploaded file
        clickable: true,
        maxFilesize: 1, //in mb
        uploadMultiple: true,
        maxFiles: 10, // allowing any more than this will stress a basic php/mysql stack
        addRemoveLinks: true,
        acceptedFiles: '.png,.jpg,.jpeg', //allowed filetypes
        dictDefaultMessage: "Upload your files here", //override the default text
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                var id = $('#empId').val();
                var sessionCode = $('#empSessionCode').val();
                console.log(id);
                formData.append("session_code", sessionCode); // Append all the additional input data of your form here!
                formData.append("id", id); // Append all the additional input data of your form here!
            });
            this.on("success", function(file, responseText) {
                console.log(responseText);
                var html = "<img data-dz-thumbnail='' alt='' src='"+responseText+"' style='width: 100%;height: 100px'>";
                //auto remove buttons after upload
                $("#div-files").html(html);
                $("#empsign").val(responseText);
                var _this = this;
                _this.removeFile(file);
            });
        }
    });


    var teamSign = new Dropzone(teamlead_signature, {
        url: '/upload-team-lead-signature',
        paramName: "file", //the parameter name containing the uploaded file
        clickable: true,
        maxFilesize: 1, //in mb
        uploadMultiple: true,
        maxFiles: 10, // allowing any more than this will stress a basic php/mysql stack
        addRemoveLinks: true,
        acceptedFiles: '.png,.jpg,.jpeg', //allowed filetypes
        dictDefaultMessage: "Upload your signature here", //override the default text
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                var id = $('#commentId').val();
                var userId = $('#userId').val();
                var sessionCode = $('#userSessionCode').val();
                formData.append("session_code", sessionCode); // Append all the additional input data of your form here!
                formData.append("id", id); // Append all the additional input data of your form here!
                formData.append("user_id", userId);
            });
            this.on("success", function(file, responseText) {
                console.log(responseText);
                var html = "<img data-dz-thumbnail='' alt='' src='"+responseText+"' style='width: 100%;height: 100px'>";
                //auto remove buttons after upload
                $("#div-sign").html(html);
                $("#teamleadsign").val(responseText);
                var _this = this;
                _this.removeFile(file);
            });
        }
    });

    var mngSign = new Dropzone(manager_signature, {
        url: '/upload-mng-signature',
        paramName: "file", //the parameter name containing the uploaded file
        clickable: true,
        maxFilesize: 1, //in mb
        uploadMultiple: true,
        maxFiles: 10, // allowing any more than this will stress a basic php/mysql stack
        addRemoveLinks: true,
        acceptedFiles: '.png,.jpg,.jpeg', //allowed filetypes
        dictDefaultMessage: "Upload your signature here", //override the default text
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                var id = $('#mngcommentId').val();
                var userId = $('#mnguserId').val();
                var sessionCode = $('#mnguserSessionCode').val();
                formData.append("session_code", sessionCode); // Append all the additional input data of your form here!
                formData.append("id", id); // Append all the additional input data of your form here!
                formData.append("user_id", userId);
            });
            this.on("success", function(file, responseText) {
                console.log(responseText);
                var html = "<img data-dz-thumbnail='' alt='' src='"+responseText+"' style='width: 100%;height: 100px'>";
                //auto remove buttons after upload
                $("#div-mngsign").html(html);
                $("#mngsign").val(responseText);
                var _this = this;
                _this.removeFile(file);
            });
        }
    });
    $('select.rating option:first').attr('readonly', true);



});

var Form = function () {
    function Form(element, _options) {
        var _this = this;
        if (_options === void 0) {
            _options = {};
        }
        this._element = element;
    }

    var _proto = Form.prototype;

    _proto.save = function save() {
        var _this1 = this;
        return formContent(_this1._element);
        // var formEl = document.querySelector('.content.active');
    };

    _proto.submit = function submit(){
        var _this1 = this;
        submitContent(_this1._element);
    };
    return Form;
}();

var formContent = function formContent(elements){
    var form = elements.querySelector('form');
    // var dataToSend = elements.querySelector("form").serialize();
    var formId = form.getAttribute('id');
    var json = $('#'+formId).serializeJSON();
var error = false;
    json['url'] = form.getAttribute("action");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: json.url,
        data: json,
        async: false,
        // processData: false,
        // contentType: false,
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            if(data.status == 200){
                toastr["success"](data.message);
            }

            error = true;

        },
        error: function (data) {
            var json = JSON.parse(data.responseText);
            console.log(data.responseText);
            var html = '';
            var errors = json.errors;
            for (x in errors ) {
                html += errors[x];

            }
            toastr["error"](html);
            error = false;
        }
    });

    return error;
};


var submitContent = function submitContent(elements){
    var form = elements.querySelector('form');
    if(form==null){
        location.reload();
    }
    // var dataToSend = elements.querySelector("form").serialize();
    var formId = form.getAttribute('id');
    var json = $('#'+formId).serializeJSON();

    json['url'] = form.getAttribute("action");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: json.url,
        data: json,
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            if(data.status == 200){
                toastr["success"](data.message);
            }
            alert("Form submitted successfully");
            var pathname = window.location.pathname.split('/');
            if(pathname[1] === "emp-appraisal"){
                location.href = "/appraisalUserSessions";
            }else
            {
                location.reload();
            }



        },
        error: function (data) {
            var json = JSON.parse(data.responseText);
            console.log(data.responseText);
            var html = '';
            var errors = json.errors;
            for (x in errors ) {
                html += errors[x];

            }
            toastr["error"](html);


        }
    });

    console.log(json);
};


function toJSONString( form ) {
    var obj = {};
    var elements = form.querySelectorAll( "input, select, textarea, file" );
    let data = $("#frm2").serialize();
    console.log(data);

    obj['url'] = form.getAttribute("action");
    for( var i = 0; i < elements.length; ++i ) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;

        if( name ) {
            obj[ name ] = value;
        }
    }

    return obj;
}


function serialize(form) {
    let requestArray = {};
    form.querySelectorAll('[name]').forEach((elem) => {
        requestArray[elem.name]= elem.value;
    });
    // if(requestArray.length > 0)
        return requestArray;
    // else
    //     return false;
}



