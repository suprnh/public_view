<!DOCTYPE html>
<html lang="en">
 
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Change Title and Meta tags-->
    <title><?php echo __t(get_settings('site_title')); ?></title>
    <meta name="description" content="matrix ico landing">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Perle Template">

    <!-- Favicon -->
    <link rel="icon" href="{{url('public/home_ico/images/favicon.png')}}">

    <!--Css Libraries-->
    <link rel="stylesheet" href="{{url('public/home_ico')}}/css/plugins.css">

    <!-- Our Min CSS -->
    <link rel="stylesheet" href="{{url('public/home_ico')}}/css/styles-2-dark.css">
    <link rel="stylesheet" href="{{url('public/home_ico')}}/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" type="text/javascript"></script>
    <![endif]-->

</head>
<body class="dark-style">

<div class="page container">

    <!--div to scroll to top-->
    <div class="top-div" data-scroll-index="0"></div>

    <!-- Start Nav Section-->
    <div class="nav-container">
        <nav class="navbar navbar-expand-lg main-navbar navbar-light">
            <div class="container-fluid ">
                <!--Nav Logo on small screens Only-->
                <a class="navbar-brand" data-scroll-nav="1" href="{{url('/')}}">
                    <img class="img-fluid" src="{{url('public/home_ico')}}/images/logo.png" alt="Logo">
                </a>
                <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-label="navbarSupportedContent">
                    <a class="very_small_hamburger" id="hamburger-menu">
                        <svg viewBox="0 0 800 600">
                            <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                            <path d="M300,320 L540,320" class="middle"></path>
                            <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                        </svg>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto flex-end-content menu-nav">
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link active" data-scroll-nav="1" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link" data-scroll-nav="2" href="#about">About us</a>
                        </li>
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link" data-scroll-nav="3" href="#token">Tokenomics</a>
                        </li>
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link" data-scroll-nav="4" href="#roadmap">Roadmap</a>
                        </li>
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link" data-scroll-nav="5" href="#team">Team</a>
                        </li>
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link" data-scroll-nav="6" href="#faqs">FAQs</a>
                        </li>
                        <li class="nav-item nav-link-scroll waves-effect">
                            <a class="nav-link" data-scroll-nav="7" href="#contact">Contact</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Blog
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item nav-link-scroll waves-effect waves-light" data-scroll-nav="9" href="#">News Section</a>
                                <a class="dropdown-item waves-effect" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item waves-effect" href="#">Something else here</a>
                            </div>
                        </li> -->
                    </ul>
                    
                    <div class="nav-buttons d-flex align-items-center menu_btn_social">
                        <div class="nav-social  ml-auto mr-3">
                        <a href="https://twitter.com/MatrixMix" target="_blank" data-aos="fade-up" data-aos-delay="120"><i class="fab fa-twitter"></i></a>
                            <a href="https://t.me/Matrix_0fficial" target="_blank" data-aos="fade-up" data-aos-delay="100"><i class="fab fa-telegram"></i></a>
                            <a href="https://medium.com/@Matrix_0fficial" target="_blank" data-aos="fade-up" data-aos-delay="160"><i class="fab fa-medium"></i></a>
                            <a href="https://www.instagram.com/matrix_0fficial/" target="_blank" data-aos="fade-up" data-aos-delay="140"><i class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank" data-aos="fade-up" data-aos-delay="180"><i class="fab fa-github"></i></a>
                    </div>
                        <a href="{{url('/signup')}}"  class="btn ssup hoverable main-gradient-bg waves-effect waves-button nav-subscribe-btn">
                            Signup
                        </a>
                        <div class="btn hoverable main-dark-background waves-effect waves-button nav-subscribe-btn">
                            <a href="{{url('/login')}}">Sign In</a>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </div>
    <!-- End Nav Section-->

    <!-- Start Header Section-->
    <header class="main-header main-section" data-scroll-index="1">
        <div class="header-content">
            <div class=" header-sub-bg" >
                <div class="overlay"></div>
                <div class="container">
                <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-5">
                    <div class="header-title">
                        <h1 class="textillate text-white" data-loop="true">
                        <span class="textillate-text">
                            <span data-in-effect="fadeIn" data-out-effect="fadeOut">Matrix Coin</span>
                            <span data-in-effect="fadeIn" data-out-effect="fadeOut">Matrix On Solana</span> 
                        </span>
                        </h1>
                        <p>A world created by various NFTs, A space to gather, sympathize and enjoy. What MATRIX do you envision? Metaverse, NFT, P2E Game and You What is Real? </p>
                    </div>
                    <div class="header-sub">
                        <div class="btn hoverable whitepaper_btn main-gradient-bg waves-effect waves-button hover-up">
                            <a href="#">Whtiepaper</a>
                        </div>
                        <div class="social-icons">
                            <a href="https://twitter.com/MatrixMix" target="_blank" data-aos="fade-up" data-aos-delay="120"><i class="fab fa-twitter"></i></a>
                            <a href="https://t.me/Matrix_0fficial" target="_blank" data-aos="fade-up" data-aos-delay="100"><i class="fab fa-telegram"></i></a>
                            <a href="https://medium.com/@Matrix_0fficial" target="_blank" data-aos="fade-up" data-aos-delay="160"><i class="fab fa-medium"></i></a>
                            <a href="https://www.instagram.com/matrix_0fficial/" target="_blank" data-aos="fade-up" data-aos-delay="140"><i class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank" data-aos="fade-up" data-aos-delay="180"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 main-header-sub text-center">
                    <div class="pre-sale-timerr ">
                                       
                        <h3><?php echo get_settings('clock_title'); ?></h3>
                        <div class="clock_area mb-4">
                            <div id="clock" data-date="<?php echo get_settings('clock_countdown_time'); ?>"> </div>
                        </div>
                        
                        <div class="rang-slider-main mt-3">
                            <div class="rang-slider-toltip">
                                <span>Soft Cap <strong><?php echo get_token_info('soft_cap'); ?></strong></span>
                                <span>Hard Cap <strong><?php echo get_token_info('hard_cap'); ?></strong></span>
                            </div>
                            <div class="rang-slider">
                                <div class="rang-line">
                                    <span style="width: <?php echo get_token_info('percentage'); ?>%!important;"></span>
                                </div>
                            </div>
                            <div class="rang-slider-total">
                               <p>Accepted Currency: <span>SOL</span></p>
                            </div>
                        </div>
                        <div class="btn_area ">
                            <a href="{{url('/login')}}" class="btn hoverable buy_btn main-gradient-bg waves-effect waves-button hover-up mt-4 ">Buy Now</a>
                        </div>
                    </div>
                </div>

                </div>
            </div>


            </div>
        </div>
    </header>
    <!-- End Header Section-->

    

    <div class="main-about main-section" data-scroll-index="2" id="about">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 left-side-content">
                    <div class="section-title about_sec">
                        <h2> Matrix Token</h2>
                        <p>Matrix's MIX token is a Solana-based SPL token. Matrix users can receive MIX tokens as a reward for playing games, staking tokens, and participating in key governance voting. In addition, users can engage in a variety of productive activities within Matrix, such as gameplay, community activities, and content and asset creation.</p>
                    </div>
                    
                    <div class="images_about">
                        <img src="{{url('public/home_ico')}}/images/matrix_500x500.gif" alt="">
                    </div> 

                </div>
                <div class="col-12 col-lg-6 right-side-content">
                    <div class="about-cards-containerr">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="single-cardd" data-aos="fade-up" data-aos-delay="100">
                                    <div class="blue-light-backgroundd" style=" background: #2196f3;"> 
                                        <h4>Metaverse </h4>
                                        <p>We are wary of the virtual space community spending too much time in virtual space. The metaverse hopes to grow into a space for more free and diverse experiences based on reality. MATRIX is focusing on the part where only virtual social space and game activities can contribute to society. A certain amount of all fees generated within the virtual space platform will be transferred to a separate environmental donation pool and donated to the real world through DAO voting. Users can be provided with experiences that contribute to the real world just by using the virtual space. We want to take advantage of the metaverse form and ultimately serve as a window to draw people's attention out of the world again. </p>
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="single-cardd" data-aos="fade-up" data-aos-delay="200">
                                    <div class="blue-light-backgroundd" style="background: #673ab7;"> 
                                        <h4>LAND</h4>
                                        <p>MATRIX develops virtual land, a space that combines virtual reality and blockchain technology based on 'Unreal Engine'. In addition to trading items and essets, users can fill their own space with games, activities, and works, and interact with other users. In addition, users are entirely up to themselves what to do with their land, and thus can generate revenue through virtual land. MATRIX has various utilization methods for users' virtual land. This includes in-land advertising and content curation. After the development of the virtual land, MATRIX will provide new usage examples and various platforms in the virtual land for users in stages.</p>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="single-cardd" data-aos="fade-up" data-aos-delay="300">
                                    <div class="blue-light-backgroundd" style=" background: #009688;"> 
                                        <h4>NFT</h4>
                                        <p>MATRIX tries to solve the problems faced by PFP (PROFILE of Picture) projects belonging to proprietary NFT among NFT fields. A chronic problem with PFP projects is the absence of a platform on which to operate. A simple NFT with few uses cannot sustain continuous growth. We want to solve this problem to extend and support their worldview into space. It is to convert NFT items that exist only as 2D photos into 3D characters so that they can engage in new activities in the metaverse. MATRIX will provide a metaverse space and game platform for PFP projects to work, and PFP projects will bring their community users to MATRIX, which will have a huge marketing effect for both sides.</p>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="single-cardd" data-aos="fade-up" data-aos-delay="400">
                                    <div class="blue-light-backgroundd" style=" background: #3f51b5;"> 
                                        <h4>P2E GAME</h4>
                                        <p>MATRIX's own game story: ELOAH (PvP Game) ELOAH speaks of one God in Hebrew, and the name of its own PFP published by The Matrix is ‘ELOHIM’, meaning “gods”. Elohims can upgrade their abilities through daily quests, and through PvP matches, they can absorb the opposing team's abilities to increase the probability of obtaining high-rarity NFTs. Players can enjoy dungeon PVP battle games by forming a team with other players. It is a game where team formation, strategy, and teamwork are as important as skill. MATRIX game ecosystem: It consists of its own games and affiliated P2E games, and provides game users and liquidity through partnership with the guild community. All payments and rewards in the game are made with MIX tokens, and users can purchase and craft items using MIX tokens, and earn profits through sales. </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Road map Section-->
    <div class="main-road-map main-section blue-light-background" data-scroll-index="4">
        <div class="content">
            <div class="section-title">
                <h2> ROADMAP</h2>
            </div>
            

            <div class="rbrm-wrapper">
            <div class="rbrm-list">
                <div class="rbrm-line-wrapper">
                    <i class="rbrm-line"></i>
                </div>
				
				<?php 
					if(!empty($roadmap)){ 
						
						$total = count($roadmap);
						
						$i=0;
						foreach($roadmap as $roadmapData){
							$i++;
							?>
							<div class="rbrm-item">
								<div class="rbrm-item__col-title">
									<p class="rbrm-item__date body-5">{{$i}} / {{$total}}</p>
									<p class="rbrm-item__title headline-4"><?php echo $roadmapData->publish_date; ?></p>
								</div>
								<div class="rbrm-item__col-text">
									<p class="rbrm-item__text body-1">
										 <?php echo $roadmapData->description; ?>
									</p>
								</div>
								<div class="rbrm-dot-wrapper">
									<i class="rbrm-dot"></i>
								</div>
							</div>
							<?php
						}
					}
				?>
            </div>
        </div>




        </div>
    </div>
    <!-- End Road map Section-->

    <!-- Start tokenomics Section-->
    <div class="main-news main-section" data-scroll-index="3">
        <div class="content">
            <div class="section-title">
                <h2 class="gradient-transparent-background">
                    <img src="{{url('public/home_ico')}}/images/svg/half-circle.svg" alt="half circle icon">Tokenomics</h2>
            </div>
            <div>
                <div class="container">
                    <div class="row justify-content-center"> 
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Token Name (Symbol)</h6>
                                    <p class="news-details token_title">
                                        {{ get_token_info('token_name') }} (MIX)
                                    </p> 
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Total Supply</h6>
                                    <p class="news-details token_title">
                                        <?php echo get_token_info('total_supply_tokens'); ?>
                                    </p> 
                                </div>
                            </div>
                        </div>     
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Token Type </h6>
                                    <p class="news-details token_title">
                                        SPL
                                    </p> 
                                </div>
                            </div>
                        </div>   
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Token Explorer</h6>
                                    <p class="news-details token_title">
                                        <a href="<?php echo get_token_info('token_explorer'); ?>">Click here to View on Solana</a>
                                    </p> 
                                </div>
                            </div>
                        </div>  

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End tokenmoic Section-->

    <!-- token distribution Section-->
    <div class="main-projects main-section" >
        <div class="content">
            <div class="section-title">
                <h2 class="gradient-transparent-background">
                    <img src="{{url('public/home_ico')}}/images/svg/half-circle.svg" alt="half circle icon">Token Distribution</h2>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-sm-6">
                    <div class="sale-chart-view">
                        <div class="doughnut">
                            <div class="doughnutChartContainer">
                                <canvas id="doughnutChart" height="270" width="100%"></canvas>
                            </div>
                            <div id="legend" class="chart-legend"></div>
                         </div>
                    </div>
                </div>
                 
            </div> 
        </div>
    </div>
    <!-- token distribution  Section-->

    <!-- Start Team Section-->
    <div class="main-team main-section blue-light-background" data-scroll-index="5">
        <div class="content">
            <div class="section-title">
                <h2 class="gradient-transparent-background">
                    <img src="{{url('public/home_ico')}}/images/svg/half-circle.svg" alt="half circle icon">Our Team</h2>
            </div>
            <div class="team-container">
                <div class="container">
                    <div class="row justify-content-md-center">
						<?php 
							if(!empty($team)){
								$tm_cnt = 1;
								foreach($team as $tm){
									$tm_cnt++;
									?>
									<div class="col-12 col-lg-4 single-team-container">
										<div class="team-container-sub hoverable main-dark-background" data-aos="fade-up" data-aos-delay="100">
											<h4><?php echo $tm->full_name; ?></h4>
											<div class="job-container">
												<p class="job-title main-gradient-bg text-transparent"><?php echo $tm->designation; ?></p>
												<span></span>
											</div>
											<p class="description"><?php echo $tm->designation; ?></p>
											<img src="<?php echo get_recource_url($tm->image_id); ?>" alt="team image">
											<p> 
												<a href="<?php echo $tm->link; ?>"><i class="fab fa-linkedin-in"></i></a> 
											</p>
											<div class="more-link blue-light-background hoverable waves-effect waves-button">
												<a href="#">see more</a>
											</div>
										</div>
									</div>
									<?php
								}
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="content">
            <div class="section-title">
                <h2 class="gradient-transparent-background">
                    <img src="{{url('public/home_ico')}}/images/svg/half-circle.svg" alt="half circle icon">Our Advisor</h2>
            </div>
            <div class="team-container">
                <div class="container">
                    <div class="row justify-content-md-center">
						<?php 
							if(!empty($advisor)){
								$tm_cnt = 1;
								foreach($advisor as $tm){
									$tm_cnt++;
									?>
									<div class="col-12 col-lg-4 single-team-container">
										<div class="team-container-sub hoverable main-dark-background" data-aos="fade-up" data-aos-delay="100">
											<h4><?php echo $tm->full_name; ?></h4>
											<div class="job-container">
												<p class="job-title main-gradient-bg text-transparent"><?php echo $tm->designation; ?></p>
												<span></span>
											</div>
											<p class="description"><?php echo $tm->designation; ?></p>
											<img src="<?php echo get_recource_url($tm->image_id); ?>" alt="team image">
											<p> 
												<a href="<?php echo $tm->link; ?>"><i class="fab fa-linkedin-in"></i></a> 
											</p>
											<div class="more-link blue-light-background hoverable waves-effect waves-button">
												<a href="#">see more</a>
											</div>
										</div>
									</div>
									<?php
								}
							}
						?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End advisor Section-->

    <!-- Start Download Section-->
    <div class="main-download main-section blue-light-background"  >
        <div class="download-container">
            <nav class="nav nav-pills nav-justified main-gradient-bg">
                <a class="owl-download-link nav-item nav-link active" data-owl-item="0">
                    <img width="30" src="{{url('public/home_ico')}}/images/panthom.png" alt=""> &nbsp;<span>Panthom Wallet</span></a>
              
            </nav>
            <div class="owl-carousell owl-downloadd main-dark-background">
                <div class="download-sub-container pantomm">
                    <h2>A friendly crypto wallet, Phantom Wallet</h2>
                    <p>Phantom makes it safe & easy for you to store, buy, send, receive, swap tokens and collect NFTs on the Solana blockchain.</p>

                    <div class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                        <a href="https://phantom.app/">
                             <img width="20" src="{{url('public/home_ico')}}/images/panthom.png" alt=""> Panthom Website</a>
                        <span class="first-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2011.svg" alt=""></span>
                        <span class="second-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2012.svg" alt=""></span>
                        <span class="third-span"><img src="{{url('public/home_ico')}}/images/svg/Path%2015.svg" alt=""></span>
                    </div>
                    <div class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                        <a href="https://apps.apple.com/app/phantom-solan"><i class="fab fa-apple fa-lg"></i> Get on Apple store</a>
                        <span class="first-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2011.svg" alt=""></span>
                        <span class="second-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2012.svg" alt=""></span>
                        <span class="third-span"><img src="{{url('public/home_ico')}}/images/svg/Path%2015.svg" alt=""></span>
                    </div>
                    <div class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                        <a href="https://chrome.google.com/webstore/detail/phantom/bfnaelmomeimhlpmgjnjophhpkkoljpa?hl=ko">
                        <img width="20" src="{{url('public/home_ico')}}/images/chrome.png" alt=""> Get on Chrome store (PC)</a>
                        <span class="first-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2011.svg" alt=""></span>
                        <span class="second-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2012.svg" alt=""></span>
                        <span class="third-span"><img src="{{url('public/home_ico')}}/images/svg/Path%2015.svg" alt=""></span>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
    <!-- End Download Section-->

    <!-- Start News Section-->
    <div class="main-news main-section main-contact-faq main-section" data-scroll-index="6">
        <div class="content">
            
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="section-title">
                        <h2 class="gradient-transparent-background">
                            <img src="{{url('public/home_ico')}}/images/svg/half-circle.svg"  alt="half circle icon">FAQs</h2>
                    </div>
                    <div id="accordion" class="faq-container">
						<?php
							if(!empty($faqs)){
								$i=0;
								foreach($faqs as $faq){
									$i++;
									
									?>
									<div class="card single-faq-container main-dark-background">
										<div class="card-header" id="heading{{$i}}">
											<h5 class="mb-0">
												<button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
													<?php echo $faq->question ?>
												</button>
											</h5>
										</div>
										<div id="collapse{{$i}}" class="collapse @if($i == 1) show @endif" aria-labelledby="heading{{$i}}"
											 data-parent="#accordion">
											<div class="card-body">
												<?php echo $faq->answer ?>
											</div>
										</div>
									</div>
									<?php
								}
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End News Section-->

    <!-- Start Contact and FAQ Section-->
    <div class="main-contact-faq main-sectionn blue-light-background mt-5" data-scroll-index="7">
        <div class="content">
            <div class="row justify-content-center">
                
                <div class="col-lg-8">
                    <div class="join_community text-center mb-5 mt-5">
                        <h2>Join our community</h2>
                        <div class="btn_ara_join mt-4">
                            <a href="https://twitter.com/MatrixMix" target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Twitter <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://t.me/Matrix_0fficial" target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Telegram <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://medium.com/@Matrix_0fficial" target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Medium <i class="fab fa-medium"></i>
                            </a>
                            <a href="https://www.instagram.com/matrix_0fficial/"  target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Instagram <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"  target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Github <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- End Contact and FAQ Section-->

    <!-- Start Footer Section-->
    <div class="main-footer">
        <div class="content">
            <img class="img-fluid" src="{{url('public/home_ico')}}/images/logo.png" alt="site-logo">
            <p>
               <a href="https://twitter.com/MatrixMix" target="_blank" data-aos="fade-up" data-aos-delay="120"><i class="fab fa-twitter"></i></a>
                <a href="https://t.me/Matrix_0fficial" target="_blank" data-aos="fade-up" data-aos-delay="100"><i class="fab fa-telegram"></i></a>
                <a href="https://medium.com/@Matrix_0fficial" target="_blank" data-aos="fade-up" data-aos-delay="160"><i class="fab fa-medium"></i></a>
                <a href="https://www.instagram.com/matrix_0fficial/" target="_blank" data-aos="fade-up" data-aos-delay="140"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" data-aos="fade-up" data-aos-delay="180"><i class="fab fa-github"></i></a>
            </p>
        </div>
    </div>
    <!-- End Footer Section-->
	
	

    <!-- Start Copyright Section-->
    <div class="main-copyright blue-light-background">
        <p><?php echo get_settings('copyright_text'); ?> Code with <i class="fas fa-heart"></i> &nbsp; by icodev</p>
        <div class="copyright-nav">
            <a class="nav-link" data-scroll-nav="1" href="#">Home</a>
            <a class="nav-link" data-scroll-nav="2" href="#about">About</a>
            <a class="nav-link" data-scroll-nav="3" href="#token">Token</a>
            <a class="nav-link" data-scroll-nav="4" href="#roadmap">Roadmap</a>
            <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#Subscribe">Subscribe</a>
        </div>
    </div>
    <!-- End Copyright Section-->

    <!--Back to top button-->
    <a href="#0" class="cd-top js-cd-top waves-effect waves-circle"><i class="fas fa-chevron-up"></i></a>

    <!-- <span data-aos="zoom-out-left" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/circle.svg');"></span>
    <span data-aos="zoom-out-right" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/circle.svg');"></span>
    <span data-aos="zoom-out-left" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/circle.svg');"></span>
    <span data-aos="zoom-out-right" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/circle.svg');"></span>
    <span data-aos="fade-up" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/square.svg') no-repeat;"></span>
    <span data-aos="fade-up" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/square.svg') no-repeat;"></span>
    <span data-aos="fade-up" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/square.svg') no-repeat;"></span>
    <span data-aos="fade-up" data-aos-delay="100" class="shapes" style="background: url('{{url('public/home_ico')}}/images/svg/square.svg') no-repeat;"></span> -->

</div>

<div id="Subscribe" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subscribe Now</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form id="subscribe-form" class="ico-subscription form subscribe" action="{{ route('save-subscriber') }}" method="post">
					{{ csrf_field() }}
					<div class="input"><input type="email" name="youremail" class="required" placeholder="Your email address"></div>
					<div class="submit"><input type="submit" name="subscribe" value="subscribe"></div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--All Javascript Plugins Used-->
<script src="{{url('public/home_ico')}}/js/plugins.js"></script>
<!--Contact Form using Gmail Servers-->
<!-- <script src="js/contact-form-gmail.js"></script> -->
<!--Main Javascript file-->
<script src="{{url('public/home_ico')}}/js/main.js"></script>
<script src="{{url('public/home_ico')}}/js/jquery.countdown.js"></script>
<script src="{{url('public/home_ico')}}/js/Chart.js"></script>
<script src="{{url('public/home_ico')}}/js/chart-function.js"></script>
<script src="{{url('public/home_ico')}}/js/jquery.countdown.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>	    		

<script type="text/javascript">
	
	$("#subscribe-form").validate({
		submitHandler: function (form) {
			
			var formdata = $("form#subscribe-form").serialize();
		
			$.ajax({
				type: "POST",
				url: "./save-subscriber",
				cache: false,
				data: formdata,
				dataType: "JSON",
				beforeSend: function () {
					//$('#HomePopUp').modal("hide");
					$('.sub-btn_sub').css("opacity", "0.5");
					$('.sub-btn_sub').text('Loading...');
					$('.sub-btn_sub').prop('disabled', true);
				},
				success: function (data, status) {
					
					$("form#subscribe-form").trigger("reset");
					$('.sub-btn_sub').prop('disabled', false);
					$('.sub-btn_sub').text('subscribe');
					$('.sub-btn_sub').css("opacity", "1");
					
					//console.log(data);
					if(data.result == 'success' ){
						
						$('.sub_thanku').html('<p class="success white">'+data.message+'</p>');
						
					}else{
						$('.sub_thanku').html('<p class="error white">'+data.message+'</p>');
					}
					setTimeout(function(){ 
						$('.sub_thanku').html('');	
					}, 8000);
					
				},
				error: function () {
					alert("Oops something went wrong. <br>Please try again.");
				}
			});

		}
	});
	
</script>

</body>
 
</html>