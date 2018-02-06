<?php
function list_action() {
    $posts = getPostsGeneralPreview();
    renderTemplate('templates/index.tpl.html', [
    'pageTitle' => 'Home',
    'currentPage' => 'home',
    'posts' => $posts,
    ]);
}

function list_single_blog($id) {
    if (!empty($id) && $id != null) {
        if (empty(displayDiseredBlogPost($id)) || displayDiseredBlogPost($id)['published'] == 0) {
            header('location:blogs.php');
        }
        $comments = displayAllComments();
        createComment();
        $blogResult = displayDiseredBlogPost($id);
        renderTemplate('templates/blogs.tpl.html', [
            'pageTitle' => 'BlogaPosts',
            'currentPage' => 'blogposts',
            'blogResult' => $blogResult,
            'comments' => $comments,

        ]);
    }
}

function list_action_blogPage() {
    $posts = getAllBlogPosts();
    renderTemplate('templates/blogs.tpl.html', [
   'pageTitle' => 'BlogaPosts',
   'currentPage' => 'blogposts',
   'posts' => $posts,
    ]);
}

function loadAboutPage() {
    renderTemplate('templates/about.tpl.html', [
    'pageTitle' => 'About',
    'currentPage' => 'about',
    ]);
}

function loadContactPage() {
    renderTemplate('templates/contact.tpl.html', [
    'pageTitle' => 'Contact',
    'currentPage' => 'contact',
    ]);
}

function load404Page() {
    renderTemplate('templates/pagenotfound.tpl.html', [
    'pageTitle' => 'Page Not Found',
    'currentPage' => 'pagenotfound',
  ],
  false
  );
}

function renderTemplate($template, $vars , $showSidebar = true, $showHeader = true, $showFooter = true) {
    if($showHeader){
        include('inc/header.php');
    }
    include($template);
    if ($showSidebar) {
        include('inc/nav_menu.php');
    }
    if($showFooter){
        include('inc/footer.php');
    }
}

function createComment(){
    $id = $_GET['id'];
    if(isset($_POST['displayed'])){
        $displayed = 1;
    } else {
        $displayed = 0;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $author = $_POST['author'];
        $commentBody = $_POST['comment_body'];
        $blogPostId = $_GET['id'];
    }

    if(!empty($_POST) && empty(trim($author))){
        $error_message = 'Don\'t mess with the author';
    }

    if(!empty($_POST) && empty(trim($commentBody))){
        $error_message = 'No Comment';
    }

    if(!empty($_POST) && !isset($error_message)){
    $comment =  addComment($author,$commentBody,$displayed, $blogPostId);
    } else {
        if (isset($error_message)){
                echo $error_message;
        }
    }
}
