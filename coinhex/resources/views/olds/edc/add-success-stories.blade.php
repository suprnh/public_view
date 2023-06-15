@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($success_stories)) echo "Edit Story"; else echo "Add New Story"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('success_stories_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('success_stories_success') }}</div>
                </div></div>
                @endif

                @if (Session::has('success_stories_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('success_stories_error') }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($success_stories)) { ?> {{ route('edc-update-success-stories') }} <?php } else { ?> {{ route('edc-save-success-stories') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Title :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($success_stories)) echo $success_stories->title; else  { ?>{{ old('title') }}<?php } ?>">
                        @if($errors->has('title'))
                        <span style="color:RED;"><small>{{$errors->first('title')}}</small></span>
                        @endif
                    </div>

                    <?php if(!empty($success_stories)){ ?>
                    <div class="form-group">
                        <label>Url Path</label>
                        <input class="form-control" type="text" name="slug" id="slug" value="<?php if(!empty($success_stories)) echo $success_stories->slug; else {?>{{ old('slug') }}<?php }?>">
                        @if($errors->has('slug'))
                        <span style="color:RED;"><small>{{$errors->first('slug')}}</small></span>
                        @endif
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Description :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($success_stories)) echo $success_stories->description; else  { ?>{{ old('description') }}<?php } ?></textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Alumni Name :</label>
                        <input type="text" name="alumni_name" class="form-control" value="<?php if(!empty($success_stories)) echo $success_stories->alumni_name; else  ?>{{ old('alumni_name') }}">
                        @if($errors->has('alumni_name'))
                        <span style="color:RED;"><small>{{$errors->first('alumni_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Alumni Designation :</label>
                        <input type="text" name="alumni_designation" class="form-control" value="<?php if(!empty($success_stories)) echo $success_stories->alumni_designation; else  ?>{{ old('alumni_designation') }}">
                    </div>

                    <div class="form-group">
                        <label>Publish Date :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($success_stories)) echo $success_stories->publish_date; else  { ?>{{ old('publish_date') }} <?php } ?>">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;"><small>{{$errors->first('publish_date')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($success_stories) && $success_stories->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($success_stories) && $success_stories->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                     <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="success_stories_img">
                    </div>

                    <?php if(!empty($success_stories) && $success_stories->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($success_stories->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;"><br/>
                        <input type="checkbox" name="del_img" value="yes"> Remove Image
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <?php if(!empty($success_stories)) { ?>
                        <input type="submit" name="update_success_story" class="btn btn-success" value="Save Story">
                        <a href="{{ route('edc-all-success-stories') }}" class="btn btn-primary">All Stories</a>
                        <input type="hidden" name="success_story_id" value="<?php echo $success_stories->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $success_stories->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_success_story" class="btn btn-primary" value="Add Story">
                        <?php } ?>
                    </div>      

                </form>
            

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