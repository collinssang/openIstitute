<!-- Leave Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('leave_type', 'Leave Type:') !!}
    {!! Form::select('leave_type', $leave_typeItems, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('leave duration', 'Enter Duration details for your leave below:') !!}
    <p class="form-control" style="border-color: transparent;"> &nbsp;</p>
</div>
<!-- Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'leave_start_date','autocomplete'=>'off']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#leave_start_date').datepicker({
            format: 'yyyy-mm-dd',
            useCurrent: true,
            sideBySide: true,
            autoclose: true,
        }).on('changeDate', function (selected) {
            console.log($(this).val());
            var minDate = new Date(selected.date.valueOf());
            $("#leave_end_date").datepicker('setStartDate', minDate);
        });
    </script>
@endpush

<!-- Start Date Field -->
<div class="form-group col-sm-6">
    <label for='start_date_time'>Start Date Time:</label>
    <select name="start_date_time" class= 'form-control' id='start_date_time' data-placeholder="Select Start Time">
        <option value="1">Morning</option>
        <option value="2">Afternoon</option>
    </select>
</div>

<!-- End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'leave_end_date','autocomplete'=>'off']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#leave_end_date').datepicker({
            format: 'yyyy-mm-dd',
            useCurrent: true,
            sideBySide: true,
        });
    </script>
@endpush

<!-- End Date Time Field -->
<div class="form-group col-sm-6">
    <label for='end_date_time'>End Date Time:</label>
    <select name="end_date_time" class = 'form-control' id='end_date_time' data-placeholder="Select End Time">
    <option value="1">Morning</option>
    <option value="2">Afternoon</option>
    </select>
</div>

<!-- Reason Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::textarea('reason', null, ['class' => 'form-control']) !!}
</div>


<!-- Leave Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('leave_status', 'Leave Status:') !!}
    {!! Form::select('leave_status', $leave_statusItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('leaves.index') }}" class="btn btn-default">Cancel</a>
</div>
