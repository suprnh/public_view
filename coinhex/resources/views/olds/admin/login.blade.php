<?php set_admin_language(); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title><?php echo __t(get_settings('admin_title')); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
</head>
<style>
.user-ath {
    background:#000000;
  background-size: cover;
}
.user-ath-page { display: flex; min-height: 100vh; align-items: center; padding: 40px 0; }
.panel-title{
text-align: center;
font-size: 20px;
}
.btn {
/*     border-radius: 30px; */
}
.btn {
    height: 50px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background: #eabf22;
    color: #fff;
    font-size: 20px;
    text-align: center;
    display: block;
    -webkit-transition: .4s;
    -o-transition: .4s;
    transition: .4s;
    white-space: nowrap;
    border-color: #eabf22;
}
.btn:hover, .btn:focus, .btn:active {
    color: #fff;
    background-color: #eabf22;
    border-color: #eabf22;
}
.user-ath-box {
    position: relative;
    padding: 45px 40px 40px;
    background: linear-gradient(to right, #292828 0%, #272626 100%);
    border-radius: 4px;
    box-shadow: 0px 3px 8px 0px rgba(0, 0, 0, 0.05);
}

.user-ath .well-lg {
    box-shadow: none;
    background-image: linear-gradient(to right, #292828 0%, #272626 100%);
    border: 1px solid #272626;
}
.user-ath .well-lg h3 {
    text-align: center;
    color: #fff;
    padding: 15px 0;
    margin: 0;
    font-weight: 500;
    font-size: 26px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.user-ath .form-control {
    border-radius: 4px;
    border: 2px solid #d3e0f3;
    width: 100%;
    min-height: 50px;
    padding: 10px 15px;
    line-height: 20px;
    font-size: 14px;
    color: #6783b8;
    transition: all .4s;
    margin-bottom: 20px;
}
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active  {
    -webkit-box-shadow: 0 0 0 30px white inset !important;
    color: #333 !important;
}
/*Change text in autofill textbox*/
input:-webkit-autofill {
    -webkit-text-fill-color: #333 !important;
}
input:-internal-autofill-previewed, input:-internal-autofill-selected, textarea:-internal-autofill-previewed, textarea:-internal-autofill-selected, select:-internal-autofill-previewed, select:-internal-autofill-selected {
    background-color: #fff !important;
}
.user-ath .form-control:focus {
    box-shadow:none !important;
}
</style>
<body class="user-ath">
<div class="user-ath-page">
	<div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
           <div class="well well-lg"> 
		<h3>{{ _tr('Admin Login') }}</h3>
	
               <form method="POST" action="{{ route('admin-login-post') }}" accept-charset="UTF-8">
                    <fieldset>
						<div class="checkbox">
   								<p style="color:#FF3300;font-size:16px;">{{ Session::get('errmsg') !== null ? _tr(Session::get('errmsg')) : '' }} </p>                 
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{ _tr('Email') }}" name="username" type="text" autofocus required="required">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{ _tr('Password') }}" name="password" type="password" value="" required="required">
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
						 <input class="btn btn-lg btn-success btn-block"  name="submit" type="submit" value="{{ _tr('Submit') }}">
                         <input name="actioned" type="hidden" value="admin_login">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </fieldset>
              </form>
              </div>
	</div>
        </div>
    </div>
    </div>
</body>
</html>