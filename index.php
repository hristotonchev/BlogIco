<?php
$pageTitle = 'Home';
$currentPage = 'home';
include('inc/header.php');


 ?>
<!-- end of MENU WRAPPER -->
<div class="banner-wrapper">
  <div class="row">
  </div>
  <div class="clear"></div>
  <div class="banner">
    <div class="banner-bg">
      <div class="panel">
        <div class="title">
          <h1>The Blog<br />
            of Ico Tonchev</h1>
        </div>
        <div class="content">
          <p>A blog about Ico's experience , jobs , hobbies and life it slef.</p>
        </div>
        <div class="banner-button"><a href="about.php">Show more info</a></div>
      </div>
      <div class="banner-img">
	  	<div id="carousel">
		<div id="slides">
				<ul>
						<li><img src="images/banner-img3.png"  alt="Slide 3"/></li>
						<li><img src="images/banner-img1.png"  alt="Slide 1"/></li>
						<li><img src="images/banner-img2.png"  alt="Slide 2"/></li>


				</ul>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div id="buttons"> <a href="#" id="prev">prev</a> <a href="#" id="next">next</a>
				<div class="clear"></div>
		</div>
</div>

	  </div>
    </div>
  </div>
</div>
<!-- end of BANNER WRAPPER -->
<div class="page">
  <div class="boxs1">
    <div class="panel">
      <div class="title">
        <h1>ICO THE BLOGGER</h1>
        <h2>Blog about the author</h2>
      </div>
      <div class="panel-img"><img src="images/img1.jpg" alt="" /></div>
      <div class="content">
        <p>Who am I? What I do ? What I don't do. What i do for a living? Just your everyday normal guy.</p>
      </div>
      <div class="controller">
        <div class="buttons">
          <h2><a href="#">MORE</a></h2>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <div class="boxs2">
    <div class="panel">
      <div class="title">
        <h1>MY SOUL-MATE</h1>
        <h2>Always pushing me forward</h2>
      </div>
      <div class="panel-img"><img src="images/img2.jpg" alt="" /></div>
      <div class="content">
        <p>She is the reason that, I develop my self. I move forward. I want to create a better world for us!</p>
      </div>
      <div class="controller">
        <div class="buttons">
          <h2><a href="#">MORE</a></h2>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <div class="boxs3">
    <div class="panel">
      <div class="title">
        <h1>MUFFIN THE DOGGO</h1>
        <h2>My Cuteness overload dogie</h2>
      </div>
      <div class="panel-img"><img src="images/img3.jpg" alt="" /></div>
      <div class="content">
        <p>What is to live with a BIEGLE? What is to have a loving pet, that you need to care for?</p>
      </div>
      <div class="controller">
        <div class="buttons">
          <h2><a href="#">MORE</a></h2>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>

<?php
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

$sql = "SELECT * FROM blog_posts WHERE published = 1 ORDER BY id DESC limit 3";
$query = $DB_con->prepare($sql);
$query->execute();



 ?>
<!-- end of BOX WRAPPER -->
<div class="page padding-bottom">
  <div class="content_wrap">
    <div class="left-panel">
      <div class="panel">
        <div class="title">
        <?php

        if ($query->rowCount()>0) {
        while ($result=$query->fetch(PDO::FETCH_ASSOC)) {

            ?>
            <div class="icons"><img src="images/arrow-icons.png" alt="" /></div>
                <div class="title">
            <?php
            echo "<h1>".htmlspecialchars($result['title'])."</h1>";
            echo "<h2>".'Author: Icaka'."</h2>";
            ?>
                <div class="content">
            <?php
            echo "<p>".substr(htmlspecialchars($result['body']), 0, 300)."...</p>";
                ?>
                  <div class="controller">
                <div class="buttons">
             <h2><a href='<?php echo 'blogs.php?id='.$result['id'];?>' class='button'> More</a></h2>
                </div>
                </div>
                </div>
                 <div class="clear"></div>
                </div>


<?php

    }
}
         ?>

    </div>

    </div>
    </div>

    <?php
include('inc/nav_menu.php');
include('inc/footer.php');
?>
<!----footer-wrapper-------->
<!-- end of WRAPPER -->
</body>
</html>
