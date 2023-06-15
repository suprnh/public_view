@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $socila_links = unserialize($user_detail->social_links); ?>
            <div class="row">
            <p style="color:#FF3300;font-size:16px;">{{ Session::get('errmsg') !== null ? _tr(Session::get('errmsg')) : '' }} </p>  
            @if(Session::get('success') !== null)
            <div class="alert alert-success" style="text-align:center;">
                {{ _tr(Session::get('success')) }}
            </div>
            @endif 
            <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
        {{ _tr('Edit User') }}
        </h3>
        </div>
<div class="panel-body">
            {{ Form::open(array('url' => 'iamadmin/dashboard/edit-user' , 'method' => 'post' , 'enctype' => 'multipart/form-data')) }}
            
			<div class="form-group">
				<label>{{ _tr('Parent User') }} </label>
				<select class="form-control" name="parent" id="parent">
						<option value="0">{{ _tr('Select User') }}</option>
					<?php 
					$parent = get_parent_uid_by_id($user_detail->ID);
					if(!empty($users) && count($users) > 0){ 
						foreach($users as $user){ 
						?>
							<option value="<?php echo $user->ID; ?>" data-email="<?php echo $user->email; ?>" <?php if($parent==$user->ID){?> selected="selected" <?php }else if(old('parent') == $user->ID){ ?>selected="selected"<?php } ?>><?php echo $user->full_name; ?> ( <?php echo $user->email; ?> ) </option>
						<?php
						}
					}
					?>
				</select>
				 @if($errors->has('parent'))
				<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('parent')) }}</small></span>
				@endif
			</div>
			<?php /*
			<div class="form-group">
                <label>{{ _tr('Full Name') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="full_name" id="full_name" value="{{ $user_detail->full_name }}">
                @if($errors->has('full_name'))
                <span style="color:RED;"><small>{{ _tr($errors->first('full_name')) }}</small></span>
                @endif
            </div>
			*/ ?>
			
			<div class="form-group">
                <label>{{ _tr('First Name') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="{{ $user_detail->first_name }}">
                @if($errors->has('first_name'))
                <span style="color:RED;"><small>{{ _tr($errors->first('first_name')) }}</small></span>
                @endif
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Last Name') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="{{ $user_detail->last_name }}">
                @if($errors->has('last_name'))
                <span style="color:RED;"><small>{{ _tr($errors->first('last_name')) }}</small></span>
                @endif
            </div>

			<!--div class="form-group">
                <label>Surname:</label>
                <input class="form-control" type="text" name="surname" id="surname" value="{{ $user_detail->last_name }}">
                @if($errors->has('surname'))
                <span style="color:RED;"><small>{{$errors->first('surname')}}</small></span>
                @endif
            </div-->
			
            
            <div class="form-group">
                <label>{{ _tr('Email Address') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="user_email" id="user_email" value="{{ $user_detail->email }}">
                 @if($errors->has('user_email'))
                <span style="color:RED;"><small>{{ _tr($errors->first('user_email')) }}</small></span>
                @endif
            </div>
			<?php 
			if(!empty($user_detail->email_change_request)){ ?>
			<div class="form-group">
			<label>{{ _tr('Email address changed to ') }} <em><?php echo $user_detail->email_change_request; ?></em> {{ _tr(', but verification pending.') }}</label>
			</div>			
			<?php } ?>
            <!--div class="form-group">
                <label>Password:</label>
                <input class="form-control" type="password" name="user_password" id="user_password">
                 @if($errors->has('user_password'))
                <span style="color:RED;"><small>{{$errors->first('user_password')}}</small></span>
                @endif
            </div-->

            <div class="form-group">
                <label>{{ _tr('Mobile Number') }}:</label>
                <input class="form-control" type="text" name="user_phone" id="user_phone" value="{{ $user_detail->phone_no }}">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Date Of Birth') }}:</label>
                <input class="form-control datepicker" type="text" name="user_dob" id="user_dob" value="{{ $user_detail->date_of_birth }}">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Nationality') }}:</label>
                <select class="form-control" name="country" id="country">
					<option value="">{{ _tr('Select Country') }}</option>
                    <!--option value="us" <?php selected('us',$user_detail->country) ?>>United State</option>
					<option value="uk" <?php selected('uk',$user_detail->country) ?>>United KingDom</option>
					<option value="fr" <?php selected('fr',$user_detail->country) ?>>France</option>
					<option value="ch" <?php selected('ch',$user_detail->country) ?>>China</option>
					<option value="cr" <?php selected('cr',$user_detail->country) ?>>Czech Republic</option>
					<option value="cb" <?php selected('cb',$user_detail->country) ?>>Colombia</option-->
					
					
					<?php 
					$countries = get_country_lable();
					if(count($countries) > 0){
						foreach($countries as $ky=>$country){
							?>
							<option value="<?php echo $ky; ?>" <?php if(isset($user_detail)){ selected($ky,$user_detail->country); } ?>><?php echo $country; ?></option>
							<?php
						}
					}
					?>
                </select>
            </div>
           
		   <div class="form-group">
                <label>{{ _tr('Wallet Type') }}:</label>
                <select class="form-control" name="wallet_type" id="wallet_type">
                    <option value="eth" <?php selected('eth',$user_detail->wallet_type) ?>>Ethereum</option>
					<option value="ltc" <?php selected('ltc',$user_detail->wallet_type) ?>>LiteCoin</option>
					<option value="btc" <?php selected('btc',$user_detail->wallet_type) ?>>BitCoin</option>
                </select>
            </div>
			
			<?php /*<div class="form-group">
                <label>{{ _tr('Second Step Authentication') }}:</label>
                <select class="form-control" name="is_second_auth" id="is_second_auth">
                    <option value="0" <?php selected(0,$user_detail->is_second_auth) ?>>Disable</option>
					<option value="1" <?php selected(1,$user_detail->is_second_auth) ?>>Enable</option>
                </select>
            </div>*/ ?>
			
			<div class="form-group">
                <label>{{ _tr('Wallet Address') }}:</label>
                <input class="form-control" type="text" name="wallet_address" id="wallet_address" value="{{ $user_detail->wallet_address }}">
            </div>
			
            <div class="form-group">
                <label>{{ _tr('Status') }}</label>
                <select class="form-control" name="status" id="status">
                    <option value="1" <?php selected(1,$user_detail->status) ?>>Active</option>
                    <option value="0" <?php selected(0,$user_detail->status) ?>>Inactive</option>
                </select>
            </div>

           

            <input type="hidden" name="actioned" id="actioned" value="edit_user">
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save User') }}</button>
            <input type="hidden" name="id" id="id" value="{{ $user_detail->ID }}" >
			 <a href="{{ route('all-edcs') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Users') }}</a>
            
        {{ Form::close() }}
        </div>
             </div>
        </div>
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

$("#edc_slug").keyup(function(){
        var Text = string_to_slug($(this).val());
        $("#edc_slug").val(Text);        
});
</script>
@stop