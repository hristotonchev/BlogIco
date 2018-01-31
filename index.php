<?php
$pageTitle = 'Home';
$currentPage = 'home';
include('inc/header.php');
require_once('models/model.php');
require_once('controllers.php');

// route the request internally
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ('/index.php' === $uri || '/' === $uri) {
    list_action();
} elseif ('/blogs.php' === $uri && !isset($_GET['id'])) {
    list_action_blogPage();
} elseif ('/blogs.php' === $uri && isset($_GET['id'])) {
    list_single_blog($_GET['id']);
} else {
    header('location:/pagenotfound.php');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}

include('inc/nav_menu.php');
include('inc/footer.php');
?>
