<?php

function open_database_con() {

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "Ht0891001";
    $db_name = "ico";

    try
        {
            $link = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception){

            echo $exception->getMessage();
        }
        return $link;
    }

function close_database_con(&$link) {
    $link = null;
}

function createBlogPost($title,$body,$published) {
    $link = open_database_con();

    $sql = "insert into blog_posts (title, body,published) values (:title, :body, :published)";
    $query = $link->prepare($sql);
        $query->execute(array('title' => $title,
                              'body' => $body,
                              'published' => $published));
        $_SESSION['messages'] = [
        'blogPosted' => 'Blog post send successfully',
        'postAnotherBlog' => 'You can post another one!'
        ];
        header("Location:admin.php");
}


