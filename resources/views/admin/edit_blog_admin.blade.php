@extends('layouts.admin')
@section('pageTitle','Blog Posts')
@section('content')
<a>{{session()->get('key')}}</a>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
        @endif
    @if ($isNew)
        <title> Submit Blog HERE</title>
        <h1>Create blog post</h1>
         {{Form::open(array('route'=>'admin_save_blogpost'))}}
    @else
        <title> Update Blog</title>
        <h1>Update blog post</h1>
        {{ Form::open(array('route'=>'admin_update_blogpost'))}}
    @endif
    <div>
        {{Form::label('title', '* Title')}}
        {{Form::text('title',$title,array('placeholder' =>'Type the blog title here'))}}
    </div>
    <div>
        <br>
        {{Form::label('body', '* Body')}}
        {{Form::textarea('body',$body,array('placeholder' =>'Type the blog post here'))}}
    </div>
    <div>
        <br>
        {{Form::label('published','Published')}}
        {{Form::checkbox('published'),$published}}
    </div>
   <div style="display:none">
        <br>
        {{Form::label('id','Id')}}
        {{Form::hidden('id',$id)}}
    </div>
    <div>
        <br>
        @if($isNew)
            {{Form::submit('send',array('class'=>'button'))}}
        @else
            {{Form::submit('send', array('class'=>'button'))}}
            <a href="{{ route('admin_destroy_blogpost',$id)}}" class="button button3">Delete</a>
        @endif
    </div>
    @endsection

