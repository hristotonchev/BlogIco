<?php
session_start();
require_once('models/model.php');
require_once('controllers/controller.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/index.php', '',  $uri);
var_dump($uri);
if(('/admin/login.php' != $uri) and !isset($_SESSION['login_user']) and strpos($uri,'admin')){
    var_dump($_SESSION);
  header("location:/admin/login.php");
}

if ('/index.php' === $uri || '/' === $uri || $uri === '') {
    list_action();
} elseif ('/blogs.php' === $uri && !isset($_GET['id'])) {
    list_action_blogPage();
} elseif ('/blogs.php' === $uri && isset($_GET['id'])) {
    list_single_blog($_GET['id']);
} elseif ('/about.php' === $uri ) {
    loadAboutPage();
} elseif ('/contact.php' === $uri) {
    loadContactPage();
} elseif ('/admin/admin.php' === $uri) {
   createBlogPostAdmin();
} elseif ('/admin/blogposts.php' === $uri) {
    displayBlogPostsAdmin();
} elseif ('/admin/login.php' === $uri) {
    loginToAdmin();
} elseif ('/admin/delete.php' === $uri) {
    deletePost();
} elseif ('/admin/logout.php' === $uri) {
    logout();
} elseif ('/admin/edit.php' === $uri) {
    editBlogPost();
} elseif ('/admin/comment_list.php' === $uri) {
    displayAllCommentsInAdmin();
} else {
    load404Page();
}

