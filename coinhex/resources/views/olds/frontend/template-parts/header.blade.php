<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>@yield('site_title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Bootstrap -->
<link href="{{asset('/public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Menu Css -->
<link href="{{asset('/public/frontend/css/slimmenu.css')}}" rel="stylesheet">
<!-- Owl Carousel Css -->
<link href="{{asset('/public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
<link href="{{asset('/public/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">
<!-- Custom Css -->
<link href="{{asset('/public/frontend/css/style.css')}}" rel="stylesheet">
<!-- Font Link -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link href="{{asset('/public/sw_alt/sweetalert.css')}}" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php echo get_settings('header_code'); ?>
</head>
<body>
<!-- header section start -->
<header class="main_hdr">
  <div class="container">
    <div class="top_main_mnu">
      <ul class="slimmenu">
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ url('about-us') }}">About Us</a></li>
        <li class="{{ Request::is('edc') || Request::is('edc/*') ? 'active' : '' }}"><a href="{{ url('edc') }}">EDC's</a></li>
        <li class="{{ Request::is('resource') ? 'active' : '' }}"><a href="{{ url('resource') }}">Resources</a></li>
        <li class="{{ Request::is('mentors') ? 'active' : '' }}"><a href="{{ url('mentors') }}">Network</a></li>
        <li class="{{ Request::is('news-events') ? 'active' : '' }}"><a href="{{ url('news-events') }}">News</a></li>
        <li class="{{ Request::is('all-events') ? 'active' : '' }}"><a href="{{ url('all-events') }}">Events</a></li>
        <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ url('contact-us') }}">Contact Us</a></li>
      </ul>
    </div>
    <div class="top_srch_sec">
      <a class="srch_icon" href="#"><i class="fa fa-search"></i></a>
      <div class="srch_fld_area">

      <form name="s" id="s" action="{{ url('search')}}" method="get">
      <input type="search" placeholder="Search..." name="s" id="s" value="<?php echo (isset($_GET['s']) ? $_GET['s'] : ''); ?>">
      <button type="submit" class="search">Search</button>
      </form>

      </div>
    </div>
  </div>
</header>
<!-- header section end -->

<!-- inner banner section start -->
<div class="inr_bnr">
  <img src="{{asset('/public/frontend/images/banner2.jpg')}}" alt="">
  <div class="inr_bnr_cap">
    <ul>
	  <?php 
	  $site_logo_id = get_settings('site_logo_id');
	  if($site_logo_id > 0){
		  $site_logo_url = get_recource_url($site_logo_id);
	  }else{
		  $site_logo_url = url('/public/frontend/images/bnr_cap_logo1.jpg');
	  }
	  
	  $alt_site_logo_id = get_settings('alt_site_logo_id');
	  if($alt_site_logo_id > 0){
		  $alt_site_logo_url = get_recource_url($alt_site_logo_id);
	  }else{
		  $alt_site_logo_url = url('/public/frontend/images/bnr_cap_logo2.jpg');
	  }
	  ?>
      <li><a href="{{ url('/') }}"><img src="<?php echo $site_logo_url; ?>" alt=""></a></li>
      <li><a href="{{ url('/') }}"><img src="<?php echo $alt_site_logo_url; ?>" alt=""></a></li>
    </ul>
  </div>
  @yield('breadcrumb')
</div>
<!-- inner banner section end -->