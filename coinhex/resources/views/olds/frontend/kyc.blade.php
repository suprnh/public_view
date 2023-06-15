<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
                
                <div class="user-content">
                    <div class="user-panel">
						@include('frontend.section.msg')
						<?php if(isset($kyc) > 0 && !empty($kyc) && $kyc->status!=0){ ?>
							
							<!--p>{{ __t('To comply with regulation each participant will have to go through identity verification (AML/KYC). So please complete our fast and secure verification process to participate in our token sale. You can proceed from here to verify your identity and also you can check your application status if you submit already.') }} </p-->
							<?php 
								if($kyc->status== 1){
									$current_status = "Processing";
								} elseif($kyc->status== 2){
									$current_status = "Rejected";
								} elseif($kyc->status== 3){
									$current_status = "Information Missing";
								} elseif($kyc->status== 4){
									$current_status = "Verified";
								}else{$current_status = "Unknown";}
							?>
							
							<h2 class="user-panel-title">AML/KYC Form Status - <?php echo $current_status; ?></h2>
							
							<?php if($kyc->status==4){ // verified ?>
							<div class="gaps-2x"></div>
							
							<div class="status status-thank">
								<div class="status-icon">
									<em class="ti ti-files"></em>
									<div class="status-icon-sm">
										<em class="ti ti-alarm-clock"></em>
									</div>
								</div>
								<span class="status-text">{{ __t('Thank you! You have completed the process for your Identity verification.') }}</span>
								<!--p>We are still waiting for your identity verification. Once our team verified your identity, you will be whitelisted and notified by email.</p-->
							</div><!-- .status -->
							
							<?php }else if($kyc->status==3){ // information missing ?>
							
								<div class="status status-warnning">
									<div class="status-icon">
										<em class="ti ti-files"></em>
										<div class="status-icon-sm">
											<em class="ti ti-alert"></em>
										</div>
									</div>
									<span class="status-text">{{ __t('We found some information missing in application.') }}</span>
									<p>{{ __t('In our verification process, we found information are missing. It would great if you resubmit the form. If face problem in submission please contact us with support team.') }}</p>
									<a href="{{ route('kyc-application') }}" class="btn btn-primary">{{ __t('Submit Again') }}</a>
								</div><!-- .status -->
								
							<?php }else if($kyc->status==2){ // rejected ?>
							
								<div class="status status-canceled">
									<div class="status-icon">
										<em class="ti ti-files"></em>
										<div class="status-icon-sm">
											<em class="ti ti-close"></em>
										</div>
									</div>
									<span class="status-text">{{ __t('Your application rejected by admin.') }}</span>
									<p>{{ __t('In our verification process, we found information incurrect. It would great if you resubmit the form. If face problem in submission please contact us with support team.') }}</p>
									<a href="{{ route('kyc-application') }}" class="btn btn-primary">{{ __t('Resubmit') }}</a>
								</div><!-- .status -->
								
							<?php }else if($kyc->status==1){ // processing ?>
							
								 <div class="status status-process">
									<div class="status-icon">
										<em class="ti ti-files"></em>
										<div class="status-icon-sm">
											<em class="ti ti-alarm-clock"></em>
										</div>
									</div>
									<span class="status-text">{{ __t('Your Application under Process for Verification.') }}</span>
									<p>{{ __t('We are still working on your identity verification. Once our team verified your identity, you will be whitelisted and notified by email.') }}</p>
								</div><!-- .status -->
								
							<?php } ?>
							
						<?php }else{ ?>
						
                        <h2 class="user-panel-title">{{ __t('Identity Verification - AML/KYC') }}</h2>
                        <p>{{ __t('To comply with regulation each participant will have to go through identity verification (AML/KYC). So please complete our fast and secure verification process to participate in our token sale. You can proceed from here to verify your identity and also you can check your application status if you submit already.') }} </p>
                        <div class="gaps-2x"></div>
                        <div class="status status-empty">
                            <div class="status-icon">
                                <em class="ti ti-files"></em>
                                <div class="status-icon-sm">
                                    <em class="ti ti-close"></em>
                                </div>
                            </div>
							<?php if(isset($kyc) > 0 && !empty($kyc) && $kyc->status==0){ ?>
							<span class="status-text">{{ __t('You have submitted your AML/KYC Application - status is pending') }} </span>
                            <a href="{{ route('kyc-application') }}" class="btn btn-primary">{{ __t('CLick to update') }}</a>
							<?php }else{ ?>
                            <span class="status-text">{{ __t('You have not submitted your AML/KYC Application') }}</span>
                            <a href="{{ route('kyc-application') }}" class="btn btn-primary">{{ __t('CLick to proceed') }}</a>
							<?php } ?>
                        </div>
                        <div class="note note-md note-info note-plane">
                            <em class="fas fa-info-circle"></em> 
                            <p>{{ __t('Some of countries and regions will not able to pass AML/KYC process and therefore are restricted from token sale.') }}</p>
                        </div>
						<?php } ?>
						
                    </div><!-- .user-kyc -->
                </div><!-- .user-content -->
           

			
    
    
@endsection