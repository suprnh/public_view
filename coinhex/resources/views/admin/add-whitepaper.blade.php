@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('whitepaper_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('whitepaper_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('whitepaper_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('whitepaper_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($whitepaper)) echo _tr("Edit Whitepaper"); else echo _tr("Add New Whitepaper"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($whitepaper)) { ?> {{ route('update-whitepaper') }} <?php } else { ?> {{ route('save-whitepaper') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Title') }} :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($whitepaper)) echo $whitepaper->title; else  ?>{{ old('title') }}">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('title')) }}</small></span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label>{{ _tr('Description') }} :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($whitepaper)) echo $whitepaper->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('description')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Publish Date') }} :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($whitepaper)) echo $whitepaper->publish_date; else  ?>{{ old('publish_date') }}">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('publish_date')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($whitepaper) && $whitepaper->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($whitepaper) && $whitepaper->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                     <div class="form-group">
                    <label>{{ _tr('Document') }}</label>
                    <input type="file" name="whitepaper_img">
                    </div>

                    <?php if(!empty($whitepaper) && $whitepaper->image_id != 0) { ?>
                    <div class="form-group">
    
                        <a href="<?php echo get_recource_url($whitepaper->image_id); ?>" target="_blank">{{ _tr('View Document') }}</a>
                    </div>
                    <?php } ?>


                    <div class="form-group">
                        <label>{{ _tr('Is show in Front ?') }}</label>
                        <select class="form-control" name="is_show_front" id="is_show_front">
                            <option value="0" <?php if(!empty($whitepaper) && $whitepaper->is_show_front == 0) { ?> selected="selected" <?php } ?>>NO</option>
                            <option value="1" <?php if(!empty($whitepaper) && $whitepaper->is_show_front == 1) { ?> selected="selected" <?php } ?>>YES</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if(!empty($whitepaper)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Whitepaper') }}">
                        <input type="hidden" name="whitepaper_id" value="<?php echo $whitepaper->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $whitepaper->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_whitepaper" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Whitepaper') }}">
                        <?php } ?>
                        <a href="{{ route('all-whitepaper') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Whitepapers') }}</a>
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