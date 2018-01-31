<?php
$currentPage = 'blogposts';
$pageTitle = 'BlogPost';

include("../inc/header_admin.php");
require_once('controllers.php');
displayBlogPostsAdmin();
