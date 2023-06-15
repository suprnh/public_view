@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('partner_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('partner_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('partner_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('partner_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($partner)) echo _tr("Edit Partner"); else echo _tr("Add New Partner"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($partner)) { ?> {{ route('update-partner') }} <?php } else { ?> {{ route('save-partner') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Name') }} :</label>
                        <input type="text" name="name" class="form-control" value="<?php if(!empty($partner)) echo $partner->name; else  ?>{{ old('name') }}">
                        @if($errors->has('name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('name')) }}</small></span>
                        @endif
                    </div>

					<div class="form-group">
                        <label>{{ _tr('Link') }} :</label>
                        <input type="text" name="link" class="form-control" value="<?php if(!empty($partner)) echo $partner->link; else  ?>{{ old('link') }}">
                        @if($errors->has('link'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('link')) }}</small></span>
                        @endif
                    </div>
					
                    <div class="form-group">
						<label>{{ _tr('Image') }}</label>
						<input type="file" name="partner_img">
					</div>

					<?php if(!empty($partner) && $partner->image_id != 0) { ?>
						<div class="form-group">
							<img src="<?php echo get_recource_url($partner->image_id); ?>" style="width:150px;border:1px solid black; border-radius:4px;"><br/>
							
						</div>
					<?php } ?>

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($partner) && $partner->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($partner) && $partner->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    

                   <div class="form-group">
                        <label>{{ _tr('Order') }} :</label>
                        <input type="text" name="order" class="form-control" value="<?php if(!empty($partner)) echo $partner->order; else  ?>{{ old('order') }}">
                        @if($errors->has('order'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('order')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <?php if(!empty($partner)) { ?>
                        <input type="submit" name="update_partner" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Partner') }}">
                        <a href="{{ route('all-partner') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Partners') }}</a>
                        <input type="hidden" name="partner_id" value="<?php echo $partner->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $partner->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_partner" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Partner') }}">
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
</script>
@stop