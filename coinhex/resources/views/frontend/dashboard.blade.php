<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
<div class="user-content">
	<div class="user-panel">
		@include('frontend.section.msg')
		<div class="row">
		<?php if($user_detail->role_id == 2){ ?>
			<div class="col-md-12">
				<div class="tile-item tile-primary">
					
					<div class="row">
						<div class="col-md-4">
							<div class="tile-bubbles"></div>
							<h6 class="tile-title">{{ __t('TOKEN BALANCE') }}</h6>
							<h1 class="tile-info"><?php echo get_p2p_by_user_id(get_current_front_user_id()); ?> CXP </h1>
							
						</div>
						<?php if((float)$user_detail->eth_token_amount > 0){ ?>
						<div class="col-md-8">
							<div class="tile-bubbles"></div>
							<h6 class="tile-title">{{ __t('ETHEREUM BALANCE') }}</h6>
							<h1 class="tile-info"><?php echo number_format($user_detail->eth_token_amount,2,'.',','); ?> ETH</h1>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			
		<?php }elseif($user_detail->role_id == 4){ 
		
		?>
			<div class="col-md-6">
				<div class="tile-item tile-primary">
					
					<div class="row">
						<div class="col-md-8">
						<div class="tile-bubbles"></div>
						<h6 class="tile-title">{{ __t('TOKEN BALANCE') }}</h6>
						<h1 class="tile-info"><?php echo number_format($user_detail->high_token_amount,2,'.',','); ?> fCRVL</h1>
						
						</div>
					</div>
					
				</div>
			</div><!-- .col -->
			<div class="col-md-6">
				<div class="tile-item tile-primary">
					
					<div class="row">
						<div class="col-md-8">
						<?php if((float)$user_detail->eth_token_amount > 0){ ?>
						
						<div class="tile-bubbles"></div>
						<h6 class="tile-title">{{ __t('ETHEREUM BALANCE') }}</h6>
						<h1 class="tile-info"><?php echo number_format($user_detail->eth_token_amount,2,'.',','); ?> ETH</h1>
						
						<?php }else{ ?>
							<div class="tile-bubbles"></div>
							<h6 class="tile-title">{{ __t('ETHEREUM BALANCE') }}</h6>
							<h1 class="tile-info">0.00 ETH</h1>	
						<?php } ?>
						</div>
					</div>
					
				</div>
			</div>
		<?php }?>
		</div><!-- .row -->
		
		<div class="info-card info-card-bordered">
			<div class="row align-items-center">
				<div class="col-sm-3">
					<div class="info-card-image">
						<img src="{{ url('public/images/faviconn.png') }}" alt="vector">
					</div>
					<div class="gaps-2x d-md-none"></div>
				</div>
				<div class="col-sm-9">
					<h4>{{ __t('Thank you for your interest towards to the CoinhexPro coin. You can contribute CoinhexPro Coin in Contributions section.') }}</h4>
					<div class="btnndiv mb-2">
						<a class="btn btn-primary btn-sendEther" href="{{url('token')}}">BUY TOKEN</a>
					</div>
					<p>{{ __t('You can get a quick response to any questions, and chat with the project in our Telegram') }}: <a href="<?php echo get_settings('telegram_link'); ?>">  <?php echo get_settings('telegram_link'); ?></a></p>
					
		
				</div>
			</div>
		</div><!-- .info-card -->
		<div class="progress-card">
			<h4>Token Sale Progress</h4>
			<div class="progress track-progress"> 
				<span class="start-point">Softcap <span><?php echo get_token_info('soft_cap'); ?></span></span> 
				<span class="end-point">Hardcap <span><?php echo get_token_info('hard_cap'); ?></span></span>
				<div class="progress  progress-striped track-progress progress-bar progress-bar-striped progress-bar-animated" style="width: <?php echo get_token_info('percentage'); ?>%">
					
				</div>

			  </div>
		</div>


	  <!--   <div class="progress-card">
			<h4>{{ __t('Token Sale Progress') }}</h4>
			<div class="progress track-progress">
				<div class="progress-bar" style="width: 60%;">
					<span class="sr-only">60% Complete</span>
				</div>
			</div>
			<div class="progress  progress-striped track-progress progress-bar progress-bar-striped progress-bar-animated" > <span class="start-point">{{ __t('Softcap') }} 24.000 ETH<span><?php echo get_settings('softcap'); ?></span></span> <span class="end-point">{{ __t('Hardcap') }} 4.000 ETH<span><?php echo get_settings('hardcap'); ?></span></span>
				<div class="determinate" style="width: <?php echo get_settings('percentage'); ?>%"></div>
			</div>
		</div> -->
		<div class="gaps-3x"></div>
		<div class="section section-pad token-sale-section section-bg-zinnia" id="tokenSale">
			<div class="tokenInformationHeading">
				<div class="row justify-content-center text-center">
					<div class="col-md-6">
						<div class="section-head-s7">
							<h2 class="section-title-s7 animated fadeInUp" data-animate="fadeInUp" data-delay=".1" style="visibility: visible; animation-delay: 0.1s;">Token Information</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="gaps-2x"></div>
			<div class="tokenInformationSection">
				<div class="tokdis-list">
					<div class="row text-center token-container text-lg-left">
						<div class="col-lg-12">
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 token-info-section">
								<div class="tokdis-item animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="visibility: visible; animation-delay: 0.2s;">
									<span>Tokens Offered</span>
									<h5><?php echo get_platform_distribution('tokens_offered'); ?></h5>
								</div>
							</div>
							<!-- .col -->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 token-info-section">
								<div class="tokdis-item animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="visibility: visible; animation-delay: 0.2s;">
									<span>Soft Cap</span>
									<h5><?php echo get_token_info('soft_cap'); ?></h5>
								</div>
							</div>
							<!-- .col -->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 token-info-section">
								<div class="tokdis-item animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="visibility: visible; animation-delay: 0.2s;">
									<span>Hard Cap</span>
									<h5><?php echo get_token_info('hard_cap'); ?></h5>
								</div>
							</div>
							<!-- .col -->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 token-info-section">
								<div class="tokdis-item animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="visibility: visible; animation-delay: 0.2s;">
									<span>Distrbution of Tokens</span>
									<h5><?php echo get_platform_distribution('distrbution_tokens'); ?></h5>
								</div>
							</div>
							<!-- .col -->
						</div>
						<!-- .row -->
					</div>
					<!-- .tokdis-list -->
				</div>
				<!-- .container -->
				<div class="gaps size-2x d-none d-md-block"></div>
				<div class="gaps size-2x"></div>
				<div class="toktmln-list">
					<div class="tokenInformationsection">
						<div class="row">
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 token-duration">
							<span class="circle-span"></span>
							<div class="toktmln-item animated fadeInUp" data-animate="fadeInUp" data-delay=".8" style="visibility: visible; animation-delay: 0.8s;">
								<div>
									<span class="dl">Private Sale</span>
									<span class="dt"><?php echo get_ico_phase('pre_sale'); ?></span>
								</div>
							</div>
						</div>
						<!-- .col -->
					</div>
					<div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 token-duration">
						<span class="circle-span"></span>
						<div class="toktmln-item animated fadeInUp" data-animate="fadeInUp" data-delay=".8" style="visibility: visible; animation-delay: 0.8s;">
							<div>
								<span class="dl">ICO Phase I</span>
								<span class="dt"><?php echo get_ico_phase('ico_phase_1'); ?></span>
							</div>
						</div>
					</div>
					<!-- .col -->
				</div>
				<div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 token-duration">
					<span class="circle-span"></span>
					<div class="toktmln-item animated fadeInUp" data-animate="fadeInUp" data-delay=".8" style="visibility: visible; animation-delay: 0.8s;">
						<div>
							<span class="dl">ICO Phase II</span>
							<span class="dt"><?php echo get_ico_phase('ico_phase_2'); ?></span>
						</div>
					</div>
				</div>
				<!-- .col -->
			</div>
			<div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 token-duration">
				<span class="circle-span"></span>
				<div class="toktmln-item animated fadeInUp" data-animate="fadeInUp" data-delay=".8" style="visibility: visible; animation-delay: 0.8s;">
					<div>
						<span class="dl">ICO Phase III</span>
						<span class="dt"><?php echo get_ico_phase('ico_phase_3'); ?></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 token-duration">
				<span class="circle-span"></span>
				<div class="toktmln-item animated fadeInUp" data-animate="fadeInUp" data-delay=".8" style="visibility: visible; animation-delay: 0.8s;">
					<div>
						<span class="dl">ICO Extended</span>
						<span class="dt"><?php echo get_ico_phase('ico_phase_4'); ?></span>
					</div>
				</div>
			</div>
			<!-- .col -->
		</div>
		
	</div><!-- .user-panel -->
</div><!-- .user-content -->
           
    
    
@endsection