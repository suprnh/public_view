@extends('admin.layout.leftbar')
@section('dashboard')
           @if (Session::has('contribution_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('contribution_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('contribution_error'))
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-danger">{{ _tr(Session::get('contribution_error')) }}</div>
						</div>
					</div>
                @endif
<div class="panel panel-default">
      
	<div class="panel-heading">
		<h3 class="panel-title"><?php if(!empty($contribution)) echo _tr("Edit Contribution"); else echo _tr("Add New Contribution"); ?></h3>
	</div>
	<div class="panel-body">
		<form name="ar-frm" action="<?php if(!empty($contribution)) { ?> {{ route('update-contribution') }} <?php } else { ?>{{ route('save-contribution') }}<?php } ?>" method="post" onsubmit="return confirm('Do you really want to submit the form?');">>
		{{ csrf_field() }}

		<?php if(empty($contribution)) { ?>
		<div class="form-group">
			<label>{{ _tr('Submitted By') }} <span class="required">*</span></label>
			<select class="form-control chosen-select" name="submitted_by" id="submitted_by" data-placeholder="Choose a user">
				<option value="0">{{ _tr('Select User') }}</option>
				<?php 
				if(!empty($users) && count($users) > 0){ 
					foreach($users as $user){ 
					?>
						<option value="<?php echo $user->ID; ?>" data-email="<?php echo $user->email; ?>" <?php if(!empty($contribution) && $contribution->submitted_by == $user->ID) { ?> selected="selected" <?php }else if(old('submitted_by') == $user->ID){ ?>selected="selected"<?php } ?>><?php echo $user->full_name; ?> ( <?php echo $user->email; ?> ) </option>
					<?php
					}
				}
				?>
			</select>
			 @if($errors->has('submitted_by'))
			<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('submitted_by')) }}</small></span>
			@endif
		</div>
		<?php }else{ ?>
		
		<input type="hidden" name="submitted_by" value="<?php echo $contribution->submitted_by; ?>">
		<?php } ?>
		
		
			<div class="form-group">
				<label>{{ _tr('Email-id') }}<span class="required">*</span> :</label>
				<input type="text" name="show_email" id="show_email" disabled="disabled" class="form-control" value="<?php if(!empty($contribution)) echo $contribution->email; else  { ?>{{ old('email') }}<?php } ?>">
				<input type="hidden" name="email" id="email" class="form-control" value="<?php if(!empty($contribution)) echo $contribution->email; else  { ?>{{ old('email') }}<?php } ?>">
				@if($errors->has('email'))
				<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('email')) }}</small></span>
				@endif
			</div>
			
			 <div class="form-group">
			   
				<label>{{ _tr('Amount') }}<span class="required">*</span> :</label>
				<input type="text" name="amount" class="form-control" <?php if(!empty($contribution)){ echo 'disabled="disabled"'; } ?> value="<?php  if(!empty($contribution)) echo $contribution->amount; else  { ?>{{ old('amount') }}<?php } ?>">
				@if($errors->has('amount'))
				<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('amount')) }}</small></span>
				@endif
				
			</div>
			
			
			<div class="form-group">
				<label>{{ _tr('Currency') }}<span class="required">*</span> :</label>
			   <select class="form-control" name="currency" id="currency" <?php if(!empty($contribution)){ echo 'disabled="disabled"'; } ?>>
					<option value="">{{ _tr('Choose Wallet type') }}</option>
					<option value="eth" <?php if(!empty($contribution)) { selected('eth',$contribution->currency); }else if(old('currency') == 'eth'){ ?>selected="selected"<?php } ?>>Ethereum</option>
					<option value="usdt" <?php if(!empty($contribution)) { selected('usdt',$contribution->currency); }else if(old('currency') == 'usdt'){ ?>selected="selected"<?php } ?>>USDT</option>
					<option value="btc" <?php if(!empty($contribution)) { selected('btc',$contribution->currency); }else if(old('currency') == 'btc'){ ?>selected="selected"<?php } ?>>BitCoin</option>
					<option value="bnb" <?php if(!empty($contribution)) { selected('bnb',$contribution->currency); }else if(old('currency') == 'bnb'){ ?>selected="selected"<?php } ?>>BNB</option>
					<option value="ada" <?php if(!empty($contribution)) { selected('ada',$contribution->currency); }else if(old('currency') == 'ada'){ ?>selected="selected"<?php } ?>>Cardano (ADA)</option>
					<option value="usd" <?php if(!empty($contribution)) { selected('usd',$contribution->currency); }else if(old('currency') == 'usd'){ ?>selected="selected"<?php } ?>>USD</option>
				</select>
				 @if($errors->has('currency'))
				<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('currency')) }}</small></span>
				@endif
			</div>
			
			<div class="form-group">
				<label>{{ _tr('Transfer Proof') }} :</label>
				<input type="text" name="transfer_proof" class="form-control" id="trasaction_p" value="<?php if(!empty($contribution)) echo $contribution->transfer_proof; else  { ?>{{ old('transfer_proof') }}<?php } ?>"><a onclick="myFunction()" class="btn btn-primary btn-sm">Copy Text</a>
				@if($errors->has('transfer_proof'))
				<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('transfer_proof')) }}</small></span>
				@endif
			</div>
			
			<?php if(!empty($contribution)){ ?>
			<div class="form-group">
				<label>{{ _tr('DDT Amount') }}:</label>
				<input type="text" name="base_amount" class="form-control" <?php if(!empty($contribution)){ echo 'disabled="disabled"'; } ?> value="<?php if(!empty($contribution)) echo $contribution->base_amount; else  { ?>{{ old('base_amount') }}<?php } ?>">
				@if($errors->has('base_amount'))
				<span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('base_amount')) }}</small></span>
				@endif
			</div>
			<?php } ?>
			
			<div class="form-group">
				<label>{{ _tr('Status') }}</label>
				<select class="form-control" name="status" id="status">
					<option value="0" <?php if(!empty($contribution) && $contribution->status == 0) { ?> selected="selected" <?php } ?>>Pending</option>
					<?php //if(isset($contribution) && !empty($contribution)){ ?>
					<!--option value="1" <?php if(!empty($contribution) && $contribution->status == 1) { ?> selected="selected" <?php } ?>>Processing</option>
					<option value="2" <?php if(!empty($contribution) && $contribution->status == 2) { ?> selected="selected" <?php } ?>>Rejected</option-->
					 <?php if(!empty($contribution)) { ?>
					<option value="3" <?php if(!empty($contribution) && $contribution->status == 3) { ?> selected="selected" <?php } ?>>Accepted</option>
					 <?php } ?>
					<?php //} ?>
				</select>
			</div>
			
			<div class="form-group">
				<label>{{ _tr('Status Msg') }} :</label>
				<textarea name="status_msg" class="form-control ar-editor"><?php if(!empty($contribution)) echo $contribution->status_msg; else{ ?>{{ old('status_msg') }}<?php } ?></textarea>
			</div>

		   
			
			<div class="form-group">
				<?php if(!empty($contribution)) { ?>
					
					<input type="submit"  name="update_contribution" class="btn btn-primary btn-sm-block" value="{{ _tr('Update Contribution') }}">
					<input type="hidden" name="contribution_id" value="<?php echo $contribution->ID; ?>">
				
				<?php } else { ?>
					<input type="submit" name="add_contribution" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Contribution') }}">
				<?php } ?>
				<a href="{{ route('all-contributions') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Contributions') }}</a>
			</div>      

		</form>
	</div>
</div>
        
			
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<script>
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
	</script>
	
	<script>
	  
	  function myFunction() {
	  
	  var copyText = document.getElementById("trasaction_p");

	  copyText.select();
	  copyText.setSelectionRange(0, 99999); 
	  document.execCommand("copy");
	  alert("Copied the text: " + copyText.value);
     }
	
	</script>

@stop