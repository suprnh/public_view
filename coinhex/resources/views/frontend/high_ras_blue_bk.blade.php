<!DOCTYPE html>
<html lang="en">
 
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Change Title and Meta tags-->
    <title><?php echo __t(get_settings('site_title')); ?></title>
    <meta name="description" content="Lania ico landing">
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
            <div class="container ">
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
                    <ul class="navbar-nav mr-auto flex-end-content">
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
                    <div class="nav-buttons">
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
            <div class="blue-light-backgroundd header-sub-bg" >
                <div class="overlay"></div>
                <div class="container">
                <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-5">
                    <div class="header-title">
                        <h1 class="textillatee text-white" data-loop="true">
                        <span class="textillate-textt">
                            <span data-in-effect="fadeIn" data-out-effect="fadeOut">Caravel</span>
                        </span>
                        </h1>
                        <p>Caravel is a an ERC20 governance token on the Fantom Opera blockchain. By utilizing the Fantom network we're able to make transactions for pennies instad of the high rates on other chains. </p>
                    </div>
                    <div class="header-sub">
                        <div class="btn hoverable whitepaper_btn main-gradient-bg waves-effect waves-button hover-up">
                            <a target="_blank" href="#">Whitepaper</a>
                        </div>
                        <div class="social-icons mb-3"> 

                            <?php if(get_settings('telegram_link') != ""){ ?>
                                        
                                <a target="_blank" href="<?php echo get_settings('telegram_link'); ?>"><i class="fab fa-telegram"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('instagram_link') != ""){ ?>
                                        
                                <a target="_blank" href="<?php echo get_settings('telegram_link'); ?>"><i class="fab fa-telegram"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('fb_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('fb_link'); ?>"><i class="fab fa-facebook-f"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('twitter_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('twitter_link'); ?>"><i class="fab fa-twitter"></i></a>
                            
                            <?php } ?> 

                            <?php if(get_settings('youtube_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('youtube_link'); ?>"><i class="fab fa-youtube"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('reddit_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('reddit_link'); ?>"><i class="fab fa-reddit"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('github_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('github_link'); ?>"><i class="fab fa-github"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('bitcointalk_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('bitcointalk_link'); ?>"><i class="fab fa-bitcoin"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('medium_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('medium_link'); ?>"><i class="fab fa-medium-m"></i></a>
                            
                            <?php } ?>

                            <?php if(get_settings('linkedin_link') != ""){ ?>
                            
                                <a target="_blank" href="<?php echo get_settings('linkedin_link'); ?>"><i class="fab fa-linkedin-in"></i></a>
                            
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 main-header-sub text-center">
                    <div class="pre-sale-timerr ">
                                       
                        <h3><?php echo get_settings('clock_title'); ?></h3>
                        <div class="clock_area">
                            <div id="clock" data-date="<?php echo get_settings('clock_countdown_time'); ?>"> </div>
                        </div>

                    
                        <div class="btn_area ">
                            <a href="{{url('/login')}}" class="btn hoverable buy_btn main-gradient-bg waves-effect waves-button hover-up mt-4 ">Buy Now</a>
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
                               <p>Accepted Currency: <span><?php echo get_token_info('purchase_methods_accepted'); ?></span></p>
                            </div>
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
            <div class="row justify-content-center ">
                <div class="col-12 col-lg-6 left-side-content mb-3 ">
                    <div class="section-title">
                        <h2 class="gradient-transparent-background">What is Caravel?</h2>
                    </div>
                    <p></p>
                    <p>Caravel aims to solve peer-to-peer bottlenecks like the time of transfer, transaction costs, and ease of use. We want to increase the number of peer-to-peer payments on blockchain by engaging a new set of users through easy to use apps. </p>
                    <a href="#" class="more"  data-scroll-nav="3"><span></span>see more</a>

                    <div class="image abouttimg">
                        <img width="270" src="{{url('public/home_ico')}}/images/logo.png" alt="">
                    </div>
                    
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="row justify-content-center">
                <div class="col-12 col-lg-6 right-side-content  ">
                    <div class="about-cards-container">
                        <div class="single-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="blue-light-background">
                                <img src="{{url('public/home_ico')}}/images/svg/bitcoin-10.svg" alt="">  
                                <h4>Cross Chain Ecosystem </h4>
                                <p>Caravel will use Cross-chain smart contracts, which are decentralized apps made up of several smart contracts distributed across many blockchain networks and working together to produce a single integrated service. An entirely new category of smart contract use cases may be created by leveraging the specific advantages of distinct blockchains, side chains, and layer-2 networks, thanks to this new design paradigm. </p>
                               
                            </div>
                        </div> 
                    </div>   
                </div>
                <div class="col-12 col-lg-6 mb-4 right-side-content">
                    <div class="about-cards-container">
                        <div class="single-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="blue-light-background">
                                <img src="{{url('public/home_ico')}}/images/svg/bitcoin-4.svg" alt="">
                                <h4>Yield Farming</h4>
                                <p>Caravel 1% yield on Blue token Caravel is a decentralized smart contract for yield farming. Yield farming, also referred to as liquidity mining, is a way to generate rewards with cryptocurrency holdings. In simple terms, it means locking up cryptocurrencies and getting rewards. Yield farming is a way to make more crypto with your crypto.  In return for your service, you earn fees in the form of crypto. </p>
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
                </div>
                
                <div class="col-lg-9 mt-4">
                    <div class="vid_area">
                        <?php 
                            if(get_landing_page_video('video_1') != ""){ 
                                    
                                    $link = get_landing_page_video('video_1');
                                    
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match);
                                    
                                    $video_id = $match[1];
                                ?>
                                <div class="video" data-aos="fade-up">
                                    <iframe width="100%" height="470" src="https://www.youtube.com/embed/<?php echo $video_id;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php }?>
                    </div>
                </div>
                
            </div>

            
        </div>
    </div>

    <!-- Start Road map Section-->
    <div class="main-road-map main-section blue-light-background" data-scroll-index="4">
        <div class="content">
            <div class="section-title text-center">
                <h2 class="gradient-transparent-background">
                     ROADMAP</h2>
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




                 <!-- <div class="roadmap-slider owl-carousel mt-5">
                    <?php 
                    if(!empty($roadmap)){ 
                        
                        $total = count($roadmap);
                        
                        $i=0;
                        foreach($roadmap as $roadmapData){
                            $i++;
                            ?>
                    <div class="item">
                        <span><?php echo $roadmapData->publish_date; ?></span>
                        <p> <?php echo $roadmapData->description; ?></p>
                    </div>
                    <?php
                        }
                    }
                ?>
                </div> -->
                            

       




        </div>
    </div>
    <!-- End Road map Section-->

    <!-- Start tokenomics Section-->
    <div class="main-news main-section" data-scroll-index="3">
        <div class="content">
            <div class="section-title text-center">
                <h2 class="gradient-transparent-background">
                     Tokenomics</h2>
            </div>
            <div>
                <div class="container">
                    <div class="row justify-content-center"> 
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Token Name</h6>
                                    <p class="news-details token_title">
                                        {{ get_token_info('token_name') }} 
                                    </p> 
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Token Symbol</h6>
                                    <p class="news-details token_title">
                                        fCRVL 
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
                                        Fantom
                                    </p> 
                                </div>
                            </div>
                        </div>    
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Minimum Purchase </h6>
                                    <p class="news-details token_title">
                                        <?php echo get_token_info('min_purchase_cap'); ?>
                                    </p> 
                                </div>
                            </div>
                        </div>  
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Purchase Method </h6>
                                    <p class="news-details token_title">
                                        <?php echo get_token_info('purchase_methods_accepted'); ?>
                                    </p> 
                                </div>
                            </div>
                        </div>   
                        <div class="col-12 col-lg-3 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Token Explorer</h6>
                                    <p class="news-details token_title">
                                        <a href="<?php echo get_token_info('token_explorer'); ?>">Click here to View on Fantom Opera</a>
                                    </p> 
                                </div>
                            </div>
                        </div>  
                        <div class="col-12 col-lg-6 single-news-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-container-sub tokent hoverable blue-light-background"> 
                                <div class="news-content text-center">
                                    <h6 class="mt-3">Contract Address</h6>
                                    <p class="news-details token_title" style="word-break: break-all;">
                                        <?php echo get_token_info('contract_address'); ?>
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
            <div class="section-title text-center">
                <h2 class="gradient-transparent-background">
                     Token Distribution</h2>
                     <p>The Caravel distribution is projected as follows:</p>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 col-sm-6">
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
    <div class="main-team main-section blue-light-backgroundd" data-scroll-index="5">
        <div class="content">
            <div class="section-title text-center">
                <h2 class="gradient-transparent-background"> Our Team</h2>
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
											<img src="<?php echo get_recource_url($tm->image_id); ?>" alt="team image">
											 <p> 
												<a href="<?php echo $tm->link; ?>"><i class="fab fa-linkedin-in"></i></a> 
											</p> 

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
            <div class="section-title text-center">
                <h2 class="gradient-transparent-background ">
                     Our Advisor</h2>
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
											<img src="<?php echo get_recource_url($tm->image_id); ?>" alt="team image">
											 <p> 
												<a href="<?php echo $tm->link; ?>"><i class="fab fa-linkedin-in"></i></a> 
											</p> 
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
                    <img width="30" src="{{url('public/home_ico')}}/images/panthom.png" alt=""> &nbsp;<span>Our Mobile App</span></a>
              
            </nav>
            <div class="owl-carousell owl-downloadd main-dark-background">
                <div class="download-sub-container pantomm">
                    <h2>Our Mobile App Coming Soon</h2>
                    <p>Our app makes it safe & easy for you to store, buy, send, receive, swap tokens and collect NFTs on the blockchain.</p>

                    <div class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                        <a href="#">
                              <i class="fab fa-android fa-lg"></i> Play Store</a>
                        <span class="first-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2011.svg" alt=""></span>
                        <span class="second-span"><img src="{{url('public/home_ico')}}/images/svg/Line%2012.svg" alt=""></span>
                        <span class="third-span"><img src="{{url('public/home_ico')}}/images/svg/Path%2015.svg" alt=""></span>
                    </div>
                    <div class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                        <a href="#"><i class="fab fa-apple fa-lg"></i> Apple store</a>
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
                    <div class="section-title text-center">
                        <h2 class="gradient-transparent-background">FAQs</h2>
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
    <div class="main-contact-faq main-sectionn  mt-5" data-scroll-index="7">
        <div class="content">
            <div class="row justify-content-center">
                
                <div class="col-lg-8">
                    <div class="join_community text-center mb-5 mt-5">
                        <h2>Join our community</h2>
                        <div class="btn_ara_join mt-4">
                            <a href="<?php echo get_settings('twitter_link'); ?>" target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Twitter <i class="fab fa-twitter"></i>
                            </a>
                            <a href="<?php echo get_settings('telegram_link'); ?>" target="_blank" class="btn mb-3 hoverable main-gradient-bg main-gradient-main-btn waves-effect waves-button hover-up">
                                Telegram <i class="fab fa-twitter"></i>
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
            <div class="social_fotter">
               <?php if(get_settings('telegram_link') != ""){ ?>
                                        
                    <a target="_blank" href="<?php echo get_settings('telegram_link'); ?>"><i class="fab fa-telegram"></i></a>
                
                <?php } ?>

                <?php if(get_settings('fb_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('fb_link'); ?>"><i class="fab fa-facebook-f"></i></a>
                
                <?php } ?>
                
                <?php if(get_settings('instagram_link') != ""){ ?>
                                        
                    <a target="_blank" href="<?php echo get_settings('telegram_link'); ?>"><i class="fab fa-telegram"></i></a>
                
                <?php } ?>

                <?php if(get_settings('twitter_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('twitter_link'); ?>"><i class="fab fa-twitter"></i></a>
                
                <?php } ?> 

                <?php if(get_settings('youtube_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('youtube_link'); ?>"><i class="fab fa-youtube"></i></a>
                
                <?php } ?>

                <?php if(get_settings('reddit_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('reddit_link'); ?>"><i class="fab fa-reddit"></i></a>
                
                <?php } ?>

                <?php if(get_settings('github_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('github_link'); ?>"><i class="fab fa-github"></i></a>
                
                <?php } ?>

                <?php if(get_settings('bitcointalk_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('bitcointalk_link'); ?>"><i class="fab fa-bitcoin"></i></a>
                
                <?php } ?>

                <?php if(get_settings('medium_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('medium_link'); ?>"><i class="fab fa-medium-m"></i></a>
                
                <?php } ?>

                <?php if(get_settings('linkedin_link') != ""){ ?>
                
                    <a target="_blank" href="<?php echo get_settings('linkedin_link'); ?>"><i class="fab fa-linkedin-in"></i></a>
                
                <?php } ?>
            </div>
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
            <a class="nav-link" data-scroll-nav="5" href="#team">Team</a>
            <a class="nav-link btn btn-primary btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#Subscribe">Subscribe</a>
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

<div id="Subscribe" class="modal fade subscri" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subscribe Now</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form id="subscribe-form" class="ico-subscription form subscribe" action="{{ route('save-subscriber') }}" method="post">
					{{ csrf_field() }}
					<div class="input form-group"><input type="email" name="youremail" class="required form-control" placeholder="Your email address"></div>
					<div class="submit "><input class="subsbutton form-control" type="submit" name="subscribe" value="subscribe"></div>
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