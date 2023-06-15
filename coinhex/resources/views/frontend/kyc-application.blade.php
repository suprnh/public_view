<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
            <div class="user-content">
                    <div class="user-kyc">
						<?php
						$cur_status = current_kyc_status();
						if($cur_status==0 || $cur_status==1){
						?>
						<div id="css_block_overlay">
						<div id="over_lay_text">You have submitted the form. Now it's under the process. So, you can not edit at this moment.</div>
						</div>
						<?php } ?>
                        <form action="{{ route('post-kyc') }}" method="post" enctype="multipart/form-data" id="submit_application" name="submit_application" onSubmit="if(!return confirm('After submission of this form, you would not be able to edit this form. Please confirm before submission')){return false;}">
							{{ csrf_field() }}
                            <div class="from-step">
                                <div class="from-step-item">
                                    <div class="from-step-heading">
                                        <div class="from-step-number">01</div>
                                        <div class="from-step-head">
                                            <h4>{{ __t('Step 1') }} : {{ __t('Personal Details') }}</h4>
                                            <p>{{ __t('Simple personal information, required for identification') }}</p>
                                        </div>
                                    </div>
                                    <div class="from-step-content">
                                        
										@include('frontend.section.msg')
										
										<div class="note note-md note-info note-plane">
                                            <em class="fas fa-info-circle"></em> 
                                            <p>{{ __t('Please carefully fill out the form with your personal details. You can’t edit these details once you submitted the form.') }}</p>
                                        </div>
										
                                        <div class="gaps-2x"></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="first-name" class="input-item-label">{{ __t('First Name') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="first-name" name="first_name" value="<?php if(!empty($kyc)) echo $kyc->first_name; else if(!empty(old('first_name'))){ ?>{{ old('first_name') }}<?php }else{ echo $udetail->first_name; }?>" maxlength="20">
													 @if($errors->has('first_name'))
													 <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('first_name')) }}</small></span>
													 @endif
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="last-name" class="input-item-label">{{ __t('Last Name') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="last-name" name="last_name" value="<?php if(!empty($kyc)) echo $kyc->last_name; else if(!empty(old('last_name'))){ ?>{{ old('last_name') }}<?php }else{ echo $udetail->last_name; }?>" maxlength="20">
													@if($errors->has('last_name'))
													 <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('last_name')) }}</small></span>
													 @endif
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="email-address" class="input-item-label">{{ __t('Email Address') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="email-address" disabled="disabled" name="email_address" value="<?php if(!empty($kyc)) echo $kyc->email; else if(!empty(old('email_address'))) { ?>{{ old('email_address') }}<?php }else{ echo $udetail->email; }?>" maxlength="30">
													@if($errors->has('email_address'))
													 <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('email_address')) }}</small></span>
													 @endif
													<input type="hidden" name="email_address" value="<?php if(!empty($kyc)){ echo $kyc->email;  }else{ echo $udetail->email; }?>">
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="phone-number" class="input-item-label">{{ __t('Phone Number') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="phone-number" name="phone_number" value="<?php if(!empty($kyc)) echo $kyc->phone_number; else if(!empty(old('phone_number'))) { ?>{{ old('phone_number') }}<?php }else{ echo $udetail->phone_no; } ?>" maxlength="13">
													@if($errors->has('phone_number'))
													 <span style="color:RED;" class="err_msg"><small>{{  __t($errors->first('phone_number')) }}</small></span>
													 @endif
												</div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="date-of-birth" class="input-item-label">{{ __t('Date of Birth') }} (yyyy-mm-dd)<sup>*</sup></label>
                                                    <input class="input-bordered date-picker" type="text" id="date-of-birth" name="date_of_birth" value="<?php if(isset($kyc)){ if($kyc->date_of_birth=='0000-00-00'){ echo ''; }else{ echo $kyc->date_of_birth; } }else{ if(!empty(old('date_of_birth'))){ echo old('date_of_birth'); }else{ if($udetail->date_of_birth=='0000-00-00'){ echo ''; }else{ echo $udetail->date_of_birth; } } } ?>">
													@if($errors->has('date_of_birth'))
													 <span style="color:RED;" class="err_msg"><small>{{  __t($errors->first('date_of_birth')) }}</small></span>
													 @endif
												</div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="nationality" class="input-item-label">{{ __t('Nationality') }}<sup>*</sup></label>
                                                    <select class="country-select" name="Nationality" id="Nationality">
														<option value="">{{ __t('Select Nationality') }}</option>
														<?php 
														$countries = get_country_lable();
														if(count($countries) > 0){
															foreach($countries as $ky=>$country){
																?>
																<option value="<?php echo $ky; ?>" <?php if(!empty(old('Nationality'))){ selected($ky,old('Nationality')); }else{ if(isset($kyc)){ selected($ky,$kyc->nationality); }else{ selected($ky,$udetail->country); } } ?>><?php echo $country; ?></option>
																<?php
															}
														}
														?>
                                                    </select>
													@if($errors->has('Nationality'))
													 <span style="color:RED;" class="err_msg"><small>{{  __t($errors->first('Nationality')) }}</small></span>
													 @endif
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="address-line-1" class="input-item-label">{{ __t('Address Line 1') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="address-line-1" name="address_line_1" value="<?php if(!empty($kyc)) echo $kyc->address1; else { ?>{{ old('address_line_1') }}<?php } ?>">
													@if($errors->has('address_line_1'))
													 <span style="color:RED;" class="err_msg"><small>{{  __t($errors->first('address_line_1')) }}</small></span>
													 @endif
												</div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="address-line-2" class="input-item-label">{{ __t('Address Line 2') }} <span>{{ __t('(optional)') }}</span></label>
                                                    <input class="input-bordered" type="text" id="address-line-2" name="address_line_2" value="<?php if(!empty($kyc)) echo $kyc->address2; else { ?>{{ old('address_line_2') }}<?php } ?>">
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="email-address" class="input-item-label">{{ __t('City of Residence') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="city" name="city" value="<?php if(!empty($kyc)) echo $kyc->city; else { ?>{{ old('city') }}<?php } ?>" maxlength="20">
													@if($errors->has('city'))
													 <span style="color:RED;" class="err_msg"><small>{{  __t($errors->first('city')) }}</small></span>
													 @endif
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="phone-number" class="input-item-label">{{ __t('Zip Code') }}<sup>*</sup></label>
                                                    <input class="input-bordered" type="text" id="zip" name="zip" value="<?php if(!empty($kyc)) echo $kyc->zipcode; else { ?>{{ old('zip') }}<?php } ?>" maxlength="10">
													@if($errors->has('zip'))
													 <span style="color:RED;" class="err_msg"><small>{{  __t($errors->first('zip')) }}</small></span>
													@endif
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="input-item input-with-label">
                                                    <label for="phone-number" class="input-item-label">{{ __t('Telegram Username') }} <span>{{ __t('(optional)') }}</span></label>
                                                    <input class="input-bordered" type="text" id="telegram_uname" name="telegram_uname" value="<?php if(!empty($kyc)) echo $kyc->telegram_username; else { ?>{{ old('telegram_uname') }}<?php } ?>" maxlength="40">
                                                </div><!-- .input-item -->
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div><!-- .from-step-content -->
                                </div><!-- .from-step-item -->
                                <div class="from-step-item">
                                    <div class="from-step-heading">
                                        <div class="from-step-number">02</div>
                                        <div class="from-step-head">
                                            <h4>{{ __t('Step 2') }} : {{ __t('Identity Verify') }}</h4>
                                            <p>{{ __t('Upload documents to verify your identity.') }}</p>
                                        </div>
                                    </div>
									<?php 
									$old_doc_type = old('document_type');
									$active_tab = '';
									if(!isset($old_doc_type) && !isset($kyc)){
										$active_tab = 'passport';
									}
									?>
                                    <div class="from-step-content">
                                        <div class="note note-md note-info note-plane">
                                            <em class="fas fa-info-circle"></em> 
                                            <p>{{ __t('Please upload any of the following personal document (image or pdf file only).') }}</p>
											@if($errors->has('document_type'))
												<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('document_type')) }}</small></span>
											@endif
                                        </div>
                                        <div class="gaps-2x"></div>
                                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist" id="document_tab">
                                            <li class="nav-item">
                                                <a class="nav-link <?php if(isset($old_doc_type)){ if($old_doc_type=='passport'){  echo 'show active'; }else{ echo ''; } }else{ if(isset($kyc) && !empty($kyc) && $kyc->document_type=='passport'){ echo 'active'; }else{ echo ''; } } if($active_tab=='passport'){ echo 'active'; }?>" data-toggle="tab" href="#passport" data-id="passport" >
                                                    <div class="nav-tabs-icon">
                                                        <img src="{{ url('/public/frontend/dashboard/images/icon-passport.png') }}" alt="icon">
                                                        <img src="{{ url('/public/frontend/dashboard/images/icon-passport-color.png') }}" alt="icon">
                                                    </div>
                                                    <span>{{ __t('Passport') }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if(isset($old_doc_type)){ if($old_doc_type=='national-card'){  echo 'show active'; }else{ echo ''; } }else{ if(isset($kyc) && !empty($kyc) && $kyc->document_type=='national-card'){ echo 'active'; }else{ echo ''; } }?>" data-toggle="tab" href="#national-card" data-id="national-card">
                                                    <div class="nav-tabs-icon">
                                                        <img src="{{ url('/public/frontend/dashboard/images/icon-national-id.png') }}" alt="icon">
                                                        <img src="{{ url('/public/frontend/dashboard/images/icon-national-id-color.png') }}" alt="icon">
                                                    </div>
                                                    <span>{{ __t('National Card') }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if(isset($old_doc_type)){ if($old_doc_type=='driver-licence'){  echo 'show active'; }else{ echo ''; } }else{ if(isset($kyc) && !empty($kyc) && $kyc->document_type=='driver-licence'){ echo 'active'; }else{ echo ''; } }?>" data-toggle="tab" href="#driver-licence" data-id="driver-licence">
                                                    <div class="nav-tabs-icon">
                                                        <img src="{{ url('/public/frontend/dashboard/images/icon-licence.png') }}" alt="icon">
                                                        <img src="{{ url('/public/frontend/dashboard/images/icon-licence-color.png') }}" alt="icon">
                                                    </div>
                                                    <span>{{ __t('Driver’s License') }}</span>
                                                </a>
                                            </li>
                                        </ul><!-- .nav-tabs-line -->
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade <?php if(isset($old_doc_type)){ if($old_doc_type=='passport'){  echo 'show active'; }else{ echo ''; } }else{ if(isset($kyc) && !empty($kyc) && $kyc->document_type=='passport'){ echo 'show active'; }else{ echo ''; } } if($active_tab=='passport'){ echo 'show active'; }?>" id="passport">
                                                <h5 class="kyc-upload-title">{{ __t('To avoid delays when verifying account, Please make sure bellow') }}:</h5>
                                                <ul class="kyc-upload-list">
                                                    <li>{{ __t('Chosen credential must not be expired.') }}</li>
                                                    <li>{{ __t('Document should be good condition and clearly visible.') }}</li>
                                                    <li>{{ __t('Make sure that there is no light glare on the card.') }}</li>
                                                </ul>
                                                <div class="gaps-4x"></div>
                                                <span class="upload-title">{{ __t('Upload Here Your Passport Copy') }}</span>
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="upload-box">
                                                            <div class="upload-zone">
                                                                <div class="dz-message" data-dz-message>
                                                                    <span class="dz-message-text">{{ __t('Drag and drop file') }}</span>
                                                                    <span class="dz-message-or">{{ __t('or') }}</span>
                                                                    <button class="btn btn-primary" type="button">{{ __t('SELECT') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
														@if($errors->has('document_id_passport'))
															<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('document_id_passport')) }}</small></span>
														@endif
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="kyc-upload-img">
															<?php 
															if(!empty(old('document_id_passport'))){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url(old('document_id_passport')); ?>');">{{ __t('View') }}</button>
															<?php
															}else if(isset($kyc) && !empty($kyc) && $kyc->document_type=='passport' && $kyc->document_upload_id > 0){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url($kyc->document_upload_id); ?>');">{{ __t('View') }}</button>
															<?php
															}else{ 
															?>
																<img src="{{ url('/public/frontend/dashboard/images/vector-passport.png') }}" alt="vector">
															<?php 
															}
															?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gaps-1x"></div>
                                            </div>
                                            <div class="tab-pane fade <?php if(isset($old_doc_type)){ if($old_doc_type=='national-card'){  echo 'show active'; }else{ echo ''; } }else{ if(isset($kyc) && !empty($kyc) && $kyc->document_type=='national-card'){ echo 'show active'; }else{ echo ''; } }?>" id="national-card">
                                                <h5 class="kyc-upload-title">{{ __t('To avoid delays when verifying account, Please make sure bellow') }}:</h5>
                                                <ul class="kyc-upload-list">
                                                    <li>{{ __t('Chosen credential must not be expired.') }}</li>
                                                    <li>{{ __t('Document should be good condition and clearly visible.') }}</li>
                                                    <li>{{ __t('Make sure that there is no light glare on the card.') }}</li>
                                                </ul>
                                                <div class="gaps-4x"></div>
                                                <span class="upload-title">{{ __t('Upload Here Your National id Front Side') }}</span>
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="upload-box">
                                                            <div class="upload-zone" id="frontside">
                                                                <div class="dz-message" data-dz-message>
                                                                    <span class="dz-message-text">{{ __t('Drag and drop file') }}</span>
                                                                    <span class="dz-message-or">{{ __t('or') }}</span>
                                                                    <button class="btn btn-primary" type="button">{{ __t('SELECT') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
														@if($errors->has('document_id_national-card_1'))
															<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('document_id_national-card_1')) }}</small></span>
														@endif
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="kyc-upload-img">
                                                            <?php 
															if(!empty(old('document_id_national-card_1'))){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url(old('document_id_national-card_1')); ?>');">{{ __t('View') }}</button>
															<?php
															}else if(isset($kyc) && !empty($kyc) && $kyc->document_type=='national-card' && $kyc->document_upload_id > 0){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url($kyc->document_upload_id); ?>');">{{ __t('View') }}</button>
															<?php
															}else{ 
															?>
																<img src="{{ url('/public/frontend/dashboard/images/vector-passport.png') }}" alt="vector">
															<?php 
															}
															?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gaps-3x"></div>
                                                <span class="upload-title">{{ __t('Upload Here Your National id Back Side') }}</span>
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="upload-box">
                                                            <div class="upload-zone" id="backside">
                                                                <div class="dz-message" data-dz-message>
                                                                    <span class="dz-message-text">{{ __t('Drag and drop file') }}</span>
                                                                    <span class="dz-message-or">{{ __t('or') }}</span>
                                                                    <button class="btn btn-primary" type="button">{{ __t('SELECT') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
														@if($errors->has('document_id_national-card_2'))
															<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('document_id_national-card_2')) }}</small></span>
														@endif
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="kyc-upload-img">
                                                            <?php 
															if(!empty(old('document_id_national-card_2'))){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url(old('document_id_national-card_2')); ?>');">{{ __t('View') }}</button>
															<?php
															}else if(isset($kyc) && !empty($kyc) && $kyc->document_type=='national-card' && $kyc->document_upload_id_2 > 0){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url($kyc->document_upload_id_2); ?>');">{{ __t('View') }}</button>
															<?php
															}else{ 
															?>
																<img src="{{ url('/public/frontend/dashboard/images/vector-passport.png') }}" alt="vector">
															<?php 
															}
															?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gaps-1x"></div>
                                            </div>
                                            <div class="tab-pane fade <?php if(isset($old_doc_type)){ if($old_doc_type=='driver-licence'){  echo 'show active'; }else{ echo ''; } }else{ if(isset($kyc) && !empty($kyc) && $kyc->document_type=='driver-licence'){ echo 'show active'; }else{ echo ''; } }?>" id="driver-licence">
                                                <h5 class="kyc-upload-title">{{ __t('To avoid delays when verifying account, Please make sure bellow') }}:</h5>
                                                <ul class="kyc-upload-list">
                                                    <li>{{ __t('Chosen credential must not be expired.') }}</li>
                                                    <li>{{ __t('Document should be good condition and clearly visible.') }}</li>
                                                    <li>{{ __t('Make sure that there is no light glare on the card.') }}</li>
                                                </ul>
                                                <div class="gaps-4x"></div>
                                                <span class="upload-title">{{ __t('Upload Here Your Driving Licence Copy') }}</span>
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="upload-box">
                                                            <div class="upload-zone">
                                                                <div class="dz-message" data-dz-message>
                                                                    <span class="dz-message-text">{{ __t('Drag and drop file') }}</span>
                                                                    <span class="dz-message-or">{{ __t('or') }}</span>
                                                                    <button class="btn btn-primary" type="button">{{ __t('SELECT') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
														@if($errors->has('document_id_driver-licence'))
															<span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('document_id_driver-licence')) }}</small></span>
														@endif
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="kyc-upload-img">
                                                            <?php 
															if(!empty(old('document_id_driver-licence'))){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url(old('document_id_driver-licence')); ?>');">{{ __t('View') }}</button>
															<?php
															}else if(isset($kyc) && !empty($kyc) && $kyc->document_type=='driver-licence' && $kyc->document_upload_id > 0){
															?>
															<button class="btn btn-primary" type="button" onclick="window.open('<?php echo get_recource_url($kyc->document_upload_id); ?>');">{{ __t('View') }}</button>
															<?php
															}else{ 
															?>
																<img src="{{ url('/public/frontend/dashboard/images/vector-passport.png') }}" alt="vector">
															<?php 
															}
															?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gaps-1x"></div>
                                            </div>
                                        </div>
                                        <div class="gaps-2x"></div>
										  <div class="input-item text-left">
												<?php 
												$terms_conditions = get_settings('terms_conditions');
												$privacy_policy = get_settings('privacy_policy');
												?>
												<input type="checkbox" name="aggrement" id="aggrement" class="input-checkbox" value="1">
                                                <label for="aggrement">{{ __t('I confirm that I have read, understood and agreed to the') }} <a href="<?php echo get_recource_url($privacy_policy); ?>" style="color: #fd9900;" target="_blank">{{ __t('Privacy Policy') }}</a> {{ __t('and') }} <a href="<?php echo get_recource_url($terms_conditions); ?>" target="_blank" style="color: #fd9900;">{{ __t('Terms & Conditions') }}</a>.</label>
                                          </div>
										   @if($errors->has('aggrement'))
										  <span style="color:RED;" class="err_msg"><small>{{ __t($errors->first('aggrement')) }}</small></span>
										  <div style="clear:both;"></div>
										  @endif
                                            <div class="gaps-1x"></div>
											<input name="document_type" type="hidden" id="document_type" value="<?php if(isset($old_doc_type)){ if(!empty($old_doc_type)){  echo $old_doc_type; }else{ echo $active_tab; } }else{ if(isset($kyc) && !empty($kyc)){ echo $kyc->document_type; }else{ echo $active_tab; } } ?>">
											
											<input name="document_id_passport" type="hidden" id="document_id_passport" value="<?php if(isset($kyc) && !empty($kyc) && $kyc->document_type=='passport'){ echo $kyc->document_upload_id; }else{ if(!empty(old('document_id_passport'))){ echo old('document_id_passport'); }else{ echo 0; } } ?>">
											<input name="document_id_national-card_1" type="hidden" id="document_id_national-card_1" value="<?php if(isset($kyc) && !empty($kyc) && $kyc->document_type=='national-card'){ echo $kyc->document_upload_id; }else{ if(!empty(old('document_id_national-card_1'))){ echo old('document_id_national-card_1'); }else{ echo 0; } } ?>">
											<input name="document_id_national-card_2" type="hidden" id="document_id_national-card_2" value="<?php if(isset($kyc) && !empty($kyc) && $kyc->document_type=='national-card'){ echo $kyc->document_upload_id_2; }else{ if(!empty(old('document_id_national-card_2'))){ echo old('document_id_national-card_2'); }else{ echo 0; } } ?>">
											<input name="document_id_driver-licence" type="hidden" id="document_id_driver-licence" value="<?php if(isset($kyc) && !empty($kyc) && $kyc->document_type=='driver-licence'){ echo $kyc->document_upload_id; }else{ if(!empty(old('document_id_driver-licence'))){ echo old('document_id_driver-licence'); }else{ echo 0; } } ?>">
											
											
											<input type="hidden" name="kyc_id" id="kyc_id" value="<?php if(isset($kyc) && !empty($kyc) && ($kyc->status==0)){ echo $kyc->ID; }else{ echo 0; } ?>">
											
                                        <a class="btn btn-primary kyc_submit" href="javascript:void(0)"  data-toggle="modal" data-target="#kycConfirm">{{ __t('Submit Details') }}</a>
                                    </div><!-- .from-step-content -->
                                   
                                </div><!-- .from-step-item -->
                                
                            </div><!-- .from-step -->
                        </form>
                    </div><!-- .user-kyc -->
                </div><!-- .user-content -->
            
           

	<div class="modal fade" id="kycConfirm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="kyc-popup">
                    <h2 class="text-center">Confirm Information</h2>
					<?php /*
                    <div class="input-item">
                        <!--input class="input-checkbox" id="term-condition" type="checkbox"-->
                        <label for="term-condition">I have read the <a href="<?php echo get_recource_url($terms_conditions); ?>" target="_blank">Terms of Condition</a> and <a href="<?php echo get_recource_url($privacy_policy); ?>" target="_blank">Privacy Policy.</a></label>
                    </div>
					*/ ?>
                    <div class="input-item">
                        <!--input class="input-checkbox" id="info-currect" type="checkbox"-->
                       <div class="text-center"> <label for="info-currect">Recheck the information you have entered</label></div>
                    </div>
                    <div class="gaps-2x"></div>
                    <div class="text-center">
					<a href="javascript:void(0)" onclick="jQuery('#submit_application').submit();" class="btn btn-primary">{{ __t('Confirm') }}</a>
					<a href="javascript:void(0)" onclick="jQuery('#kycConfirm').modal('hide');" class="btn btn-primary">{{ __t('Cancel') }}</a></div>
                </div><!-- .modal-content -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- Modal End -->
			
    
    
@endsection