<?php
$pageTitle = 'Home';
$currentPage = 'admin';
include("../inc/header_admin.php");
require_once('models/model.php');
require_once('controllers.php');



// route the request internally
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
var_dump($uri);
var_dump('/admin/blogposts.php' === $uri);
if ('/admin/admin.php' === $uri) {
   createBlogPostAdmin();
} elseif ('/admin/blogposts.php' === $uri) {
    displayBlogPostsAdmin();
} else {
    header('location:/pagenotfound.php');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}
