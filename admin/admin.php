<?php
include("../inc/header_admin.php");

$currentPage = 'admin';

    if(!empty($_SESSION['messages'])){
        echo '<ul>';
        foreach($_SESSION['messages'] as $value){
                echo '<li>'.$value.'</li>';
        } echo '</ul>';
    }
    unset($_SESSION['messages']);
    if(isset($_POST['published']))
    {
        $published= 1;
    }
    else {
        $published= 0;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $body = $_POST['body'];

    }
    if(!empty($_POST) && isset($body) && $body == ''){
        $error_message = 'Body is blank MF';
    }
    if(!empty($_POST) && isset($title) && $title == ''){
        $error_message = 'Title is blank MF';
    }

    if(!empty($_POST) && !isset($error_message)){
        $sql = "insert into blog_posts (title, body,published) values (:title, :body, :published)";
        $query = $DB_con->prepare($sql);
        $query->execute(array('title' => $title,
                              'body' => $body,
                              'published' => $published));
        $_SESSION['messages'] = [
        'blogPosted' => 'Blog post send successfully',
        'postAnotherBlog' => 'You can post another one!'
        ];
        header("Location:admin.php");
    } else {
            if (isset($error_message)){
                    echo "<p class='p p2'>".$error_message."</p>";
            }
    }
$isNew = True;
$messages = null;
include('templates/edit_blog_post.tpl.html');



