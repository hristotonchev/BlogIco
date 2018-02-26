<?php

namespace controllers;

class SiteController {

/**
 * Function that is used to display the blogposts on Home Page
 */
public function list_action() {
    $posts = getPostsGeneralPreview();
    renderTemplate('templates/index.tpl.html', [
    'pageTitle' => 'Home',
    'currentPage' => 'home',
    'posts' => $posts,
    ]);
}

/**
 * Function that list a single blog posts and it's comments if it has any
 */
public function list_single_blog($id) {
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

/**
 * Function that lists all the blog posts
 */
public function list_action_blogPage() {
    $posts = getAllBlogPosts();
    renderTemplate('templates/blogs.tpl.html', [
   'pageTitle' => 'BlogaPosts',
   'currentPage' => 'blogposts',
   'posts' => $posts,
    ]);
}

/**
 * Function that loads the About Page
 */
public function loadAboutPage() {
    renderTemplate('templates/about.tpl.html', [
    'pageTitle' => 'About',
    'currentPage' => 'about',
    ]);
}

/**
 * Function that loads Contact Page
 */
public function loadContactPage() {
    renderTemplate('templates/contact.tpl.html', [
    'pageTitle' => 'Contact',
    'currentPage' => 'contact',
    ]);
}

/**
 * Function that loads 404 page
 */
public function load404Page() {
    renderTemplate('templates/pagenotfound.tpl.html', [
    'pageTitle' => 'Page Not Found',
    'currentPage' => 'pagenotfound',
  ],
  false
  );
}

/**
 * Function that creates comments
 */
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

/**
 * Function that renders templates and is responsible to collect some data that will be passed on the templates
 */
private function renderTemplate($template, $vars , $showSidebar = true, $showHeader = true, $showFooter = true) {
    if($showHeader){
        include('templates/header.tpl.html');
    }
        include($template);
        if ($showSidebar) {
            include('templates/navigation_menu.tpl.html');
            }
            if($showFooter){
            include('templates/footer.tpl.html');
            }
        }

}
