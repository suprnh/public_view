<?php set_front_language(); ?>
<?php $current_lang = get_front_language(); ?>
<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	<meta charset="utf-8">
	<meta name="author" content="ACW">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<meta name="description" content="ACW | Ico Website">
    <meta property="og:url" content="https://ACW.io/"/>
    <meta property="og:type"  content="ACW ICO Website"/>
    <meta property="og:title" content="ACW ICO Website"/>
    <meta property="og:description" content="This is ACW ico website, a Better blockchain website"/>
    <meta property="og:image"  content="{{ url('/public/frontend/images/logo.png') }}"/>
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
	<link rel="stylesheet" href="{{ url('/public/frontend/assets/css/vendor/all.min.css ?ver=142') }}">
    <link rel="stylesheet" href="{{ url('/public/frontend/assets/css/perfect-scrollbar.css?ver=142') }}">
	<!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ url('/public/frontend/assets/css/style.css?ver=142') }}">
	<link rel="stylesheet" href="{{ url('/public/frontend/assets/css/responsive.css?ver=142') }}">
	

</head>
<?php $tim_thimb_url = url('timthumb.php');?>
<body class="theme-dark io-zinnia" data-spy="scroll" data-target="#mainnav" data-offset="80">
 
	<!-- Header -->

	<header class="site-header is-sticky">
        <!-- Place Particle Js -->
        <div id="particles-js" class="particles-container particles-js"></div>

	   <div class="container-fluid padd-less justify-content-center"> 

		<!-- Navbar -->
		<div class="navbar navbar-full navbar-expand-lg is-transparent" id="mainnav">
            <a class="navbar-brand animated" data-animate="fadeInDown" data-delay=".65" href="{{ url('/') }}">
                <img class="logo logo-dark" alt="logo" src="{{ url('/public/frontend/images/logo.png') }}">
                <img class="logo logo-light" alt="logo" src="{{ url('/public/frontend/images/logo-white.png') }}">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle">
                <span class="navbar-toggler-icon">
                    <span class="ti ti-align-justify"></span>
                </span>
            </button>

            <div class="collapse navbar-collapse nav-coll" id="navbarToggle">
                <ul class="navbar-nav animated remove-animation nabar-area" data-animate="fadeInDown" data-delay=".75">
                    <li class="nav-item"><a class="nav-link menu-link" href="#about">{{ __t('About') }}<span class="sr-only">(current)</span></a></li>
                    <!-- <li class="nav-item"><a class="nav-link menu-link" href="#vision">{{ __t('Vision') }}</a></li> -->
                    <li class="nav-item"><a class="nav-link menu-link" href="#benifits">{{ __t('Benefits') }}</a></li>
                    <li class="nav-item"><a class="nav-link menu-link" href="#features">{{ __t('Features') }}</a></li>
                    <li class="nav-item"><a class="nav-link menu-link" href="#tokenSale">{{ __t('Token') }}</a></li>
                    <li class="nav-item"><a class="nav-link menu-link" href="#tokenAlocate">{{ __t('Fund Allocation') }}</a></li>
                   
					<li class="nav-item"><a class="nav-link menu-link" href="#timeline">{{ __t('Roadmap') }}</a></li>
					
                    <li class="nav-item"><a class="nav-link menu-link" href="#team">{{ __t('Team') }}</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ __t('More') }}</a>
                        <div class="dropdown-menu">
                            
                            <!-- <a class="dropdown-item menu-link" href="#services">{{ __t('Solution') }}</a> -->
                            <a class="dropdown-item menu-link" href="#partners">{{ __t('Partners') }}</a>
							<a class="dropdown-item menu-link" href="#faq">{{ __t('Faqs') }}</a>
                            <a class="dropdown-item menu-link" href="#contact">{{ __t('Contact') }}</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-btns animated remove-animation justify-content-right" data-animate="fadeInDown" data-delay=".85">
					<?php if(get_current_front_user_id()==0){ ?>
                    <li class="nav-item"><span class="nav-link btn btn-sm btn-outline  menu-link"><a href="{{ url('login') }}">{{ __t('login') }} / </a>  <a href="{{ url('signup') }}">{{ __t('Registration') }} </a></span> </li>
					<?php }else{ ?>
					 <li class="nav-item"><span class="nav-link btn btn-sm btn-outline  menu-link"><a href="{{ url('dashboard') }}">{{ __t('My Dashboard') }}</a></span> </li>
					<?php } ?>
                    <li class="nav-item"><a href="https://etherscan.io/token/0x1354c8c1a66c2573ce9cc3e92e98d17869501a46" target="_blank" class="nav-link btn btn-sm btn-outline menu-link">{{ __t('Token Contract') }}</a></li>
                </ul>
            </div>
		</div>
		<!-- End Navbar -->
