@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('airdrop_listing_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('airdrop_listing_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('airdrop_listing_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('airdrop_listing_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
				<div class="panel-heading">
					<h3 class="panel-title"><?php if(!empty($airdrop_listing)) echo _tr("Edit Airdrop"); else echo _tr("Add New Airdrop"); ?></h3>
				</div>
			<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($airdrop_listing)) { ?> {{ route('update-airdrop-listing') }} <?php } else { ?> {{ route('save-airdrop-listing') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Name') }} :</label>
                        <input type="text" name="name" class="form-control" value="<?php if(!empty($airdrop_listing)) echo $airdrop_listing->name; else  ?>{{ old('name') }}">
                        @if($errors->has('name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('name')) }}</small></span>
                        @endif
                    </div>

					<div class="form-group">
                        <label>{{ _tr('Link') }} :</label>
                        <input type="text" name="link" class="form-control" value="<?php if(!empty($airdrop_listing)) echo $airdrop_listing->link; else  ?>{{ old('link') }}">
                        @if($errors->has('link'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('link')) }}</small></span>
                        @endif
                    </div>
					
					<?php /*
					<div class="form-group">
                        <label>Content:</label>
                        <textarea name="other_text" class="form-control ar-editor"><?php if(!empty($airdrop_listing)) echo $airdrop_listing->other_text; else{ ?>{{ old('other_text') }}<?php } ?></textarea>
                    </div> */ ?>
					
					
					<div class="form-group">
						<label>{{ _tr('Choose Type') }}<span class="required">*</span></label>
						<select class="form-control" name="airdrop_type" id="ico_type">
							<option value="">{{ _tr('Airdrop Type') }}</option>
							<option value="widget" <?php if(!empty($airdrop_listing) && $airdrop_listing->other_text != '') { ?> selected="selected" <?php } ?>>Widget</option>
							<option value="image" <?php if(!empty($airdrop_listing) && $airdrop_listing->image_id != 0) { ?> selected="selected" <?php } ?>>Image</option>
						</select>
						@if($errors->has('airdrop_type'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('airdrop_type')) }}</small></span>
                        @endif
					</div>
					
					<div class="form-group" id="widget" style="display:none;">
                        <label>Content:</label>
                        <textarea name="other_text" class="form-control ar-editor2"><?php if(!empty($airdrop_listing)) echo $airdrop_listing->other_text; else{ ?>{{ old('other_text') }}<?php } ?></textarea>
                    </div>
					
                    <div class="form-group" id="image" style="display:none;">
						<label>{{ _tr('Image') }}</label>
						<input type="file" name="airdrop_listing_img">
					</div>

					<?php if(!empty($airdrop_listing) && $airdrop_listing->image_id != 0) { ?>
						<div class="form-group">
							<img src="<?php echo get_recource_url($airdrop_listing->image_id); ?>" style="width:150px;border:1px solid black; border-radius:4px;"><br/>
							
						</div>
					<?php } ?>
					
					<input type="hidden" name="last_choosen_item" id="last_choosen_item">
					
                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($airdrop_listing) && $airdrop_listing->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($airdrop_listing) && $airdrop_listing->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    

                   <div class="form-group">
                        <label>{{ _tr('Order') }} :</label>
                        <input type="text" name="order" class="form-control" value="<?php if(!empty($airdrop_listing)) echo $airdrop_listing->order; else  ?>{{ old('order') }}">
                        @if($errors->has('order'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('order')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <?php if(!empty($airdrop_listing)) { ?>
                        <input type="submit" name="update_airdrop_listing" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Airdrop') }}">
                        <a href="{{ route('all-airdrop-listing') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Airdrop Listing') }}</a>
                        <input type="hidden" name="airdrop_listing_id" value="<?php echo $airdrop_listing->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $airdrop_listing->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_airdrop_listing" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Airdrop') }}">
                        <?php } ?>
                    </div>      

                </form>
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

$("#slug").keyup(function(){
        var Text = string_to_slug($(this).val());
        $("#slug").val(Text);        
});


$(function () {
	$( "#ico_type" ).change(function() {
		
		var ico_type = $( "#ico_type" ).val();
		
		//alert(ico_type);
		if(ico_type == 'widget'){
			$( "#widget" ).show();
			$( "#image" ).hide();
			$( "#last_choosen_item" ).val('widget');
			
		}else if(ico_type == 'image'){
			$( "#image" ).show();
			$( "#widget" ).hide();
			$( "#last_choosen_item" ).val('image');
		}else{
			$( "#image" ).hide();
			$( "#widget" ).hide();
			$( "#last_choosen_item" ).val('');
		}
	});
});

@if(!$errors->has('airdrop_type'))

	$(function () {
		$("#ico_type").change();
	});

@endif

</script>
@stop