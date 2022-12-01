{!! Form::open(['route' => ['leaves.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="javascript:void(0)" onclick="show_popup('{{ route('leaves.show', $id) }}')" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
<!--    <a href="{{ route('leaves.edit', $id) }}" class='btn btn-default btn-xs'>-->
<!--        <i class="glyphicon glyphicon-edit"></i>-->
<!--    </a>-->

</div>
{!! Form::close() !!}
