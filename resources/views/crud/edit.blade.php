@extends('layout.app')

@section('title', 'Edit article')

@section('content')
    <div id="editArticle">
        {!! Form::open(['url' => "/articles/$article->id", 'method' => 'put', 'files' => true]) !!}
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                {{ Form::label('title', 'Title', []) }}
                {{ Form::text('title', $article->title, ['class'=> 'form-control']) }}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description' , $article->description, ['class' => 'form-control'])  }}
                <small class="text-danger">{{ $errors->first('description') }}</small>
            </div>
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                <label class="btn btn-default btn-file">
                    Browse {{ Form::file('image', ['id' => 'updateImage']) }}
                </label>
                <br>
                <small class="text-danger">{{ $errors->first('image') }}</small>
            </div>
            <div class="form-group">
                <img src='{{ $article->image_link ? $article->image_link : "/images/articles/$article->image"  }}'>                
            </div>
            {{ Form::submit('Add', ['class'=> 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>    
@endsection


@section('javascript')
{!! Html::script('/js/event.js') !!}
@endsection