<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo __t(get_settings('site_title')); ?>">
  	<meta name="keywords" content="<?php echo __t(get_settings('site_title')); ?>">
  	<meta name="author" content="<?php echo __t(get_settings('site_title')); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{url('public/frontend/latest/img/favicon-16x16.png')}}" type="image/x-icon">
	<link rel="shortcut icon" href="{{url('public/frontend/latest/img/favicon-16x16.png')}}" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="180x180" href="{{url('public/frontend/latest/img/favicon-16x16.png')}}">
	<title><?php echo __t(get_settings('site_title')); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="for-top-area text-center" style="background: #557ef8; height: 75px; width: 100%;">
		<a href="{{ url('/') }}"><img style="width:200px; margin-top:12px;" src="{{url('public/landingpage/logo-white-1-1-1.png')}}" alt=""></a>
	</div>

	<div class="for-img text-center" style="margin-top: 35px; margin-bottom: 25px;">
		<img style="max-width: 100%;" src="{{ url('/public/uploads/error-404.png') }}" alt="">
	</div>

	<div style="font-size: 1.3em; padding-top: 10px; margin-bottom: 35px; text-align: center; color: #333;">
	Unfortunately the page you are looking for has been moved or deleted


	</div>
	<div style="text-align: center; margin-bottom: 100px;">
		<a style="text-align:center; margin-top: 30px; background: #557ef8; color: #fff; padding: 10px 20px; border-radius: 4px;" href="{{ url('/') }}">GO TO HOMEPAGE</a>
	</div>

	<!-- js here -->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>