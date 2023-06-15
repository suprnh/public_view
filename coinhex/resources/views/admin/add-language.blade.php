@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('language_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('language_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('language_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('language_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
		<h3 class="panel-title"><?php if(!empty($language)) echo _tr("Edit Language"); else echo _tr("Add New Language"); ?>
        </h3>
</div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($language)) { ?> {{ route('update-language') }} <?php } else { ?> {{ route('save-language') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Language') }} :</label>
                        <input type="text" name="language" class="form-control" value="<?php if(!empty($language)) echo $language->language; else  ?>{{ old('language') }}">
                        @if($errors->has('language'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('language')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Language Code') }}:</label>
                        <input type="text" name="language_code" class="form-control" value="<?php if(!empty($language)) echo $language->language_code; else  ?>{{ old('title') }}">
                        @if($errors->has('language_code'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('language_code')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Writing System') }}</label>
                        <select class="form-control" name="writing_system" id="writing_system">
                            <option value="LTR" <?php if(!empty($language) && $language->writing_system == 'LTR') { ?> selected="selected" <?php } ?>>LTR</option>
                            <option value="RTL" <?php if(!empty($language) && $language->writing_system == 'RTL') { ?> selected="selected" <?php } ?>>RTL</option>
                        </select>
                    </div>
					
					<div class="form-group">
						<label>{{ _tr('Flag Image') }}</label>
						<input type="file" name="flag_img">
					</div>

					<?php if(!empty($language) && $language->flag_id != 0) { ?>
						<div class="form-group">
							<img src="<?php echo get_recource_url($language->flag_id); ?>"><br/>
							<input type="checkbox" name="del_flag_img" value="yes"> {{ _tr('Remove Image') }}
						</div>
					<?php } ?>
					
                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($language) && $language->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($language) && $language->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Is Default') }}</label>
                        <select class="form-control" name="is_default" id="is_default">
                            <option value="1" <?php if(!empty($language) && $language->is_default == 1) { ?> selected="selected" <?php } ?>>yes</option>
                            <option value="0" <?php if(!empty($language) && $language->is_default == 0) { ?> selected="selected" <?php } ?>>no</option>
                        </select>
                    </div>

                    

                   

                    <div class="form-group">
                        <?php if(!empty($language)) { ?>
                        <input type="submit" name="update_language" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Language') }}">
                        <a href="{{ route('all-language') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Languages') }}</a>
                        <input type="hidden" name="language_id" value="<?php echo $language->ID; ?>">
                        <input type="hidden" name="prev_flag_img_id" value="<?php echo $language->flag_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_language" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Language') }}">
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