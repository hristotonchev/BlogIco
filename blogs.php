<?php
$pageTitle = 'Blog';
$currentPage = 'blogs';
include('inc/header.php');

$db_host = "localhost";
$db_user = "root";
$db_pass = "Ht0891001";
$db_name = "ico";

try {
     $DB_con = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
     echo $exception->getMessage();
}

$sql = "SELECT * FROM blog_posts WHERE published = 1 ORDER BY id DESC";
$query = $DB_con->prepare($sql);
$query->execute();
?>



<!-- end of MENU WRAPPER -->
<div class="page padding-bottom">
  <div class="content_wrap">
    <div class="left-panel">
      <div class="panel">

<?php
if (!empty($_GET['id']) && $_GET['id'] != null && isset($_GET['id'])) {
    $sql = "select * from blog_posts where id = ?";
    $query = $DB_con->prepare($sql);
    $query->execute([$_GET['id']]);
    $blogResult = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($blogResult['id']) || $blogResult['published'] == 0) {
        header('location:blogs.php');
    }
                ?>
                 <div class="title">
                <?php
                echo "<h1>".htmlspecialchars($blogResult['title'])."</h1>";
                echo "<h2>".'Author: Icaka'."</h2>";
                ?>
                <div class="content">
                <?php
                echo "<p>".htmlspecialchars($blogResult['body'])."</p>";
                echo "<h1>"."Comments"."</h1>";
                echo "<br>";
                include('comments.php');
                ?>
                </div>
                </div>

<?php } else {
    if ($query->rowCount()>0) {
        while ($result=$query->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="title">
            <?php
            echo "<h1>".htmlspecialchars($result['title'])."</h1>";
            echo "<h2>".'Author: Icaka'."</h2>";
            ?>
                <div class="content">
            <?php
            echo "<p>".substr(htmlspecialchars($result['body']), 0, 300)."...</p>";
                ?>
             <a href='<?php echo '?id='.$result['id'];?>' class='button'> --You can continue reading here --</a>
                </div>
                </div>
<?php

        }
    }
}
?>
        </div>
      <div class="clear"></div>
    </div>
    <?php
    include('inc/nav_menu.php');
    include('inc/footer.php');
?>
<!----footer-wrapper-------->
<!-- end of WRAPPER -->
</body>
</html>
