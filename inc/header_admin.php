 <link href="../css/styles2.css" rel="stylesheet" type="text/css" />

<title><?php echo $vars['pageTitle'];?></title>

<a href="admin.php" class='button <?php if($vars['currentPage'] == 'createBlog'){ echo 'active';}?>'>CREATE BLOG</a>

<a href="blogposts.php" class='button <?php if($vars['currentPage'] == 'blogposts'){ echo 'active';}?>'>BLOG POSTS</a>

<a href="comment_list.php" class='button <?php if($vars['currentPage'] == 'comment_list'){ echo 'active';}?>'>COMMENTS</a>


<a href='logout.php' class='button button4'>LOGOUT</a>

