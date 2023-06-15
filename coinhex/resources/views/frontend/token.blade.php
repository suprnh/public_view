<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 

<?php

$price_table = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=USD&tsyms=ETH,USDT,BTC,BNB,ADA,SOL");
$price_table_json = json_decode($price_table, true);
// echo "<pre>"; print_r($price_table_json);

?>

<div class="user-content">
	<div class="user-panel">
		<h2 class="user-panel-title">{{ __t('Buy Token') }}</h2>
		@include('frontend.section.msg')
		<!--form name="submit_contribution" id="submit_contribution" action="./pay" method="post" target="_blank"-->
		<form action="./paystripe" method="POST">
			{{ csrf_field() }}
			
			<?php 
				$user_detail = get_user_detail_by_id(get_current_front_user_id()); 
				$tx_hash = time();
				
				$dataName = $user_detail->full_name;
				$dataEmail = $user_detail->email;
				
				//$amount = 10*100;
			?>

			<input type="hidden" name="full_name" value="<?php echo $dataName; ?>">
			<input type="hidden" name="email" value="<?php echo $user_detail->email; ?>">
			<input type="hidden" name="user_id" value="<?php echo $user_detail->ID; ?>">
			<input type="hidden" name="tx_hash" value="<?php echo $tx_hash; ?>">

			<input type="hidden" id="usd_eth" value="{{$price_table_json['ETH']}}">
			<input type="hidden" id="usd_usdt" value="{{$price_table_json['USDT']}}">
			<input type="hidden" id="usd_btc" value="{{$price_table_json['BTC']}}">
			<input type="hidden" id="usd_bnb" value="{{$price_table_json['BNB']}}">
			<input type="hidden" id="usd_ada" value="{{$price_table_json['ADA']}}">
			<input type="hidden" id="usd_sol" value="{{$price_table_json['SOL']}}">
			
			<h5 class="user-panel-subtitle">01. {{ __t('Please select the currency below') }}</h5>
			<div class="gaps-1x"></div>
			<div class="payment-list">
				<div class="row">
				   <div class="col-md col-sm-6">
						<div class="payment-item">
							<input class="payment-check" type="radio" id="payeth" name="payOption" value="ETH" checked  data-convertion="<?php echo get_settings('eth_to_p2p');?>">
							<label for="payeth">
								<div class="payment-icon payment-icon-eth"><img src="{{ url('/public/frontend/dashboard/images/icon-ethereum.png') }}" alt="icon"></div>
								<span class="payment-cur">{{ __t('Ethereum') }}</span>
							</label>
						</div>
				   </div>
				    <div class="col-md col-sm-6">
					   <div class="payment-item">
							<input class="payment-check" type="radio" id="paybtc" name="payOption" value="BTC"  data-convertion="<?php echo get_settings('btc_to_p2p');?>">
							<label for="paybtc">
								<div class="payment-icon payment-icon-btc"><em class="payment-icon fab fa-btc"></em></div>
								<span class="payment-cur">{{ __t('Bitcoin') }}</span>
							</label>
						</div>
				   </div>  
				   
				   <div class="col-md col-sm-6">
						<div class="payment-item">
							<input class="payment-check" type="radio" id="paylightcoin" name="payOption" value="USDT" data-convertion="<?php echo get_settings('ltc_to_p2p');?>">
							<label for="paylightcoin">
								<div class="payment-icon payment-icon-ltc"><img class="payment-icon" src="{{ url('/public/frontend/dashboard/images/icon-usdt.png') }}" height="50" alt="icon"></div>
								<span class="payment-cur">{{ __t('USDT TRC20') }}</span>
							</label>
						</div>
				   </div>
				   
				   <div class="col-md col-sm-6">
						<div class="payment-item">
							<input class="payment-check" type="radio" id="payBNB" name="payOption" value="BNB">
							<label for="payBNB">
								<div class="payment-icon payment-icon-ltc"><img class="payment-icon" src="{{ url('/public/frontend/dashboard/images/icon-bnb.png') }}" height="50" alt="icon"></div>
								<span class="payment-cur">{{ __t('BSC BNB') }}</span>
							</label>
						</div>
				   </div> 
				   
				   <div class="col-md col-sm-6">
						<div class="payment-item">
							<input class="payment-check" type="radio" id="payada" name="payOption" value="ADA" data-convertion="<?php echo get_settings('ltc_to_p2p');?>">
							<label for="payada">
								<div class="payment-icon payment-icon-ltc"><img class="payment-icon" src="{{ url('/public/frontend/dashboard/images/icon-ada.png') }}" height="50" alt="icon"></div>
								<span class="payment-cur">{{ __t('ADA') }}</span>
							</label>
						</div>
				   </div>
				   
				   <div class="col-md col-sm-6">
						<div class="payment-item">
							<input class="payment-check" type="radio" id="paysol" name="payOption" value="SOL">
							<label for="paysol">
								<div class="payment-icon payment-icon-ltc"><img class="payment-icon" src="{{ url('/public/frontend/dashboard/images/icon-sol.png') }}" height="50" alt="icon"></div>
								<span class="payment-cur">{{ __t('SOL') }}</span>
							</label>
						</div>
				   </div>
				   
				</div>
			</div>
			
		   <input type="hidden" id="choosen_crypto" name="choosen_crypto">
		   <?php
			   if(get_settings('token_value') !=''){
				   $token_value = get_settings('token_value');
			   }else{
				   $token_value = 0.25;
			   }
		   ?>
		   <input type="hidden" id="token_value" name="token_value" value="{{$token_value}}">
		   
		   <input type="hidden" id="payable_crypto_amount" name="payable_crypto_amount">
		   
			<div class="gaps-1x"></div>
			<h5 class="user-panel-subtitle">02. {{ __t('Set amount of CoinhexPro Coin you would like to purchase') }}</h5>
			<p>{{ __t('If you like to participate in  our CoinhexPro project and to purchase (CXP) tokens, please select payment method and enter the amount of (CXP) tokens you wish to purchase. You can buy (CXP) tokens using ETH, BTC, USDT, BNB, ADA, SOL') }} 
				</p>
			<div class="gaps-1x"></div>
			<div class="row">
				<div class="col-md-8">
					<div class="payment-calculator">
						<div class="payment-get">
							<label for="paymentGet">{{ __t('Tokens UNITS to Purchase') }}</label>
							<div class="payment-input">
								<input class="input-bordered restrict_token" type="text" name="token_amount" id="paymentGet" value="1200">
								<span class="payment-get-cur payment-cal-cur">CXP</span>    
							</div>
						</div>
						<em class="ti ti-exchange-vertical"></em>
						<div class="payment-from">
							<label for="paymentFrom">{{ __t('Payment Amount') }}</label>
							<div class="payment-input">
								<input class="input-bordered restrict_token" type="text" name="usd_amount" id="paymentFrom" value="50">
								<span class="payment-from-cur payment-cal-cur" id="current_currency">USD</span>    
								<input type="hidden" id="coin" name="coin">
							</div>
						</div>
					</div>
					<div class="gaps-2x d-md-none"></div>
				</div>
				<input name="bonus_percentage" type="hidden" id="bonus_percentage" value="<?php echo ((float)get_settings('bonus_percentage') > 0 ? get_settings('bonus_percentage') : 0); ?>">
			</div>
			<div class="gaps-1x"></div>
			<div class="payment-calculator-note" style="color:#F44336;"><i class="fas fa-info-circle"></i>{{ __t('This calculator helps you to convert the  required currency to (CXP) tokens.') }}</div>
			<div class="gaps-3x"></div>
			<div class="payment-summary">
				<div class="row">
					<div class="col-md-4">
						<div class="payment-summary-item payment-summary-final">
							<h6 class="payment-summary-title">{{ __t('Final UNITS') }}</h6>
							<div class="payment-summary-info">
								<span class="payment-summary-amount" id="final_payment">1200.00</span> <span>CXP</span>
							</div>
						</div>
					</div><!-- .col -->
					<div class="col-md-4">
						<div class="payment-summary-item payment-summary-bonus">
							<h6 class="payment-summary-title">{{ __t('Received (CXP) Bonus') }}</h6>
							<div class="payment-summary-info">
								<span>+</span> <span class="payment-summary-amount " id="received_bonus">480.00</span> <span>CXP</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="payment-summary-item payment-summary-tokens">
							<h6 class="payment-summary-title">{{ __t('Total Tokens Received') }}</h6>
							<div class="payment-summary-info">
								<span class="payment-summary-amount" id="total_received">1680.00</span> <span>CXP</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
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
						<input type="checkbox" name="aggrement" id="aggrement" class="input-checkbox" value="1">
						<label for="aggrement" style="color:#3f51b5 !important; font-weight: 600;">I accept the 
							<a href="#" target="_blank"><strong ><span style="color: #f00;"><a target="_blank" href="<?php echo $plink; ?>">Privacy Policy</a>  | </span>  <span style="color: #f00;">
								<a target="_blank" href="<?php echo $tlink; ?>">Term & Conditions</a></span></strong></a> 
						</label>
				  </div>
				   @if($errors->has('aggrement'))
				  <span style="color:RED;"><small>{{ __t($errors->first('aggrement')) }}</small></span>
				  <div style="clear:both;"></div>
				  @endif
			</div>
			<a href="javascript:void(0);" class="btn btn-primary payment-btn add_wat_id" style="display:none;" onclick="$('#modal_p_detail').modal('show');">{{ __t('Payment Details') }}</a>
			
			@section('modal')
				<div class="modal fade" id="modal_p_detail">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="tranx-popup">
								<h5>{{ __t('Purchase Details') }}</h5>
								<div class="tranx-payment-details">
									<p id="contribution_amount">{{ __t('Contribution amount') }}: <strong>10 ETH</strong> </p>
									
									
									
									
									
									<p id="contribution_detail">{{ __t('You will receive') }} <strong>1680 CXP</strong> {{ __t('tokens') }} ({{ __t('incl') }}. {{ __t('bonus of') }} 480 CXP {{ __t('once Contributed.') }}</p>
									<h6>Please make your Contributions to the below <span id="payable_crypto_coin"></span> Address</h6>
									<div class="tranx-payment-info">
										<span class="tranx-copy-feedback copy-feedback"></span>
										<em class="fab fa-ethereum" id="coin_logo"></em>
										
										<em class="fab" id="coin_logo_usdt" style="display:none; top: -1px; left: 0px;"><img style="width:35%" src="{{ url('/public/frontend/dashboard/images/icon-usdt.png') }}"></em>
										
										<em class="fab" id="coin_logo_bnb" style="display:none; top: -1px; left: 0px;"><img style="width:35%" src="{{ url('/public/frontend/dashboard/images/icon-bnb.png') }}"></em>
										
										<em class="fab" id="coin_logo_ada" style="display:none; top: -1px; left: 0px;"><img style="width:35%" src="{{ url('/public/frontend/dashboard/images/icon-ada.png') }}"></em>
										
										<em class="fab" id="coin_logo_sol" style="display:none; top: -1px; left: 0px;"><img style="width:35%" src="{{ url('/public/frontend/dashboard/images/icon-sol.png') }}"></em>
										
										<input type="text" class="tranx-payment-address copy-address" id="wallet_address" value="<?php echo get_settings('admin_wallet_address'); ?>" disabled>
										<a href="#" class="tranx-payment-copy copy-trigger"><em class="ti ti-files"></em></a>
										<div class="text-center">
											<img class="" src="https://chart.googleapis.com/chart?chs=450x300&cht=qr&chl=<?php echo get_settings('admin_wallet_address'); ?>&choe=UTF-8" alt="QR Code">
										</div>


									</div>
							  
									<div class="row">
										<div class="col-sm-12">
											<div class="gaps-2x"></div>
											<div class="note note-danger">
												<em class="fas fa-info-circle"></em>
												<p>{{ __t('In case you sent a different amount') }} <em id="cur_crypto">ETH</em>, {{ __t('the number of CXP tokens will update accordingly.') }}</p>
											</div>
											<div class="gaps-2x"></div>
											<span style="font-weight: 600;">{{ __t(' Once you finish the contribution, kindly fill the Confirm Payment form. Token Balance will reflect on the Dashboard after the confirmation.') }}</span>

											<div class="purchaseinfobtn text-center mt-2">
												<a href="{{url('/contribution')}}" class="btn btn-primary payment-btn">Confirm Payment</a>
											</div>
										 
										</div>
									</div>
										
								</div>
								<?php //}?>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal End -->
			@endsection
			
		
		</form>
	</div>
</div>

@endsection
