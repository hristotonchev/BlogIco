<?php
require_once('models/model.php');

function createBlogPostAdmin() {
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
    $blog = createBlogPost($title,$body,$published);
    } else {
            if (isset($error_message)){
                    echo "<p class='p p2'>".$error_message."</p>";
            }
    }
    $isNew = True;
    $messages = null;
    include('templates/edit_blog_post.tpl.html');

}


function displayBlogPostsAdmin(){
$query = "SELECT * FROM blog_posts ORDER BY id DESC";
$records_per_page=10;
$newquery = paging($records_per_page);
$list_blog_posts = dataview($newquery);
$list_blog_posts2 = paginglink($query,$records_per_page);
include('templates/list_blog_post.tpl.html');
}
