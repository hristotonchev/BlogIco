@extends('layouts.public')
@section('pageTitle','Blog Post')
@section('content')
<div class="page padding-bottom">
    <div class="content_wrap">
        <div class="left-panel">
            <div class="panel">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="title">
                    <h1>{{$post['title']}}</h1>
                    <h2>Author: Icaka</h2>
                    <div class="content">
                        <p>{{$post['body']}}</p>
                        <h1>Comments</h1>
                        <br>
                        @include('comments')
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('sidebar')
@parent
@endsection
