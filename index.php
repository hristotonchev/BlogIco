<?php
use controllers\SiteController;
use controllers\AdminController;

session_start();
require_once('models/model.php');
require_once('controllers/SiteController.php');
require_once('controllers/AdminController.php');

$siteController = new SiteController;
$adminController = new AdminController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/index.php', '', $uri);
var_dump($uri);
if (('/admin/login.php' != $uri) and !isset($_SESSION['login_user']) and strpos($uri, 'admin')) {
    header("location:/admin/login.php");
}

if ('/index.php' === $uri || '/' === $uri || $uri === '') {
    $siteController->list_action();
} elseif ('/blogs.php' === $uri && !isset($_GET['id'])) {
    $siteController->list_action_blogPage();
} elseif ('/blogs.php' === $uri && isset($_GET['id'])) {
     $siteController->list_single_blog($_GET['id']);
} elseif ('/about.php' === $uri) {
     $siteController->loadAboutPage();
} elseif ('/contact.php' === $uri) {
    $siteController->loadContactPage();
} elseif ('/admin/admin.php' === $uri) {
    $adminController->createBlogPostAdmin();
} elseif ('/admin/blogposts.php' === $uri) {
    $adminController->displayBlogPostsAdmin();
} elseif ('/admin/login.php' === $uri) {
    $adminController->loginToAdmin();
} elseif ('/admin/delete.php' === $uri) {
    $adminController->deletePost();
} elseif ('/admin/logout.php' === $uri) {
    $adminController->logout();
} elseif ('/admin/edit.php' === $uri) {
    $adminController->editBlogPost();
} elseif ('/admin/comment_list.php' === $uri) {
    $adminController->displayAllCommentsInAdmin();
} elseif ('/admin/comment/delete.php' === $uri) {
    $adminController->deleteComment();
} else {
     $siteController->load404Page();
}
