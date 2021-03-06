@extends('layouts.admin')
@section('pageTitle','Delete Blog Posts')
@section('content')
<a>{{session()->get('key')}}</a>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
        @endif

        <h1>Are you sure you want to delete this blog post</h1>
    <div>
        {{ Form::open(array('route' => "admin_delete_blogpost"))}}
         <div style="display:none">
        <br>
        {{Form::label('id','Id')}}
        {{Form::hidden('id',$id)}}
    </div>
        {{Form::submit('Yes', ['class' => 'button button3'])}}
         <a href="{{ route('admin_edit_blogpost',$id)}}" class="button">No</a>
        {{Form::close()}}
    @endsection

