@extends('layout.app')

@section('title', 'Articles')

@section('content')
    @if (Session::has('message'))
    <div id="messageBlock" class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered" id="articleTable">
        <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Url</th>
            <th>Show</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('javascript')
    {!! Html::script('/js/index.js') !!}
@stop