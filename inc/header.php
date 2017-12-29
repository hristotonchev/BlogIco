<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

$page = null;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle;?></title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Oswald|Open+Sans' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/carouselScript.js"></script>
<link href="css/carousel.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="social-wrapper">
  <div class="row">
    <ul>
      <li><a href="https://plus.google.com/u/1/109294871772581957325"><img src="images/social-1.jpg" alt="Google Plus" /></a></li>
      <li><a href="https://www.facebook.com/profile.php?id=100000478827988"><img src="images/social-2.jpg" alt="Facebook" /></a></li>
      <li><a href="https://twitter.com/SiteGround"><img src="images/social-3.jpg" alt="Siteground" /></a></li>
      <li class="no-padding"><a href="https://www.linkedin.com/in/hristo-tonchev-54a36193/"><img src="images/social-4.jpg" alt="LinkedIn" /></a></li>
    </ul>
    <div class="clear"></div>
  </div>
</div>
<div class="clear"></div>
<!-- end of SOCIAL ICONS -->
<div class="header">
  <div class="row">
    <div class="logo">
      <h1>BLOG ICO</h1>
    </div>
    <div class="menu">
      <ul class="nav navbar -nav">
        <li><a href="index.php" class='<?php if($currentPage == 'home'){echo 'active';}?>'>Home</a></li>
        <li><a href="about.php" class='<?php if($currentPage == 'about') {echo 'active';}?>'>About</a></li>
        <li> <a href="work.php" class='<?php if($currentPage == 'work') {echo 'active';}?>'>Work</a> </li>
        <li><a href="blogs.php" class='<?php if($currentPage == 'blogs') {echo 'active';}?>'>Blogs</a></li>
        <li><a href="contact.php" class='<?php if($currentPage == 'contact') {echo 'active';}?>'>Contact</a></li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
