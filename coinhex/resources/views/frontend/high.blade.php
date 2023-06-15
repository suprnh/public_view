<!DOCTYPE html>
<html lang="en" xml:lang="en">    
<head>       
    <meta charset="UTF-8">  
    <!-- Responsive Meta -->                    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"  href="{{url('public')}}/home_page/images/fav.png" type="image/x-icon" /> 
    <!-- favicon & bookmark -->
    <link rel="icon" href="{{url('public')}}/images/faviconn.png"> 
    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&display=swap" rel="stylesheet">
    <!-- Website Title -->
    <title><?php echo __t(get_settings('site_title')); ?></title>
    <!-- Stylesheets Start -->
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/fontawesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/vegas.css" type="text/css"/> 
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/slick.css" type="text/css"/>
    <link rel="stylesheet" href="{{url('public')}}/home_page/style.css" type="text/css"/>
    <link rel="stylesheet" href="{{url('public')}}/home_page/css/responsive.css" type="text/css"/>
    
    <script  src="{{url('public')}}/home_page/js/jquery.min.js"></script> 
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @if (Session::has('status_msg'))
        <script>
            $(document).ready(function(e){
                $('html, body').animate({
                    scrollTop: $("#contact").offset().top
                }, 500);
            });
        </script>
     @endif
	<!-- Stylesheets End -->
    <style>
        .video iframe {
            padding: 0;
            border-radius: 10px;
            border: 8px solid #18448d;
            overflow: hidden;
        }
    </style>
    
