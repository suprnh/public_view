<?php set_front_language(); ?>
<!DOCTYPE html>
<html lang="zxx" class="js">
<head>	
	<meta charset="utf-8">
	<meta name="author" content="PAR coin">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="PAR coin">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<!-- Fav Icon  -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('/public/images/faviconn.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('/public/images/faviconn.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/public/images/faviconn.png') }}">
	<link rel="shortcut icon" href="{{ url('/public/images/faviconn.png')}}" type="image/x-icon">
	<link rel="manifest" href="images/favicon/site.html">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<!-- Site Title  -->
	<title><?php echo __t(get_settings('site_title')); ?></title>
	<!-- Vendor Bundle CSS -->
	<link rel="stylesheet" href="{{ url('/public/frontend/dashboard/assets-dashboard/css/vendor.bundled751.css?ver=100') }}">
	<!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ url('/public/frontend/dashboard/assets-dashboard/css/dashboard-styled751.css?ver=100') }}">
    <link rel="stylesheet" href="{{ url('/public/frontend/dashboard/assets/css/theme.css') }}">
	
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
	<script src="{{ url('/public/frontend/dashboard/assets-dashboard/js/jquery.bundle.js?ver=100') }}"></script>


	<style>
		.ct-topbar {
		  text-align: right;
		  background: #eee;
		}
		.ct-topbar__list {
		  margin-bottom: 0px;
		}
		.ct-language__dropdown{
			padding-top: 8px;
			max-height: 0;
			overflow: hidden;
			position: absolute;
			top: 110%;
			left: -24px;
			-webkit-transition: all 0.25s ease-in-out;
			transition: all 0.25s ease-in-out;
			width: 135px;
			text-align: center;
			padding-top: 0;
		  	z-index:200;
		}
		.ct-language__dropdown li{
			background: #70c6a7;
			padding: 5px;
			display: block;
			text-align: left;
		}
		.ct-language__dropdown li a{
			display: block;
    		color: #fff;
    		text-decoration: none;
		}
		.ct-language__dropdown li:first-child{
			padding-top: 10px;
			border-radius: 3px 3px 0 0;
		}
		.ct-language__dropdown li:last-child{
			padding-bottom: 10px;
			border-radius: 0 0 3px 3px;
		}
		.ct-language__dropdown li:hover{
			background: #4ad6a4;
		}
		.ct-language__dropdown:before{
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			margin: auto;
			width: 8px;
			height: 0;
			border: 0 solid transparent;
			border-right-width: 8px;
			border-left-width: 8px;
			border-bottom: 8px solid #70c6a7;
		}
		.ct-language {
		    position: relative;
		    background: #70c6a7;
		    color: #fff;
		    padding: 10px 19px !important;
		    border-radius: 30px !important;
		    height: 42px;
		    margin-top: 7px !important;
		}
		.ct-language:hover .ct-language__dropdown{
			max-height: 236px;
			padding-top: 8px;
		}
		.list-unstyled {
			padding-left: 0;
			list-style: none;
		}
		.goog-te-banner-frame.skiptranslate {
			display: none !important;
			} 
		body {
			top: 0px !important; 
			}
	</style>
</head>
<?php $tim_thimb_url = url('timthumb.php');?>
<?php $user_detail = get_user_detail_by_id(get_current_front_user_id()); ?>
<?php $sub_plan_details = subscriber_plan_details(get_current_front_user_id()); ?>



