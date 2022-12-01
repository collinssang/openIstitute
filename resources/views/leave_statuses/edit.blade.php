@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Leave Status
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($leaveStatus, ['route' => ['leaveStatuses.update', $leaveStatus->id], 'method' => 'patch']) !!}

                        @include('leave_statuses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection