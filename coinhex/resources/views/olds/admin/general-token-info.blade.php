@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $settings = get_token_info(); ?>
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
          {{ _tr('General Token Info') }}
        </h3>
    </div>
	<div class="panel-body">
        <form name="frm" action="{{ route('save-general-token-info') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

			<div class="form-group">
                <label>{{ _tr('Name') }}</label>
               <input class="form-control" type="text" name="token_name" id="token_name" value="<?php if(!empty($settings['token_name'])){ echo $settings['token_name']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Contract Address') }}</label>
               <input class="form-control" type="text" name="contract_address" id="contract_address" value="<?php if(!empty($settings['contract_address'])){ echo $settings['contract_address']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Token Explorer') }}</label>
               <input class="form-control" type="text" name="token_explorer" id="token_explorer" value="<?php if(!empty($settings['token_explorer'])){ echo $settings['token_explorer']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Purchase Methods Accepted') }}</label>
               <input class="form-control" type="text" name="purchase_methods_accepted" id="purchase_methods_accepted" value="<?php if(!empty($settings['purchase_methods_accepted'])){ echo $settings['purchase_methods_accepted']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Hard Cap') }}</label>
               <input class="form-control" type="text" name="hard_cap" id="hard_cap" value="<?php if(!empty($settings['hard_cap'])){ echo $settings['hard_cap']; }?>">
            </div>
			<div class="form-group">
                <label>{{ _tr('Soft Cap') }}</label>
               <input class="form-control" type="text" name="soft_cap" id="soft_cap" value="<?php if(!empty($settings['soft_cap'])){ echo $settings['soft_cap']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Token Price') }}</label>
               <input class="form-control" type="text" name="cost_ubex_token" id="cost_ubex_token" value="<?php if(!empty($settings['cost_ubex_token'])){ echo $settings['cost_ubex_token']; }?>">
            </div>
			<div class="form-group">
                <label>{{ _tr('Total Supply of Tokens') }}</label>
               <input class="form-control" type="text" name="total_supply_tokens" id="total_supply_tokens" value="<?php if(!empty($settings['total_supply_tokens'])){ echo $settings['total_supply_tokens']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('New Token Commissions') }}</label>
               <input class="form-control" type="text" name="new_token_commissions" id="new_token_commissions" value="<?php if(!empty($settings['new_token_commissions'])){ echo $settings['new_token_commissions']; }?>">
            </div>
			<div class="form-group">
                <label>{{ _tr('Key your customer (KYC)') }}</label>
               <input class="form-control" type="text" name="key_your_customer_kyc" id="key_your_customer_kyc" value="<?php if(!empty($settings['key_your_customer_kyc'])){ echo $settings['key_your_customer_kyc']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Min Purchase Cap') }}</label>
               <input class="form-control" type="text" name="min_purchase_cap" id="min_purchase_cap" value="<?php if(!empty($settings['min_purchase_cap'])){ echo $settings['min_purchase_cap']; }?>">
            </div>
			<div class="form-group">
                <label>{{ _tr('Max Purchase Cap') }}</label>
               <input class="form-control" type="text" name="max_purchase_cap" id="max_purchase_cap" value="<?php if(!empty($settings['max_purchase_cap'])){ echo $settings['max_purchase_cap']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Whitelist') }}</label>
               <input class="form-control" type="text" name="whitelist" id="whitelist" value="<?php if(!empty($settings['whitelist'])){ echo $settings['whitelist']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Percentage') }}</label>
               <input class="form-control" type="text" name="percentage" id="percentage" value="<?php if(!empty($settings['percentage'])){ echo $settings['percentage']; }?>">
            </div>
			
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
        </form>
    </div>
</div>
@stop