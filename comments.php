<?php

if(isset($_POST['displayed'])){
    $displayed = 1;
} else {
    $displayed = 0;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $author = $_POST['author'];
    $commentBody = $_POST['comment_body'];
    $blogPostId = $_GET['id'];
}

if(!empty($_POST) && isset($author) && $author == ''){
    $error_message = 'Don\' mess with the author';
}

if(!empty($_POST) && isset($commentBody) && $commentBody == ''){
    $error_message = 'No Comment';
}

require_once('models/model.php');

$comments = displayAllComments();


if(!empty($_POST) && !isset($error_message)){
    $commnet =  addComment($author,$commentBody,$displayed, $blogPostId);
} else {
        if (isset($error_message)){
                echo "<p class='p p2'>".$error_message."</p>";
        }
}

$isNew = True;
$messages = null;
include('templates/comments.tpl.html');

