<?php set_front_language(); ?>
@extends('frontend.layouts.structure')
@section('mid_area') 
	 @if (Session::has('signup_success'))
	 @else
     <?php language_switcher_html(); ?>
	 @endif
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
						 @if (Session::has('signup_success'))
						 <div class="status status-thank">
                            <div class="status-icon">
                                <em class="ti ti-check"></em>
                            </div>
                            <h4>{{ __t('Thank you!') }}</h4>
							<br> 
							<span class="status-text">{{ __t('Your signup process is almost done.') }}</span>
                            <p>{{ __t('Please check your email and verify.') }}</p>
                        </div><!-- .status -->
						 @else
                        <h4>{{ __t('Create New Account') }}</h4>
                        <form action="{{ route('post-signup') }}" method="post" enctype="multipart/form-data" class="user-ath-form-new" id="user-ath-form-new">
<!--
                            <div class="note note-lg note-no-icon note-danger">
                                <p>Please check your submited information for error.</p>
                            </div>
                            <div class="note note-lg note-no-icon note-success">
                                <p>Your registration is succesfull, please check you email to confirm.</p>
                            </div>
-->
							{{ csrf_field() }}
							<?php /*
                            <div class="input-item">
                                <input type="text" placeholder="{{ __t('Your Name') }}" name="name" class="input-bordered" value="{{ old('name') }}">
								@if($errors->has('name'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('name')) }}</small></span>
								@endif
                            </div>
							*/ ?>
							
							<div class="input-item">
                                <input type="text" placeholder="{{ __t('First Name') }}" name="first_name" class="input-bordered required" value="{{ old('first_name') }}" maxlength="20">
								@if($errors->has('first_name'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('first_name')) }}</small></span>
								@endif
                            </div>
							
							<div class="input-item">
                                <input type="text" placeholder="{{ __t('Last Name') }}" name="last_name" class="input-bordered required" value="{{ old('last_name') }}" maxlength="20">
								@if($errors->has('last_name'))
								<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('last_name')) }}</small></span>
								@endif
                            </div>
							 
                            <div class="input-item">
                                <input type="text" placeholder="{{ __t('Your Email') }}" name="email" class="input-bordered required" value="{{ old('email') }}" maxlength="30">
								@if($errors->has('email'))
								  <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('email')) }}</small></span>
								@endif
                            </div>
							
                            <div class="input-item">
                                <input type="text" placeholder="{{ __t('Personal BNB Wallet') }}" name="wallet" id="wallet_address" class="input-bordered required" value="{{ old('wallet') }}" maxlength="60" onKeyPress="ethAddressValidator()" onKeyUp="ethAddressValidator()" >
								@if($errors->has('wallet'))
									<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('wallet')) }}</small></span>
								@endif
								<span id="addCheck" class="eth--error" style="color:red"></span>
								
                            </div>
							
                            <div class="input-item">
                                <input type="password" placeholder="{{ __t('Password') }}" name="password" id="password" class="input-bordered required" maxlength="20">
								@if($errors->has('password'))
								  <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('password')) }}</small></span>
								@endif
                            </div>
							
                            <div class="input-item">
                                <input type="password" placeholder="{{ __t('Repeat Password') }}" name="password_confirmation" class="input-bordered required" maxlength="20">
								@if($errors->has('password_confirmation'))
							    <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('password_confirmation')) }}</small></span>
							    @endif
                            </div>
							
							
							
							<div class="input-item">
							 
								   <?php 
									if(!empty($plans)){
										foreach($plans as $plan){
											?>
											<input type="radio" name="plan" value="<?php echo $plan ->id; ?>"> <?php echo $plan ->plan_name;?> $<?php echo $plan -> plan_amount; ?>
																						
											<?php
										}
									}
								?>
								@if($errors->has('plan'))
							    <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('plan')) }}</small></span>
							    @endif
																
                            </div>
							
							
							
							{{--<div class="input-item text-left">
								
                                <input class="input-checkbox" id="second_auth" type="checkbox" name="second_auth" value="1">
                                <label for="second_auth">{{ __t('Opt for 2nd step authentication via Google Authenticator.') }}</label>
								@if($errors->has('second_auth'))
							    <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('second_auth')) }}</small></span>
								<div style="clear:both;"></div>
							    @endif
                            </div>--}}
							
							<div class="input-item text-left">
                                <input class="input-checkbox required" id="subscription" type="checkbox" name="subscription" value="1">
                                <label for="subscription">{{ __t('By signing up to registration, you agree to receive promotional/periodical updates via email from us.') }}</label>
								@if($errors->has('subscription'))
							    <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('subscription')) }}</small></span>
								<div style="clear:both;"></div>
							    @endif
                            </div>

                            <div class="input-item text-left">
								<?php 
								$terms_conditions = get_settings('terms_conditions');
								$privacy_policy = get_settings('privacy_policy');
								$plink = '';
								$tlink = '';
								if(isset($privacy_policy) && !empty($privacy_policy) && $privacy_policy > 0){
									$plink = get_recource_url($privacy_policy);
								}
								if(isset($terms_conditions) && !empty($terms_conditions) && $terms_conditions > 0){
									$tlink = get_recource_url($terms_conditions);
								}
								?>
                                <input class="input-checkbox required" id="term-condition" type="checkbox" name="term" value="1">
                                <label for="term-condition"> {{ __t('I agree to the') }} <a href="<?php echo $tlink; ?>" class="hlight-color" target="_blank"> {{ __t('Terms') }}</a> {{ __t('&') }} <a href="<?php echo $plink; ?>" class="hlight-color" target="_blank"> {{ __t('Privacy Policy') }}.</a></label>
								@if($errors->has('term'))
								<div style="clear:both;"></div>
							    <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('term')) }}</small></span>
								<div style="clear:both;"></div>
							    @endif
                            </div>
                            <!-- google recaptcha start -->
                            <div class="g-recaptcha" data-sitekey="6LeJDW4bAAAAAEaXP-dF6SPY8-eeHuuA43iuoK5Z"></div>
                            <!-- google recaptcha end -->
							
                            <div class="gaps"></div>
                            <div class="d-flex justify-content-between align-items-center">
								<input type="hidden" name="referral_code" id="referral_code" value="<?php if(isset($_GET['ref']) && !empty($_GET['ref'])){ echo $_GET['ref']; }?>">
                                <button type="submit" name="signupfrm" class="btn btn-primary show_loader2" id="btn-sendEther">{{ __t('Sign Up') }}</button>
                            </div>
                        </form>
						 @endif

						 <div class="loginwith mt-4">
                    		<ul class="list-inline social colored text-center mb-5">
                    			Signup with 
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
                        {{ __t('Already a member?') }} <a href="{{ url('login') }}">{{ __t('Login here Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script type="text/livescript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script type="text/livescript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>

$(document).ready(function() {
    // Letters only
    jQuery.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only letters are allowed.");
	
	jQuery.validator.addMethod("pwcheck", function(value) {
	   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
		   && /[a-z]/.test(value) // has a lowercase letter
		   && /\d/.test(value) // has a digit
	});

    $("#user-ath-form-new").validate({
        rules: {
			password: {
				pwcheck: true
			},
            password_confirmation: {
                equalTo: "#password"
            },
            first_name: {
                lettersOnly: true,
            },
            last_name: {
                lettersOnly: true,
            },
        },
        messages: {
            password: {
                pwcheck: "Password should include Number and Letters."
            },
            password_confirmation: {
                equalTo: "Please enter the same password again."
            }
        },
        submitHandler: function(form) {
            if(grecaptcha.getResponse() == "") {
                alert("Please use captcha to proove that you are not a robot!");
                return;
            }
			$(".loader-wrapper").show();
			$(this).text('Please Wait....');
            form.submit();
        }
    });
})

	/*$(".show_loader2").click(function () {
		if ($("#user-ath-form-new").valid()){
			
			$(".loader-wrapper").show();
			$(this).text('Plase Wait....');
			$("#user-ath-form-new").submit();
		}
	});*/

	/*$("#user-ath-form-new").validate();
	
	if ($("#user-ath-form-new").valid()) {
		//CallSomeOtherFunction();
		
	}*/
	
	function ethAddressValidator(){
		
		var re = new RegExp("^0x([a-fA-F0-9]){40}$");
		var receiverAddressObj = document.getElementById("wallet_address");
		var receiverAddress = receiverAddressObj.value;	
        addCheck.innerText = "Invalid ETH wallet address.";
        if(receiverAddress === "" || receiverAddress === null)
		{
			document.getElementById("btn-sendEther").disabled = false;
			//document.getElementById("addCheck").style.display = 'none';
			$("#addCheck").hide();
		}			
		else if (re.test(receiverAddress)) {
			document.getElementById("btn-sendEther").disabled = false;
			//document.getElementById("addCheck").style.display = 'none';
			$("#addCheck").hide();
		} else {
			
			document.getElementById("btn-sendEther").disabled = true;
			addCheck.innerText = "Invalid ETH wallet address.";
			//document.getElementById("addCheck").style.display = 'inline';
			$("#addCheck").show();
		}
	}
	
</script>

@endsection