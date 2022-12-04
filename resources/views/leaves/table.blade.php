@section('css')
    @include('layouts.datatables_css')
@endsection

<table width = '100%' class = 'table table-striped table-bordered'>
<tr>
    <th>Leave Type</th>
    <th>Leave Status</th>
    <th>Leave Start Date</th>
    <th>Leave End Date</th>
    <th>Number of days</th>
</tr>
    @foreach($leaves as $leave)
    <tr>
        <td>
            {{\App\Models\LeaveType::where('id',$leave->leave_type)->first()->name}}
        </td><td>
            {{\App\Models\LeaveStatus::where('id',$leave->leave_status)->first()->name}}
        </td>
        <td>
            {{$leave->start_date}}
        </td> <td>
            {{$leave->end_date}}
        </td> <td>
            {{$leave->days}}
        </td>
    </tr>
    @endforeach
</table>

@push('scripts')
    @include('layouts.datatables_js')
@endpush
