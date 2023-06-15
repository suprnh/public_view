@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('people_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('people_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('people_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('people_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($people)) echo _tr("Edit Team"); else echo _tr("Add New Team"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($people)) { ?> {{ route('update-people') }} <?php } else { ?> {{ route('save-people') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Full Name') }}</label>
                        <input class="form-control" type="text" name="full_name" id="full_name" value="<?php if(!empty($people)) echo $people->full_name; else { ?>{{ old('full_name') }}<?php } ?>">
                        @if($errors->has('full_name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('full_name')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Description') }} :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($people)) echo $people->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('description')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Designation') }}</label>
                        <input class="form-control" type="text" name="designation" id="designation" value="<?php if(!empty($people)) echo $people->designation; else { ?>{{ old('designation') }}<?php } ?>">
                        @if($errors->has('designation'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('designation')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Link') }}</label>
                        <input class="form-control" type="text" name="link" id="link" value="<?php if(!empty($people)) echo $people->link; else { ?>{{ old('link') }}<?php } ?>">
                        @if($errors->has('link'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('link')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
						<label>{{ _tr('Image') }}</label>
						<input type="file" name="people_img">
					</div>

					<?php if(!empty($people) && $people->image_id != 0) { ?>
						<div class="form-group">
							<img src="<?php echo get_recource_url($people->image_id); ?>" style="width:150px; height:110px; border:1px solid black; border-radius:4px;"><br/>
							<input type="checkbox" name="del_img" value="yes"> {{ _tr('Remove Image') }}
						</div>
					<?php } ?>
					
					<div class="form-group">
						<label>{{ _tr('Category') }}</label>
						<select class="form-control" name="category" id="category">
							<option value="0">{{ _tr('Select Category') }}</option>
							<?php if(isset($people_category) && count($people_category) > 0){ ?>
							<?php foreach($people_category as $people_cat){ ?>
								<option value="<?php echo $people_cat->ID; ?>" <?php if(!empty($people) && $people->category_id == $people_cat->ID) { ?> selected="selected" <?php } ?>><?php echo $people_cat->name; ?></option>
							<?php } ?>
							<?php } ?>
							
						</select>
					</div>
					
					<div class="form-group">
                        <label>{{ _tr('Order') }} :</label>
                        <input type="text" name="order" class="form-control" value="<?php if(!empty($people)) echo $people->order; else  ?>{{ old('order') }}">
                        @if($errors->has('order'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('order')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
						<label>{{ _tr('Status') }}</label>
						<select class="form-control" name="status" id="status">
							<option value="1" <?php if(!empty($people) && $people->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
							<option value="0" <?php if(!empty($people) && $people->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
						</select>
					</div>

               

                <div class="form-group">
                    <?php if(!empty($people)) { ?>
                    <input type="submit" name="update_people" value="{{ _tr('Save Team') }}" class="btn btn-primary btn-sm-block">
                    <input type="hidden" name="people_id" value="<?php echo $people->ID; ?>">
                    <input type="hidden" name="prev_image_id" value="<?php echo $people->image_id; ?>">
                    <a href="{{ route('all-people') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Teams') }}</a>
                    <?php } else { ?>
                    <input type="submit" name="create_people" value="{{ _tr('Create Team') }}" class="btn btn-primary btn-sm-block">
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