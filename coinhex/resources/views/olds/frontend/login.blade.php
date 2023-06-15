<?php set_front_language(); ?>
@extends('frontend.layouts.structure')
@section('mid_area') 
  <?php language_switcher_html(); ?>
   <div class="user-ath-page">
       <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8  text-center">
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
                            <!--img src="{{ url('/public/frontend/userpanel/images/extra-pages/logo-sm.png') }}"  srcset="{{ url('/public/userpanel/frontend/images/logo-sm2x.png') }} 2x" alt="icon"-->
                        </a>
                    </div>
					
                    <div class="user-ath-box">

                    	

						<?php if(isset($_GET['otp']) && $_GET['otp']=='yes' && Session::has('otp_user')){ ?>
                        <h4>{{ __t('Enter OTP') }}</h4>
						 <p>{{ __t('Scan this QR code with') }} <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">{{ __t('google authenticator') }}</a> {{ __t('mobile app') }}.</p>
						<?php }else{ ?>
						<h4>{{ __t('Login to Your Account') }}</h4>
						<?php } ?>
						
							@if (Session::has('otp_message'))
                            <div class="note note-lg note-no-icon note-success">
                                <p>{{ __t(Session::get('otp_message')) }}</p>
                            </div>
							@endif
							@if (Session::has('otp_error'))
                            <div class="note note-lg note-no-icon note-danger">
                                <p>{{ __t(Session::get('otp_error')) }}</p>
                            </div>
							@endif
							@if (Session::has('message'))
                            <div class="note note-lg note-no-icon note-danger">
                                <p>{{ __t(Session::get('message')) }}</p>
                            </div>
							@endif
						<div class="gaps-1x"></div>
						<?php if(isset($_GET['otp']) && $_GET['otp']=='yes' && Session::has('otp_user')){ ?>
						<form action="{{ route('post-otp') }}" method="post" class="user-ath-form">
							{{ csrf_field() }}
							<div id="img">
							<img src='<?php echo Session::get('qrCodeUrl'); ?>' />
							</div>
                            <div class="input-item">
								<p>{{ __t('Enter the code your app gives you after scanning.') }}</a></p>
                                <input type="text" placeholder="{{ __t('Enter Code') }}" class="input-bordered" name="otp_value" value="{{ old('otp_value') }}">
								@if($errors->has('otp_value'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('otp_value')) }}</small></span>
								@endif
                            </div>
                            <div class="gaps"></div>
							<div style="clear:both"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary show_loader">{{ __t('Submit') }}</button>
                                <a href="{{ url('resendotp') }}" class="simple-link">{{ __t('Regenerate QR Code') }}</a>
                            </div>
                        </form>
						<?php }else{ ?>
                        <form action="{{ route('post-login') }}" method="post" class="user-ath-form" id="user-login-form">
							{{ csrf_field() }}
                            <div class="input-item">
                                <input type="text" placeholder="{{ __t('Your Email') }}" class="input-bordered required" name="email" value="{{ old('email') }}">
								@if($errors->has('email'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('email')) }}</small></span>
								@endif
                            </div>
                            <div class="input-item">
                                <input type="password" placeholder="{{ __t('Password') }}" class="input-bordered required" name="password">
								@if($errors->has('password'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('password')) }}</small></span>
								<div style="clear:both"></div>
								@endif
                            </div>
                            <div class="gaps"></div>
							<div style="clear:both;"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary show_loader2">{{ __t('Log in') }}</button>
                                <a href="{{ url('recovery') }}" class="simple-link">{{ __t('Forgot password?') }}</a>
                            </div>
                        </form>
						<?php } ?>

						<div class="loginwith mt-4">
                    		<ul class="list-inline social colored text-center mb-5">
                    			Login with 
							<li class="list-inline-item">
								<a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
									<img width="20" src="https://cdn3.iconfinder.com/data/icons/capsocial-round/500/facebook-512.png" alt=""> Facebook
								</a>
							</li>
							<li class="list-inline-item">
								<a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
									<img width="20" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1200px-Google_%22G%22_Logo.svg.png" alt=""> Google
								</a>
							</li>
							
						</ul>

                    	</div>


						
                    </div>
                    <div class="gaps-2x"></div>


                    <div class="form-note">
						<?php if(isset($_GET['otp']) && $_GET['otp']=='yes' && Session::has('otp_user')){ ?>
						<a href="{{ url('login') }}">{{ __t('Back to login') }}</a>
						<?php }else{ ?>
                        {{ __t('Not a member?') }} <a href="{{ url('signup') }}">{{ __t('Sign up now') }}</a>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script type="text/livescript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/livescript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script>

      $(document).ready(function() {
          $("#user-login-form").validate({
              submitHandler: function(form) {
                  $(".loader-wrapper").show();
                  $(this).text('Please Wait....');
                  form.submit();
              }
          });
      })
  </script>

@endsection