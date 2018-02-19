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



function createBlogPostAdmin() {
    if(!empty($_SESSION['messages'])){
        echo '<ul>';
        foreach($_SESSION['messages'] as $value){
                echo '<li>'.$value.'</li>';
        } echo '</ul>';
    }
    unset($_SESSION['messages']);
    if(isset($_POST['published']))
    {
        $published= 1;
    }
    else {
        $published= 0;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $body = $_POST['body'];

    }
    if(!empty($_POST) && isset($body) && $body == ''){
        $error_message = 'Body is blank MF';
    }
    if(!empty($_POST) && isset($title) && $title == ''){
        $error_message = 'Title is blank MF';
    }

    if(!empty($_POST) && !isset($error_message)){
    $blog = createBlogPost($title,$body,$published);
    } else {
            if (isset($error_message)){
                    echo "<p class='p p2'>".$error_message."</p>";
            }
    }
    $isNew = True;
    $messages = null;
    $post = null;
    renderAdminTemplate('templates/edit_blog_post.tpl.html', [
    'currentPage' => 'createBlog',
    'pageTitle' => 'Create Blog Post',
    'isNew' => true,
    'messages' => null,
    'title' => '',
    'body' => '',
    ]);

}


function displayBlogPostsAdmin(){
    $query = "SELECT * FROM blog_posts ORDER BY id DESC";
    $records_per_page=10;
    $newquery = paging($records_per_page);
    $list_blog_posts = dataview($newquery);
    $list_blog_posts2 = paginglink($query,$records_per_page);
    renderAdminTemplate('templates/list_blog_post.tpl.html', [
        'currentPage' => 'blogposts',
        'pageTitle' => 'List Blogs',
        'list_blog_posts' => $list_blog_posts,
        'list_blog_posts2' => $list_blog_posts2,
    ]);
}

function loginToAdmin() {
    $username = null;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    if(isset($username) && $username == ''){
        $errorMessage = 'Empty username MF';
    }

    if(isset($password) && $password == ''){
        $errorMessage = 'Empty password MF';
    }

    if(isset($errorMessage)){
        echo '<p>'.$errorMessage.'</p>';

    }
    if(!empty($_POST) && !isset($errorMessage)){
        login($username);
    }
    renderAdminTemplate('templates/login_page.tpl.html',[
        'pageTitle' => 'Login',
        'username' => $username,
        'currentPage' => null,
    ],
    false
    );
}

function renderAdminTemplate($template, $vars , $showAdminHeader = true) {
    if($showAdminHeader) {
        include("inc/header_admin.php");
    }
    include($template);
}

function deletePost() {
    if(isset($_POST['delete']) && $_POST){
        $id = $_GET['id'];
        deleteBlogPost($id);
        $_SESSION['MESSAGE_DELETE'] = "The Blog Post has been deleted";
        header('location:blogposts.php');
    }
    renderAdminTemplate('templates/delete_blog_post.tpl.html',[
        'pageTitle' => 'Delete Post',
        'currentPage' => null,
    ]);
}

function logout() {
    session_start();
    if(session_destroy()) {
      header("Location: login.php");
    }
}

function editBlogPost() {
    $message = null;
    $id = $_GET['id'];
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $title=$_POST['title'];
        $body=$_POST['body'];
        $published=$_POST['published'];

    }
    if(isset($_POST['published'])) {
        $published= 1;
    }
    else {
        $published= 0;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $body = $_POST['body'];
    } else {
        $error_message = '';
    }

    if(!empty($_POST) && empty(trim($body))){
            $error_message = "<font color='red'>Title field is empty.</font><br/>";
    }
        elseif(!empty($_POST) && empty(trim($title))){
            $error_message =  "<font color='red'>Body field is empty.</font><br/>";
        } else {
        //updating the table
            if(!empty($_POST) && !isset($error_message)){
            updateBlogPost($id,$title, $body , $published);
            }
        }
    $posts = displayInfoAboutSinglePost($id);
    foreach ($posts as $post) {
        $title = $post['title'];
        $body = $post['body'];
        $published = $post['published'];

    }
    if(isset($_GET['id']) && $_GET['id'] == "$id" && isset($_GET['status']) && $_GET['status'] == 'success'){
        $message = "<font color='green'>The Post has been updated!</font>";
        echo "<br>";
    } else {
        if (isset($error_message)){
            echo "<p class='p p2'>".$error_message."</p>";
        } else {
            echo 'This message should never appear but better be sure than sorry';
        }
    }

    renderAdminTemplate('templates/edit_blog_post.tpl.html',[
        'pageTitle' => 'Edit Blog Post',
        'currentPage' => null,
        'isNew' => false,
        'message' => $message,
        'id' => $id,
        'title' => $title,
        'body' => $body,
        'published' => $published,
    ]);
}

function displayAllCommentsInAdmin(){
    $query = "SELECT * FROM comments ORDER BY id DESC";
    $records_per_page=10;
    $newquery = pagingForComments($records_per_page);
    $list_commnets = displayCommentsInAdmin($newquery);
    $list_comments_2 = paginglinkForComments($query,$records_per_page);
    renderAdminTemplate('templates/comment_list.tpl.html', [
        'currentPage' => 'comment_list',
        'pageTitle' => 'Comments',
        'list_commnets' => $list_commnets,
        'list_comments_2' => $list_comments_2,
    ]);
}
