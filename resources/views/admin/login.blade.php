<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/styles2.css" rel="stylesheet" type="text/css" />
<title>Login</title>
<p>{{session()->get('login_fail')}}</p>
<a>{{session()->get('key')}}</a>
<div>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
</div>
    @endif
<h1>Login</h1>

{{Form::open (array ('route' => 'logincheck'))}}

<div>
    <h2>{{ Form::label('username', '* Your UserName')}}</h2>
        {{Form::text('username',null, array('class'=>'box','placeholder'=>'Type your username here'))}}
</div>
<div>
    <h2>{{ Form::label('password', '* Your Passowrd')}}</h2>
        {{Form::password('password', array('class'=>'box','placeholder'=>'Type your password here'))}}
</div>
<div>
    <br>
        {{Form::submit('Submit!')}}
</div>
{{Form::close ()}}
