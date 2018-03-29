@extends('layouts.admin')
@section('pageTitle','Blog Posts')
@section('content')
    <ul>{{session()->get('key')}}</ul>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h1 align='center'>Blog Posts </h1>
    <table>
        <tr>
            <th width="5%">ID</th>
            <th width="5.5%">Title</th>
            <th>Body</th>
            <th width="5%">Published</th>
            <th width="6.5%">Edit</th>
            <th width="6.5%">Delete</th>
        </tr>
          {{ $blogPost->links() }}
    <table>
    @foreach ($blogPost as $result)
            <tr>
                <th width="5%">{{$result->id}}</th>
                <th width="5%">{{$result->title}}</th>
                <th>{{ substr($result['body'], 0, 300).'...' }}</th>
                <th width="5%">{!! $result->published ? "&#10004;":"&#10008;" !!}</th>
                <th><a class="button button" href="{{ route('admin_edit_blogpost', ['id'=>$result->id])}}"</a>Edit</th>
                <th width="5%"><a href="{{ route('admin_destroy_blogpost',['id'=>$result->id])}}" class="button button3">Delete</a></th>

    @endforeach
            </tr>

@endsection

