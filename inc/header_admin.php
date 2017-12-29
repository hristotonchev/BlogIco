<link href="../css/styles2.css" rel="stylesheet" type="text/css" />
<?php
include_once("dbconfig.php");
include("session.php");
$currentPage = '';

?>
<a href="admin.php"   class='button <?php if($currentPage == 'admin'){ echo 'active';}?>'>CREATE BLOG</a>

<a href="blogposts.php" class='button <?php if($currentPage == 'blogposts'){ echo 'active';}?>'>BLOG POSTS</a>

<a href='logout.php' class='button button4'>LOGOUT</a>

