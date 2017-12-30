<?php include("../admin/session.php"); ?>
<link href="../css/styles2.css" rel="stylesheet" type="text/css" />
<?php
include_once("../admin/dbconfig.php");
$currentPage = '';

?>
<a href="admin.php"   class='button <?php if($currentPage == 'admin'){ echo 'active';}?>'>CREATE BLOG</a>

<a href="blogposts.php" class='button <?php if($currentPage == 'blogposts'){ echo 'active';}?>'>BLOG POSTS</a>

<a href="comment_list.php" class='button <?php if($currentPage == 'comment_list'){ echo 'active';}?>'>COMMENTS</a>


<a href='logout.php' class='button button4'>LOGOUT</a>

