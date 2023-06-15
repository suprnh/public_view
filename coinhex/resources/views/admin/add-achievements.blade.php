@extends('admin.layout.leftbar')

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
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($achievements)) echo "Edit Achievement"; else echo "Add New Achievement"; ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($achievements)) { ?> {{ route('update-achievements') }} <?php } else { ?> {{ route('save-achievements') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Title :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($achievements)) echo $achievements->title; else  ?>{{ old('title') }}">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('title')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Description :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($achievements)) echo $achievements->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Publish Date :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($achievements)) echo $achievements->publish_date; else  ?>{{ old('publish_date') }}">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('publish_date')}}</small></span>
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
                        <img src="<?php echo get_recource_url($achievements->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;">
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Is show in Front ?</label>
                        <select class="form-control" name="is_show_front" id="is_show_front">
                            <option value="0" <?php if(!empty($achievements) && $achievements->is_show_front == 0) { ?> selected="selected" <?php } ?>>NO</option>
                            <option value="1" <?php if(!empty($achievements) && $achievements->is_show_front == 1) { ?> selected="selected" <?php } ?>>YES</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Is for any EDC ?</label>
                        <select class="form-control" name="is_edc_id" id="is_edc_id">
                            <option value="0">NO</option>
                            <?php
                            $getAllEdcs = getAllEdcs();
                            if(!empty($getAllEdcs))
                            {
                                foreach($getAllEdcs as $k=>$v)
                                {
                                    ?>
                                    <option value="<?php echo $v; ?>" <?php if(!empty($achievements) && $achievements->is_edc_id == $v) { ?> selected="selected" <?php } ?>><?php echo $k; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if(!empty($achievements)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-primary btn-sm-block" value="Save Achievement">
                        <a href="{{ route('all-achievements') }}" class="btn btn-primary btn-sm-block">All Achievements</a>
                        <input type="hidden" name="achievement_id" value="<?php echo $achievements->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $achievements->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_contact" class="btn btn-primary btn-sm-block" value="Add Achievement">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
            </div>
@stop