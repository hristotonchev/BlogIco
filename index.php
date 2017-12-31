<?php
$pageTitle = 'Home';
$currentPage = 'home';
include('inc/header.php');

require_once('models/model.php');

$posts = getPostsGeneralPreview();



include('templates/index.tpl.html');
include('inc/nav_menu.php');
include('inc/footer.php');
?>
<!----footer-wrapper-------->
<!-- end of WRAPPER -->
</body>
</html>
