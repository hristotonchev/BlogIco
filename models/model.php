<?php

function open_database_con() {

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "haha";
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

function getPostsGeneralPreview() {
    $link = open_database_con();

    $sql = ("SELECT * FROM blog_posts WHERE published = 1 ORDER BY id DESC limit 3");
    $query = $link->prepare($sql);
    $query->execute();

    $posts = array();

    while ($result=$query->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $result;

    }
    close_database_con($link);

    return $posts;
}

function getAllBlogPosts() {
    $link = open_database_con();
    $sql = "SELECT * FROM blog_posts WHERE published = 1 ORDER BY id DESC";
    $query = $link->prepare($sql);
    $query->execute();

    $posts = array();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $result;
    }
    close_database_con($link);

    return $posts;
}

function displayDiseredBlogPost($id) {
        $link = open_database_con();

        $sql = "select * from blog_posts where id = ?";
        $query = $link->prepare($sql);
        $query->execute([$_GET['id']]);

        $blogResult = $query->fetch(PDO::FETCH_ASSOC);

        close_database_con($link);
        return $blogResult;

    }

function displayAllComments() {
    $link = open_database_con();

    $sql = "SELECT * FROM comments where blog_post_id = ? order by id desc";
    $query = $link->prepare($sql);
    $query->execute([$_GET['id']]);

    $comments = array();
    while ($result=$query->fetch(PDO::FETCH_ASSOC)) {
        $comments[] = $result;
    }
    close_database_con($link);

    return $comments;
}

function addComment($author,$commentBody,$displayed,$blogPostId) {
    $link = open_database_con();
    $sql = "INSERT INTO comments (author, comment_body, displayed, blog_post_id) VALUES (:author,:comment_body,:displayed,:blog_post_id)";
    $query = $link->prepare($sql);
    $query->execute(array(  'author'       => $author,
                            'comment_body' => $commentBody,
                            'displayed'    => $displayed,
                            'blog_post_id' => $blogPostId));

    header("Location:blogs.php?id=".$blogPostId);

   close_database_con($link);
}
