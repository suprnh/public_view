<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
<?php $user_detail = get_user_detail_by_id(get_current_front_user_id()); ?>                               
<div class="user-content">
	<div class="user-panel">
		<h2 class="user-panel-title">
		<?php if(what_my_role_logged_in()=='partner'){ ?>
		{{ __t('Investment Proof') }}
		<?php }else{ ?>
		{{ __t('Purchase Information') }}
		<?php } ?>
		</h2>
		@include('frontend.section.msg')
		
		<form name="submit_contribution" id="submit_contribution" action="{{ route('post-contribution') }}" method="post">
			{{ csrf_field() }}
		<div class="transaction-i">
				<div class="gaps-2x"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="input-item input-with-label">
							<label for="email-address" class="input-item-label">{{ __t('Email Address') }}</label>
							<input class="input-bordered" type="text" id="email-address" name="email_address" value="<?php echo $user_detail->email; ?>" readonly="readonly">
							@if($errors->has('email_address'))
							<span style="color:RED;"><small>{{ __t($errors->first('email_address')) }}</small></span>
							@endif
						</div><!-- .input-item -->
					</div><!-- .col -->
					<div class="col-md-6">
							<div class="input-item input-with-label">
								<label for="nationality" class="input-item-label">{{ __t('Select Currency') }}</label>
								<select class="country-select" name="currency" id="currency">
									<option value="eth" <?php selected('eth',old('currency')); ?>>ETH</option>
									<option value="btc" <?php selected('btc',old('currency')); ?>>BTC</option>
									<option value="usdt" <?php selected('usdt',old('currency')); ?>>USDT</option>
									<option value="bnb" <?php selected('bnb',old('currency')); ?>>BNB</option>
									<option value="ada" <?php selected('ada',old('currency')); ?>>ADA</option>
								</select>
								@if($errors->has('currency'))
								<span style="color:RED;"><small>{{ __t($errors->first('currency')) }}</small></span>
								@endif
							</div><!-- .input-item -->
					</div><!-- .col -->
					<div class="col-md-6">
						<div class="input-item input-with-label">
							<label for="phone-number" class="input-item-label">{{ __t('Contribution Amount in crypto ETH/BTC/USDT/ADA') }}</label>
							<input class="input-bordered" type="text" id="contribution-amount" name="contribution_amount" value="{{ old('contribution_amount') }}">
							@if($errors->has('contribution_amount'))
							<span style="color:RED;"><small>{{ __t($errors->first('contribution_amount')) }}</small></span>
							@endif
						</div><!-- .input-item -->
					</div><!-- .col -->
					<div class="col-md-12">
							<div class="input-item input-with-label">
								<label for="email-address" class="input-item-label">{{ __t('Transfer proof') }} (TxHASH)</label>
								<input class="input-bordered" type="text" id="transfer_proof" name="transfer_proof" value="{{ old('transfer_proof') }}">
								@if($errors->has('transfer_proof'))
								<span style="color:RED;"><small>{{ __t($errors->first('transfer_proof')) }}</small></span>
								@endif
							</div><!-- .input-item -->
					</div><!-- .col -->
					<div class="gaps-2x"></div>
					<div class="col-md-12">
						  <div class="input-item text-left">
								<input type="checkbox" name="aggrement" id="aggrement" class="input-checkbox" value="1">
								<label for="aggrement" style="color:#eabf22 !important; font-weight: 600;">{{ __t('I hereby confirm that all the details provided are correct. I will be solely responsible for any wrong entry.') }}</label>
						  </div>
						   @if($errors->has('aggrement'))
						  <span style="color:RED;"><small>{{ __t($errors->first('aggrement')) }}</small></span>
						  <div style="clear:both;"></div>
						  @endif
					</div>
					<div style="clear:both;"></div>
						<div class="col-md-12">
						<a href="javascript:void(0)" class="btn btn-primary payment-btn" onclick="jQuery('#submit_contribution').submit();">{{ __t('Submit') }}</a>
					</div>
					
				</div><!-- .row -->

				<div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="rewars_rules">
                            <h3>Purchase info  Form Submission Rules: </h3>
                            <ul>
                                <li>1. Select The Currency you have paid. Example: ETH/BTC/USDT/BNB/ADA</li>
                                <li>2. Enter the Amount in crypto. Example: 0.25 ETH</li>
                                <li>3. Enter Your TxHASH &amp; submit the form</li>
                                <li>4. Don't Submit form more than one. if you do you won't receive Token that you paid for. </li>
                            </ul>
                        </div>
                    </div>
                </div>
			</div><!-- .from-step-content -->
			</form>
	</div><!-- .user-panel -->
</div><!-- .user-content -->
            
			
           

			
    
    
@endsection