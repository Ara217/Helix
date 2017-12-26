{!! Form::open(['url' => "/articles/$articleId", 'method' => 'delete']) !!}
    {{ Form::submit('Delete', ['class'=> 'btn btn-danger']) }}
{!! Form::close() !!}