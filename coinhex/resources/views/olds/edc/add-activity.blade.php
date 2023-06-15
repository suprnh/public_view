@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($activity)) echo "Edit Activity"; else echo "Add New Activity"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('activity_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('activity_success') }}</div>
                </div></div>
                @endif

                @if (Session::has('activity_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('activity_error') }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($activity)) { ?> {{ route('edc-update-activity') }} <?php } else { ?> {{ route('edc-save-activity') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Activity Name</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?php if(!empty($activity)) echo $activity->title; else {?>{{ old('title') }}<?php }?>">
                        @if($errors->has('title'))
                        <span style="color:RED;"><small>{{$errors->first('title')}}</small></span>
                        @endif
                    </div>

                    <?php if(!empty($activity)){ ?>
                    <div class="form-group">
                        <label>Url Path</label>
                        <input class="form-control" type="text" name="slug" id="slug" value="<?php if(!empty($activity)) echo $activity->slug; else {?>{{ old('slug') }}<?php }?>">
                        @if($errors->has('slug'))
                        <span style="color:RED;"><small>{{$errors->first('slug')}}</small></span>
                        @endif
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control ar-editor"><?php if(!empty($activity)) echo $activity->description; else { ?>{{ old('description') }}<?php } ?></textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Start Date :</label>
                        <input type="text" name="start_date" id="from_date" class="form-control datepicker" value="<?php if(!empty($activity)) echo date('d-m-Y',strtotime($activity->from_date)); else { ?>{{ old('start_date') }}<?php } ?>">
                        @if($errors->has('start_date'))
                        <span style="color:RED;"><small>{{$errors->first('start_date')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>End Date :</label>
                        <input type="text" name="end_date" id="to_date" class="form-control datepicker" value="<?php if(!empty($activity)) echo date('d-m-Y',strtotime($activity->to_date)); else { ?>{{ old('end_date') }}<?php } ?>">
                        @if($errors->has('end_date'))
                        <span style="color:RED;"><small>{{$errors->first('end_date')}}</small></span>
                        @endif
                    </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" <?php if(!empty($activity) && $activity->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                        <option value="0" <?php if(!empty($activity) && $activity->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="activity_img">
                </div>

                <?php if(!empty($activity) && $activity->image_id != 0) { ?>
                <div class="form-group">
                    <img src="<?php echo get_recource_url($activity->image_id); ?>" style="width:150px; height:110px; border:1px solid black; border-radius:4px;"><br/>
                    <input type="checkbox" name="del_img" value="yes"> Remove Image
                </div>
                <?php } ?>


                <div class="form-group">
                    <?php if(!empty($activity)) { ?>
                    <input type="submit" name="update_activity" value="Save Activity" class="btn btn-success">
                    <input type="hidden" name="activity_id" value="<?php echo $activity->ID; ?>">
                    <input type="hidden" name="prev_img_id" value="<?php echo $activity->image_id; ?>">
                    <a href="{{ route('edc-all-activity') }}" class="btn btn-primary">All Activities</a>
                    <?php } else { ?>
                    <input type="submit" name="create_activity" value="Create Activity" class="btn btn-primary">
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