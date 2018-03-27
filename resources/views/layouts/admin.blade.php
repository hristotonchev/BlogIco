<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> @yield('pageTitle')</title>
<link href="/css/styles2.css" rel="stylesheet" type="text/css" />
</head>

<a href="{{ route('admin_blogposts')}}" class="button @if ((\Request::route()->getName()) == 'admin_blogposts') active @endif">Blog Posts</a>
<a href="{{ route('admin_create_blogpost')}}" class="button @if((\Request::route()->getName()) == 'admin_create_blogpost') active @endif">Create Blog Post</a>
<a href="{{ route('admin_comments_list')}}" class="button @if((\Request::route()->getName()) == 'admin_comments_list') active @endif">Comments</a>

<a href="{{ route('logout')}}" class="button button4">Logout</a>
<!-- here should be the content -->

@yield('content')
