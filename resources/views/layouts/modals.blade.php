<!-- jQuery 3.1.1 -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script type="text/javascript">
function show_popup(url){
    // LOADING THE AJAX MODAL
    //alert("found");

     $('#modal_ajax').modal('show', {backdrop: 'true'});

    //load spinner
    $('#modal_ajax .modal-body').html('<div style="text-align:center">' +
        '<i class="fa fa-refresh fa-5x fa-spin" style="font-size: 4em;"></i>'+
        '</div>');

    setTimeout(function (){
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            method: 'get',
            success: function(response)
            {
                if(!response){
                    toastr["error"]('Page Not Found');
                }
                console.log(response);
                $('#modal_ajax .modal-body').html(response);
            }
        });
    }, 2000);

 }


function show_preview_popup(url,id,code){
    // LOADING THE AJAX MODAL
    let uri = "{{url('/')}}/pdf-report/"+id+"/"+code;
    let href = '<a href="'+uri+'" target="_blank" style="color: #ffffff" >Generate Report</a>';
    $('#report').html(href);
    console.log(href);
    $('#preview_modal_ajax').modal('show', {backdrop: 'true'});

    //load spinner
    $('#preview_modal_ajax .modal-body').html('<div style="text-align:center">' +
        '<i class="fa fa-refresh fa-5x fa-spin" style="font-size: 4em;"></i>'+
        '</div>');

    setTimeout(function (){
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            method: 'get',
            success: function(response)
            {
                if(!response){
                    toastr["error"]('Page Not Found');
                }
                console.log(response);
                $('#preview_modal_ajax .modal-body').html(response);
            }
        });
    }, 2000);

}

</script>
<div class="modal fade in" id="modal_ajax" role="dialog" width="" style="width: auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5>{{ config('app.name', 'E-kraal') }}</h5>
            </div>

            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade in" id="preview_modal_ajax" role="dialog" width="" style="width: auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5>{{ config('app.name', 'E-kraal') }}</h5>
            </div>

            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="report"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
