<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>P2P Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
     <!-- Fav Icon  -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('/public/frontend/images/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('/public/frontend/images/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/public/frontend/images/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ url('/public/frontend/images/favicon/site.webmanifest') }}">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    
    <link rel="stylesheet" href="{{asset('/public/admin_css/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/fonts/fonts.css')}}" />
        <link rel="stylesheet" href="{{asset('/public/plugins/fancybox/jquery.fancybox.css')}}" />
        <link rel="stylesheet" href="{{asset('/public/plugins/Data Table/jquery.dataTables.min.css')}}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
        <script src="http://demo.startlaravel.com/sb-admin-laravel/assets/scripts/frontend.js" type="text/javascript"></script>
        <script src="{{asset('/public/plugins/fancybox/jquery.fancybox.min.js')}}"></script> 
         <script src="{{asset('public/plugins/Data Table/jquery.dataTables.min.js')}}"></script>

         <link rel="stylesheet" href="{{asset('/public/jquery/jquery-ui.css')}}" />
         <script src="{{asset('public/jquery/jquery-ui.js')}}"></script>
</head>
<body>
	<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://karmickdev.com/iimcip/admin">EDCN Admin Panel</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <li class=""> Welcome admin</li>
            <li class="dropdown">
                <a href="http://karmickdev.com/iimcip/admin/logout">
                    <i class="fa fa-sign-out fa-fw"></i> Logout
                </a>

                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->