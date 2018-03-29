@extends('layouts.admin')
@section('pageTitle','Comments')
@section('content')
    <ul>{{session()->get('key')}}</ul>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1 align='center'>Comment</h1>
    <table>
        <tr>
            <th width="5%">ID</th>
            <th width="5.5%">Author</th>
            <th>Body</th>
            <th width="10%">Created</th>
            <th width="5%">Displayed</th>
            <th width="5%">Blogpost id</th>
            <th width="6.5%">Delete</th>
        </tr>
            {{ $comment->links() }}
    <table>
    @foreach ($comment as $result)
            <tr>
                <th width="5%">{{$result->id}}</th>
                <th width="5%">{{$result->author}}</th>
                <th>{{ substr($result['comment_body'], 0, 300).'...' }}</th>
                <th width="10%">{{$result->created}}</th>
                <th width="5%">{!! $result->displayed ? "&#10004;":"&#10008;" !!}</th>
                <th width="5%">{{$result->blog_post_id}}</th>
                <th width="5%"><a href="{{ route('admin_destroy_comment',['id'=>$result->id])}}" class="button button3">Delete</a></th>
    @endforeach
            </tr>
@endsection

