<?php set_front_language(); ?>
@extends('frontend.layouts.structure')
@section('mid_area')    
  <?php language_switcher_html(); ?>
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
						<?php if($msg_type==1 || $msg_type==5 || $msg_type==2 || $msg_type==6 ){ ?>
                        <h4>{{ __t('Reset Your Password') }}</h4>
                        <form action="{{ route('resetpassword-post') }}" class="user-ath-form" method="post">
						{{ csrf_field() }}
							<?php if(isset($msg_type) && $msg_type==5){ ?>
                            <div class="note note-lg note-no-icon note-success">
                                <p>{{ __t('Password updated successfully !') }}</p>
                            </div>
							<?php } ?>
                            <div class="input-item">
                                <input type="password" placeholder="{{ __t('Password') }}" name="password" class="input-bordered">
								 @if($errors->has('password'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('password')) }}</small></span>
								@endif
                            </div>
							 <div class="input-item">
                                <input type="password" placeholder="{{ __t('Confirm Password') }}" name="password_confirmation" class="input-bordered">
								 @if($errors->has('password_confirmation'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('password_confirmation'))}}</small></span>
								@endif
                            </div>
                            <div class="gaps"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary show_loader">{{ __t('Reset') }}</button>
								<input type="hidden" name="reset_password_token" value="<?php if(isset($_GET['token']) && !empty($_GET['token'])){ echo $_GET['token']; } ?>">
                                <span> <a href="{{ url('login') }}" class="simple-link"><em class="ti ti-arrow-right"></em> {{ __t('Login Here') }}</a></span>
                            </div>
                        </form>
						<?php }else{ ?>
						<div class="status status-canceled">
                            <div class="status-icon">
                                <em class="ti ti-close"></em>
                            </div>

                            <?php if(isset($msg_type) && $msg_type==3){ ?>
                            <span class="status-text">{{ __t('This is not a valid url!') }}</span>
							<?php }else if(isset($msg_type) && $msg_type==2){ ?>
							<span class="status-text">{{ __t('This user is inactive !') }}</span>
							<?php }else{ ?>
							<span class="status-text">{{ __t('This is not a valid url !') }}</span>
							<?php } ?>
                           
                        </div><!-- .status -->
						<?php } ?>
						
                    </div>
                    <div class="gaps-2x"></div>
                    <div class="form-note">
                        {{ __t('Not a member?') }} <a href="{{ url('signup') }}">{{ __t('Sign up now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection