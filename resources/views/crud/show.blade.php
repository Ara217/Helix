@extends('layout.app')

@section('title', 'Show article')

@section('content')
    <div style="text-align: left">
        <h2>{{$article->title}}</h2>
        <img src='{{ $article->image_link ? $article->image_link : "/images/articles/$article->image" }}'>
        <p>{{$article->description}}</p>
        <p>Created at {{$article->date}}</p>

        @if ($article->image_link)
            <a href="{{$article->url}}" target="_blank">Source link</a>
        @endif
        
    </div>
@endsection


