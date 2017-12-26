@extends('layout.app')

@section('title', 'Add article')

@section('content')
    <div id="createArticle">
        {!! Form::open(['url' => '/articles', 'method' => 'post', 'files' => true]) !!}
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                {{ Form::label('title', 'Title', []) }}
                {{ Form::text('title', null, ['class'=> 'form-control']) }}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description' , null , ['class' => 'form-control'])  }}
                <small class="text-danger">{{ $errors->first('description') }}</small>
            </div>
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                <label class="btn btn-default btn-file">
                    Browse {{ Form::file('image', ['id' => 'selectImage']) }}
                </label>
                <br>
                <small class="text-danger">{{ $errors->first('image') }}</small>
            </div>
            <div class="form-group">
                <img src=''>                
            </div>
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection

@section('javascript')
{!! Html::script('/js/event.js') !!}
@endsection
