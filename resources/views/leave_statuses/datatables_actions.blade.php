{!! Form::open(['route' => ['leaveStatuses.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="javascript:void(0)" onclick="show_popup('{{ route('leaveStatuses.show', $id) }}')"
       class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @if(Auth::user()->hasRole('super-admin'))

    <a href="{{ route('leaveStatuses.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-danger btn-xs',
    'onclick' => "return confirm('Are you sure?')"
    ]) !!}
    @endif
</div>
{!! Form::close() !!}