<body class="user-dashboard">
                         
   	<div class="topbar">
        <div class="topbar-md d-lg-none">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="toggle-nav">
                        <div class="toggle-icon">
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                        </div>
                    </a><!-- .toggle-nav -->

                    <div class="site-logo">
                        <a href="{{ url('/') }}" class="site-brand">
							<?php 
								$site_logo = get_settings('site_logo_id');
								if($site_logo > 0){
								?>
								<img src="<?php echo get_recource_url($site_logo); ?>" alt="logo" style="max-height: 80px;">
								<?php
								}else{
								?>
								<img src="{{ url('/public/frontend/dashboard/images/logo.png') }}" alt="logo">
								<?php 
								} 
								?>
                        </a>
                    </div><!-- .site-logo -->
					<ul>
                    <?php language_switcher_html(); ?>
					</ul>
                    <div class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> 
							<?php 
								if($user_detail->logo_id > 0){
									$thumb_url = $tim_thimb_url.'?src='.get_recource_url($user_detail->logo_id).'&w=80&h=80&zc=1&q=100';
								}else{
									$thumb_url = url('/public/frontend/dashboard/images/user-thumb-sm.png');
								}
							?>
							<img class="icon" src="<?php echo $thumb_url; ?>" alt="thumb"> 
						</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-dropdown">
                                <div class="user-dropdown-head">
									
                                    <h6 class="user-dropdown-name"><?php echo ucwords($user_detail->full_name); ?> <span><?php echo get_current_ref_id(); ?></span></h6>
                                    <span class="user-dropdown-email"><?php echo $user_detail->email; ?></span>
                                </div>
                                <div class="user-dropdown-balance">
                                        <h6>{{ __t('TOKEN BALANCE') }}</h6>
										<?php if($user_detail->role_id == 4){ ?>
											<h3><?php echo number_format($user_detail->high_token_amount,2,'.',','); ?></h3>
										<?php }else{ ?>
											<h3> <?php echo get_p2p_by_user_id(get_current_front_user_id()); ?> Token</h3>
										<?php }?>
                                   
                                </div>
								<?php if((float)$user_detail->eth_token_amount > 0){ ?>
								 <div class="user-dropdown-balance">
                                        <h6>{{ __t('ETHEREUM BALANCE') }}</h6>
                                        <h3> <?php echo number_format($user_detail->eth_token_amount,2,'.',','); ?> ETH</h3>
                                   
                                </div>
								<?php } ?>
                                <!-- <ul class="user-dropdown-btns btn-grp guttar-10px special_button">
                                    <?php if(!is_mail_confirmed()){ ?>
									<li>
									<form action="{{ route('resend-email') }}" method="post" name="resend_email2" id="resend_email2">
									{{ csrf_field() }}
									<a href="javascript:void(0);" class="btn btn-xs btn-warning" onclick="jQuery('#resend_email2').submit();">{{ __t('Confirm Email') }}</a>
									</form>
									</li>
									<?php } ?>
									<?php if(!is_kyc_varified() && what_my_role_logged_in()=='user'){
										$cur_status = current_kyc_status();
										
									if($cur_status==0){
										?>
										<li><a href="{{ route('kyc-application') }}" class="btn btn-xs btn-warning">AML/KYC Pending</a></li>
										<?php 
									}elseif($cur_status==1){
										?>
										<li><a href="{{ route('kyc-application') }}" class="btn btn-xs btn-warning">AML/KYC Processing</a></li>
										<?php 
									}
									else{ ?>
									<li><a href="{{ route('kyc') }}" class="btn btn-xs btn-warning">Submit AML/KYC</a></li>
									<?php } ?>
									<?php 
									} ?>
                                </ul> -->
                                <div class="gaps-1x"></div>
                                <ul class="user-dropdown-links">
                                        <?php if(what_my_role_logged_in()=='user'){ ?>
                                        <li><a href="{{ route('account') }}"><i class="ti ti-id-badge"></i>{{ __t('My Profile') }}</a></li>
										<?php } ?>
										<?php if(what_my_role_logged_in()=='partner'){ ?>
										<li><a href="{{ route('partner-account') }}"><i class="ti ti-id-badge"></i>{{ __t('My Profile') }}</a></li>
										<?php } ?>
                                        <li><a href="{{ route('referrals') }}"><i class="ti ti-infinite"></i>{{ __t('Referrals') }}</a></li>																														
                                </ul>
                                <ul class="user-dropdown-links">
                                        <li><a href="{{ route('logout') }}"><i class="ti ti-power-off"></i>{{ __t('Logout') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .toggle-action -->
                </div><!-- .container -->
            </div><!-- .container -->
        </div><!-- .topbar-md -->
        <div class="container-fluid">
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="topbar-lg d-none d-lg-block">
                    <div class="site-logo">
					
							
					
                        <a href="{{ url('/') }}" class="site-brand">
							<?php 
								$site_logo = get_settings('site_logo_id');
								if($site_logo > 0){
								?>
								<img src="<?php echo get_recource_url($site_logo); ?>" alt="logo" style="max-height: 80px;">
								<?php
								}else{
								?>
								<img src="{{ url('/public/frontend/dashboard/images/logo.png') }}" alt="logo">
								<?php 
								} 
							?>
                        </a>
                    </div><!-- .site-logo -->
                </div><!-- .topbar-lg -->

                <div class="topbar-action d-none d-lg-block">
                    <ul class="topbar-action-list">
						<li class="topbar-action-item">
						
						<?php language_switcher_html(); ?>
						</li>
						<!-- <li class="ct-language"> 
							EN 
							<i class="fa fa-caret-down"></i>
							<ul class="list-unstyled ct-language__dropdown">
								<li>
									<a href="#googtrans(en|en)" class="lang-en lang-select" data-lang="en">
										<img src="{{ url('/public/img/flag/usa-today.png') }}" alt="USA"> English
									</a>
								</li>
								<li>
									<a href="#googtrans(en|fr)" class="lang-es lang-select" data-lang="fr">
										<img src="{{ url('/public/img/flag/french-polynesia.png') }}" alt="FR"> French
									</a>
								</li>
								<li>
									<a href="#googtrans(en|es)" class="lang-es lang-select" data-lang="es">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="ES"> Spanish
									</a>
								</li>
								<li>
									<a href="#googtrans(en|hi)" class="lang-hi lang-select" data-lang="hi">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="HI"> Hindi
									</a>
								</li>
								<li>
									<a href="#googtrans(en|zho)" class="lang-zho lang-select" data-lang="zho">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="ZHO"> Chinese
									</a>
								</li>
								<li>
									<a href="#googtrans(en|th)" class="lang-th lang-select" data-lang="th">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="TH"> Thai
									</a>
								</li>
								<li>
									<a href="#googtrans(en|km)" class="lang-km lang-select" data-lang="km">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="KM"> Khmer
									</a>
								</li>
								<li>
									<a href="#googtrans(en|vi)" class="lang-vi lang-select" data-lang="vi">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="VI"> Vietnamese
									</a>
								</li>
								<li>
									<a href="#googtrans(en|tl)" class="lang-tl lang-select" data-lang="tl">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="TL"> Tagalog
									</a>
								</li>
								<li>
									<a href="#googtrans(en|ja)" class="lang-ja lang-select" data-lang="ja">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="JA"> Japanese
									</a>
								</li>
								<li>
									<a href="#googtrans(en|ko)" class="lang-ko lang-select" data-lang="ko">
										<img src="{{ url('/public/img/flag/spain.png') }}" alt="KO"> Korean
									</a>
								</li>
							</ul>
						</li> -->
                        <li class="topbar-action-item topbar-action-link">
                            <a href="{{ url('/') }}"><em class="ti ti-home"></em>{{ __t('Go to Home') }}</a>
                        </li><!-- .topbar-action-item -->

                        <li class="dropdown topbar-action-item topbar-action-user">
                            <a href="#" data-toggle="dropdown"> 
							<?php 
								if($user_detail->logo_id > 0){
									$thumb_url = $tim_thimb_url.'?src='.get_recource_url($user_detail->logo_id).'&w=80&h=80&zc=1&q=100';
								}else{
									$thumb_url = url('/public/frontend/dashboard/images/user-thumb-sm.png');
								}
							?>
							<img class="icon" src="<?php echo $thumb_url; ?>" alt="thumb"> 
							</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown">
                                    <div class="user-dropdown-head">
                                        <h6 class="user-dropdown-name"><?php echo ucwords($user_detail->full_name); ?> <br> <span><?php echo get_current_ref_id(); ?></span></h6>
                                        <span class="user-dropdown-email"><?php echo $user_detail->email; ?></span>
                                    </div>
                                    <div class="user-dropdown-balance"> 
                                        <h6>{{ __t('TOKEN BALANCE') }}</h6>
										
										<?php if($user_detail->role_id == 4){ ?>
											<h3><?php echo number_format($user_detail->high_token_amount,2,'.',','); ?></h3>
										<?php }else{ ?>
											<h3> <?php echo get_p2p_by_user_id(get_current_front_user_id()); ?> Token</h3>
										<?php }?>
                                    </div>
									<?php if((float)$user_detail->eth_token_amount > 0){ ?>
									 <div class="user-dropdown-balance">
											<h6>{{ __t('ETHEREUM BALANCE') }}</h6>
											<h3> <?php echo number_format($user_detail->eth_token_amount,2,'.',','); ?> ETH</h3>
									   
									</div>
									<?php } ?>
                                    <ul class="user-dropdown-links">
										<?php if(what_my_role_logged_in()=='user'){ ?>
                                        <li><a href="{{ route('account') }}"><i class="ti ti-id-badge"></i>{{ __t('My Profile') }}</a></li>
										<?php } ?>
										<?php if(what_my_role_logged_in()=='partner'){ ?>
										<li><a href="{{ route('partner-account') }}"><i class="ti ti-id-badge"></i>{{ __t('My Profile') }}</a></li>
										<?php } ?>
                                        <li><a href="{{ route('referrals') }}"><i class="ti ti-infinite"></i>{{ __t('Referrals') }}</a></li>
                                    </ul>
                                    <ul class="user-dropdown-links">
                                        <li><a href="{{ route('logout') }}"><i class="ti ti-power-off"></i>{{ __t('Logout') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li><!-- .topbar-action-item -->
                    </ul><!-- .topbar-action-list -->
                </div><!-- .topbar-action -->
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- TopBar End -->
    
    
    <div class="user-wraper">
        <div class="container-fluid">
            <div class="d-flex">
                <div class="user-sidebar">
                    <div class="user-sidebar-overlay"></div>
                    <div class="user-box d-none-1 d-lg-block-1">
                        <div class="user-image">
						
							<?php 
								if($user_detail->logo_id > 0){
									$thumb_url = $tim_thimb_url.'?src='.get_recource_url($user_detail->logo_id).'&w=140&h=140&zc=1&q=100';
								}else{
									$thumb_url = url('/public/frontend/dashboard/images/user-thumb-sm.png');
								}
							?>
                            <img id="user_logo" src="<?php echo $thumb_url; ?>" alt="thumb">
							<span id="logo_loader" class="loader-icon" style="display:none;"><i class="fa fa-spinner fa-spin fa-fw"></i></span>
							<form name="update_logo" id="update_logo" action="{{ route('update-logo') }}" enctype="multipart/form-data" method="post">
							{{ csrf_field() }}
                            <span class="uploadImg"> 
                                <label id="#uplodImg" for="logo"><i class="fa fa-camera" aria-hidden="true" ></i> {{ __t('Upload Picture') }}
                                    <input type="file" id="logo" name="logo" accept="image/*">
                                </label> 
                            </span>
							</form>
							
                        </div>
                        <h6 class="user-name"><?php echo ucwords($user_detail->full_name); ?></h6>
						<h6 class=""><?php if($sub_plan_details->plan_id == 1){echo 'Monthly Subscriber';} if($sub_plan_details->plan_id == 2){echo 'Yearly Subscriber';} ?></h6>
						
                        <!-- <div class="user-uid">{{ __t('REFERRAL ID') }}: <span><?php echo get_current_ref_id(); ?></span></div> -->
                        <!-- <ul class="btn-grp guttar-10px special_button">
							<?php if(!is_mail_confirmed()){ ?>
                            <li>
							<form action="{{ route('resend-email') }}" method="post" name="resend_email1" id="resend_email1">
							{{ csrf_field() }}
							<a href="javascript:void(0);" class="btn btn-xs btn-warning" onclick="jQuery('#resend_email1').submit();">{{ __t('Confirm Email') }}</a>
							</form>
							</li>
							<?php } ?>
							<?php if(!is_kyc_varified() && what_my_role_logged_in()=='user'){
										$cur_status = current_kyc_status();
										
									if($cur_status==0){
										?>
										<li><a href="{{ route('kyc-application') }}" class="btn btn-xs btn-warning">AML/KYC Pending</a></li>
										<?php 
									}elseif($cur_status==1){
										?>
										<li><a href="{{ route('kyc-application') }}" class="btn btn-xs btn-warning">AML/KYC Processing</a></li>
										<?php 
									}
									else{ ?>
									<li><a href="{{ route('kyc') }}" class="btn btn-xs btn-warning">Submit AML/KYC</a></li>
									<?php } ?>
									<?php 
									} ?>
                        </ul> -->
                    </div><!-- .user-box -->
                    <ul class="user-icon-nav">
						<?php if(what_my_role_logged_in()=='user'){ ?>
						<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><em class="ti ti-dashboard"></em>{{ __t('Dashboard') }}</a></li>
                        <li class="{{ Request::is('account') ? 'active' : '' }}"><a href="{{ route('account') }}"><em class="ti ti-user"></em>{{ __t('Account') }}</a></li>

						<!-- <?php
						$cur_status = current_kyc_status();
						if($cur_status==0 || $cur_status==1){ ?>
                        <li class="{{ Request::is('kyc','kyc/*') ? 'active' : '' }}"><a href="{{ route('kyc-application') }}"><em class="ti ti-files"></em>{{ __t('AML/KYC Application') }}</a></li>
						<?php }else{ ?>
						<li class="{{ Request::is('kyc','kyc/*') ? 'active' : '' }}"><a href="{{ route('kyc') }}"><em class="ti ti-files"></em>{{ __t('AML/KYC Application') }}</a></li>
						<?php } ?> -->
						
                        <li class="{{ Request::is('token') ? 'active' : '' }}"><a href="{{ route('token') }}"><em class="ti ti-control-shuffle"></em>{{ __t('Buy PAR') }}</a></li>
                        
						<li class="{{ Request::is('contribution') ? 'active' : '' }}"><a href="{{ route('contribution') }}"><em class="ti ti-pie-chart"></em>{{ __t('Purchase Info') }}</a></li>

                        <!-- <li class="{{ Request::is('referrals') ? 'active' : '' }}"><a href="{{ route('referrals') }}"><em class="ti ti-infinite"></em>{{ __t('Referrals') }}</a></li> -->						

                        <li class="{{ Request::is('transaction-history') ? 'active' : '' }}"><a href="{{ route('ur-transaction') }}"><em class="ti ti-pie-chart"></em>{{ __t('Transaction') }}</a></li>
						
						
						<?php } ?>
						<?php if(what_my_role_logged_in()=='partner'){ ?>
						<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><em class="ti ti-dashboard"></em>{{ __t('Dashboard') }}</a></li>
						<li class="{{ Request::is('partner-account') ? 'active' : '' }}"><a href="{{ route('partner-account') }}"><em class="ti ti-user"></em>{{ __t('Account') }}</a></li>
						<li class="{{ Request::is('token') ? 'active' : '' }}"><a href="{{ route('token') }}"><em class="ti ti-control-shuffle"></em>{{ __t('Investment Information') }}</a></li>
						<li class="{{ Request::is('contribution') ? 'active' : '' }}"><a href="{{ route('contribution') }}"><em class="ti ti-pie-chart"></em>{{ __t('Investment Proof') }}</a></li>

                        <!-- <li class="{{ Request::is('partner-referrals') ? 'active' : '' }}"><a href="{{ route('partner-referrals') }}"><em class="ti ti-infinite"></em>{{ __t('Referrals') }}</a></li> -->	

                        <li class="{{ Request::is('transaction-history') ? 'active' : '' }}"><a href="{{ route('ur-transaction') }}"><em class="ti ti-pie-chart"></em>{{ __t('Transaction') }}</a></li>
						
						
						
						
						<?php } ?>
                    </ul><!-- .user-icon-nav -->
                    <div class="user-sidebar-sap"></div><!-- .user-sidebar-sap -->
                   <!--  <ul class="user-nav">
                        <li><a href="{{ route('how-to') }}">{{ __t('How to buy?') }}</a></li>
                        <li><a href="{{ route('faq') }}">{{ __t('Faqs') }}</a></li>
                        <li>{{ __t('Contact Support') }}<span>info@ACW.net</span></li>
                    </ul> --><!-- .user-nav -->
                    <div class="d-lg-none">
                        <div class="user-sidebar-sap"></div>
                        <div class="gaps-1x"></div>
                        <ul class="topbar-action-list">
                            <li class="topbar-action-item topbar-action-link">
                                <a href="{{ url('/') }}"><em class="ti ti-home"></em>{{ __t('Go to Home') }}</a>
                            </li><!-- .topbar-action-item -->
                        </ul><!-- .topbar-action-list -->
                    </div>
                </div><!-- .user-sidebar -->
				
					
				

				   @yield('mid_area')
				   
				 
				
		   </div><!-- .d-flex -->
		   
		   
		   
        </div><!-- .container -->
		
    </div>
	  
    <!-- UserWraper End -->
	
	@yield('modal')
    
    <div class="footer-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <span class="footer-copyright">  <?php echo get_settings('copyright_text'); ?></span>
                </div><!-- .col -->
                <div class="col-md-5 text-md-right">
				 
				 
					
					
                    <ul class="footer-links">
                        <!-- <li><a href="{{ url('/') }}">{{ __t('Home') }}</a></li> -->
						<!-- <?php 
						$terms_conditions = get_settings('terms_conditions');
						$privacy_policy = get_settings('privacy_policy');
						?>
						<?php if(isset($privacy_policy) && !empty($privacy_policy) && $privacy_policy > 0){ ?>
                        <li><a href="<?php echo get_recource_url($privacy_policy); ?>">{{ __t('Privacy Policy') }}</a></li>
						<?php } ?>
						<?php if(isset($terms_conditions) && !empty($terms_conditions) && $terms_conditions > 0){ ?>
                        <li><a href="<?php echo get_recource_url($terms_conditions); ?>">{{ __t('Terms of Conditions') }}</a></li>
						<?php } ?> -->

						<li><a target="_blank" href="#">Privacy Policy | Terms & Conditions</li></a>
							
                    </ul>
					
					
					
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- FooterBar End -->

    <!-- google translate -->

    <div id="google_translate_element"></div>

        <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	
	<!-- JavaScript (include all script here) -->
	<script src="{{ url('/public/frontend/dashboard/assets-dashboard/js/script.js?ver=100') }}"></script>
	
	<style>
	.err_msg{
		float:left;
	}
	</style>
	<script>
		
	Dropzone.autoDiscover = false;
	(function($){
	  
	var currentTabId = $('ul#document_tab li a.active').attr("data-id");	
	jQuery('#document_type').val(currentTabId);
	
	$(".nav-link").click(function(){
		currentTabId = $(this).attr("data-id");
		jQuery('#document_type').val(currentTabId);
	})
	
	
	  // Dropzone
	var $upload_zone = $('.upload-zone');
	if ($upload_zone.length > 0 ) {

		$upload_zone.each(function(){
			var $self = $(this);
			$self.addClass('dropzone').dropzone({
				url: "{{ route('add-kyc-document') }}",
				/*autoProcessQueue: false,*/
				maxFiles: 1,
				acceptedFiles:'image/*,application/pdf',
				maxfilesexceeded: function(file) {
					this.removeAllFiles();
					this.addFile(file);
				},
				sending: function(file, xhr, formData) {
					formData.append("_token", "{{ csrf_token() }}");
					formData.append("document_type", currentTabId);
					if(currentTabId=='national-card' && $self.attr('id')=='youNid'){
						formData.append("document_order", "3");
					}else if(currentTabId=='national-card' && $self.attr('id')=='backside'){
						formData.append("document_order", "2");
					}else{
						formData.append("document_order", "1");
					}
					$('.kyc_submit').css("opacity", "0.5");
					$('.kyc_submit').text('Uploading...');
					$('.kyc_submit').prop('disabled', true);
				},
				success: function(file, response){
					var obj = jQuery.parseJSON(response);
					if(obj.status=='success'){
						if(obj.document_type=='passport'){
							jQuery("#document_id_passport").val(obj.upload_id);
						}
						if(obj.document_type=='driver-licence'){
							jQuery("#document_id_driver-licence").val(obj.upload_id);
						}
						if(obj.document_type=='national-card'){
							if(obj.document_order=='1'){
								jQuery("#document_id_national-card_1").val(obj.upload_id);
							}else if(obj.document_order=='2'){
								jQuery("#document_id_national-card_2").val(obj.upload_id);
							}else{
							jQuery("#document_id_national-card_3").val(obj.upload_id);
							}
						}
						
						
						if(obj.document_type=='national-card' && jQuery("#document_id_national-card_2").val() =="" ){
							$('.kyc_submit').css("opacity", "0.5");
							$('.kyc_submit').text('Uploading...');
							$('.kyc_submit').prop('disabled', true);
						}else{
							$('.kyc_submit').css("opacity", "1");
							$('.kyc_submit').text('Submit Details');
							$('.kyc_submit').prop('disabled', false);
						}
						
					}
				},
				error: function(file, message, xhr) {
				   if (xhr == null) this.removeFile(file); // perhaps not remove on xhr errors
				   alert(message);
				}
			});
		});
	}
	
	function copytoclipboard(triger,action,feedback){
        var $triger = triger, $action = action, $feedback = feedback;
        $triger.on('click',function(){
            var $this = $(this);
            $this.parent().find($action).removeAttr('disabled').select();
            document.execCommand("copy");
            $feedback.text("<?php echo __t('Copied to Clipboard'); ?>").fadeIn().delay(1000).fadeOut();
            $this.parent().find($action).attr('disabled', 'disabled');
            return false;
        });
    }
	
	 var $copy_trigger = $('.copy-trigger'), 
        $copy_address = $('.copy-address'), 
        $copy_feedback = $('.copy-feedback');
    if($copy_trigger.length > 0){
        copytoclipboard($copy_trigger,$copy_address,$copy_feedback);
    }
	
	})(jQuery);

	(function($){
		
		$("input[name='payOption']").change(function(){
			
			$("#choosen_crypto").val($(this).val());
			var choosen_current_currency = $(this).val();
			
			var paymentFrom = parseFloat(remove_comma($("#paymentFrom").val()));
			if(isNaN(paymentFrom)){
				paymentFrom = 0;
			}
			
			//$('.tranx-payment-address').attr('id', 'wallet_address');
			if(choosen_current_currency == 'ETH'){
				crypto_val = $('#usd_eth').val();
			}
			if(choosen_current_currency == 'BTC'){
				crypto_val = $('#usd_btc').val();
			}
			if(choosen_current_currency == 'USDT'){
				crypto_val = $('#usd_usdt').val();
			}
			if(choosen_current_currency == 'BNB'){
				crypto_val = $('#usd_bnb').val();
			}
			if(choosen_current_currency == 'ADA'){
				crypto_val = $('#usd_ada').val();
			}
			
			var crypto_value = parseFloat(paymentFrom*crypto_val)
			
			$('#payable_crypto_amount').val(crypto_value);
			
			$('#payable_crypto_coin').text(choosen_current_currency);
		
			$('#contribution_amount').html("<?php echo __t('Contribution amount'); ?>: <strong>$"+ReplaceNumberWithCommas(paymentFrom)+" ("+crypto_value.toFixed(4)+' '+choosen_current_currency+")</strong>");
			
			$("#wallet_address").val('<?php echo get_settings('admin_wallet_address'); ?>');
			$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address'); ?>' );
			
			var that = $(this);
			$("em#coin_logo").removeClass();
			if(that.val()=='ETH'){
				$("em#coin_logo").show();
				$("em#coin_logo_usdt").hide();
				$("em#coin_logo").addClass('fab fa-ethereum');
				$("#wallet_address").val('<?php echo get_settings('admin_wallet_address'); ?>');
				$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address'); ?>' );
			}else if(that.val()=='USDT'){
				$("em#coin_logo").hide();
				$("em#coin_logo_usdt").show();
				$("em#coin_logo_ada").hide();
				$("em#coin_logo_bnb").hide();
				$("#wallet_address").val('<?php echo get_settings('admin_wallet_address_ltc'); ?>');
				$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address_ltc'); ?>' );
			}else if(that.val()=='BTC'){
				$("em#coin_logo").show();
				$("em#coin_logo_usdt").hide();
				$("em#coin_logo").addClass('fab fa-bitcoin');
				$("#wallet_address").val('<?php echo get_settings('admin_wallet_address_btc'); ?>');
				$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address_btc'); ?>' );
			}else if(that.val()=='BNB'){
				$("em#coin_logo").hide();
				$("em#coin_logo_usdt").hide();
				$("em#coin_logo_ada").hide();
				$("em#coin_logo_bnb").show();
				$("#wallet_address").val('<?php echo get_settings('admin_wallet_address_bnb'); ?>');
				$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address_bnb'); ?>' );
			}else if(that.val()=='ADA'){
				$("em#coin_logo").hide();
				$("em#coin_logo_usdt").hide();
				$("em#coin_logo_ada").show();
				$("em#coin_logo_bnb").hide();
				$("em#coin_logo").addClass('fab fa-bitcoin');
				$("#wallet_address").val('<?php echo get_settings('admin_wallet_address_ada'); ?>');
				$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address_ada'); ?>' );
			}else{
				$("#wallet_address").val('<?php echo get_settings('admin_wallet_address'); ?>');
				$("#wallet_address").attr('value', '<?php echo get_settings('admin_wallet_address'); ?>' );
			}
			/*calculate_exchange(that);
			calculate_final_payment(); */
		});
		calculate_exchange($('#token_value').val());
		$("input#paymentGet").keyup(function(){
			restrict_zero($(this));
			calculate_reverse_exchange();
			calculate_final_payment();
		});
		$("input#paymentFrom").keyup(function(){
			restrict_zero($(this));
			change_get_value();
			calculate_final_payment();
		});
		
		$("#logo").change(function () {
			
			var ext = $('#logo').val().split('.').pop().toLowerCase();
			//Allowed file types
			if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
				alert('The file type is invalid!');
				$('#logo').val("");
				return false;
			}else{
				$("#logo_loader").show();
				$("#update_logo").submit();
			}
			
		});
	})(jQuery);
	
	$('document').ready(function(){
		$("input#paymentFrom").keyup();
		$("em#coin_logo").addClass('fab fa-ethereum');
	});
	
	function restrict_zero(that){
		var this_val = parseFloat(that.val());
		if(isNaN(this_val) || this_val <= 0) {
		}
	}
	function remove_comma(str){
	  //str = str.replace(/,/g, "");
      return str;
	}
	function calculate_exchange(){
		var decimals = 2;
		
		var convertion_rate = parseFloat($('#token_value').val());
		var paymentFrom = parseFloat(remove_comma($("#paymentFrom").val()));
		if(isNaN(paymentFrom)) {
			paymentFrom = 0;
		}
		var paymentGet = parseFloat(paymentFrom/convertion_rate);
		$("#paymentGet").attr('value', ReplaceNumberWithCommas(paymentGet.toFixed(decimals)));
		$("#paymentGet").val(ReplaceNumberWithCommas(paymentGet.toFixed(decimals)));
	}
	
	function calculate_reverse_exchange(){
		var decimals = 2;
		var current_currency = $("input[name='payOption']:checked");
		var convertion_rate = parseFloat($('#token_value').val());
		if(isNaN(convertion_rate)) {
			convertion_rate = 1;
		}else{
			convertion_rate = parseFloat(1/convertion_rate);
		}
		
		var paymentGet = parseFloat(remove_comma($("#paymentGet").val()));
		if(isNaN(paymentGet)) {
			paymentGet = 0;
		}
		
		var paymentFrom = parseFloat(paymentGet/convertion_rate);
		$("#paymentFrom").attr('value', ReplaceNumberWithCommas(paymentFrom.toFixed(decimals)));
		$("#paymentFrom").val(ReplaceNumberWithCommas(paymentFrom.toFixed(decimals)));
		
	}
	
	function change_get_value(){
		//var current_currency = $("input[name='payOption']:checked");
		//calculate_exchange(current_currency);
		calculate_exchange();
	}
	function calculate_final_payment(){
		var decimals = 2;
		var paymentGet = parseFloat(remove_comma($("#paymentGet").val()));
		if(isNaN(paymentGet)){
			paymentGet = 0;
		}
		var paymentFrom = parseFloat(remove_comma($("#paymentFrom").val()));
		if(isNaN(paymentFrom)){
			paymentFrom = 0;
		}
		var bonus_percentage = parseFloat($("#bonus_percentage").val());
		if(isNaN(bonus_percentage)){
			bonus_percentage = 0;
		}
		var bonus_amount = 0;
		if(bonus_percentage > 0){
			bonus_amount = paymentGet*(bonus_percentage/100);
		}
		
		var final_payment = paymentGet;
		var received_bonus = bonus_amount;
		var total_received = final_payment+bonus_amount;
		
		$('#final_payment').html(ReplaceNumberWithCommas(final_payment.toFixed(decimals)));
		$('#received_bonus').html(ReplaceNumberWithCommas(received_bonus.toFixed(decimals)));
		$('#total_received').html(ReplaceNumberWithCommas(total_received.toFixed(decimals)));
		
		//var current_cur = $("#current_currency").html();
		var current_cur = '';
		//var choosen_current_currency = $(".choosen_crypto").val();
		var choosen_current_currency = $("input[name='payOption']:checked").val();
		if(choosen_current_currency == 'ETH'){
			crypto_val = $('#usd_eth').val();
		}
		if(choosen_current_currency == 'BTC'){
			crypto_val = $('#usd_btc').val();
		}
		if(choosen_current_currency == 'USDT'){
			crypto_val = $('#usd_usdt').val();
		}
		if(choosen_current_currency == 'ADA'){
			crypto_val = $('#usd_ada').val();
		}
		if(choosen_current_currency == 'BNB'){
			crypto_val = $('#usd_bnb').val();
		}
		
		var crypto_value = parseFloat(paymentFrom*crypto_val)
		
		$('#payable_crypto_amount').val(crypto_value);
		$('#payable_crypto_coin').text(choosen_current_currency);
		
		$('#contribution_amount').html("<?php echo __t('Contribution amount'); ?>: <strong>$"+ReplaceNumberWithCommas(paymentFrom)+" ("+crypto_value.toFixed(4)+' '+choosen_current_currency+")</strong>");
		$('#cur_crypto').html(current_cur);
		$('#contribution_detail').html("<?php echo __t('You will receive'); ?> <strong>"+ReplaceNumberWithCommas(total_received.toFixed(decimals))+" PAR </strong> <?php echo __t('tokens') ?> ( <?php echo __t('incl. bonus of'); ?> "+ReplaceNumberWithCommas(received_bonus.toFixed(decimals))+" PAR) <?php echo __t('once Contributed.'); ?>");
		
	}
	
	setTimeout(function(){
	  if ($('.alert-box').length){
	  $('.alert-box').remove();
	  }
	}, 8000);
	$('input').click(function(){
	  if ($('.alert-box').length){
	  $('.alert-box').remove();
	  }
	});
	
	function ReplaceNumberWithCommas(yourNumber) {
		/* //Seperates the components of the number
		var n= yourNumber.toString().split(".");
		//Comma-fies the first part
		n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		//Combines the two sections
		return n.join("."); */
		return yourNumber;
	}
	
	(function($){
		
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
	})(jQuery);
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
			if($(this).parent().next('.err_msg').length > 0){
				$(this).parent().next('.err_msg').remove();
			}
		});
		$("select").change(function() {
			if($(this).next('.err_msg').length > 0){
				$(this).next('.err_msg').remove();
			}
		});
		
		$("input#etc_percentage").keyup(function(){
			
			var etc_percentage = $('#etc_percentage').val();
			
			if(isNaN(etc_percentage)){
				etc_percentage = 0;
			}
			
			if(etc_percentage > 99 || etc_percentage < 1 ){
				//alert('Please enter a number between 1 to 100');
				$('#etc_percentage').val('0');
				$('#high_percentage').val('0');
			}else{
				var high_percentage = 100-etc_percentage;
			
				//alert(etc_percentage);
				//alert(high_percentage);
				$('#high_percentage').val(high_percentage);
			}
			
		});
		
		$("input#high_percentage").keyup(function(){
			
			var high_percentage = $('#high_percentage').val();
			
			if(isNaN(high_percentage)){
				high_percentage = 0;
			}
			
			if(high_percentage > 99 || high_percentage < 1 ){
				//alert('Please enter a number between 1 to 100');
				$('#etc_percentage').val('0');
				$('#high_percentage').val('0');
			}else{
				var etc_percentage = 100-high_percentage;
			
				//alert(etc_percentage);
				//alert(high_percentage);
				$('#etc_percentage').val(etc_percentage);
			}
			
		});
		
		$(".add_wat_id").click(function(){
			
			//$('.tranx-payment-address').attr('id', 'wallet_address');
		})
		
		$('#aggrement').change(function() {
			if($(this).is(":checked")) {
				$('.add_wat_id').show();
			}else{
				$('.add_wat_id').hide();
			}
			
		});
		
	})(jQuery);
	</script>
	<script>
	$('#currency').change(function() {
		//alert($(this).val());
		var currency = $(this).val();
		
		if(currency == 'card'){
			$('#upload_proof_sec').show();
		}else{
			$('#upload_proof_sec').hide();
		}
		
	});
	</script>
	
	<script>		
	$(document).ready(function() {
		$('#token_table').DataTable();
	} );
</script> 
</body>
</html>
