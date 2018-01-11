<?php
$pageTitle = 'Blog';
$currentPage = 'blogs';
include('inc/header.php');
require_once('models/model.php');


if (!empty($_GET['id']) && $_GET['id'] != null) {
    if (empty(displayDiseredBlogPost($_GET['id'])) || displayDiseredBlogPost($_GET['id'])['published'] == 0) {
        header('location:blogs.php');
    }

        $blogResult = displayDiseredBlogPost($_GET['id']);

}
$posts = getAllBlogPosts();


include('templates/blogs.tpl.html');
include('inc/nav_menu.php');
include('inc/footer.php');
?>
<!----footer-wrapper-------->
<!-- end of WRAPPER -->
</body>
</html>
