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
											<h6 class="tile-title">{{ __t('PAR BALANCE') }}</h6>
											<h1 class="tile-info"><?php echo get_p2p_by_user_id(get_current_front_user_id()); ?> PAR</h1>
											
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
										<h1 class="tile-info"><?php echo number_format($user_detail->high_token_amount,2,'.',','); ?> ACW</h1>
										
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
                                    <h4>{{ __t('Thank you for your interest towards to the PAR Coin. You can contribute PAR Coins in Contributions section.') }}</h4>
                                    <div class="btnndiv mb-2">
                                    	<a class="btn btn-primary btn-sendEther" href="{{url('token')}}">BUY PAR</a>
                                    </div>
                                    <p>{{ __t('You can get a quick response to any questions, and chat with the project in our Telegram') }}: <a href="  https://t.me/">  https://t.me/</a></p>
                                    
						
                                </div>
                            </div>
                        </div><!-- .info-card -->
                        <!-- <div class="progress-card">
                            <h4>Token Sale Progress</h4>
                            <div class="progress track-progress"> 
                            	<span class="start-point">Softcap <span><?php echo get_token_info('soft_cap'); ?></span></span> 
                            	<span class="end-point">Hardcap <span><?php echo get_token_info('hard_cap'); ?></span></span>
                                <div class="progress  progress-striped track-progress progress-bar progress-bar-striped progress-bar-animated" style="width: <?php echo get_token_info('percentage'); ?>%">
                                	
                                </div>

                              </div>
                        </div> -->


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
                       
                        
                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
           
    
    
@endsection