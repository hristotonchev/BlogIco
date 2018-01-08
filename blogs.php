<?php
$pageTitle = 'Blog';
$currentPage = 'blogs';
include('inc/header.php');
require_once('models/model.php');


if (!empty($_GET['id']) && $_GET['id'] != null) {
    /**
     *@TODO ASK DOPARIS HOW TO MAKE THIS
     * if (empty($blogResult['id']) || $blogResult['published'] == 0) {
        header('location:blogs.php');
        }
        */
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
