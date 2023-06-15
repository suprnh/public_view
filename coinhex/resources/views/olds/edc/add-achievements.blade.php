@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($achievements)) echo "Edit Achievement"; else echo "Add New Achievement"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('achievements_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('achievements_success') }}</div>
                </div></div>
                @endif

                @if (Session::has('achievements_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('achievements_error') }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($achievements)) { ?> {{ route('edc-update-achievements') }} <?php } else { ?> {{ route('edc-save-achievements') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Title :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($achievements)) echo $achievements->title; else  { ?>{{ old('title') }}<?php } ?>">
                        @if($errors->has('title'))
                        <span style="color:RED;"><small>{{$errors->first('title')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Description :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($achievements)) echo $achievements->description; else  { ?>{{ old('description') }}<?php } ?></textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Publish Date :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($achievements)) echo $achievements->publish_date; else  { ?>{{ old('publish_date') }}<?php } ?>">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;"><small>{{$errors->first('publish_date')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($achievements) && $achievements->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($achievements) && $achievements->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                     <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="achievement_img">
                    </div>

                    <?php if(!empty($achievements) && $achievements->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($achievements->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;"><br/>
                        <input type="checkbox" name="del_img" value="yes"> Remove Image
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <?php if(!empty($achievements)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-success" value="Save Achievement">
                        <a href="{{ route('edc-all-achievements') }}" class="btn btn-primary">All Achievements</a>
                        <input type="hidden" name="achievement_id" value="<?php echo $achievements->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $achievements->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_contact" class="btn btn-primary" value="Add Achievement">
                        <?php } ?>
                    </div>      

                </form>
            

            </div>
@stop