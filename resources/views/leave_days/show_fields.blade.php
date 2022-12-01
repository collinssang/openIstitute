<div class="row">
    <!-- Leave Type Field -->
    <div class="form-group">
        {!! Form::label('leave_type', 'Leave Type:') !!}
        <p>{{
            $leaveDays->leave_type
            ? App\Models\LeaveType::where('id', $leaveDays->leave_type)->first()->name
            : "Type Not defined"
            }}
        </p>
    </div>
    <br>
    <!-- Entitled Days Field -->
    <div class="form-group">
        {!! Form::label('Entitled_days', 'Entitled Days:') !!}
        <p>{{ $leaveDays->Entitled_days }}</p>
    </div>
    <br>
    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{{ $leaveDays->created_at }}</p>
    </div>
    <br>
    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{{ $leaveDays->updated_at }}</p>
    </div>

</div>
