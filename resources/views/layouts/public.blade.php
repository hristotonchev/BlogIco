<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> @yield('pageTitle')</title>
<link href="/css/styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Oswald|Open+Sans' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/js/carouselScript.js"></script>
<link href="/css/carousel.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="social-wrapper">
  <div class="row">
    <ul>
      <li><a href="https://plus.google.com/u/1/109294871772581957325"><img src="/images/social-1.jpg" alt="Google Plus" /></a></li>
      <li><a href="https://www.facebook.com/profile.php?id=100000478827988"><img src="/images/social-2.jpg" alt="Facebook" /></a></li>
      <li><a href="https://twitter.com/SiteGround"><img src="/images/social-3.jpg" alt="Siteground" /></a></li>
      <li class="no-padding"><a href="https://www.linkedin.com/in/hristo-tonchev-54a36193/"><img src="/images/social-4.jpg" alt="LinkedIn" /></a></li>
    </ul>
<!-- Will Delete this later on , now i am too lazy to write it manual in the URl -->
    <a href="{{ route('login')}}" class="@if($currentPage == 'contact') active @endif">Login</a>

    <div class="clear"></div>
  </div>
</div>
<div class="clear"></div>
<!-- end of SOCIAL ICONS -->
<div class="header">
  <div class="row">
    <div class="logo">
      <h1><a href="{{route('home')}}">BLOG ICO</a></h1>
    </div>
    <div class="menu">
      <ul class="nav navbar -nav">
        <li><a href="{{ route('home')}}" class="@if ($currentPage == 'home') active @endif">Home</a></li>
        <li><a href="{{ route('about')}}" class="@if($currentPage == 'about') active @endif">About</a></li>
        <li><a href="{{ route('blogposts')}}" class="@if($currentPage == 'blogposts') active @endif">Blogs</a></li>
        <li><a href="{{ route('contact')}}" class="@if($currentPage == 'contact') active @endif">Contact</a></li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!-- here should be the content -->

   @yield('content')

<!-- here should be the sidebar-->
@section('sidebar')
           <div class="right-panel">
      <div class="contact-panel">
        <div class="title">
          <h1>Submit your Idea</h1>
          <span>Do you have any ideas for blogs</span></div>
        <div class="form">
          <ul>
            <li>
              <input type="text"  class="text-field" value="your name here"/>
            </li>
            <li>
              <input name="" type="text"  class="text-field" value="your email  here"/>
            </li>
            <li>
              <textarea name="" cols="" rows="" class="textarea">your message  here
</textarea>
            </li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="controller">
          <div class="buttons">
            <h2><a href="#">SUBMIT</a></h2>
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      <div class="panel martop">
        <div class="title">
          <h1>Popular Blogs</h1>
          <h2>Here you can find popular Blogs</h2>
        </div>
        <div class="content">
          <ul>
            <li><a href="{{ route('blogpost',1)}}"> -- Super man here --</a></li>
            <li><a href="{{ route('blogpost',2)}}"> -- Wonder Woman here --</a></li>
            <li><a href="{{ route('blogpost',3)}}"> -- The Flash here --</a></li>
            <li><a href="{{ route('blogpost',4)}}"> -- Batman here --</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      <div class="contact-panel padding-bottm">
        <div class="title">
          <h1>Quick Search</h1>
          <span>Try if you dare</span></div>
        <div class="search">
          <ul>
            <li class="libg">
              <input type="text" class="search-filed" value="search here..."/>
            </li>
            <li><img src="/images/search-bt.jpg" alt="" /></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
@show

<!-- end of BOX WRAPPER -->
  <div class="clear"></div>
</div>
<div class="footer-wrapper">
  <div class="footer">
    <div class="panel">
      <div class="title">
        <h1>ABOUT US</h1>
        <h2>The Blog of Ico Tonchev</h2>
        <div class="content">
          <P>A site about gaining knowledge , learning the best practices and css </P>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="title">
        <h1>CONTACT US</h1>
        <h2>You can contact us at any time</h2>
        <div class="content">
          <P><a href="info@sitename.com">hristo.tonchev@siteground.com</a> </P>
          <h3>( +359 ) 883 516998</h3>
        </div>
      </div>
    </div>
    <div class="panel border-right">
      <div class="title">
        <h1>COPY RIGHT</h1>
        <h2>All rights received</h2>
        <div class="content">
          <p> <a href='www.icopanda.com'> www.icopanda.com</a></p>
          <p><a href="www.pandaico.com" target="_blank" >www.pandaico.com</a> </p>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!----footer-wrapper-------->
<!-- end of WRAPPER -->
</body>
</html>
