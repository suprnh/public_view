@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('translation_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('translation_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('translation_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('translation_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($translation)) echo _tr("Edit Translation"); else echo _tr("Add New Translation"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($translation)) { ?> {{ route('update-translation') }} <?php } else { ?> {{ route('save-translation') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

					<?php 
					$langs = get_langs();
					if(isset($langs) && count($langs) >0){
						foreach($langs as $lng){
						$label = _tr("$lng->language ( $lng->language_code )");
					?>
                    <div class="form-group">
                        <label>{{ _tr('Text') }} <?php echo $label; ?>:</label>
						<?php $name = 'text_'.$lng->language_code; ?>
						<?php 
						$text = '';
						if($lng->language_code=='en_GB' && !empty($translation)){
							$text = $translation->text;
						}
						if(!empty($translation) && $lng->language_code!='en_GB'){
							$text = get_translation($translation->ID,$lng->language_code);
						}
					
						?>
                        <textarea name="<?php echo $name; ?>" rows="7" class="form-control ar-editor-1"><?php if(!empty($translation)) echo $text; else  ?><?php echo old($name); ?></textarea>
						<?php if($errors->has($name)){ ?>
                        <span style="color:RED;" class="err_msg"><small><?php echo $errors->first($name); ?></small></span>
                        <?php } ?>
                    </div>
					<?php
						}
					}
					?>
					
					

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($translation) && $translation->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($translation) && $translation->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if(!empty($translation)) { ?>
                        <input type="submit" name="update_translation" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Translation') }}">
                        <a href="{{ route('all-translation') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Translation') }}</a>
                        <input type="hidden" name="translation_id" value="<?php echo $translation->ID; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_translation" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Translation') }}">
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