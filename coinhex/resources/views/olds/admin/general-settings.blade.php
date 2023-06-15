@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $settings = get_settings(); ?>
            @if (Session::has('success'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-success">{{ _tr(Session::get('success')) }}</div>
            </div></div>
            @endif

            @if (Session::has('error'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-danger">{{ _tr(Session::get('error')) }}</div>
            </div></div>
            @endif
            <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
          {{ _tr('General Settings') }}
        </h3>
        </div>
<div class="panel-body">
        <form name="frm" action="{{ route('save-general-settings') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label>{{ _tr('Site Title') }}</label>
                <input class="form-control" type="text" name="site_title" id="site_title" value="<?php if(!empty($settings['site_title'])){ echo $settings['site_title']; }?>">
                @if($errors->has('site_title'))
                <span style="color:RED;"><small>{{ $errors->first('site_title')}}</small></span>
                @endif
            </div>
			
            <div class="form-group">
                <label>{{ _tr('Admin Title') }}</label>
                <input class="form-control" type="text" name="admin_title" id="admin_title" value="<?php if(!empty($settings['admin_title'])){ echo $settings['admin_title']; }?>">
                @if($errors->has('admin_title'))
                <span style="color:RED;"><small>{{ $errors->first('admin_title')}}</small></span>
                @endif
            </div>
			
            <div class="form-group">
                <label>{{ _tr('Admin Email') }}</label>
                <input class="form-control" type="text" name="admin_email" id="admin_email" value="<?php if(!empty($settings['admin_email'])){ echo $settings['admin_email']; }?>">
                @if($errors->has('admin_email'))
                <span style="color:RED;"><small>{{ $errors->first('admin_email')}}</small></span>
                @endif
            </div>

            <div class="form-group">
                <label>{{ _tr('Site Logo') }}</label>
                <input type="file" name="site_logo" accept="image/*">
                <?php 
                if(!empty($settings['site_logo_id']) && $settings['site_logo_id'] > 0){
                ?>
                    <br/>
                    <img src="<?php echo get_recource_url($settings['site_logo_id']); ?>" style="width:150px;">
                    <input type="checkbox" name="remove_logo" id="remove_logo" value="yes">
                    {{ _tr('Remove Logo') }}
                <?php
                }
                ?>
                <input type="hidden" name="saved_logo_id" value="<?php if(!empty($settings['site_logo_id'])){ echo $settings['site_logo_id']; }?>">
            </div>

           
            <div class="form-group">
                <label>{{ _tr('Header Code') }}</label>
               <textarea class="form-control" name="header_code" id="header_code"><?php if(!empty($settings['header_code'])){ echo $settings['header_code']; }?></textarea>
              
            </div>

            <div class="form-group">
                <label>{{ _tr('Footer Code') }}</label>
               <textarea class="form-control" name="footer_code" id="footer_code"><?php if(!empty($settings['footer_code'])){ echo $settings['footer_code']; }?></textarea>
               
            </div>
			
            <div class="form-group">
                <label>{{ _tr('Copyright Text') }}</label>
               <textarea class="form-control" name="copyright_text" id="copyright_text"><?php if(!empty($settings['copyright_text'])){ echo $settings['copyright_text']; }?></textarea>
               
            </div>
			
			
			<div class="form-group">
                <label>{{ _tr('Clock Title') }}</label>
                <input class="form-control" type="text" name="clock_title" id="clock_title" value="<?php if(!empty($settings['clock_title'])){ echo $settings['clock_title']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Clock Sub Title') }}</label>
                <input class="form-control" type="text" name="clock_sub_title" id="clock_sub_title" value="<?php if(!empty($settings['clock_sub_title'])){ echo $settings['clock_sub_title']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Clock Countdown Date (yyyy/mm/dd)') }}</label>
                <input class="form-control" type="text" name="clock_countdown_time" id="clock_countdown_time" value="<?php if(!empty($settings['clock_countdown_time'])){ echo $settings['clock_countdown_time']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Token Price (USD)') }}</label>
                <input class="form-control" type="text" name="token_value" id="token_value" value="<?php if(!empty($settings['token_value'])){ echo $settings['token_value']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Admin Wallet Address (ETH)') }}</label>
                <input class="form-control" type="text" name="admin_wallet_address" id="admin_wallet_address" value="<?php if(!empty($settings['admin_wallet_address'])){ echo $settings['admin_wallet_address']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Admin Wallet Address (USDT)') }}</label>
                <input class="form-control" type="text" name="admin_wallet_address_ltc" id="admin_wallet_address_ltc" value="<?php if(!empty($settings['admin_wallet_address_ltc'])){ echo $settings['admin_wallet_address_ltc']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Admin Wallet Address (BTC)') }}</label>
                <input class="form-control" type="text" name="admin_wallet_address_btc" id="admin_wallet_address_btc" value="<?php if(!empty($settings['admin_wallet_address_btc'])){ echo $settings['admin_wallet_address_btc']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Admin Wallet Address (BNB)') }}</label>
                <input class="form-control" type="text" name="admin_wallet_address_bnb" id="admin_wallet_address_bnb" value="<?php if(!empty($settings['admin_wallet_address_bnb'])){ echo $settings['admin_wallet_address_bnb']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Admin Wallet Address (ADA)') }}</label>
                <input class="form-control" type="text" name="admin_wallet_address_ada" id="admin_wallet_address_ada" value="<?php if(!empty($settings['admin_wallet_address_ada'])){ echo $settings['admin_wallet_address_ada']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Current Bonus Percentage (only value, no % sign)') }}</label>
                <input class="form-control" type="text" name="bonus_percentage" id="bonus_percentage" value="<?php if(!empty($settings['bonus_percentage'])){ echo $settings['bonus_percentage']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Referral Commission Percentage (only value, no % sign)') }}</label>
                <input class="form-control" type="text" name="referral_commission_percentage" id="referral_commission_percentage" value="<?php if(!empty($settings['referral_commission_percentage'])){ echo $settings['referral_commission_percentage']; }?>">
            </div>
			
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
            </form>
            </div>
            </div>
@stop