</head>
<body>
    <!--Main Wrapper Start-->
    <div class="wrapper" id="top">
        <!--Header Start --> 
        <header>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-2 col-md-2 logo">
                        <a href="{{url('/')}}" title="Thumb">
                            <img class="light" src="{{url('public')}}/home_page/images/logo.png" alt="Logo">
                            <img class="dark" src="{{url('public')}}/home_page/images/logo.png" alt="Logo">
                        </a>
                    </div>
                    <div class="col-sm-10 col-md-10 main-menu">
                        <div class="menu-icon">
                          <span class="top"></span>
                          <span class="middle"></span>
                          <span class="bottom"></span>
                        </div>
                        <nav class="onepage">
                            <ul> 
                                <!-- <li><a class="ropdown-item" href="{{url('/nfts')}}">NFTs</a></li> -->
                                
                                <li><a href="#about">About</a></li>
                                <li><a target="_blank" class="ropdown-item" href="<?php echo get_recource_url(get_settings('whitepaper_id')); ?>">Whitepaper</a></li>
                                <li><a href="#howto">How to buy</a></li>
                                <li><a href="#token">Tokenomics</a></li>
                                <li><a href="#roadmap">RoadMap</a></li> 
                                <li><a href="#faq">Faq</a></li>
                                <li><a href="#contact">Contact</a></li> 

                                <!-- <li class="dropdown manu">
                                    <span class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</span>

                                    <div class="dropdown-menuu" aria-labelledby="navbarDropdown">
                                        <a class="ropdown-item" href="#about">About</a>
                                        <a class="ropdown-item" href="#faq">FAQ</a>
                                        <a href="#contact ">Contact </a>
                                    </div>
                                </li> --> 
									<li><a class="ddt" href="{{ url('/login') }}">Login </a></li> 
									<!-- <li><a class="ddt" href="{{ url('/signup') }}">Signup </a></li>  -->
										
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!--Header End-->
 
        <!-- Content Section Start -->   
        <div class="midd-container">
            <!-- Hero Section Start -->   
            <div class="hero-main" id="hero-slider" style="background: rgb(241, 247, 253);">
                <div class="hero_table">
                    <div class="hero_cell">
                        <div class="container">
                            <div class="row hero_row align-items-center justify-content-center"> 
                                <div class="col-sm-12 col-md-7 mt-5">
                                    <h1 class="wow fadeInUp" data-wow-delay="0.1s">CoinhexPro(CXP) <span>Decentralising the world of finance</span> <!-- <span>Cryptocurrency and NFT Buy and sell made easy</span> --></h1>
                                    <h2 class="wow fadeInUp" data-wow-delay="0.2s">CXP token runs on BEP-20 Network. Transactions paid for using CXP tokens will be significantly discounted with the token</h2> 

                                    <div class="hero_btns justify-content-between my-5"> 
                                        <a target="_blank" href="<?php echo get_recource_url(get_settings('whitepaper_id')); ?>" class="btn wow fadeInUp" data-wow-delay="0.6s">Whitepaper</a>
										
												<a href="{{url('/signup')}}" class="btn wow fadeInUp" data-wow-delay="0.8s">Register</a>
												
                                    </div>  
                                </div>
                                <div class="col-md-5 wow fadeIn" data-wow-delay="0.2s">
                                    <div class="pre-sale-timer">
                                        <div>
                                            <h3><?php echo get_settings('clock_title'); ?></span></h3>
                                            <div id="clock" data-date="<?php echo get_settings('clock_countdown_time'); ?>">
                                                
                                            </div>
                                            <div class="hero-right-btn">
											
													<a class="btn" href="{{url('/login')}}">Buy Token</a>
												
                                            </div>
                                            <div class="rang-slider-main">
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
                </div> 
            </div>
            <!-- Hero Section End -->  

            <!--About Start -->
            <div class="about-section has-color" id="about">
                <div class="container">
                    <div class="row align-items-center wow fadeIn justify-content-center" data-wow-delay="0.2s">

                        <div class="col-lg-5 col-md-12">
                            <div class="about_thumb">
                                <img src="{{url('public')}}/home_page/images/ilus-bner.png" alt="">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-12 about_dd">
                            <h3 class="section-heading">About CoinhexPro</h3> 
                            <p class="lead">CoinhexPro is the easiest place to buy and sell cryptocurrency. CoinhexPro is offering NFTs through its partnership with NFT Ocean and are compatible with ERC20/BSC</p> 
                            <p>CXP, a utility token backed by CoinhexPro, forms the backbone of CoinhexPro ecosystem. We launched CXP tokens to involve our community in helping us build out CoinhexPro, and reward them accordingly for contributing to our success.  </p>  
                            <p>This helps us stay true to the ethos of cryptocurrency and blockchain - to share the rewards of CoinhexPro's success with our early adopters and supporters.</p>

                        </div> 

                        <div class="col-lg-10 mt-5">
                            <?php 
                            if(get_landing_page_video('video_1') != ""){ 
                                    
                                    $link = get_landing_page_video('video_1');
                                    
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match);
                                    
                                    $video_id = $match[1];
                                ?>
                                <div class="video" data-aos="fade-up">
                                    <iframe width="100%" height="370" src="https://www.youtube.com/embed/<?php echo $video_id;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div> 
            </div>
            <!--About end -->
            
            <!-- Benefits Start -->
            <div class="benefits p-tb">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="sec-title text-center wow fadeInUp" data-wow-delay="0.1s">
                                <h3>CoinhexPro ECOSYSTEMS</h3>
                            </div>
                            <div class="sub-txt text-center"> 
                                Every feature you need for financial freedom. Buy and sell cryptocurrency, directly from CoinhexPro. Easily and effortlessly buy and sell NFTs’ from CoinhexPro Platform. 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container"> 
                    <!-- <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="eco_img mb-4">
                                <img src="{{url('public/home_page/images/wallet/big_img1.png')}}" alt="">
                            </div>
                        </div>
                    </div> -->
                    <div class="benefits-boxes align-items-center row"> 
                        <div class="col-lg-12">
                                <h4 style="font-weight: bold; font-size: 30px;">Problems and challenges</h4>
                           </div> 
                        <div class="col-md-4 mb-3">
                           
                            <div class="item text-center wow fadeIn" data-wow-delay="0.1s"> 
                                    <img src="{{url('public')}}/home_page/images/iconn-1.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>Complicated to Use</h4> 
                                    <p>Current platforms require investors to understand complex technical terminology. They also require the performance of complicated interactions to perform transactions which causes the reduction in potential investor participation</p>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.3s">
                                    <img src="{{url('public')}}/home_page/images/iconn-2.png" alt="Read Time Update">
                                <div class="bf-details"> 
                                    <h4>Dificult Payments & Transfers</h4> 
                                    <p>The lack of a direct bridge between cryptocurrency and fiat payment networks reduces the portion of savings that investors are willing to hold in cryptocurrencies. The inability to make direct crypto to fiat payments and transfers to other individuals or companies, reduces the attractiveness of cryptocurrencies as a store of savings</p>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.5s"> 
                                    <img src="{{url('public')}}/home_page/images/iconn-3.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>High Fees & Commissions</h4> 
                                    <p>Existing platforms charge high fees and commissions which can be reduced through the streamlining of their platform’s operational inefficiencies and business models. </p>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.7s"> 
                                    <img src="{{url('public')}}/home_page/images/iconn-4.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>Lack of Beginner Friendly Guidance</h4> 
                                    <p>New investor learning curves can be significantly reduced through the targeted focus on beginner investors within the platform’s investor experience and journey models. </p>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.7s"> 
                                    <img src="{{url('public')}}/home_page/images/iconn-5.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>Lack of Shared Experience</h4> 
                                    <p>Existing platforms lack social interactivity features yet current studies indicate that investors are likely to increase their investments when working in groups due to the effects of socially supported decision-making.</p>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.7s"> 
                                    <img src="{{url('public')}}/home_page/images/iconn-6.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>Digital Ownership</h4> 
                                    <p>Current technologies to allow for the decentralized ownership of digital and physical assets lack in terms of security and identifiability and fall prey to piracy and fraud.</p>
                                </div>
                            </div>
                        </div> 
                         
                    </div>
                </div>
            </div>
            <!-- Benefits End -->

            

            

            <!--About Start -->
            <div class="about-section has-color" id="about">
                <div class="container">
                    <div class="row align-items-center wow fadeIn justify-content-center" data-wow-delay="0.2s">

                        <div class="col-lg-7 col-md-12 mb-5">
                            <h3 class="section-heading">Key Features</h3> 

                            <div class="row mt-5">
                                <div class="col-lg-12 mb-3">
                                    <div class="key_fes mb-3">
                                        <h4>Pay Utility Bills & Make Payments:</h4>
                                        <p>Direct utility bill payments and invoice payments from cryptocurrency holdings. Transfer funds or cryptocurrency to family and friends seamlessly.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="key_fes mb-3">
                                        <h4>Buy & Sell Cryptocurrencies:</h4>
                                        <p>Beginner friendly, 3-click cryptocurrency purchase and sale interface for hundreds of cryptocurrency pairs .</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="key_fes mb-3">
                                        <h4>NFT Art & Media Marketplace:</h4>
                                        <p>Easy to use marketplace to trade art and media from the industry’s hottest stars, using NFT technology.</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="key_fes mb-3">
                                        <h4>Chat with Friends and Groups:</h4>
                                        <p>Chat with family and friends in groups of unlimited numbers of members. This will enable the creation of a social network within the platform and encourage increased investment and trading through on-platform user to user interactions and support.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="key_fes mb-3">
                                        <h4>Zero Fees:</h4>
                                        <p>0% fees and commission on cryptocurrency buying and selling transactions.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="key_fes mb-3">
                                        <h4>Expert Advice & Support:</h4>
                                        <p>Receive expert advice and support at the click of a button.</p>
                                    </div>
                                </div>
                            </div>
 
                        </div> 

                        <div class="col-lg-5 col-md-12">
                            <div class="about_thumb">
                                <img src="{{url('public')}}/home_page/images/key-mobile.png" alt="">
                            </div>
                        </div>

                         
                    </div>
                </div> 
            </div>
            <!--About end -->

  
            <!-- Token Sale start -->
            <div class="token-sale" id="token">
                <div class="container wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sec-title text-center"><h3>Tokenomics</h3></div>
                    <div class="sub-txt text-center mb-5"> 
                        <p>We have put in deflationary system via auto burned  for each transaction to ensure the decreased of token in circulation over time, and thus rise in token price </p>
                    </div> 
                </div>
                <div class="container mb-5">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-7 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="token-sale-box">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4 class="text-uppercase">Token Name</h4>
                                            <h5><?php echo get_token_info('token_name'); ?></h5>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4 class="text-uppercase">Token Symbol</h4>
                                            <h5><?php echo get_token_info('whitelist'); ?></h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-6 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4 class="text-uppercase">Token Price</h4>
                                            <h5><?php echo get_token_info('cost_ubex_token'); ?></h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-6 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4>Minimum Purchase</h4>
                                            <h5><?php echo get_token_info('min_purchase_cap'); ?></h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4>Maximum Purchase</h4>
                                            <h5> <?php echo get_token_info('max_purchase_cap'); ?></h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4>Purchase Method</h4>
                                            <h5> <?php echo get_token_info('purchase_methods_accepted'); ?></h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4>Max Supply</h4>
                                            <h5> <?php echo get_token_info('total_supply_tokens'); ?> </h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4>Token Explorer</h4>
                                            <h5> <a href="<?php echo get_token_info('token_explorer'); ?>" target="_blank">Click Here To View on BscScan</a> </h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="sale-box">
                                            <h4>Contract Address</h4>
                                            <h5> <?php echo get_token_info('contract_address'); ?> </h5>
                                        </div>
                                    </div> 
                                    <!-- col-lg-12 -->
                                </div> 
                                <!-- row -->
                            </div>
                            <!-- token-sale-box -->
                        </div>
                        <!-- col-lg-6 -->
                           
                    </div>
                    <!-- row --> 
                </div>
                <!-- container -->
            </div>
            <!-- Token Sale end -->

            <div class="token-salee has-color ">
                <div class="container wow fadeInUp mt-5" data-wow-delay="0.1s">
                    <div class="sec-title text-center"><h3>Token Distribution</h3></div>
                    <div class="sub-txt text-center mb-5"> 
                        <p>CXP runs on the BEP-20 network and is compiled with the latest version of Solidity, in order to avoid compiler bugs, along with a community audited contract. CXP can be stored on
