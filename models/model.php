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




