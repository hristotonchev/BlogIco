@foreach($comments as $comment)
    <div class="title">
        <h2>From : {{$comment['author']}}</h2>
        <p>{{substr($comment['comment_body'], 0, 300)}}</p>
    </div>
@endforeach
    {{Form::open(array('route'=>'comment'))}}
    <div>
        <h2>{{ Form::label('author', '* Your Name')}}</h2>
        {{Form::text('author',null, array('class'=>"text-field", 'placeholder'=>'Type your name here'))}}
    </div>
    <div>
        <br>
        <h2>{{Form::label('commentBody','* Your Comment:')}}</h2>
        {{Form::textarea('comment_body',null,array('class'=>"textarea", 'placeholder'=>'Type your comment here'))}}
    </div>
    <div style="display:none">
        <br>
        {{Form::label('displayed','Displayed')}}
        {{Form::checkbox('displayed', 'value', true)}}
    </div>
    <div style="display:none">
        <br>
        {{Form::label('blog_post_id','blog_post_id')}}
        {{Form::hidden('blog_post_id',"$post->id")}}
    </div>
    <div>
        <br>
        {{Form::submit('Submit!')}}
    </div>
    {{ Form::close() }}
