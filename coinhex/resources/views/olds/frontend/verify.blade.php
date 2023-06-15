<?php set_front_language(); ?>
@extends('frontend.layouts.structure')
@section('mid_area') 
   <div class="user-ath-page">
       <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 text-center">
                    <div class="user-ath-logo">
                         <a href="{{ url('/') }}">
						 <?php 
						$site_logo = get_settings('site_logo_id');
						if($site_logo > 0){
						?>
						<img src="<?php echo get_recource_url($site_logo); ?>" srcset="<?php echo get_recource_url($site_logo); ?> 2x" alt="logo">
						<?php
						}else{
						?>
						<img src="{{ url('/public/frontend/dashboard/images/logo.png') }}" srcset="{{ url('/public/frontend/dashboard/images/logo-sm2x.png') }} 2x" alt="icon">
						<?php 
						} 
						?>
                            <!--img src="{{ url('/public/frontend/images/extra-pages/logo-sm.png') }}"  srcset="{{ url('/public/frontend/images/logo-sm2x.png') }} 2x" alt="icon"-->
                        </a>
                    </div>
					
                    <div class="user-ath-box">
						<?php if($msg_type==1 || $msg_type==2 || $msg_type==5 || $msg_type==6 ){ ?>
						 <div class="status status-thank">
                            <div class="status-icon">
                                <em class="ti ti-check"></em>
                            </div>
							<?php if($msg_type==1){ ?>
                            <span class="status-text">{{ __t('Thank you! Your email is now verified.') }}</span>
							<?php }else if($msg_type==5){ ?>
							<span class="status-text">{{ __t('Thank you! Your new email id is now verified, you can now login with your new email id.') }}</span>
							<?php }else if($msg_type==6){ ?>
							<span class="status-text">{{ __t('Thank you! Your email is now verified but password have not set. Please check your inbox, we have sent and email with instruction of how to set password.') }}</span>
							<?php }else{ ?>
							<span class="status-text">{{ __t('Thank you! Your email already verified.') }}</span>
							<?php } ?>
                        </div><!-- .status -->
						<?php }else{ ?>
						<div class="status status-canceled">
                            <div class="status-icon">
                                <em class="ti ti-close"></em>
                            </div>

                            <?php if($msg_type==3){ ?>
                            <span class="status-text">{{ __t('This is not a valid url!') }}</span>
							<?php }else{ ?>
							<span class="status-text">{{ __t('This is not a valid url !') }}</span>
							<?php } ?>
                           
                        </div><!-- .status -->
						<?php } ?>
						
                    </div>
					
					
                    <div class="gaps-2x"></div>
                    <div class="form-note">
                        {{ __t('Already a member?') }} <a href="{{ url('login') }}">{{ __t('Login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection