<?php set_front_language(); ?>
<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	<meta charset="utf-8">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<!-- Fav Icon  -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('/public/images/faviconn.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('/public/images/faviconn.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/public/images/faviconn.png') }}">
	<link rel="manifest" href="images/favicon/site.html">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<!-- Site Title  -->
	<title><?php echo __t(get_settings('site_title')); ?></title>
	<!-- Vendor Bundle CSS -->
	<link rel="stylesheet" href="{{ url('/public/frontend/dashboard/assets-dashboard/css/vendor.bundled751.css?ver=100') }}">
	<!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ url('/public/frontend/dashboard/assets-dashboard/css/dashboard-styled751.css?ver='.time()) }}">
    <link rel="stylesheet" href="{{ url('/public/frontend/dashboard/assets/css/theme.css') }}">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body class="user-ath loader-hide-content" id="body-user">
   @yield('mid_area')
    
    
	<!-- JavaScript (include all script here) -->
	<script src="{{ url('/public/frontend/dashboard/assets-dashboard/js/jquery.bundle.js?ver=100') }}"></script>
	<script src="{{ url('/public/frontend/dashboard/assets-dashboard/js/script.js?ver=100') }}"></script>
	<style>
	.err_msg{
		float:left;
	}
	</style>
	<script>
	(function($){
		$('.show_loader').click(function(){
			$(".loader-wrapper").show();
			$(this).text('Plase Wait....');
			/*$(this).attr('disabled','disabled');*/
			//return true;
		});
		$("input").focus(function() {
			if($(this).next('.err_msg').length > 0){
				$(this).next('.err_msg').remove();
			}
		});
		$('input[type="checkbox"]').change(function() {
			if($(this).next().next('.err_msg').length > 0){
				$(this).next().next('.err_msg').remove();
			}
			if($(this).next().next().next('.err_msg').length > 0){
				$(this).next().next().next('.err_msg').remove();
			}
		});
		$("select").change(function() {
			if($(this).next('.err_msg').length > 0){
				$(this).next('.err_msg').remove();
			}
		});
	})(jQuery);
	</script>
	    <!-- loader -->
<div class="loader-wrapper" style="display:none;">
<div id="loader" class="overlay">
	<img src="{{ url('/public/frontend/dashboard/assets-dashboard/images/loader.svg') }}" alt="loader animated">
</div>
</div>
</body>
</html>
