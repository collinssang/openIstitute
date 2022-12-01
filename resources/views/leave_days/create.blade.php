@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Leave Days
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'leaveDays.store']) !!}

                        @include('leave_days.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
