@extends('layouts.public')
@section('pageTitle','Blogs')
@section('content')
<!-- end of MENU WRAPPER -->
<div class="page padding-bottom">
    <div class="content_wrap">
        <div class="left-panel">
            <div class="panel">
                @foreach ($posts as $post)
                <div class="title">
                    <h1>{{$post['title']}}</h1>
                    <h2>Author: Icaka</h2>
                    <div class="content">
                        <p>{{substr($post['body'], 0, 300).'...'}}</p>
                        <a href="{{ route('blogpost',$post['id'])}}" class='button'> --You can continue reading here --</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="clear"></div>

    </div>
</div>
@endsection
@section('sidebar')
@parent
@endsection
