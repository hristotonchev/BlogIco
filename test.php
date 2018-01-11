<?php
/*$link = mysql_connect('localhost', 'mysql_user', 'mysql_password');
if (!$link) {
	    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);



* to do
**
 * Create the nav menu with pressed buttons if accordingly to the choosen page
 *         <li><a href="index.php" class="active">Home</a></li>
 *     <title><?php echo $pageTitle?></title>
*/

//How to create a MF TABLE

CREATE TABLE Ico (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(60) NOT NULL,
lastname VARCHAR(60) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP,
active tinyint(1)
)

CREATE TABLE comments(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
author VARCHAR(255) NOT NULL,
comment_body text,
created TIMESTAMP,
displayed tinyint(1),
blog_post_id INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (blog_post_id) REFERENCES blog_posts(id)
)


//how to create a MF admin usser
include('dbconfig.php');
$hash = password_hash('patka123' ,PASSWORD_DEFAULT);
$username = 'tonchev';
$sql = "insert into admin set username=?, password=?";
$query = $DB_con->prepare($sql);
$query->execute([$username,$hash]);


<?php
if($query->rowCount()>0)
    {
            while($result=$query->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <div class="title">
                <?php
                echo "<h1>".$result['title']."</h1>";
                echo "<h2>".'Author: Icaka'."</h2>";
                echo "<p>".$result['body']."</p>";
                 ?>
                </div>
                <?php
            }
    }



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


  <?php } else { ?>
            <br>
                <input class='button button2' type='submit' value='Update'/>
                <a class='button button3' href="delete.php?id= <?php echo $id?>">Delete</a>
            <?php  header('Location:'.$_SERVER['PHP_SELF']); } ?>

