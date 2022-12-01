<!-- Leave Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('leave_type', 'Leave Type:') !!}
    {!! Form::select('leave_type', $leave_typeItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Entitled Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Entitled_days', 'Entitled Days:') !!}
    {!! Form::number('Entitled_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('leaveDays.index') }}" class="btn btn-default">Cancel</a>
</div>
