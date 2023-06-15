@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($news)) echo "Edit News"; else echo "Add New News"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('news_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('news_success') }}</div>
                </div></div>
                @endif

                @if (Session::has('news_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('news_error') }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($news)) { ?> {{ route('edc-update-news') }} <?php } else { ?> {{ route('edc-save-news') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Title :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($news)) echo $news->title; else  {?>{{ old('title') }}<?php } ?>">
                        @if($errors->has('title'))
                        <span style="color:RED;"><small>{{$errors->first('title')}}</small></span>
                        @endif
                    </div>

                    <?php if(!empty($news)){ ?>
                    <div class="form-group">
                        <label>Url Path :</label>
                        <input type="text" name="slug" class="form-control" id="slug" value="<?php if(!empty($news)) echo $news->slug; else  ?>{{ old('slug') }}">
                        @if($errors->has('slug'))
                        <span style="color:RED;"><small>{{$errors->first('slug')}}</small></span>
                        @endif
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Description :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($news)) echo $news->description; else {  ?>{{ old('description') }}<?php } ?></textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Publish Date :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($news)) echo date('d-m-Y', strtotime($news->publish_date)); else  { ?>{{ old('publish_date') }}<?php } ?>">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;"><small>{{$errors->first('publish_date')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($news) && $news->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($news) && $news->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                     <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="news_img">
                    </div>

                    <?php if(!empty($news) && $news->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($news->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;"><br/>
                        <input type="checkbox" name="del_img" value="yes"> Remove Image
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <?php if(!empty($news)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-success" value="Save News">
                        <a href="{{ route('edc-all-news') }}" class="btn btn-primary">All News</a>
                        <input type="hidden" name="news_id" value="<?php echo $news->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $news->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_news" class="btn btn-primary" value="Add News">
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