</div>
		<!-- Banner/Slider -->
		<div id="header" class="banner banner-zinnia">
            <div class="ui-shape ui-shape-light ui-shape-header"></div>
			<div class="container">
				
				<div class="banner-content">
					<div class="row ">
						<div class="col-sm-12 col-md-6 col-lg-6 col-12 align-items-center">
							<div class="header-txt slider-hd tab-center mobile-center align-items-center">
								<h1 class="animated" data-animate="fadeInUp" data-delay="1.25">{{ __t('ACW ICO Website') }}<br class="d-none d-xl-block"></h1>
                                <p class="animated" data-animate="fadeInUp" data-delay="1.25">{{ __t('ACW looks like to be the next big thing') }}</p>
								
								<a href="" target="_blank" class="nav-link btn in-block btn-sm btn-outline menu-link no-linee">{{ __t('Whitepaper') }}</a>
                                <a href="" target="_blank" class="nav-link btn btn-sm in-block btn-outline menu-link no-linee">{{ __t('Onepager') }}</a>
								<div class="gaps size-1x d-none d-md-block"></div>
								
							</div>
						</div><!-- .col  -->

                        
                             <div class="col-lg-4 offset-lg-2 col-md-6 col-sm-6 col-12">
                                <div class="presale-countdown clockdetails  animated" data-animate="fadeIn" data-delay="1.65">
                                    <!-- <h5>ICO starts soon</h5> -->
                                    <h6 class="animated" data-animate="fadeInUp" data-delay="1.25"><?php echo __t(get_settings('clock_title')); ?></h6>
                                    <div class="token-countdown" data-date="<?php echo get_settings('clock_countdown_time'); ?>"></div>

                                    <div class="presale-status">
                                        <div class="progress track-progress"> 
                                        <span class="every-start-point">0 USD</span>
                                            <span class="start-point"> <span>15M USD</span></span> 
                                            <span class="end-point"> <span>150M USD</span></span>
                                        <div class="determinate" style="width: <?php echo get_settings('percentage'); ?>%"></div>
                                        </div>
                                    </div>
                                    <p class="animated text-center" data-animate="fadeInUp" data-delay="1.25">{{ __t('We accept : BTC, ETH, LTC.') }}</p>
                                    <a href="{{ url('login') }}" class="nav-link btn in-block btn-sm btn-outline menu-link ico-bttn animated no-linee" data-animate="fadeInUp" data-delay="1.25">{{ __t('Invest Now') }}</a>

                                </div>
                            </div>
                        <!-- .clockdetails -->
                        

					</div><!-- .row  -->
                   
				</div><!-- .banner-content  -->
			</div><!-- .container  -->
			<!-- <ul class="hr-social hr-social-mid animated" data-animate="fadeIn" data-delay="1.55">
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
			</ul> -->
		</div>
		<!-- End Banner/Slider -->
		
	</header>
	<!-- End Header -->

   

    <!-- Start about us Section -->
    <div class="section section-pad extra-padd about-section no-pb section-bgg" id="about">
        <div class="container">
            <div class="row justify-content-center text-center">
				<div class="col-md-10 col-sm-10">
					<div class="section-head-s7 titttle-clr title-clr-wh">
						<h2 class="section-title-s7 animated" data-animate="fadeInUp" data-delay=".1">{{ __t('About ACW') }}</h2>
						<p class="lead animated" data-animate="fadeInUp" data-delay=".2">{{ __t('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, quae!') }}</p>
					</div>
				</div>
			</div>

             <!-- Nav tabs -->
              <!-- <ul class="nav nav-tabs justify-content-center"> -->
                <!-- <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">{{ __t('Korean') }}</a>
                </li> -->
               <!--  <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu1">{{ __t('English') }}</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu2">{{ __t('Japanese') }}</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu3">{{ __t('Chinese') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu4">{{ __t('Vietnamese') }}</a>
                </li> -->
             <!--  </ul> -->

              <!-- Tab panes -->
              <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <div class="row text-center">
						<?php 
							if(count($k_videos) > 0){
							foreach($k_videos as $k=>$vid){
							preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $vid->video_link, $match);
							$youtube_id = $match[1];
							if(!empty($youtube_id)){
								$embed_link = 'https://www.youtube.com/embed/'.$youtube_id.'?showinfo=0';
							}else{
								$embed_link = '';
							}
						?>
							<div class="col-lg-6 col-sm-12">
                            <div class="video-box-s3 animated" data-animate="fadeInUp" data-delay=".3">
                                
                                <iframe class="ifreame" width="100%" height="315" src="<?php echo $embed_link; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <!--h3>{{ __t('ACW ICO Listing platform & Airdrop Platform with all other features') }}</h3-->
								<?php echo $vid->description; ?>
                            </div>
							</div><!-- .col-lg-6 -->
						<?php 
							}
						} 
						?>
                    </div><!-- .row -->
                  
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                  <div class="row text-center">
						<?php 
							if(count($e_videos) > 0){
							foreach($e_videos as $k=>$vid){
							preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $vid->video_link, $match);
							$youtube_id = $match[1];
							if(!empty($youtube_id)){
								$embed_link = 'https://www.youtube.com/embed/'.$youtube_id.'?showinfo=0';
							}else{
								$embed_link = '';
							}
						?>
							<div class="col-lg-6 col-sm-12">
                            <div class="video-box-s3 animated" data-animate="fadeInUp" data-delay=".3">
                                
                                <iframe class="ifreame" width="100%" height="315" src="<?php echo $embed_link; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <!--h3>{{ __t('ACW ICO Listing platform & Airdrop Platform with all other features') }}</h3-->
								<?php echo $vid->description; ?>
                            </div>
							</div><!-- .col-lg-6 -->
						<?php 
							}
						} 
						?>
                    </div><!-- .row -->
                  
                </div>
                

                


              </div><!-- .tab-content -->
           
           
        </div>
    </div>
    <!-- End Section -->


    <!-- Start Section -->
   
    <!-- End Section -->


    <!-- Start benifits Section -->
    <div class="section section-pad prblmsltn-section" id="benifits">
        <div class="ui-shape ui-shape-s2"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2 class="title-coloor-blue">ACW Benefits</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blan ditiis praes entium volup tatum deleniti.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="seciton-problem-img">
                        <img src="/public/frontend/assets/images/about_img4.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-problem-text">
                        <h3>PROBLEM</h3>
                        <h4>Centralize Network</h4>
                        <ul class="problem-text">
                            <li>Control of an activity or organization under a single authority.</li>
                            <li>Single Point of failure.</li>
                            <li>Dependency on single source of truth.</li>
                            <li>Control of an activity or organization under a single authority.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="section-solution-text">
                        <h3>Solution</h3>
                        <h4>ACW Network</h4>
                        <ul class="solution-text">
                            <li>Participants collectively control the final decision.</li>
                            <li>Blockchain based programmable decision using smart contract.</li>
                            <li>Replicated shared ledger prevents discrepancy & ensures immutability.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-solution-img text-center">
                        <img src="/public/frontend/assets/images/solution.png" alt="">
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <!-- End Section -->




    <!-- Start keyfeatre Section -->
    <section>
        <div class="keyfearue-section" id="features">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2 class="title-coloor-blue">Key Features</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">

                    <div class="feature-left">
                        <div class="feature-text-left text-right">
                            <span>ICO Listing</span> 
                            <p>Lorem ipsum dolor sit amet ipsum dolor, consectetur adipisicing elit. Quibusdam inventore unde dolore</p>
                        </div>
                        <div class="icon-ddiv">
                            <div class="icon-c">
                                <span class="fas fa-user-secret icon-echo"></span>
                            </div>
                        </div>
                    </div>

                     

                    <div class="feature-left">
                        <div class="feature-text-left text-right">
                            <span>Expert Rating</span> 
                            <p>Lorem ipsum dolor sit amet ipsum dolor, consectetur adipisicing elit. Quibusdam inventore unde dolore</p>
                        </div>
                        <div class="icon-ddiv">
                            <div class="icon-c">
                                <span class="fas fa-trophy"></span>
                            </div>
                        </div>
                    </div>

                    <div class="feature-left">
                        <div class="feature-text-left text-right">
                            <span>Discussion Forum</span> 
                            <p>Lorem ipsum dolor sit amet ipsum dolor, consectetur adipisicing elit. Quibusdam inventore unde dolore</p>
                        </div>
                        <div class="icon-ddiv">
                            <div class="icon-c">
                                <span class="far fa-comments"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="feature-middle-img text-center">
                        <img src="/public/frontend/assets/images/mobile1.png" alt="">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-right">
                        <div class="icon-ddiv">
                            <div class="icon-c">
                                <span class="fas fa-funnel-dollar"></span>
                            </div>
                        </div>
                        <div class="feature-text-right">
                            <span>Crypto Exchange</span> 
                            <p>Lorem ipsum dolor sit amet ipsum dolor, consectetur adipisicing elit. Quibusdam inventore unde dolore</p>
                        </div>
                    </div>

                    <div class="feature-right">

                        <div class="icon-ddiv">
                            <div class="icon-c">
                                <span class="fas fa-sun"></span>
                            </div>
                        </div>
                        <div class="feature-text-right">
                            <span>Fundraising Platform</span> 
                            <p>Lorem ipsum dolor sit amet ipsum dolor, consectetur adipisicing elit. Quibusdam inventore unde dolore</p>
                        </div>
                    </div>

                    <div class="feature-right">
                        <div class="icon-ddiv">
                            <div class="icon-c">
                                <span class="fas fa-sliders-h"></span>
                            </div>
                        </div>
                        <div class="feature-text-right">
                            <span>Airdrop Campeign</span> 
                            <p>Lorem ipsum dolor sit amet ipsum dolor, consectetur adipisicing elit. Quibusdam inventore unde dolore</p>
                        </div>
                    </div>

                </div>

                
            </div>

            <!-- <div class="row text-center section-padding">
                <div class="col-lg-3">

                    <div class="high-echo echo-m-top">
                        <div class="echo-text-left">
                            <span class="fas fa-user-secret icon-echo"></span>
                            <span>ICO Listing</span> 
                            <p>Make individual payments through fully secured and traceable Token Contracts by sale-purchase of ACW Tokens</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="high-echo">
                        <div class="echo-text-left">
                            <span class="fas fa-funnel-dollar icon-echo"></span>
                            <span>Fund Raising</span> 
                            <p>Raise funds through individual donations of ACW Tokens by a multitude of small contributors, validated by smart contract transparency.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="high-echo echo-m-top">
                        <div class="echo-text-left">
                            <span class="fas fa-address-card icon-echo"></span>
                            <span>Community & Airdrop</span> 
                            <p>Make individual payments through fully secured and traceable Token Contracts by sale-purchase of ACW Tokens</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="high-echo">
                        <div class="echo-text-left">
                            <span class="fas fa-american-sign-language-interpreting icon-echo"></span>
                            <span>Crypto Exchange</span> 
                            <p>Raise funds through individual donations of ACW Tokens by a multitude of small contributors, validated by smart contract transparency.</p>
                        </div>
                    </div>

                </div>
            </div> -->
        </div>
        </div>
    </section>

    <!-- end keyfeatre Section -->


    <!-- Start Section -->
	<div class="section section-pad token-sale-section" id="tokenSale">
	   

       <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title-info text-center">
                        <h2>Token Information</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, similique..</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-colooor token-cc">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="token-img-left text-center">
                                    <img src="/public/frontend/assets/images/currency-img.png" alt="">
                                    <a href="#">Buy Token  --></a>
                                    <div class="payment-iconss">
                                        <!-- <span class="fab fa-btc picon"></span>
                                        <span class="fab fa-ethereum picon"></span>
                                        <span class="fas fa-bolt picon"></span> -->
                                        <p>We accept : BTC, ETH, LTC.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="token-innfo">
                                            <h6>Tokens Offered</h6>
                                            <p>January 15 - <span>January 29</span></p>
                                            <p><span>40%</span>  Bonus</p>
                                        </div>

                                        <div class="token-innfo">
                                            <h6>Soft Cap</h6>
                                            <p>January 30 - <span>February 13</span></p>
                                            <p><span>30%</span>  Bonus</p>
                                        </div>


                                        <div class="token-innfo">
                                            <h6>Hard Cap</h6>
                                            <p>February 14 - <span>February 27</span></p>
                                            <p><span>20%</span>  Bonus</p>
                                        </div>


                                        <div class="token-innfo">
                                            <h6>Distrbution of Tokens</h6>
                                            <p>February 27 - <span>March 13</span></p>
                                            <p><span>No</span>   Bonus</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="token-distri">
                                            <h6>Pre Sale</h6>
                                            <p><span>100 Million</span> ACW</p>
                                        </div>
                                        <div class="token-distri">
                                            <h6>ICO Phase I</h6>
                                            <p><span>2 Million</span> USD</p>
                                        </div>
                                        <div class="token-distri">
                                            <h6>ICO Phase II</h6>
                                            <p><span>20 Million</span> USD</p>
                                        </div>
                                        <div class="token-distri">
                                            <h6>ICO Phase III</h6>
                                            <p><span>2 days after</span> token sale ends</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="gaps size-2x d-none d-md-block"></div>
        <div class="gaps size-2x"></div> -->
        

    </div>
	<!-- End Section -->


    <!-- Start Section -->
	<div class="section section-pad token-alocate-section section-bg" id="tokenAlocate">
        <div class="ui-shape ui-shape-s3"></div>
	    <div class="container">
            <div class="row justify-content-center text-center">
				<div class="col-md-6">
					<div class="section-head-s7">
						<h2 class="section-title-s7 animated" data-animate="fadeInUp" data-delay=".1">{{ __t('Token & Fund Information') }}</h2>
					</div>
				</div>
			</div>

			<div class="row justify-content-center text-center">
				<div class="col-lg-6">
					<div class="t-left-token">
						<h5>Token Distribute</h5>
						<img src="https://ACW.net/public/frontend/assets/images/1.png" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="t-left-token">
						<h5>Fund Allocation</h5>
						<img src="https://ACW.net/public/frontend/assets/images/2.png" alt="">
					</div>
				</div>
			</div>
            <!-- <div class="tab-s4">
                <ul class="nav nav-tabs text-center animated" data-animate="fadeInUp" data-delay=".2">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-dist">{{ __t('Distribution') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-fund">{{ __t('Funding Allocation') }}</a>
                    </li>
                </ul>
                <div class="gaps size-2x"></div>
                <div class="gaps size-3x d-none d-xl-block"></div>



                <div class="tab-content animated" data-animate="fadeInUp" data-delay=".3">
                    <div class="tab-pane animate active show" id="tab-dist">
                        <div class="tkn-crt">
                            <div class="tkn-crt-img">
                                <img src="{{ url('/public/frontend/images/zinnia/chart-zinnia-a.png') }}" alt="chart">
                            </div>
                            <ul class="tkn-crt-lst">
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt one"><span>40%</span></span><span class="tkn-crt-ttl">{{ __t('Sale') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt two"><span>30%</span></span><span class="tkn-crt-ttl">{{ __t('Ecosystem management, R&D') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt three"><span>10%</span></span><span class="tkn-crt-ttl">{{ __t('Reserve') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt four"><span>16%</span></span><span class="tkn-crt-ttl">{{ __t('Team & Advisor') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt five"><span>4%</span></span><span class="tkn-crt-ttl">{{ __t('Marketing & Promotion') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>



                    <div class="tab-pane animate" id="tab-fund">
                        <div class="tkn-crt">
                            <div class="tkn-crt-img">
                                <img src="{{ url('/public/frontend/images/zinnia/chart-zinnia-b.png') }}" alt="chart">
                            </div>
                           <ul class="tkn-crt-lst">
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt one"><span>40%</span></span><span class="tkn-crt-ttl">{{ __t('Token Sale Program') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt two"><span>8%</span></span><span class="tkn-crt-ttl">{{ __t('Reserve Fund') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt three"><span>15%</span></span><span class="tkn-crt-ttl">{{ __t('Team and Founders') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt four"><span>4%</span></span><span class="tkn-crt-ttl">{{ __t('Board Advisors') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt five"><span>27%</span></span><span class="tkn-crt-ttl">{{ __t('Ecosystem Development') }}</span>
                                </li>
                                <li class="tkn-crt-itm">
                                    <span class="tkn-crt-prcnt five"><span>6%</span></span><span class="tkn-crt-ttl">{{ __t('Marketing and Bounty') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
        </div><!-- .container -->
    </div>
	<!-- End Section -->


	<!-- Start Section -->
	
	<!-- End Section -->


	


	<!-- Timeline -->
      <div class="section-padding section-bg-color" id="timeline">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-8">
                    <div class="section-title squire-shape section-p text-center ">
                        <h2 class="animated fadeInUp title-coloor-white" data-animate="fadeInUp" data-delay=".1" style="visibility: visible; animation-delay: 0.1s;">Roadmap</h2>
                        <p class="lead animated title-coloor-white" data-animate="fadeInUp" data-delay=".2">When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution</p>
                    </div>
                </div>
            </div><!-- .row -->

            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="road-img">
                        <img src="/public/frontend/assets/images/roadmap2.png" alt="">
                    </div>
                </div>
            </div> -->


            <div class="row">
                <div class="col-lg-6">
                    <div class="left-roadmap text-right">
                        <div class="left-conetent-roadmap">
                            <span>2018 Q3</span>
                            <h6>Concept Generation</h6>
                            <p>initial Thought Process, Business Plan, Strategic Plan & Minimum Business Team Assembling</p>
                        </div>


                        <div class="left-conetent-roadmap">
                            <span>2019 Q1</span>
                            <h6>Initial Coin Offering (ICO)</h6>
                            <p>ACW Partner system in operation, Decentralized wallet with upcoming ICO listing in ACW platform with growing partnerships with other Blockchain startups</p>
                        </div>


                        <div class="left-conetent-roadmap">
                            <span>2019 Q3</span>
                            <h6>Airdrop, Bounty and marketing promotional procedures via ACW eco system launch</h6>
                            <p>Community driven decentralized decision, ACW powered marketing strategy for upcoming ICO</p>
                        </div>


                        <div class="left-conetent-roadmap">
                            <span>2020 Q1</span>
                            <h6>ACW Decentralized exchange in production</h6>
                            <p>Product Enhancement and UAT Testing with continued partnerships & product Marketing</p>
                        </div>


                        
                        <div class="left-conetent-roadmap">
                            <span>2020 Q3</span>
                            <h6>ACW R & D center opening</h6>
                            <p>ACW offline and online community center with R & D center across the globe.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="right-roadmap">
                        <div class="right-conetent-roadmap">
                            <span>2018 Q4</span>
                            <h6>Strategic Plan</h6>
                            <p>Research & Analyses, Tech Team Assemble, Whitepaper Drafting with ACW Token creation</p>
                        </div>

                        <div class="right-conetent-roadmap">
                            <span>2019 Q2</span>
                            <h6>ACW Crowdfunding Platform launch</h6>
                            <p>Ability for upcoming ICO concept to launch crowdfunding via ACW eco system, product Enhancement and UAT Testing, Continued Partnerships, Continued Business TeamAssembling & Product Marketing.</p>
                        </div>


                        <div class="right-conetent-roadmap">
                            <span>2019 Q4</span>
                            <h6>ACW Decentralized exchange beta launch</h6>
                            <p>Multi cryptocurrency exchange trading system with continued Partnerships & product Marketing</p>
                        </div>


                        <div class="right-conetent-roadmap">
                            <span>2020 Q2</span>
                            <h6>ACW consortium system launch</h6>
                            <p>ACW powered consortium system to provide success strategy via aggregation of multiple ICO platforms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- Timeline End -->

      <!-- Start ecosystem team Section -->

    <!-- end ecosystem Section -->

    <!-- Start solution Section -->
    
    <!-- End Section -->

    


    <!-- Start team Section -->
	<div class="section section-pad section-bg" id="team">
	    <div class="ui-shape ui-shape-s5"></div>
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-xl-6 col-lg-8">
					<div class="section-head-s7">
						<h2 class="section-title-s7 animated" data-animate="fadeInUp" data-delay=".1">{{ __t('Team Members') }}</h2>
						<p class="animated" data-animate="fadeInUp" data-delay=".2">{{ __t('ACW Team combines a passion for blockchain, industry experts & proven record in development, marketing & research') }}</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php 
				if(isset($team) >0 && count($team) > 0){ 
					foreach($team as $tm){
				?>
                <div class="col-lg-6 col-sm-12 animated" data-animate="fadeInUp" data-delay=".2">
                    <div class="whole-sectionnn" >
                        <div class="team-memberr">
                            <div class="tt-img">
                                <img src="<?php echo $tim_thimb_url.'?src='.get_recource_url($tm->image_id).'&w=160&h=160&zc=1&q=100' ?>" alt="" />
                            </div>
                            <div class="r-text">
                                <h3><?php echo $tm->full_name; ?></h3>
                                <span><?php echo $tm->designation; ?></span>
								
                                <ul>
								<?php if(!empty($tm->link)){ ?>
								<li><a href="<?php echo $tm->link; ?>" target="_blank"><em class="fab fa-linkedin-in"></em></a></li>
								<?php } ?>
                                </ul> 
                            </div> 
                        </div>
                        <div class="pro-text">
                            <?php echo $tm->description; ?>
                        </div>
                    </div>
                </div> <!-- .col-lg-6 --> 
					<?php } 
				}?>
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="gaps size-2x"></div>
					<h3 class="sub-heading ucap animated" data-animate="fadeInUp" data-delay=".7">{{ __t('Advisors') }}</h3>
					<div class="gaps size-2x"></div>
				</div>
			</div>
			<div class="row">
				 <?php 
				if(isset($advisor) >0 && count($advisor) > 0){ 
					foreach($advisor as $adv){
				?>
                <div class="col-lg-6 col-sm-12 animated" data-animate="fadeInUp" data-delay=".2">
                    <div class="whole-sectionnn ">
                        <div class="team-memberr">
                            <div class="tt-img">
                                <img src="<?php echo $tim_thimb_url.'?src='.get_recource_url($adv->image_id).'&w=160&h=160&zc=1&q=100' ?>" alt="" />
                            </div>
                            <div class="r-text">
                                <h3><?php echo $adv->full_name; ?></h3>
                                <span><?php echo $adv->designation; ?></span>
                                <ul>
                                <?php if(!empty($adv->link)){ ?>
								<li><a href="<?php echo $adv->link; ?>" target="_blank"><em class="fab fa-linkedin-in"></em></a></li>
								<?php } ?>
                                </ul> 
                            </div> 
                        </div>
                        <div class="pro-text">
                            <?php echo $adv->description; ?>
                        </div>
                    </div>
                </div> <!-- .col-lg-6 -->  
				<?php 
					}
				}
				?>
                
			</div>
        </div>
    </div>
	<!-- Start our partener Section -->
	<div class="section section-pad section-bg-ras" id="partners">
		  
        <div class="partn">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-8">
                        <div class="section-title-partner squire-shape section-p text-center ">
                            <h2 class="animated fadeInUp" data-animate="fadeInUp" data-delay=".1" style="visibility: visible; animation-delay: 0.1s;">Our Partner</h2>
                            <p class="lead animated" data-animate="fadeInUp" data-delay=".2">When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                        </div>
                    </div>
                </div><!-- .row -->

                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <a href="" target="_blank">
                            <div class="card card1 text-center">
                                <div class="card-body">
                                    <img src="/public/frontend/assets/images/partner1.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="" target="_blank">
                            <div class="card card1 text-center">
                                <div class="card-body">
                                    <img src="/public/frontend/assets/images/partner2.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="" target="_blank">
                            <div class="card card1 text-center">
                                <div class="card-body">
                                    <img src="/public/frontend/assets/images/partner3.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="" target="_blank">
                            <div class="card card1 text-center">
                                <div class="card-body">
                                    <img src="/public/frontend/assets/images/partner4.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<!-- End partner Section -->


	<!-- Start faq Section -->
	<div class="section section-pad-md section-bg" id="faq">
	    <div class="ui-shape ui-shape-s6"></div>
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-md-7">
					<div class="section-head-s7">
						<h2 class="section-title-s7 animated" data-animate="fadeInUp" data-delay=".1">{{ __t('Frequently asked questions') }}</h2>
						<p class="animated" data-animate="fadeInUp" data-delay=".2">{{ __t('Below we’ve provided common questionnaires regarding ACW eco system, If you have any other questions, please get in touch using the contact form below.') }}</p>
					</div>
				</div>
			</div>
			<div class="row align-items-center justify-content-center">
				<div class="col-md-10">
					<div class="tab-custom-s3">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs text-center justify-content-center animated" data-animate="fadeInUp" data-delay=".1">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tab-1">{{ __t('General') }}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tab-2">{{ __t('ICO') }}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tab-3">{{ __t('Tokens') }}</a>
							</li>
						</ul>
						<div class="gaps size-1x"></div>
						<!-- Tab panes -->
						<div class="tab-content animated" data-animate="fadeInUp" data-delay=".2">
							<div class="tab-pane fade show active" id="tab-1">
								<div class="accordion-s2" id="accordion-1">
									<div class="card active">
										<div class="card-header">
											<h5>
												<a data-toggle="collapse" data-target="#collapse-1-1">
													{{ __t('What is ACW Network?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-1-1" class="collapse show" data-parent="#accordion-1">
											<div class="card-body">
												<p>{{ __t('A Decentralized ACW network to enable users to seek help during their tough situation like joblessness. Valid proof and honest appeal will be determined by distributed consensus among other peers of the network. "Help others to get help" is the main motto which is powered by ACW Blockchain Technology. To know more details kindly have a look on our Whitepaper.') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-1-2">
													{{ __t('What is the aim of ACW Network?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-1-2" class="collapse" data-parent="#accordion-1">
											<div class="card-body">
												<p>{{ __t('Distress and tough situation is part of life when people looses his/her basic aminities. Being a part of ACW network will help to get rid of such kind of emergency situation') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-1-3">
													{{ __t('How do I benefit from ACW Network?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-1-3" class="collapse" data-parent="#accordion-1">
											<div class="card-body">
												<p>{{ __t('Buying our token means you are joining to secure future in tough situations of your life. We will continously be working on new ideas and new technologies to better our partnership with you. There is no limit to where we can take ACW with the work we are willing to put in. Being involved in the early stages of this platform puts you in the best position for when we are fully operational.') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-1-4">
													{{ __t('How can we track progress of ACW Development?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-1-4" class="collapse" data-parent="#accordion-1">
											<div class="card-body">
												<p>{{ __t('Follow us on any of the links provided on this page to see what we are up to, and how things are going. We will provide weekly updates on all available forms of social media.') }}</p>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End tab-pane -->
							<div class="tab-pane fade" id="tab-2">
								<div class="accordion-s2" id="accordion-2">
									<div class="card active">
										<div class="card-header">
											<h5>
												<a data-toggle="collapse" data-target="#collapse-2-1">
												  {{ __t('How can I participate in Token Sale?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-2-1" class="collapse show" data-parent="#accordion-2">
											<div class="card-body">
												<p>{{ __t('You can join the Crowdsale by creating a new account on our website and participate by investing in one of our company ACW Network address via one of our accepted ACW Global Networkcurrencies.') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-2-2">
													{{ __t('What ACW Networkcurrencies can we use to purchase?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-2-2" class="collapse" data-parent="#accordion-2">
											<div class="card-body">
												<p>{{ __t('You can use BTC, ETH or LTC ACW Networkcurrency.') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-2-4">
												   {{ __t('How many tokens are available for ICO?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-2-4" class="collapse" data-parent="#accordion-2">
											<div class="card-body">
												<p>{{ __t('40% of total supply is allocated for ICO sell. Total supply of tokens = 100 million. ICO sell allocation = 40 million.') }}</p>
											</div>
										</div>
									</div>
									
								</div>
							</div><!-- End tab-pane -->
							<div class="tab-pane fade" id="tab-3">
								<div class="accordion-s2" id="accordion-3">
									<div class="card active">
										<div class="card-header">
											<h5>
												<a data-toggle="collapse" data-target="#collapse-3-1">
													{{ __t('What is ICO Token?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-3-1" class="collapse show" data-parent="#accordion-3">
											<div class="card-body">
												<p>{{ __t('An Initial Coin Offering, also commonly referred to as an ICO, is a fund raising mechanism in which new projects sell their underlying ACW Global Network tokens in exchange for other popular ACW kcurrencies.') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-3-2">
													{{ __t('Are there any restrictions?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-3-2" class="collapse" data-parent="#accordion-3">
											<div class="card-body">
												<p>{{ __t('Sales are not allowed to places where there are regulations in place to prevent participation.') }}</p>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>
												<a class="collapsed" data-toggle="collapse" data-target="#collapse-3-3">
													{{ __t('What will happens once the hard cap is reached?') }}<span class="plus-minus"><span class="ti ti-angle-up"></span></span>
												</a>
											</h5>
										</div>
										<div id="collapse-3-3" class="collapse" data-parent="#accordion-3">
											<div class="card-body">
												<p>{{ __t('ICO will close once we successfully achieve our target hard cap. Please follow our Token and Fund distribution section to have an idea of ACW financial model.') }}</p>
											</div>
										</div>
									</div>
								</div>
							</div><!-- .tab-pane -->
						</div><!-- .tab-content -->
					</div><!-- .tab-custom -->
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
	<!-- End Section -->


	<!-- Start contact us Section -->
    <div class="section section-pad-md extraaa-colr gray-bg-colr" id="contact">
        <div class="ui-shape ui-shape-s7"></div>
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <div class="section-head-s7 title-clr">
                        <h2 class="section-title-s7 animated" data-animate="fadeInUp" data-delay=".1">{{ __t('Contact Us') }}</h2>
                        <p class="animated" data-animate="fadeInUp" data-delay=".2">{{ __t('Any question? Reach out to us and we’ll get back to you shortly.') }}</p>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="contact-info contact-info justify-content-center text-center">
                        <li class="animated" data-animate="fadeInUp" data-delay=".3"><em class="fa fa-phone"></em><span>+44 0123 4567</span></li>
                        <li class="animated" data-animate="fadeInUp" data-delay=".4"><em class="fa fa-envelope"></em><span><a href="mailto:info@ACW.net" target="_blank">info@ACW.net</a></span></li>
                        <li class="animated" data-animate="fadeInUp" data-delay=".5"><em class="fa fa-paper-plane"></em><span><a href="https://t.me/ACW888" target="_blank">{{ __t('Join us on Telegram') }}</a></span></li>
                    </ul>
                </div><!-- .col -->
            </div><!-- .row -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form id="contact-form" class="form-message text-center show-error-hint" action="{{ route('save-contact-us') }}" method="post">
                        <div class="form-results"></div>

                        <!--div class="input-field animated" data-animate="fadeInUp" data-delay=".6">
                            <select name="contact-type" id="contact-type" class="input-line required contact-type">
                                <option value="">{{ __t('Choose Contact Type') }}</option>
                                <option value="1">Technical</option>
                                <option value="2">General</option>
                                <option value="3">Partnership or Promotion</option>
                            </select>

                        </div-->
                            <!--label class="input-title">Contact Regarding</label-->
                        <div class="input-field animated" data-animate="fadeInUp" data-delay=".6">
                            <input name="contact-name" type="text" class="input-line required">
                            <label class="input-title">{{ __t('Your Name') }}</label>
                        </div>
                        <div class="input-field animated" data-animate="fadeInUp" data-delay=".7">
                            <input name="contact-email" type="email" class="input-line required email">
                            <label class="input-title">{{ __t('Your Email') }}</label>
                        </div>
                        <div class="input-field animated" data-animate="fadeInUp" data-delay=".8">
                            <textarea name="contact-message" class="txtarea input-line required"></textarea>
                            <label class="input-title">{{ __t('Your Message') }}</label>
                        </div>
                        <input type="text" class="d-none" name="form-anti-honeypot" value="">
                        <div class="input-field animated" data-animate="fadeInUp" data-delay=".9">
                            <button type="submit" class="btn" id="send" value="submit">{{ __t('Submit') }}</button>
                        </div>
                    </form>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- End Section -->


	<?php 
	/*
	<!-- Start Section -->
	<div class="section footer-section section-pad-md no-pb">
        <div class="ui-shape ui-shape-light ui-shape-footer"></div>
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-3 col-sm">
	                <div class="widget-item">
	                    <h5 class="widget-title">{{ __t('Pages') }}</h5>
	                    <ul class="widget-links">
							<li><a href="#about">{{ __t('About') }}<span class="sr-only">(current)</span></a></li>
							<li><a href="#vision">{{ __t('vision') }}</a></li>
							<li><a href="#benifits">{{ __t('Benefits') }}</a></li>
							<li><a href="#services">{{ __t('Solution') }}</a></li>
	                    </ul>
	                </div>
	            </div><!-- .col -->
	            <div class="col-lg-3 col-sm">
	                <div class="widget-item">
	                    <h5 class="widget-title" style="opacity: 0;">vv</h5>
	                    <ul class="widget-links">
							<li><a href="#tokenSale">{{ __t('Token Sale') }}</a></li>
							<li><a href="#partners">{{ __t('Partners') }}</a></li>
							<li><a href="#team">{{ __t('Team') }}</a></li>
							<li><a href="#contact">{{ __t('Contact') }}</a></li>
	                    </ul>
	                </div>
	            </div><!-- .col -->
	            <div class="col-lg-3 col-sm">
	                <div class="widget-item">
	                    <h5 class="widget-title" style="opacity: 0;">{{ __t('Company') }}</h5>
	                    <ul class="widget-links">
							<li><a href="#services">{{ __t('Privacy Policy') }}</a></li>
							<li><a href="#services">{{ __t('Terms of use') }}</a></li>
							<li><a href="#timeline">{{ __t('Roadmap') }}</a></li>
							<li><a href="#faq">{{ __t('Faqs') }}</a></li>	 
	                    </ul>
	                </div>
	            </div><!-- .col -->
	            <div class="col-lg-3">
	                <div class="widget-item">
	                    <h5 class="widget-title widget-title-ncap">{{ __t('Subscribe') }}</h5>
	                    <div class="widget-subsctibe">
	                        <p>{{ __t('Subscribe to stay updated with latest ACW Network news') }}</p>
	                        <form id="subscribe-form" action="{{ route('save-subscriber') }}" method="post" class="subscription-form subscription-form-sm">
                                <input type="text" name="youremail" class="input-round required email" placeholder="{{ __t('Enter mail') }}" >
                                <input type="text" class="d-none" name="form-anti-honeypot" value="">
                                <button type="submit" class="btn btn-plane"><i class="fas fa-paper-plane"></i></button>
                                <div class="subscribe-results"></div>
                            </form>
	                    </div>
	                </div>
	            </div><!-- .col -->
	        </div><!-- .row -->
	        <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 res-m-bttm">
                        <a class="footer-brand" href="index.html">
                            <img class="logo logo-light" alt="logo" src="{{ url('/public/frontend/images/logo-white.png') }}" srcset="{{ url('/public/frontend/images/logo-full-white2x.png') }} 2x">
                        </a>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <span class="copyright-text"><?php echo __t(get_settings('copyright_text')); ?></span>
                    </div>
                </div>
	        </div>
	    </div><!-- .container -->
	</div>
	*/ ?>
	<!-- End Section -->

    <!-- Footer -->
    <footer>
        <div class="section-padding footer-area">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-texts text-center">
                        <h5>Subscribe to our Newsletter</h5>
                        <form id="subscribe-form" class="ico-subscription" action="{{ route('save-subscriber') }}" method="post">
                            <div class="form-group">
                              <!--input type="email" placeholder="Your email address" class="form-control"-->
							  <input type="text" name="youremail" class="form-control input-round required email" placeholder="{{ __t('Your email address') }}" >
                            </div>
                            <!--a href="#" class="butam-white"></a-->
							<button type="submit" class="btn btn-plane butam-white">subscribe</button>
							<div class="subscribe-results"></div>
                      </form>
                    </div>
                    <div class="social-community text-center">
                        <h5>Join us in the Community</h5>
                        <a href="<?php echo get_settings('telegram_link'); ?>" target="_blank"><i class="fab fa-telegram"></i></a>
                    </div>
                    <div class="footer-social-icons text-center">
                        <ul>
                            <li><a href="<?php echo get_settings('fb_link'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo get_settings('twitter_link'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="<?php echo get_settings('youtube_link'); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="<?php echo get_settings('reddit_link'); ?>" target="_blank"><i  class="fab fa-reddit-alien"></i></a></li>
                            <li><a href="<?php echo get_settings('github_link'); ?>" target="_blank"><i class="fab fa-github"></i></a></li>
                            <li><a href="<?php echo get_settings('medium_link'); ?>" target="_blank"><i class="fab fa-medium-m"></i></a></li>
                            <li><a href="<?php echo get_settings('instagram_link'); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="<?php echo get_settings('linkedin_link'); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="<?php echo get_settings('bitcointalk_link'); ?>" target="_blank"><i class="fab fa-bitcoin"></i></a></li>
                        </ul>
                    </div>
			
                </div>
            </div>
        </div>
        
        </div>

        <div class="bottom-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                    <div class="footer-logo">
                        <img src="https://ACW.net/public/frontend/images/logo-white.png" alt="">
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-t text-center">
                            @ACW, 2021
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-menuss text-center">
                            <a href="" target="_blank">Terms of use</a> |
                            <a href="" target="_blank">Private policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->


	<!-- Preloader !remove please if you do not want -->
	<div id="preloader">
		<div id="loader"></div>
		<div class="loader-section loader-top"></div>
   		<div class="loader-section loader-bottom"></div>
	</div>
	<!-- Preloader End -->

	<!-- JavaScript (include all script here) -->
	<script src="{{ url('/public/frontend/assets/js/jquery.bundle.js?ver=142') }}"></script>
    <script src="{{ url('/public/frontend/assets/js/perfect-scrollbar.min.js?ver=142') }}"></script>
    <script src="{{ url('/public/frontend/assets/js/vendor/all.min.js?ver=142') }}"></script>
	<script src="{{ url('/public/frontend/assets/js/script.js?ver=142') }}"></script>
	
	<script>
	<?php if($current_lang=='ko_KR'){ ?>
	$.extend( $.validator.messages, {
	required: "필수 항목입니다.",
	remote: "항목을 수정하세요.",
	email: "유효하지 않은 E-Mail주소입니다.",
	url: "유효하지 않은 URL입니다.",
	date: "올바른 날짜를 입력하세요.",
	dateISO: "올바른 날짜(ISO)를 입력하세요.",
	number: "유효한 숫자가 아닙니다.",
	digits: "숫자만 입력 가능합니다.",
	creditcard: "신용카드 번호가 바르지 않습니다.",
	equalTo: "같은 값을 다시 입력하세요.",
	extension: "올바른 확장자가 아닙니다.",
	maxlength: $.validator.format( "{0}자를 넘을 수 없습니다. " ),
	minlength: $.validator.format( "{0}자 이상 입력하세요." ),
	rangelength: $.validator.format( "문자 길이가 {0} 에서 {1} 사이의 값을 입력하세요." ),
	range: $.validator.format( "{0} 에서 {1} 사이의 값을 입력하세요." ),
	max: $.validator.format( "{0} 이하의 값을 입력하세요." ),
	min: $.validator.format( "{0} 이상의 값을 입력하세요." )
	} );
	<?php } ?>
	(function($){
	var $count_token = $('.token-countdown');
	if ($count_token.length > 0 ) {
		$count_token.each(function() {
			var $self = $(this), datetime = $self.attr("data-date");
			$self.countdown(datetime).on('update.countdown', function(event) {
				$(this).html(event.strftime('' + '<div class="col"><span class="countdown-time countdown-time-first">%D</span><span class="countdown-text"><?php echo __t('Days'); ?><span>ays</span></span></div>' + '<div class="col"><span class="countdown-time">%H</span><span class="countdown-text"><?php echo __t('Hours'); ?><span>ours</span></span></div>' + '<div class="col"><span class="countdown-time">%M</span><span class="countdown-text"><?php echo __t('Minutes'); ?><span>inutes<span></span></div>' + '<div class="col"><span class="countdown-time countdown-time-last">%S</span><span class="countdown-text"><?php echo __t('Seconds'); ?><span>econds</span></span></div>'));
			});
		});
	}
    
	var $count_s2 = $('.countdown-s2');
	if ($count_s2.length > 0 ) {
		$count_s2.each(function() {
			var $self = $(this), datetime = $self.attr("data-date");
			$self.countdown(datetime).on('update.countdown', function(event) {
				$(this).html(event.strftime('' + '<div class="countdown-s2-item"><span class="countdown-s2-time countdown-time-first">%D</span><span class="countdown-s2-text">Days</span></div>' + '<div class="countdown-s2-item"><span class="countdown-s2-time">%H</span><span class="countdown-s2-text">Hours</span></div>' + '<div class="countdown-s2-item"><span class="countdown-s2-time">%M</span><span class="countdown-s2-text">Min</span></div>' + '<div class="countdown-s2-item"><span class="countdown-s2-time countdown-time-last">%S</span><span class="countdown-s2-text">Sec</span></div>'));
			});
		});
	}
	
	// Ajax Form Submission
	var contactForm = $('#contact-form'), subscribeForm = $('#subscribe-form');
	if (contactForm.length > 0 || subscribeForm.length > 0) {
		if( !$().validate || !$().ajaxSubmit ) {
			console.log('contactForm: jQuery Form or Form Validate not Defined.');
			return true;
		}
		// ContactForm
		if (contactForm.length > 0) {
			/*var selectRec = contactForm.find('select.required'), */
			qf_results = contactForm.find('.form-results');
			contactForm.validate({
			invalidHandler: function () { qf_results.slideUp(400); },
			submitHandler: function(form) {
				qf_results.slideUp(400);
				$("#send").attr('disabled','disabled');
				$("#send").text("<?php echo __t('Sending..'); ?>");
				$(form).ajaxSubmit({
					target: qf_results, dataType: 'json',
					success: function(data) {
						var type = (data.result==='error') ? 'alert-danger' : 'alert-success';
						qf_results.removeClass( 'alert-danger alert-success' ).addClass( 'alert ' + type ).html(data.message).slideDown(400);
						if (data.result !== 'error') { $(form).clearForm().find('.input-field').removeClass('input-focused'); }
						/*
						$('#contact-type').select2({
							placeholder: "<?php echo __t('Choose Contact Type'); ?>"
						});
						*/
						$("#send").removeAttr('disabled');
						$("#send").text("<?php echo __t('Submit'); ?>");
						setTimeout(function(){ qf_results.hide(); }, 2000);
					}
				});
				}
			});
			/*selectRec.on('change', function() { $(this).valid(); });*/
		}
		// SubscribeForm
		if (subscribeForm.length > 0) {
			var sf_results = subscribeForm.find('.subscribe-results');
			subscribeForm.validate({
			invalidHandler: function () { sf_results.slideUp(400); },
			submitHandler: function(form) {
				sf_results.slideUp(400);
				$(form).ajaxSubmit({
					target: sf_results, dataType: 'json',
					success: function(data) {
						var type = (data.result==='error') ? 'alert-danger' : 'alert-success';
						sf_results.removeClass( 'alert-danger alert-success' ).addClass( 'alert ' + type ).html(data.message).slideDown(400);
						if (data.result !== 'error') { $(form).clearForm(); }
						
						setTimeout(function(){ sf_results.hide(); }, 2000);
					}
				});
				}
			});
		}
	}
	
	})(jQuery);
	</script>
	

</body>
</html>

