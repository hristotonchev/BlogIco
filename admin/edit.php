<?php
include("../inc/header_admin.php");

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $title=$_POST['title'];
    $body=$_POST['body'];
    $published=$_POST['published'];

}   // checking empty fields

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
    } else {
        $error_message = '';
    }

    if(empty($title) || empty($body)) {
        if(!empty($_POST) && isset($body) && $body == ''){
            $error_message = "<font color='red'>Title field is empty.</font><br/>";
    }
        if(!empty($_POST) && isset($title) && $title == ''){
            $error_message =  "<font color='red'>Body field is empty.</font><br/>";
        }
    } else {
        //updating the table
        if(!empty($_POST) && !isset($error_message)){
            $link = open_database_con();
            $sql = "UPDATE blog_posts SET title=:title, body=:body, published=:published WHERE id=:id";
            $query = $link->prepare($sql);
            $id= $_GET['id'];
            $query->bindparam(':id', $id);
            $query->bindparam(':title', $title);
            $query->bindparam(':body', $body);
            $query->bindparam(':published', $published);
            $query->execute();

            header("Location: edit.php?id=$id&status=success");
            close_database_con($link);
        }
    }
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$link = open_database_con();
$sql = "SELECT * FROM blog_posts WHERE id=:id";
$query = $link->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $title = $row['title'];
    $body = $row['body'];
    $published = $row['published'];
}
$messages = null;
if(isset($_GET['id']) && $_GET['id'] == "$id" && isset($_GET['status']) && $_GET['status'] == 'success'){
    $messages = "<a>The Post has been updated!</a>";
    echo "<br>";
} else {
    if (isset($error_message)){
            echo "<p class='p p2'>".$error_message."</p>";
    } else {
        echo 'This message should never appear but better be sure than sorry';
    }
}
$isNew = false;
include('templates/edit_blog_post.tpl.html');
