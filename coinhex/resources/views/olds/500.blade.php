<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Softnio">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ACW Crypto Eco System">
	<!-- Fav Icon  -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('/public/frontend/images/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('/public/frontend/images/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/public/frontend/images/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ url('/public/frontend/images/favicon/site.webmanifest') }}">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<!-- Site Title  -->
	<title><?php echo __t(get_settings('site_title')); ?></title>
	<!-- Vendor Bundle CSS -->
	<link rel="stylesheet" href="{{ url('/public/frontend/assets/css/vendor.bundle.css?ver=142') }}">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="{{ url('/public/frontend/assets/css/style.css?ver=142') }}">
	<link rel="stylesheet" href="{{ url('/public/frontend/assets/css/theme-orange.css?ver=142') }}">

</head>
<body class="theme-light" data-spy="scroll" data-target="#mainnav" data-offset="80">

	<!-- Header --> 
	<header class="site-header is-sticky">
		<!-- Navbar -->
		<div class="navbar navbar-expand-lg is-transparent" id="mainnav">
			<nav class="container">

				<a class="navbar-brand" href="{{ url('/') }}">
					 <img class="logo logo-dark" alt="logo" src="{{ url('/public/frontend/images/logo.png') }}">
					 <img class="logo logo-light" alt="logo" src="{{ url('/public/frontend/images/logo-white.png') }}">
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle">
					<span class="navbar-toggler-icon">
						<span class="ti ti-align-justify"></span>
					</span>
				</button>

			
			</nav>
		</div>
		<!-- End Navbar -->
        
        <div class="page-error d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="error-content">
                          
                            <span class="error-text-large">500</span>
                            <h5>{{ __t('Opps! Why you’re here?') }}</h5>
                            <p>{{ __t('We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.') }}</p>
                            <a href="{{ url('/') }}" class="btn">{{ __t('Back to Home') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-small">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <ul class="social">
                            <li><a href="<?php echo get_settings('twitter_link'); ?>" target="_blank"><em class="fab fa-twitter"></em></a></li>
							<li><a href="<?php echo get_settings('telegram_link'); ?>" target="_blank"><em class="fab fa-telegram-plane"></em></a></li>
							<li><a href="<?php echo get_settings('fb_link'); ?>" target="_blank"><em class="fab fa-facebook-f"></em></a></li>
							<li><a href="<?php echo get_settings('linkedin_link'); ?>" target="_blank"><em class="fab fa-linkedin-in"></em></a></li>
							<li><a href="<?php echo get_settings('medium_link'); ?>" target="_blank"> <em class="fab fa-medium-m" target="_blank"></em></a></li>
							<li><a href="<?php echo get_settings('youtube_link'); ?>" target="_blank"><em class="fab fa-youtube"></em></a></li>
							<li><a href="<?php echo get_settings('bitcointalk_link'); ?>" target="_blank"><em class="fab fa-bitcoin"></em></a></li>
							<li><a href="<?php echo get_settings('reddit_link'); ?>" target="_blank"><em class="fab fa-reddit-alien"></em></a></li>
							<li><a href="<?php echo get_settings('instagram_link'); ?>" target="_blank"><em class="fab fa-instagram"></em></a></li>
							<li><a href="<?php echo get_settings('github_link'); ?>" target="_blank"><em class="fab fa-github-alt"></em></a></li>
                        </ul>
                        <div class="copyright-text">
								<?php echo __t(get_settings('copyright_text')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
	</header>
	<!-- End Header -->


	<!-- Preloader !remove please if you do not want -->
	<div id="preloader">
		<div id="loader"></div>
		<div class="loader-section loader-top"></div>
   		<div class="loader-section loader-bottom"></div>
	</div>
	<!-- Preloader End -->

	<!-- JavaScript (include all script here) -->
<script src="{{ url('/public/frontend/assets/js/jquery.bundle.js?ver=142') }}"></script>
	<script src="{{ url('/public/frontend/assets/js/script.js?ver=142') }}"></script>

</body>
</html>