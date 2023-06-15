@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('kyc_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('kyc_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('kyc_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('kyc_error')) }}</div>
                </div></div>
                @endif
				
				<?php
					if(!empty($users)){
						//echo "<pre>"; print_r($users); echo "</pre>";
					}
				?>
<div class="panel panel-default">
      
      <div class="panel-heading">
		<h3 class="panel-title"><?php if(!empty($kyc)) echo _tr("Edit AML/KYC Application"); else echo _tr("Add New AML/KYC Application"); ?>
		</h3>
</div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($kyc)) { ?> {{ route('update-kyc-application') }} <?php } else { ?> {{ route('save-kyc-application') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
				
					<?php if(empty($kyc)) { ?>
					<div class="form-group">
						<label>{{ _tr('Existing Users') }} <span class="required">*</span></label>
						<select class="form-control chosen-select" name="existing_user" id="existing_user">
						
								<option value="0">{{ _tr('Select User') }}</option>
								@if(count($users) > 0)
									
									@foreach($users as $user)
										<option value="{{ $user->ID }}" data-email="{{ $user->email }}" data-first_name="{{ $user->first_name }}" data-last_name="{{ $user->last_name }}" data-country="{{ $user->country }}" data-date_of_birth="{{ $user->date_of_birth }}" data-phone_no="{{ $user->phone_no }}" @if(old('existing_user') == $user->ID ) {{ 'selected' }} @endif >
											{{ $user->full_name }}( {{ $user->email }} ) 
										</option>
									@endforeach
								@endif
							<?php 
							/*if(!empty($users) && count($users) > 0){ 
								foreach($users as $user){ 
								?>
									<option value="<?php echo $user->ID; ?>" data-email="<?php echo $user->email; ?>" data-first_name="<?php echo $user->first_name; ?>" data-last_name="<?php echo $user->last_name; ?>" data-country="<?php echo $user->country; ?>" data-date_of_birth="<?php echo $user->date_of_birth; ?>" data-phone_no="<?php echo $user->phone_no; ?>" @if(old('existing_user') == ' $user->ID }}') {{ 'selected' }} @endif ><?php echo $user->full_name; ?> ( <?php echo $user->email; ?> ) </option>
								<?php
								}
							} */
							?>
						</select>
						@if($errors->has('user_id'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('user_id')) }}</small></span>
                        @endif
					</div>
					<?php } ?>

                    <div class="form-group">
                        <label>{{ _tr('First Name') }}<span class="required">*</span></label>
                        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php if(!empty($kyc)) echo $kyc->first_name; else { ?>{{ old('first_name') }}<?php } ?>">
                        @if($errors->has('first_name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('first_name')) }}</small></span>
                        @endif
                    </div>
					
					 <div class="form-group">
                        <label>{{ _tr('Last Name') }}<span class="required">*</span></label>
                        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php if(!empty($kyc)) echo $kyc->last_name; else { ?>{{ old('last_name') }}<?php } ?>">
                        @if($errors->has('last_name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('last_name')) }}</small></span>
                        @endif
                    </div>
					
					 <div class="form-group">
                        <label>{{ _tr('Email') }}<span class="required">*</span></label>
                        <input class="form-control" type="text" name="email" id="email" value="<?php if(!empty($kyc)) echo $kyc->email; else { ?>{{ old('email') }}<?php } ?>">
                        @if($errors->has('email'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('email')) }}</small></span>
                        @endif
                    </div>
					
					 <div class="form-group">
                        <label>{{ _tr('Phone Number') }}</label>
                        <input class="form-control" type="text" name="phone_number" id="phone_number" value="<?php if(!empty($kyc)) echo $kyc->phone_number; else { ?>{{ old('phone_number') }}<?php } ?>">
                        @if($errors->has('phone_number'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('phone_number')) }}</small></span>
                        @endif
                    </div>
					
					 <div class="form-group">
                        <label>{{ _tr('Date Of Birth (yyyy-mm-dd)') }}</label>
                        <input class="form-control datepicker" type="text" name="date_of_birth" id="date_of_birth" value="<?php if(!empty($kyc)) echo $kyc->date_of_birth; else { ?>{{ old('date_of_birth') }}<?php } ?>">
                        @if($errors->has('date_of_birth'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('date_of_birth')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
						<label>{{ _tr('Nationality') }}:</label>
						<select class="form-control" name="nationality" id="nationality">
							<option value="">{{ _tr('Select Country') }}</option>
							<!--option value="us" <?php if(!empty($kyc)) { selected('us',$kyc->nationality); } ?>>United State</option>
							<option value="uk" <?php if(!empty($kyc)) { selected('uk',$kyc->nationality); } ?>>United KingDom</option>
							<option value="fr" <?php if(!empty($kyc)) { selected('fr',$kyc->nationality); } ?>>France</option>
							<option value="ch" <?php if(!empty($kyc)) { selected('ch',$kyc->nationality); } ?>>China</option>
							<option value="cr" <?php if(!empty($kyc)) { selected('cr',$kyc->nationality); } ?>>Czech Republic</option>
							<option value="cb" <?php if(!empty($kyc)) { selected('cb',$kyc->nationality); } ?>>Colombia</option-->
							
							<?php 
							$countries = get_country_lable();
							if(count($countries) > 0){
								foreach($countries as $ky=>$country){
									?>
									<option value="<?php echo $ky; ?>" <?php if(isset($kyc)){ selected($ky,$kyc->nationality); } ?>><?php echo $country; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
			
					<div class="form-group">
                        <label>{{ _tr('Address 1') }}<span class="required">*</span></label>
                        <input class="form-control" type="text" name="address1" id="address1" value="<?php if(!empty($kyc)) echo $kyc->address1; else { ?>{{ old('address1') }}<?php } ?>">
                        @if($errors->has('address1'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('address1')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Address 2') }}</label>
                        <input class="form-control" type="text" name="address2" id="address2" value="<?php if(!empty($kyc)) echo $kyc->address2; else { ?>{{ old('address2') }}<?php } ?>">
                        @if($errors->has('address2'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('address2')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('City') }}<span class="required">*</span></label>
                        <input class="form-control" type="text" name="city" id="city" value="<?php if(!empty($kyc)) echo $kyc->city; else { ?>{{ old('city') }}<?php } ?>">
                        @if($errors->has('city'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('city')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Zipcode') }}<span class="required">*</span></label>
                        <input class="form-control" type="text" name="zipcode" id="zipcode" value="<?php if(!empty($kyc)) echo $kyc->zipcode; else { ?>{{ old('zipcode') }}<?php } ?>">
                        @if($errors->has('zipcode'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('zipcode')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Telegram Username') }}</label>
                        <input class="form-control" type="text" name="telegram_username" id="telegram_username" value="<?php if(!empty($kyc)) echo $kyc->telegram_username; else { ?>{{ old('telegram_username') }}<?php } ?>">
                        @if($errors->has('telegram_username'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('telegram_username')) }}</small></span>
                        @endif
                    </div>
					
					<?php //echo "<pre>"; print_r($kyc); "</pre>";?>
                    
					<div class="form-group">
						<label>{{ _tr('Document Type') }}<span class="required">*</span></label>
						<select class="form-control" name="document_type" id="document_type">
							<option value="">{{ _tr('Document Type') }}</option>
							<option value="passport" <?php if(!empty($kyc)) { selected('passport',$kyc->document_type); }?> @if(old('document_type') == 'passport') {{ 'selected' }} @endif >Passport</option>
							<option value="national-card" <?php if(!empty($kyc)) { selected('national-card',$kyc->document_type); } ?>@if(old('document_type') == 'national-card') {{ 'selected' }} @endif >National Card</option>
							<option value="driver-licence" <?php if(!empty($kyc)) { selected('driver-licence',$kyc->document_type); } ?>@if(old('document_type') == 'driver-licence') {{ 'selected' }} @endif >Driver’s License</option>
						</select>
						@if($errors->has('document_type'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('document_type')) }}</small></span>
                        @endif
					</div>
					<?php if(!empty($kyc) && $kyc->document_upload_id != 0) { $display = "block"; ?>
					
					<?php }else{
						$display = "none";
					} ?>
					
					<div id="doc" style="display:<?php echo $display;?>;">
						<div class="form-group">
						<label id="doc_label"></label>
						<input type="file" name="kyc_img">
						</div>

						<?php if(!empty($kyc) && $kyc->document_upload_id != 0) { ?>
						<div class="form-group">
							<a href="<?php echo get_recource_url($kyc->document_upload_id); ?>" target="_blank">{{ _tr('View Document') }}</a><br/>
							<input type="checkbox" name="del_img" value="yes"> {{ _tr('Remove Document') }}
						</div>
						<?php } ?>
					</div>
					<?php if(!empty($kyc) && $kyc->document_upload_id_2 != 0) { $display = "block"; ?>
					
					<?php }else{
						$display = "none";
					} ?>
					<div id="doc2" style="display:<?php echo $display;?>;">
						<div class="form-group">
							<label>{{ _tr('Upload National Card Back Side') }}</label>
							<input type="file" name="kyc_img_2">
						</div>

						<?php if(!empty($kyc) && $kyc->document_upload_id_2 != 0) { ?>
						<div class="form-group">
							<a href="<?php echo get_recource_url($kyc->document_upload_id_2); ?>" target="_blank">{{ _tr('View Document') }}</a><br/>
							<input type="checkbox" name="del_img_2" value="yes"> Remove Document
						</div>
						<?php } ?>
					</div>
					
					<?php /*
					<div class="form-group">
						<label>Wallet Type:</label>
						<select class="form-control" name="wallet_type" id="wallet_type">
							<option value="">Choose Wallet type</option>
							<option value="eth" <?php if(!empty($kyc)) { selected('eth',$kyc->wallet_type); } ?>>Ethereum</option>
							<option value="ltc" <?php if(!empty($kyc)) { selected('ltc',$kyc->wallet_type); } ?>>LiteCoin</option>
							<option value="btc" <?php if(!empty($kyc)) { selected('btc',$kyc->wallet_type); } ?>>BitCoin</option>
						</select>
					</div>
					
					<div class="form-group">
                        <label>Wallet Address</label>
                        <input class="form-control" type="text" name="wallet_address" id="wallet_address" value="<?php if(!empty($kyc)) echo $kyc->wallet_address; else { ?>{{ old('wallet_address') }}<?php } ?>">
                        @if($errors->has('wallet_address'))
                        <span style="color:RED;"><small>{{$errors->first('wallet_address')}}</small></span>
                        @endif
                    </div>
					*/ ?>
			

                   

                <div class="form-group">
                    <label>{{ _tr('Status') }}</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0" <?php if(!empty($kyc) && $kyc->status == 0) { ?> selected="selected" <?php } ?>>Pending</option>
                        <option value="1" <?php if(!empty($kyc) && $kyc->status == 1) { ?> selected="selected" <?php } ?>>Processing</option>
                        <option value="2" <?php if(!empty($kyc) && $kyc->status == 2) { ?> selected="selected" <?php } ?>>Rejected</option>
                        <option value="3" <?php if(!empty($kyc) && $kyc->status == 3) { ?> selected="selected" <?php } ?>>Information Missing</option>
                        <option value="4" <?php if(!empty($kyc) && $kyc->status == 4) { ?> selected="selected" <?php } ?>>Verified</option>
                    </select>
                </div>

               
					<div class="form-group">
                        <label>{{ _tr('Remarks') }}</label>
                        <input class="form-control" type="text" name="rejection_cause" id="rejection_cause" value="<?php if(!empty($kyc)) echo $kyc->rejection_cause; else { ?>{{ old('telegram_username') }}<?php } ?>">
                        @if($errors->has('rejection_cause'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('rejection_cause')) }}</small></span>
                        @endif
                    </div>

               


                <div class="form-group">
                    <?php if(!empty($kyc)) { ?>
                    <input type="submit" name="update_kyc" value="{{ _tr('Save Application') }}" class="btn btn-primary btn-sm-block">
                    <input type="hidden" name="kyc_id" value="<?php echo $kyc->ID; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $kyc->user_id; ?>">
                    <input type="hidden" name="prev_document_upload_id" value="<?php echo $kyc->document_upload_id; ?>">
                    <input type="hidden" name="prev_document_upload_id_2" value="<?php echo $kyc->document_upload_id_2; ?>">
                    
                    <?php } else { ?>
					<input type="hidden" name="user_id" id="user_id">
                    <input type="submit" name="create_application" value="{{ _tr('Create Application') }}" class="btn btn-primary btn-sm-block">
                    <?php } ?>
					<a href="{{ route('all-kyc-applications') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Applications') }}</a>
                </div>      

                </form>
				</div>
			</div>
			
	<script>
		//$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
		//$('.chosen-select').chosen({ parser_config : { copy_data_attributes : true } });
		/*$('.chosen').chosen({
			disable_search_threshold: 15,
			inherit_select_classes: true,
			no_results_text: "No se encontraron resultados para ",
			width: "100%",
			parser_config: { copy_data_attributes: true }
		});*/
	</script>
<script>
function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}

$("#slug").keyup(function(){
        var Text = string_to_slug($(this).val());
        $("#slug").val(Text);        
});

$(function () {
	$( "#document_type" ).change(function() {
		
		var document_type = $( "#document_type" ).val();
		
		//alert(document_type);
		if(document_type == 'passport'){
			$( "#doc" ).show();
			$( "#doc2" ).hide();
			$( "label#doc_label" ).text("Upload Passport");
		}else if(document_type == 'national-card'){
			$( "#doc" ).show();
			$( "#doc2" ).show();
			$( "label#doc_label" ).text("Upload National Card Front Side");
		}else if(document_type == 'driver-licence'){
			$( "#doc" ).show();
			$( "#doc2" ).hide();
			$( "label#doc_label" ).text("Upload Driver Licence");
		}else{
			$( "#doc" ).hide();
			$( "#doc2" ).hide();
		}
	});
	
	$( "#existing_user" ).change(function() {
		var existing_user_id = $( "#existing_user" ).val();
		//$( "#doc" ).hide();
		//var email = $(this).data("email");
		//var first_name = $(this).data("first_name");
		var email = $(this).find(':selected').data('email');
		var first_name = $(this).find(':selected').data('first_name');
		var last_name = $(this).find(':selected').data('last_name');
		var country = $(this).find(':selected').data('country');
		var date_of_birth = $(this).find(':selected').data('date_of_birth');
		var phone_no = $(this).find(':selected').data('phone_no');
		
		//alert(first_name);
		$( "#user_id" ).val(existing_user_id);
		
		$( "#first_name" ).val(first_name);
		$( "#last_name" ).val(last_name);
		$( "#email" ).val(email);
		$( "#phone_number" ).val(phone_no);
		$( "#date_of_birth" ).val(date_of_birth);
		$( "#nationality" ).val(country);
		
	});
});

$(function () {
    $("#document_type").change();
    $("#existing_user").change();
});
</script>
@stop