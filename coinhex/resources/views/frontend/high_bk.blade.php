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
     <!-- Stylesheets End -->
    <style>
            
            .video iframe {
                padding: 0;
                border-radius: 10px;
                border: 5px solid #289bd7;
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
                        <a href="index.html" title="Thumb">
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
                                <li><a href="#about">About</a></li> 
                                <li><a href="#token">Tokenomics</a></li>
                                <li><a href="#team">Teams</a></li>
                                <li><a href="#roadmap">RoadMap</a></li> 
                                <li><a href="#faq">Faq</a></li> 
                                <li><a href="#contact ">Contact </a></li> 
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
            <div class="hero-main" id="hero-slider" style="background-image: url('{{url('public/home_page/images/bbg.jpg')}}');">
                <div class="hero_table">
                    <div class="hero_cell">
                        <div class="container">
                            <div class="row hero_row align-items-center  justify-content-center"> 
                                <div class="col-sm-12 col-md-7 mt-5">
                                    <h1 class="wow fadeInUp" data-wow-delay="0.1s">IMME</h1>
                                    <h2 class="wow fadeInUp" data-wow-delay="0.2s">The Future of Gaming combining Blockchain, <br> NFT & Crypto is GameFi</h2> 
                                    <p class="lead wow fadeInUp" data-wow-delay="0.3s">Intergalactic Meteorite Mining Empire (IMME). <br>Play To Earn (P2E), Transparent, Blockchain, and NFT,  co-operative GameFi</p>

                                    <div class="hero_btns justify-content-between my-5"> 
                                        <a href="https://imme2088.gitbook.io/~/files/v0/b/gitbook-x-prod.appspot.com/o/spaces%2FLITI8qAJUcNI0Kp4xKZm%2Fuploads%2FeurWj5PXDyaJ2qj06tQv%2FIMME%20LightPaper%20v3.pdf?alt=media&token=1b326a33-b771-4018-8206-0cb1f27c1cce" class="btn wow fadeInUp" data-wow-delay="0.6s">Whitepaper</a>
                                        <a href="{{url('/signup')}}" class="btn wow fadeInUp" data-wow-delay="0.8s">Signup</a>
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
                                                   <p>Accepted Currency: <span>BTC, ETH, BNB, USDT, ADA</span></p>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- .col-md-7 -->
                                <div class="col-lg-5 col-md-4 py-5 d-none d-md-block">
                                    <div class="hero-thumbnail wow fadeIn" data-wow-delay="0.6s">
                                        <img src="images/letter-h.png" alt="" />
                                    </div>
                                </div>

                            </div>  
                        </div>
                    </div>
                </div> 
            </div>
            <!-- Hero Section End -->  
            
            <!-- Benefits Start -->
            <div class="benefits p-tb">
                <div class="container">
                    <div class="sec-title text-center wow fadeInUp" data-wow-delay="0.1s"><h3>IMME Coin ECOSYSTEMS</h3></div>
                    <div class="sub-txt text-center"> 
                    </div>
                </div>
                <div class="container"> 
                    <div class="benefits-boxes align-items-center row"> 

                        <!-- col-md-5 -->
                        <div class="col-md-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.1s"> 
                                    <img src="{{url('public')}}/home_page/images/icon-1.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>ONE MARKETPLACE</h4> 
                                </div>
                            </div>
                        </div>
                            <!-- item -->

                        <div class="col-md-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.3s">
                                    <img src="{{url('public')}}/home_page/images/trust.png" alt="Read Time Update">
                                <div class="bf-details"> 
                                    <h4>TRANSHILENCY AND TRUST</h4> 
                                </div>
                            </div>
                        </div>
                            <!-- item -->

                        <div class="col-md-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.5s"> 
                                    <img src="{{url('public')}}/home_page/images/profile-picture.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>BLOCKCHAIN BASED PROFILES</h4> 
                                </div>
                            </div>
                        </div>
                            <!-- item -->

                        <div class="col-md-3">
                            <div class="item text-center wow fadeIn" data-wow-delay="0.7s"> 
                                    <img src="{{url('public')}}/home_page/images/money.png" alt="Read Time Update"> 
                                <div class="bf-details"> 
                                    <h4>PAYMENT FLEXIBILITY</h4> 
                                </div>
                            </div>
                        </div>
                            <!-- item -->
                         
                    </div>
                </div>
            </div>
            <!-- Benefits End -->

            <!--About Start -->
            <div class="about-section has-color" id="about">
                <div class="container">
                    <div class="row align-items-center wow fadeIn justify-content-center" data-wow-delay="0.2s">

                        <div class="col-lg-4 col-md-12">
                            <div class="about_thumb">
                                <img src="{{url('public')}}/home_page/images/about.png" alt="">
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12">
                            <h3 class="section-heading">About IMME (Intergalactic Meteorite Mining Empire)</h3> 
                            <p class="lead">It is the year 2088, and mankind has ventured beyond Earth to nearby planets and asteroids on their quest for rare and precious minerals.</p> 
                            <p>In this not too distant future, SpaceX successfully initiated the space mining era. Ignited by low-cost, reusable rocket designs, it was finally commercially viable to explore and extract rare earth minerals such as <a href="https://en.wikipedia.org/wiki/Molybdenum" target="_blank">molybdenum</a>, <a href="https://en.wikipedia.org/wiki/Osmium" target="_blank">osmium</a>, <a href="https://en.wikipedia.org/wiki/Palladium" target="_blank">palladium</a>, <a href="https://en.wikipedia.org/wiki/Platinum" target="_blank">platinum</a>, <a href="https://en.wikipedia.org/wiki/Rhenium" target="_blank">rhenium</a>, <a href="https://en.wikipedia.org/wiki/Rhodium" target="_blank">rhodium</a>, <a href="https://en.wikipedia.org/wiki/Ruthenium" target="_blank">ruthenium</a>, <a href="https://en.wikipedia.org/wiki/Terbium" target="_blank">terbium</a>, <a href="https://en.wikipedia.org/wiki/Neodymium" target="_blank">neodymium</a>, <a href="https://en.wikipedia.org/wiki/Tantalum" target="_blank">tantulum</a> in space.</p> 

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
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!--About end -->
  
            <!-- Token Sale start -->
            <div class="token-sale p-t" id="token">
                <div class="container wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sec-title text-center"><h3>Tokenomics</h3></div>
                    <div class="sub-txt text-center mb-5"> 
                        <p>We have put in deflationary system via auto burned rate at 3% for each transaction to ensure the decreased of token in circulation over time, and thus rise in token price </p>
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
                                            <h4>Tokens Offered</h4>
                                            <h5> <?php echo get_platform_distribution('tokens_offered'); ?></h5>
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
                                            <h5> <?php echo get_token_info('total_supply_tokens'); ?> </h5>
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

            <div class="token-salee has-color p-b">
                <div class="container wow fadeInUp mt-5" data-wow-delay="0.1s">
                    <div class="sec-title text-center"><h3>Token Distribution</h3></div>
                    <div class="sub-txt text-center mb-5"> 
                        <p>$IMME serves as the native currency for Intergalactic Meteorite Mining Empire and we use BSC Network.   </p>
                    </div> 
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-9 wow text-center fadeInUp" data-wow-delay="0.5s">
                            <div class="sale-chart-view ">
                                <div class="doughnut">
                                    <div class="doughnutChartContainer">
                                        <canvas id="doughnutChart" height="670"></canvas>
                                    </div>
                                    <div id="legend" class="chart-legend"></div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="video_section has-color" style="background: #022744;">
                <div class="container">
                    <div class="sec-title text-center wow fadeInUp" data-wow-delay="0.1s"><h3>Asteroid Mining Visualization</h3></div>
                    <div class="sub-txt text-center mb-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h4>As with all Sci-Fi, we would like to follow the concept of our GameFi as close to the real thing in the near future. Below is an introduction of Asteroid Mining Concpet. </h4>
                    </div>
                    <div class="row">
                        <div class="col-md-8 m-md-auto"> 
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
                                <span class="live-mark">Live Now</span>
                            </div>
                        </div>
					   <?	}
							}
						?>	
						
						
                       
                    </div>
                </div>
            </div>
            <!-- The Roadmap end-->
          
            <!-- Team sec start-->
            <div class="team-section p-tb light-gray-bg" id="team">
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
				 	
            </div>
            <div class="team-minimal-section p-tb white-sec">
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
						
						
						
						 <!-- Modal -->
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
            </div>
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
                            <form id="contact-form"  action="{{ route('save-contact-us') }}" method="post">
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
 
        </div>
        <!-- Content Section End -->   
        <div class="clear"></div>
        <!--footer Start-->   
        <footer class="footer-area has-color">
            <div class="footer-widget-area text-center">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-8">
                         
                            <div class="widget">
                                <div class="footer-logo wow fadeInUp" data-wow-delay="0.3s">
                                    <a href="#" title=""><img src="{{url('public/home_page/images/logo.png')}}" alt="Thumb"></a>
                                </div> 
                            </div> 
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="socials">
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
                    <!-- row -->
                </div>
                <!-- container -->
            </div> 

            <div class="copyright">
               <?php echo get_settings('copyright_text'); ?>
            </div>
        </footer>
        <!--footer end-->   
    </div>
    <!--Main Wrapper End-->
 
    <script  src="{{url('public')}}/home_page/js/jquery.min.js"></script> 
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
	
		$(document).ready(function(){
			
			$("#contact-form").validate({
				
				submitHandler: function (form) {
					
					var formdata = $("form#contact-form").serialize();
				
					$.ajax({
						type: "POST",
						url: "./save-contact-us",
						cache: false,
						data: formdata,
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
				}
			});
		});
	
	
	
	
	
	</script>
 
 
 

</body>
</html>

