@extends('admin.layout.leftbar')
@section('dashboard')

            <p style="color:#FF3300;font-size:16px;">{{ Session::get('errmsg') !== null ? _tr(Session::get('errmsg'))  : '' }} </p>  
           
            {{ Form::open(array('url' => 'iamadmin/dashboard/add-user' , 'method' => 'post' , 'enctype' => 'multipart/form-data')) }}
            <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
        {{ _tr('Add User') }}
        </h3>
        </div>
<div class="panel-body">
			<div class="form-group">
				<label>{{ _tr('Parent User') }}</label>
				<select class="form-control" name="parent" id="parent">
						<option value="0">{{ _tr('Select User') }}</option>
					<?php 
					if(!empty($users) && count($users) > 0){ 
						foreach($users as $user){ 
						?>
							<option value="<?php echo $user->ID; ?>" data-email="<?php echo $user->email; ?>" <?php if(old('parent') == $user->ID){ ?>selected="selected"<?php } ?>><?php echo $user->full_name; ?> ( <?php echo $user->email; ?> ) </option>
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
                <input class="form-control" type="text" name="full_name" id="full_name" value="{{ old('full_name') }}">
                @if($errors->has('full_name'))
                <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('full_name')) }}</small></span>
                @endif
            </div>
			*/ ?>
			
			 <div class="form-group">
                <label>{{ _tr('First Name') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                @if($errors->has('first_name'))
                <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('first_name')) }}</small></span>
                @endif
            </div>
			
			 <div class="form-group">
                <label>{{ _tr('Last Name') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
                @if($errors->has('last_name'))
                <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('last_name')) }}</small></span>
                @endif
            </div>
			
			
				
			<!--div class="form-group">
                <label>Surname:</label>
                <input class="form-control" type="text" name="surname" id="surname" value="{{ old('surname') }}">
                @if($errors->has('surname'))
                <span style="color:RED;"><small>{{$errors->first('surname')}}</small></span>
                @endif
            </div-->
			
            
            <div class="form-group">
                <label>{{ _tr('Email Address') }}<span class="required">*</span>:</label>
                <input class="form-control" type="text" name="user_email" id="user_email" value="{{ old('user_email') }}">
                 @if($errors->has('user_email'))
                <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('user_email')) }}</small></span>
                @endif
            </div>

            <!--div class="form-group">
                <label>{{ _tr('Password') }}:</label>
                <input class="form-control" type="password" name="user_password" id="user_password">
                 @if($errors->has('user_password'))
                <span style="color:RED;"><small>{{ _tr($errors->first('user_password')) }}</small></span>
                @endif
            </div-->

            <div class="form-group">
                <label>{{ _tr('Mobile Number') }}:</label>
                <input class="form-control" type="text" name="user_phone" id="user_phone" value="{{ old('user_phone') }}">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Date Of Birth') }}:</label>
                <input class="form-control datepicker" type="text" name="user_dob" id="user_dob" value="{{ old('user_dob') }}">
            </div>
			
			
			<div class="form-group">
                <label>{{ _tr('Nationality') }}:</label>
                <select class="form-control" name="country" id="country">
					<option value="">{{ _tr('Select Country') }}</option>
                    <!--option value="us">United State</option>
					<option value="uk">United KingDom</option>
					<option value="fr">France</option>
					<option value="ch">China</option>
					<option value="cr">Czech Republic</option>
					<option value="cb">Colombia</option-->
					
					<?php 
					$countries = get_country_lable();
					if(count($countries) > 0){
						foreach($countries as $ky=>$country){
							?>
							<option value="<?php echo $ky; ?>"><?php echo $country; ?></option>
							<?php
						}
					}
					?>
                </select>
            </div>
           
		   <div class="form-group">
                <label>{{ _tr('Wallet Type') }}:</label>
                <select class="form-control" name="wallet_type" id="wallet_type">
                    <option value="eth">Ethereum</option>
					<option value="ltc">LiteCoin</option>
					<option value="bic">BitCoin</option>
                </select>
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Wallet Address') }}:</label>
                <input class="form-control" type="text" name="wallet_address" id="wallet_address" value="{{ old('wallet_address') }}">
            </div>

            <div class="form-group">
                <label>{{ _tr('Status') }}:</label>
                <select class="form-control" name="status" id="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            

            <input type="hidden" name="actioned" id="actioned" value="add_user">
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Add User') }}</button>
			 <a href="{{ route('all-edcs') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Users') }}</a>
             </div>
            </div>
        {{ Form::close() }}

            
@stop