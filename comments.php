<?php
//$pageTitle = 'about';
//$currentPage = 'about';
//include('inc/header.php');
include('databaseconfig.php');

$id = $_GET['id'];

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

$sql = "SELECT * FROM comments where blog_post_id = ?";
$query = $DB_con->prepare($sql);
$query->execute([$_GET['id']]);
    while ($result=$query->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="title">
            <?php
            echo "<h2>".'From :'.htmlspecialchars($result['author'])."</h2>";
            ?>
                <div class="content">
            <?php
            echo "<p>".substr(htmlspecialchars($result['comment_body']), 0, 300)."</p>";
                ?>
                </div>
                </div>
<?php

        }


if(!empty($_POST) && !isset($error_message)){
    $sql = "INSERT INTO comments (author, comment_body, displayed, blog_post_id) VALUES (:author,:comment_body,:displayed,:blog_post_id)";
    $query = $DB_con->prepare($sql);
    $query->execute(array(  'author'       => $author,
                            'comment_body' => $commentBody,
                            'displayed'    => $displayed,
                            'blog_post_id' => $blogPostId));

  // header("Location:blogs.php?id=".$id);
} else {
        if (isset($error_message)){
                echo "<p class='p p2'>".$error_message."</p>";
        }
}

$isNew = True;
$messages = null;
include('templates/comments.tpl.html');

