@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $settings = get_platform_distribution(); ?>
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
          {{ _tr('Platform & Distribution') }}
        </h3>
    </div>
	<div class="panel-body">
        <form name="frm" action="{{ route('save-platform-distribution') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

			<div class="form-group">
                <label>{{ _tr('Tokens Offered') }}</label>
               <input class="form-control" type="text" name="tokens_offered" id="tokens_offered" value="<?php if(!empty($settings['tokens_offered'])){ echo $settings['tokens_offered']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('START TIME') }}</label>
               <input class="form-control" type="text" name="blockchain_platform" id="blockchain_platform" value="<?php if(!empty($settings['blockchain_platform'])){ echo $settings['blockchain_platform']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('END TIME') }}</label>
               <input class="form-control" type="text" name="ethereum_mainnet" id="ethereum_mainnet" value="<?php if(!empty($settings['ethereum_mainnet'])){ echo $settings['ethereum_mainnet']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('CROWDSALE') }}</label>
               <input class="form-control" type="text" name="distrbution_tokens" id="distrbution_tokens" value="<?php if(!empty($settings['distrbution_tokens'])){ echo $settings['distrbution_tokens']; }?>">
            </div>
			
			
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
        </form>
    </div>
</div>
@stop