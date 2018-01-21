<?php
function list_action() {
    $posts = getPostsGeneralPreview();
    include('templates/index.tpl.html');
}

function list_single_blog($id) {
    if (!empty($_GET['id']) && $_GET['id'] != null) {
        if (empty(displayDiseredBlogPost($_GET['id'])) || displayDiseredBlogPost($_GET['id'])['published'] == 0) {
            header('location:blogs.php');
        }
            $blogResult = displayDiseredBlogPost($id);
            include('templates/blogs.tpl.html');
    }
}

function list_action_blogPage() {
    $posts = getAllBlogPosts();
    include('templates/blogs.tpl.html');
}

