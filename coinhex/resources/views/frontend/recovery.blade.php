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
                        <h4>{{ __t('Request Your Password') }}</h4>
                        <form action="{{ route('post-recovery') }}" class="user-ath-form" method="post" id="user-recovery-form">
						{{ csrf_field() }}
							<?php if(isset($msg_type) && $msg_type==3){?>
                            <div class="note note-lg note-no-icon note-danger">
                                <p>{{ __t('There is no account with this email.') }}</p>
                            </div>
							<?php } ?>
							<?php if(isset($msg_type) && $msg_type==2){?>
                            <div class="note note-lg note-no-icon note-danger">
                                <p>{{ __t('Your email is not verified ! Please verify your ACW account email, we have just sent varification mail again.') }}</p>
                            </div>
							<?php } ?>
							<?php if(isset($msg_type) && $msg_type==1){?>
                            <div class="note note-lg note-no-icon note-success">
                                <p>{{ __t('Password recovery instruction sent to your email, Please check.') }}</p>
                            </div>
							<?php } ?>
                            <div class="input-item">
                                <input type="text" placeholder="{{ __t('Your Email') }}" name="email" class="input-bordered required">
								 @if($errors->has('email'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('email')) }}</small></span>
								@endif
                            </div>
                            <div class="gaps"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary show_loader2">{{ __t('Submit') }}</button>
                                <span> <a href="{{ url('login') }}" class="simple-link"><em class="ti ti-arrow-right"></em> {{ __t('Login Here') }}</a></span>
                            </div>
                        </form>
                    </div>
                    <div class="gaps-2x"></div>
                    <div class="form-note">
                        {{ __t('Not a member?') }} <a href="{{ url('signup') }}">{{ __t('Sign up now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script type="text/livescript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/livescript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script>

      $(document).ready(function() {
          $("#user-recovery-form").validate({
              submitHandler: function(form) {
                  $(".loader-wrapper").show();
                  $(this).text('Please Wait....');
                  form.submit();
              }
          });
      })
  </script>
    
@endsection