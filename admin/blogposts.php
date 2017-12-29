<?php
include("../inc/header_admin.php");
$currentPage = 'blogposts';

$query = "SELECT * FROM blog_posts ORDER BY id DESC";
$records_per_page=10;
$newquery = $paginate->paging($query,$records_per_page);
$list_blog_posts =        $paginate->dataview($newquery);
$list_blog_posts2 =        $paginate->paginglink($query,$records_per_page);
include('templates/list_blog_post.tpl.html');


