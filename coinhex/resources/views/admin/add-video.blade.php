@extends('admin.layout.leftbar')
@section('title')

@stop
@section('dashboard')
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php if(!empty($video)) echo _tr("Edit Video"); else echo _tr("Add New Video"); ?></h3>
        </div>
		<div class="panel-body">
            

                @if (Session::has('video_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('video_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('video_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('video_error')) }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($video)) { ?> {{ route('update-video') }} <?php } else { ?> {{ route('save-video') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Title') }} :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($video)){ echo $video->title; }else{  ?>{{ old('title') }}<?php } ?>">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('title')) }}</small></span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label>{{ _tr('Description') }} :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($video)){ echo $video->description; }else{  ?>{{ old('description') }}<?php } ?></textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('description')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Youtube Video Link') }} :</label>
                        <input type="text" name="video_link" class="form-control datepicker-1" value="<?php if(!empty($video)){ echo $video->video_link; }else{  ?>{{ old('video_link') }}<?php } ?>">
                        @if($errors->has('video_link'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('video_link')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($video) && $video->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($video) && $video->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>
					
					<?php /*
                    <div class="form-group">
                    <label>{{ _tr('Document') }}</label>
                    <input type="file" name="whitepaper_img">
                    </div>

                    <?php if(!empty($video) && $video->image_id != 0) { ?>
                    <div class="form-group">
    
                        <a href="<?php echo get_recource_url($video->image_id); ?>" target="_blank">{{ _tr('View Document') }}</a>
                    </div>
                    <?php } ?>
					*/?>

					<div class="form-group">
                        <label>Show on Homepage</label>
                        <select class="form-control" name="is_show_front" id="is_show_front">
                            <option value="0" <?php if(!empty($video) && $video->is_show_front == 0) { ?> selected="selected" <?php } ?>>No</option>
							<option value="1" <?php if(!empty($video) && $video->is_show_front == 1) { ?> selected="selected" <?php } ?>>Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if(!empty($video)) { ?>
                        <input type="submit" name="update_video" class="btn btn-success" value="{{ _tr('Save Video') }}">
                        <a href="{{ route('all-video') }}" class="btn btn-primary">{{ _tr('All Video') }}</a>
                        <input type="hidden" name="video_id" value="<?php echo $video->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $video->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_video" class="btn btn-primary" value="{{ _tr('Add Video') }}">
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