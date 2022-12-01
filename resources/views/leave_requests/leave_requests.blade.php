@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class=" ">Leave Requests
    </h1>
</section>


<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="container-fluid">
                @include('adminlte-templates::common.errors')
                <div class="table-responsive-sm">
                    <table id="dtBasicExample" class="table table-striped table-bordered ashtray-datatables"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th class="th-sm">#
                            </th>
                            <th class="th-sm">Employee Name
                            </th>
                            <th class="th-sm">Staff ID
                            </th>
                            <th class="th-sm">Leave Type
                            </th>
                            <th class="th-sm">Start date
                            </th>
                            <th class="th-sm">End date
                            </th>
                            <th class="th-sm">Duration
                            </th>
                            <th class="th-sm"><i class="fa fa-eye"></i> Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        use Carbon\Carbon;
                        use Carbon\CarbonPeriod;

                        $count = 1;
                        ?>
                        @foreach($leaves_details as $leave_detail)
                        <tr>
                            <td>
                                <a href="javascript:void(0)"  onclick="show_popup('{{ route('leaves.show', $leave_detail->id) }}')">{{$count++}}</a>
                            </td>
                            <td>{{\App\Models\User::where('id', $leave_detail->user_id)->first()->firstName}}
                                {{\App\Models\User::where('id', $leave_detail->user_id)->first()->lastName}}
                            </td>
                            <td>{{\App\Models\User::where('id', $leave_detail->user_id)->first()->id}}</td>
                            <td>{{\App\Models\LeaveType::where('id', $leave_detail->leave_type)->first()->name}}</td>
                            <td>{{date('Y-m-d',strtotime($leave_detail->start_date))}}</td>
                            <td>{{date('Y-m-d',strtotime($leave_detail->end_date))}}</td>
                            <td>{{$leave_detail->days}}</td>
                            <td> &nbsp;
                                <a href="{{url('/approve_leave')}}"
                                   title="approve"
                                   class="approve_leave btn btn-primary"
                                   urn="{{url('/approve_leave')}}"
                                   approve_value="{{\App\Models\LeaveStatus::where('name','Accepted')->first()->id}}"
                                   leave_id="{{$leave_detail->id}}">
                                    <i class="fa fa-check"></i> Approve
                                </a>
                                &nbsp;
                                <a href="{{url('/reject_leave')}}"
                                   title="reject"
                                   class="reject_leave btn btn-danger"
                                   urn="{{url('/reject_leave')}}"
                                   reject_value="{{\App\Models\LeaveStatus::where('name','Cancelled')->first()->id}}"
                                   leave_id="{{$leave_detail->id}}">
                                    <i class="fa fa-trash"></i> Reject
                                </a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

