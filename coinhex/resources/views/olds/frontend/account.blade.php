<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
                 <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">{{ __t('Account Information') }}</h2>
						
						<?php if($account_detail->user_token!='activated' && !empty($account_detail->user_token) && $account_detail->is_activated==0){ ?>
                        <div class="alert-box alert-primary">
                            <div class="alert-txt"><em class="ti ti-alert"></em>{{ __t('Confirm your email address') }}</div>
							<form action="{{ route('resend-email') }}" method="post" name="resend_email" id="resend_email">
							{{ csrf_field() }}
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="jQuery('#resend_email').submit();">{{ __t('Resend Email') }}</a>
							</form>
                        </div><!-- .alert-box -->
						<?php } ?>
						
						@include('frontend.section.msg')

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
						<?php 
							$active2 = '';
							$active = '';
							if($errors->has('token_address')){
							$active2 = 'show active';
							?>
							<li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#personal-data">{{ __t('Personal Data') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#wallet-address">{{ __t('Wallet Address') }}</a>
                            </li>
						<?php }else{ 
							$active = 'show active';
						?>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#personal-data">{{ __t('Personal Data') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#wallet-address">{{ __t('Wallet Address') }}</a>
                            </li>
						<?php } ?>
                        </ul><!-- .nav-tabs-line -->
						
						<form action="{{ route('account-post') }}" method="post" name="account-post" id="account-post">
						{{ csrf_field() }}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade <?php echo $active; ?>" id="personal-data">
           
									<?php /*
                                    <div class="input-item input-with-label">
                                        <label for="full-name" class="input-item-label">{{ __t('Full Name') }}</label>
                                        <input class="input-bordered" type="text" id="full-name" name="full_name" value="<?php echo $account_detail->full_name; ?>">
										 @if($errors->has('full_name'))
										<span style="color:RED;"><small>{{ __t($errors->first('full_name')) }}</small></span>
										@endif
                                    </div><!-- .input-item -->
									*/ ?>
									<div class="input-item input-with-label">
                                        <label for="first-name" class="input-item-label">{{ __t('First Name') }}<sup>*</sup></label>
                                        <input class="input-bordered" type="text" id="first-name" name="first_name" value="<?php if(isset($account_detail)) echo $account_detail->first_name; else old('first_name'); ?>" maxlength="20">
										 @if($errors->has('first_name'))
										<span style="color:RED;"><small>{{ __t($errors->first('first_name')) }}</small></span>
										@endif
                                    </div><!-- .input-item -->
									
									<div class="input-item input-with-label">
                                        <label for="last-name" class="input-item-label">{{ __t('Last Name') }}<sup>*</sup></label>
                                        <input class="input-bordered" type="text" id="last-name" name="last_name" value="<?php if(isset($account_detail)) echo $account_detail->last_name; else old('last_name'); ?>" maxlength="20">
										 @if($errors->has('last_name'))
										<span style="color:RED;"><small>{{ __t($errors->first('last_name')) }}</small></span>
										@endif
                                    </div><!-- .input-item -->
									
                                    <!--div class="input-item input-with-label">
                                        <label for="sur-name" class="input-item-label">Surname</label>
                                        <input class="input-bordered" type="text" id="sur-name" name="sur_name" value="<?php echo $account_detail->last_name; ?>">
                                    </div--><!-- .input-item -->
                                    
                                    <div class="input-item input-with-label">
                                        <label for="mobile-number" class="input-item-label">{{ __t('Mobile Number') }}</label>
                                        <input class="input-bordered" type="text" id="mobile-number" name="mobile_number" value="<?php if(isset($account_detail)) echo $account_detail->phone_no; else old('mobile_number'); ?>" maxlength="13">
										 @if($errors->has('mobile_number'))
										<span style="color:RED;"><small>{{ __t($errors->first('mobile_number')) }}</small></span>
										@endif
                                    </div><!-- .input-item -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="date-of-birth" class="input-item-label">{{ __t('Date of Birth') }} (yyyy-mm-dd)</label>
                                                <input class="input-bordered date-picker" type="text" id="date-of-birth" name="date_of_birth" value="<?php 
													if(isset($account_detail)){
														if($account_detail->date_of_birth=='0000-00-00'){
															echo old('date_of_birth');
														}else{
															echo old('date_of_birth',$account_detail->date_of_birth);
														}
													}else { 
														echo old('date_of_birth');
													}
													?>">
                                            </div><!-- .input-item -->
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="nationality" class="input-item-label">{{ __t('Nationality') }}</label>
                                                <select class="country-select" name="Nationality" id="Nationality">
                                                    <!--option value="us" <?php selected('us',$account_detail->country) ?>>United State</option>
													<option value="uk" <?php selected('uk',$account_detail->country) ?>>United KingDom</option>
													<option value="fr" <?php selected('fr',$account_detail->country) ?>>France</option>
													<option value="ch" <?php selected('ch',$account_detail->country) ?>>China</option>
													<option value="cr" <?php selected('cr',$account_detail->country) ?>>Czech Republic</option>
													<option value="cb" <?php selected('cb',$account_detail->country) ?>>Colombia</option-->
													
													<option value="">{{ __t('Select Nationality') }}</option>
													<?php 
													$countries = get_country_lable();
													if(count($countries) > 0){
														foreach($countries as $ky=>$country){
															?>
															<option value="<?php echo $ky; ?>" <?php if(isset($account_detail)){ selected($ky,old('Nationality',$account_detail->country));}else{
																selected(old('Nationality'),$account_detail->country);
															} ?>><?php echo $country; ?></option>
															<?php
														}
													}
													?>
                                                </select>
                                            </div><!-- .input-item -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                    <div class="gaps-1x"></div><!-- 10px gap -->
									<div class="input-item text-left">
											<input type="checkbox" name="second_auth" id="second_auth" class="input-checkbox" value="1" <?php if(isset($account_detail) && $account_detail->is_second_auth==1){ ?>checked="checked"<?php } ?>>
											<label for="second_auth">{{ __t('Opt in for 2nd step authentication via Google Authenticator.') }} </label>
                                    </div>
									<div style="clear:both;"></div>
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <button class="btn btn-primary btn-sendEther">{{ __t('Update') }}</button>
                                        <div class="gaps-2x d-sm-none"></div>
                                        <!--span class="color-success"><em class="ti ti-check-box"></em> All Changes are saved</span-->
                                    </div>
                               
                            </div><!-- .tab-pane -->
                            <div class="tab-pane fade <?php echo $active2; ?>" id="wallet-address">
                                <p>{{ __t('In order to receive your  Tokens, please select your wallet addres and you have to put the address below input box. You will receive tokens to this address after the Token Sale end.') }}</p>
                                    <div class="input-item input-with-label">
                                        <label for="wallet_address" class="input-item-label">{{ __t('Personal BNB Wallet') }}  </label>
                                        <input class="input-bordered" type="text" id="wallet_address" name="token_address" value="<?php  if(isset($account_detail) && $account_detail->wallet_address !=""){ echo $account_detail->wallet_address; }else { echo old('token_address');} ?>" maxlength="60" onKeyPress="ethAddressValidator()" onKeyUp="ethAddressValidator()" >
                                        <span class="input-note">{{ __t('Note: To receive tokens. Address should be BEP20-compliant.') }}</span>
										@if($errors->has('token_address'))
										<br><span style="color:RED;"><small>{{ __t($errors->first('token_address')) }}</small></span>
										@endif
										<span id="addCheck" class="eth--error" style="color:red"></span>
                                    </div><!-- .input-item -->
                                    <div class="gaps-2x"></div>
                                    <div class="note note-plane note-danger">
                                        <em class="fas fa-info-circle"></em>
                                        <p>"{{ __t('DO NOT USE your exchange wallet address such as Kraken, Bitfinex, Bithumb etc. You can use BEP20 Wallet, MetaMask wallets etc. Do not use the address if you don’t have a private key of the your address. You WILL NOT receive Tokens and WILL LOSE YOUR FUNDS if you do.') }}"</p>
                                    </div>
                                    <div class="gaps-3x"></div>
                                    <div class="gaps-1x"></div><!-- 10px gap -->
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <button class="btn btn-primary btn-sendEther">{{ __t('Update') }}</button>
                                        <div class="gaps-2x d-sm-none"></div>
                                        <!--span class="color-success"><em class="ti ti-check-box"></em> Saved your wallet address</span-->
                                    </div>
                                
                            </div><!-- .tab-pane -->
							</form><!-- form -->
							
         
                        </div><!-- .tab-content -->
                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
            
			
    <script>
		function ethAddressValidator(){
			
			var re = new RegExp("^0x([a-fA-F0-9]){40}$");
			var receiverAddressObj = document.getElementById("wallet_address");
			var receiverAddress = receiverAddressObj.value;	
			addCheck.innerText = "Invalid ETH wallet address.";
			if(receiverAddress === "" || receiverAddress === null)
			{
				//document.getElementById("btn-sendEther").disabled = false;
				jQuery('.btn-sendEther').prop('disabled', false);
				//document.getElementById("addCheck").style.display = 'none';
				$("#addCheck").hide();
			}			
			else if (re.test(receiverAddress)) {
				//document.getElementById("btn-sendEther").disabled = false;
				//jQuery('.btn-sendEther').prop('disabled', true);
				jQuery('.btn-sendEther').prop('disabled', false);
				//document.getElementById("addCheck").style.display = 'none';
				$("#addCheck").hide();
			} else {
				
				//document.getElementById("btn-sendEther").disabled = true;
				jQuery('.btn-sendEther').prop('disabled', true);
				addCheck.innerText = "Invalid ETH wallet address.";
				//document.getElementById("addCheck").style.display = 'inline';
				$("#addCheck").show();
			}
		}
		
	</script>
    
@endsection