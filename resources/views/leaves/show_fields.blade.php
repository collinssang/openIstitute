<!-- Leave Type Field -->
<div class="form-group">
    {!! Form::label('leave_type', 'Leave Type:') !!}
    <p>{{ App\Models\LeaveType::where('id',$leaves->leave_type)->first()->name }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ App\Models\User::where('id',$leaves->user_id)->first()->firstName }} {{ App\Models\User::where('id',$leaves->user_id)->first()->lastName }}</p>
</div>

<!-- Leave Status Field -->
<div class="form-group">
    {!! Form::label('leave_status', 'Leave Status:') !!}
    <p>{{ App\Models\LeaveStatus::where('id',$leaves->leave_status)->first()->name }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $leaves->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $leaves->end_date }}</p>
</div>

<!-- Reason Field -->
<div class="form-group">
    {!! Form::label('reason', 'Reason:') !!}
    <p>{{ $leaves->reason }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $leaves->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $leaves->updated_at }}</p>
</div>

