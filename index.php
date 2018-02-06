<?php
require_once('models/model.php');
require_once('controllers/controller.php');

// route the request internally
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/index.php', '',  $uri);
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
} else {
    load404Page();
}