and transferred to and from most major cryptocurrency wallets including Meta Mask wallet.</p>
                    </div> 
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-9 wow text-center fadeInUp" data-wow-delay="0.5s">
                            <div class="sale-chart-view ">
                                <div class="doughnut">
                                    <div class="doughnutChartContainer">
                                        <canvas id="doughnutChart" height="470"></canvas>
                                    </div>
                                    <div id="legend" class="chart-legend"></div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="video_section has-color" style="background: #f1f7fd;" id="howto">
                <div class="container">
                    <div class="sec-title text-center wow fadeInUp" data-wow-delay="0.1s"><h3>How to Buy</h3></div>
                    <div class="sub-txt text-center mb-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h4>Please follow  below steps to buy CXP tokens </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="how_buy_step">
                                <ul>
                                    <li>1. User need to   <a href="{{url('/signup')}}">Register here</a> first</li>
                                    <li>2. After Register user needs to  <a href="{{url('/login')}}">Login here</a></li>
                                    <li>3. Now go to <a href="{{url('/token')}}">Buy Token</a> page</li>
                                    <li>4. Select the currency. click any of currency to select (ETH, BTC, BNB, USDT, ADA, SOL) </li>
                                    <li>5. Calculate token price. Enter the token amount you want to purchase. and it will give you USD price.  </li> 
                                    <li>6. Below accept the 'Terms & Privacy Policy'. Click on  <a href="{{url('/token')}}">'PAYMENT DETAILS'</a> button </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="how_buy_step">
                                <ul> 
                                    <li>7. A popup will apprear with the crypto amount. You need to send exact same crypto amount to Admin's wallet. Scan the QR Code or copy wallet address and Send crypto to that wallet address</li>
                                    <li>8. Below you will see <a href="{{url('/token')}}">'CONFIRM PAYMENT'</a> button to click. </li>
                                    <li>9. You will see a form to select the 'Currency' you have paid for. then Enter the <span style="color: #cddc39;">'amount in crypto'</span>. Enter the <span  style="color: #cddc39;">'Transaction Hash'</span> and Click to submit. </li>
                                    <li>10. Wait for admin to apporve the transaction and send you the tokens. </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 m-md-auto"> 
                            <?php 
                            if(get_landing_page_video('video_2') != ""){ 
                                    
                                    $link = get_landing_page_video('video_2');
                                    
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match);
                                    
                                    $video_id = $match[1];
                                ?>
                                <div class="video" data-aos="fade-up">
                                    <iframe width="100%" height="370" src="https://www.youtube.com/embed/<?php echo $video_id;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php }?>
                            <!-- video_frame --> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- video_section -->
   
            <!-- The Roadmap  start-->
            <div class="roadmap-sec p-tb " id="roadmap">
                <div class="container">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s"><h3 class="section-heading">Road Map</h3></div>
                    <div class="sub-txt text-center wow fadeInUp" data-wow-delay="0.2s">
                         
                    </div>
                    <div class="roadmap-live-slider">
					<?php 
						if(!empty($roadmap)){ 
						    foreach($roadmap as $roadmapData){
                    ?>
                                <div class="roadmap-item wow fadeInUp" data-wow-delay="0.9s">
                                    <div>
                                        <span class="roadmap-date"><?php echo $roadmapData->publish_date; ?></span>
                                        <h4><?php echo $roadmapData->description; ?></h4>
                                        <!-- <span class="live-mark">Live Now</span> -->
                                    </div>
                                </div>
					<?php	
                            }
						}
					?>	
						
						
                       
                    </div>
                </div>
            </div>
            <!-- The Roadmap end-->
          
            <!-- Team sec start-->
            <!-- <div class="team-section p-tb light-gray-bg" id="team">
                <div class="container">
				 <div class="text-center wow fadeInUp mb-4" data-wow-delay="0.1s"><h3 class="section-heading">Core Team</h3></div>
					 <div class="row">
						<?php 
						if(!empty($team)){ 
						$counter = 0;
							foreach($team as $tm){
								$counter++;
						?>
                        <div class="col-md-6 col-lg-3 wow fadeInUp pop_up" data-wow-delay="0.2s" >
						
                            <div class="team-box">
                                <div class="team-img">
                                    <img src="<?php echo get_recource_url($tm->image_id); ?>" alt="">
                                    

                                        <div class="team-social">
                                            <ul> 
                                                <?php if(!empty($tm->link)){ ?>

                                                <li><a href="<?php echo $tm->link; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    
                                    
                                </div>
                                <div class="text">
                                    <h4 data-toggle="modal" data-target="#team1<?php echo $tm->ID;?>"><?php echo $tm->full_name; ?></h4>
                                    <span><?php echo $tm->designation; ?></span>
                                </div>
                            </div>
					
                        </div>
						
						
						<div class="modal fade" id="team1<?php echo $tm->ID;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
							  <div class="modal-header"> 
								<span  class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</span>
							  </div>
							  <div class="modal-body py-0">
								
								<div class="team-box team_details text-left mt-0">
									<div class="team-img">
										<img src="<?php echo get_recource_url($tm->image_id); ?>" alt="">
										<div class="team-social">
											<ul>
												<?php if(!empty($tm->link)){ ?>

                                                <li><a href="<?php echo $tm->link; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                                <?php } ?>
											</ul>
										</div>
									</div>
									<div class="text mb-3"  data-toggle="modal" data-target="#team1">
										<h4><?php echo $tm->full_name; ?></h4>
										<span><?php echo $tm->designation; ?></span>
									</div>
									<p><?php echo $tm->description; ?></p>
								</div>
							  </div> 
							</div>
						  </div>
						</div>
						<?php
						}
					}?>
					
					 </div>
					
                </div>
				 	
            </div> -->
            <!-- <div class="team-minimal-section p-tb white-sec">
                <div class="container">
                    <div class="text-center wow fadeInUp mb-4" data-wow-delay="0.7s"><h3 class="section-heading"><span>Advisory Team</span></h3></div>
                    <div class="row wow fadeInUp" data-wow-delay="0.9s">
						<?php 
						if(!empty($advisor)){
							foreach($advisor as $adv){
							?>
                        <div class="col-md-4 col-sm-6">
                            <div class="team-box">
                                <div class="team-img">
                                    <img src="<?php echo get_recource_url($adv->image_id); ?>" alt="">
                                    <div class="team-social">
                                        <ul>
                                            <?php if(!empty($adv->link)){ ?>

                                            <li><a href="<?php echo $adv->link; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text"  data-toggle="modal" data-target="#team1<?php echo $adv->ID;?>">
                                    <h4><?php echo $adv->full_name; ?></h4>
                                    <span><?php echo $adv->designation; ?></span>
                                </div>

                            </div>
                        </div>
						 
						<div class="modal fade" id="team1<?php echo $adv->ID;?>"       aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
							  <div class="modal-header"> 
								<span  class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</span>
							  </div>
							  <div class="modal-body py-0">
								
								<div class="team-box team_details text-left mt-0">
									<div class="team-img">
										<img src="<?php echo get_recource_url($adv->image_id); ?>" alt="">
										<div class="team-social">
											<ul>
												<?php if(!empty($adv->link)){ ?>

                                            <li><a href="<?php echo $adv->link; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                            <?php } ?>
											</ul>
										</div>
									</div>
									<div class="text mb-3"  data-toggle="modal" data-target="#team1">
										<h4><?php echo $adv->full_name; ?></h4>
										<span><?php echo $adv->full_name; ?></span>
									</div>
									<p><?php echo $adv->description; ?></p>
								</div>
							  </div> 
							</div>
						  </div>
						</div>
						
						<?php 
							}
						}
					?>
					 
                    </div>
                </div>
            </div> -->
            <!-- Team sec end-->
			
			
 

            

             <!-- FAQ Section start-->
            <div class="faq-section p-tb" id="faq">
                <div class="container">
                    <div class="text-center mb-5"><h3 class="section-heading">Frequently Asked Questions</h3></div>
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <!--Accordion wrapper-->
                            <?php 
						if(count($faqs) > 0) {
								echo '<div class="accordion md-accordion style-2" id="accordionEx" role="tablist" aria-multiselectable="true">';
								
								$i=1;

								foreach($faqs as $faq){
								?>
								<div class="card">
                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingOne{{$i}}">
                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}">
                                            <h5 class="mb-0">
                                                <?=$faq->question;?> <i class="fas fa-caret-down rotate-icon"></i>
                                            </h5>
                                        </a>
                                    </div>
                                    <!-- Card body -->
                                    <div id="collapseOne{{$i}}" class="collapse <?php if($i== 1 ) echo 'show'; ?>" role="tabpanel" aria-labelledby="headingOne{{$i}}" data-parent="#accordionEx">
                                        <div class="card-body">
                                           <?=$faq->answer?>
                                        </div>
                                    </div>
                                </div>
								<?php 
								
									$i++;
								}
								echo '</div>';
							}
							
							?>
                            <!-- Accordion wrapper -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQ Section end--> 

            <div class="contact-section p-b p-t wow fadeIn" data-wow-delay="0.1s" id="contact">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-1"></div>
                        <div class="col-md-9 text-center">
                            <div class="sec-title text-center">
                                <h3>Drop us a message now!</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"> 
                                        <div class=" form-results text-center"></div> 
                                </div>
                            </div>
                            <form id="contact-form" action="" method="post">
								{{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="contact-name" id="contact-name" class="form-control" placeholder="Your Name" required>
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <input type="email" name="contact-email" id="contact-email" class="form-control" placeholder="Email address*" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <textarea class="form-control" rows="6" name="contact-message" id="contact-message" placeholder="Your Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn sub-btn">Send Message</button>
                                </div>
                            </form>
							
							
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <!-- contact-section -->

            <div class="xtra_signup">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="extra_text">
                                <span>Create your account here</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="btn_area text-center">
                                <a href="{{url('/signup')}}" class="btn btn-primary btn_extra">Signup now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
        <!-- Content Section End -->   
        <div class="clear"></div> 
        <!--footer Start-->   
        <footer class="footer-area has-color">
            <div class="footer-widget-area">
                <div class="container"> 
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="fotterlogo">
                                <div class="footer-logo wow fadeInUp" data-wow-delay="0.3s">
                                    <a href="{{url('/')}}" title=""><img src="{{url('public/home_page/logo_f2.png')}}" alt="Thumb"></a>
                                </div>
                                
                                <div class="logo_text w-100">
                                    <h5> CoinhexPro</h5>
                                    <p>CoinhexPro is the easiest place to buy & sell crypto currency’s.And offering NFTs through its partnership with NFT Ocean. </p>

                                    <ul> 

                                    <?php if(get_settings('telegram_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('telegram_link'); ?>"><em class="fab fa-telegram"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('fb_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('fb_link'); ?>"><em class="fab fa-facebook-f"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('twitter_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('twitter_link'); ?>"><em class="fab fa-twitter"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('instagram_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('instagram_link'); ?>"><em class="fab fa-instagram"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('youtube_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('youtube_link'); ?>"><em class="fab fa-youtube"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('reddit_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('reddit_link'); ?>"><em class="fab fa-reddit"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('github_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('github_link'); ?>"><em class="fab fa-github"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('bitcointalk_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('bitcointalk_link'); ?>"><em class="fab fa-bitcoin"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('medium_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('medium_link'); ?>"><em class="fab fa-medium-m"></em></a>
                                        </li>
                                        <?php } ?>

                                        <?php if(get_settings('linkedin_link') != ""){ ?>
                                        <li>
                                            <a target="_blank" href="<?php echo get_settings('linkedin_link'); ?>"><em class="fab fa-linkedin-in"></em></a>
                                        </li>
                                        <?php } ?>
                                </ul>
                                </div>
                            </div>


                            
                        </div>

                        <div class="col-lg-6">
                            <div class="fnavall">
                                <ul class="footer-nav">
                                    <li><a href="<?php echo get_settings('instagram_link'); ?>">Instagram</a></li>
                                    <li><a href="<?php echo get_settings('twitter_link'); ?>">Twitter</a></li>
                                    <li><a href="<?php echo get_settings('reddit_link'); ?>">Reddit</a></li>
                                    <li><a href="<?php echo get_settings('telegram_link'); ?>">Telegram</a></li>
                                    <li><a href="<?php echo get_settings('youtube_link'); ?>">YouTube</a></li>
                                    <li><a href="<?php echo get_settings('github_link'); ?>">Github</a></li>
                                </ul>
								
							<?php 
								$terms_conditions = get_settings('terms_conditions');
								$privacy_policy = get_settings('privacy_policy');
								
							?>
                                <ul class="footer-nav">
                                    <li><a href="#about">About us</a></li>
                                    <li><a href="#contact">Contact us</a></li>
                                    <li><a href="#faq">FAQ</a></li>
                                    <li><a target="_blank" href="<?php echo get_recource_url($privacy_policy); ?>">Privacy Policy</a></li> 
                                    <li><a target="_blank" href="<?php echo get_recource_url($terms_conditions); ?>">Terms of Condition</a></li>
                                </ul>
                                <ul class="footer-nav">
                                    <li><a href="#token">Token</a></li>
                                    <li><a href="#roadmap">Roadmap</a></li>
                                    <li><a target="_blank" href="<?php echo get_recource_url(get_settings('whitepaper_id'));?>">Whitepaper</a></li> 
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-5 text-center">
                            <div class="copyright-text copyright-text-s2"><?php echo get_settings('copyright_text'); ?></div>
                        </div>
                    </div>
                </div>
                <!-- container -->
            </div> 
 
        </footer>
        <!--footer end-->   
    </div>
    <!--Main Wrapper End-->
 
    
    <script  src="{{url('public')}}/home_page/js/jquery.countdown.js"></script>
    <script  src="{{url('public')}}/home_page/js/bootstrap.min.js"></script>
    <script  src="{{url('public')}}/home_page/js/onpagescroll.js"></script>
    <script  src="{{url('public')}}/home_page/js/wow.min.js"></script> 
    <script  src="{{url('public')}}/home_page/js/owl.carousel.js"></script>
    <script  src="{{url('public')}}/home_page/js/vagas.js"></script>
    <script  src="{{url('public')}}/home_page/js/slick.min.js"></script>
    <script  src="{{url('public')}}/home_page/js/Chart.js"></script>
    <script  src="{{url('public')}}/home_page/js/chart-function.js"></script> 
    <script  src="{{url('public')}}/home_page/js/script.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
 
    <script>
        $(document).ready(function(e){
            
            $("#contact-form").validate({
                submitHandler: function (form) {
                    
                    //e.preventDefault();
                    
                    let contactdata = $("form#contact-form").serialize();
                    
					//console.log(contactdata);
					//return false;
					
                    $.ajax({
                        type: "POST",
                        url: "./save-contact-us",
                        data: contactdata,
                        dataType: "JSON",
                        beforeSend: function () {
                            //$('#HomePopUp').modal("hide");
                            $('.sub-btn').css("opacity", "0.5");
                            $('.sub-btn').text('Loading...');
                            $('.sub-btn').prop('disabled', true);
                        },
                        success: function (data, status) {
                            
                            $("form#contact-form").trigger("reset");
                            $('.sub-btn').prop('disabled', false);
                            $('.sub-btn').text('Send Message');
                            $('.sub-btn').css("opacity", "1");
                            
                            //console.log(data);
                            if(data.result == 'success' ){
                                
                                $('.form-results').html('<p class="success white">'+data.message+'</p>');
                                
                            }else{
                                $('.form-results').html('<p class="error white">'+data.message+'</p>');
                            }
                            setTimeout(function(){
								$('.form-results').html('');    
							}, 8000);
                            
                        },
                        error: function () {
                            alert("Oops something went wrong. <br>Please try again.");
						}
                    });
					
					return false;
                }
            });
		});
    </script>

    <!-- script>
        $(document).ready(function(){ 
          $(".dropdown-toggle").click(function(){
            $(".dropdown-menu").toggle();
          });
        });
    </script> -->
 
 
 

</body>
</html>

