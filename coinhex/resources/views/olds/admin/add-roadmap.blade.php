@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('roadmap_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('roadmap_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('roadmap_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('roadmap_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($roadmap)) echo _tr("Edit Roadmap"); else echo _tr("Add New Roadmap"); ?>
</h3>
</div>
<div class="panel-body">     
                <form name="ar-frm" action="<?php if(!empty($roadmap)) { ?> {{ route('update-roadmap') }} <?php } else { ?> {{ route('save-roadmap') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Title') }} :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($roadmap)) echo $roadmap->title; else  ?>{{ old('title') }}">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('title')) }}</small></span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label>{{ _tr('Description') }} :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($roadmap)) echo $roadmap->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('description')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Publish Date') }} :</label>
                        <input type="text" name="publish_date" class="form-control" value="<?php if(!empty($roadmap)) echo $roadmap->publish_date; else  ?>{{ old('publish_date') }}">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('publish_date')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($roadmap) && $roadmap->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($roadmap) && $roadmap->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Is Done') }}</label>
                        <select class="form-control" name="is_done" id="is_done">
                            <option value="1" <?php if(!empty($roadmap) && $roadmap->is_done == 1) { ?> selected="selected" <?php } ?>>yes</option>
                            <option value="0" <?php if(!empty($roadmap) && $roadmap->is_done == 0) { ?> selected="selected" <?php } ?>>no</option>
                        </select>
                    </div>

                    

                    <div class="form-group">
                        <label>{{ _tr('Order') }} :</label>
                        <input type="text" name="order" class="form-control" value="<?php if(!empty($roadmap)) echo $roadmap->order; else  ?>{{ old('order') }}">
                        @if($errors->has('order'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('order')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <?php if(!empty($roadmap)) { ?>
                        <input type="submit" name="update_roadmap" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Roadmap') }}">
                        <a href="{{ route('all-roadmap') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Roadmap') }}</a>
                        <input type="hidden" name="roadmap_id" value="<?php echo $roadmap->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $roadmap->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_roadmap" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Roadmap') }}">
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