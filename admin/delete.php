<?php
include("../inc/header_admin.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
if(isset($_POST['delete']) && $_POST){
    $link = open_database_con();
    $sql = "DELETE FROM blog_posts WHERE id=:id";
    $query = $link->prepare($sql);
    $query->execute(array(':id' => $id));
    $_SESSION['MESSAGE_DELETE'] = "The Blog Post has been deleted";
    header('location:blogposts.php');
}
include('templates/delete_blog_post.tpl.html');
