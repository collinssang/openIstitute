@include('layouts.modals')
{!! Form::open(['route' => ['leaveDays.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a onclick="show_popup('{{ route('leaveDays.show', $id) }}')"
       href="javascript:void(0);" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @if(Auth::user()->hasRole('super-admin'))
    <a href="{{ route('leaveDays.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endif
</div>
{!! Form::close() !!}
