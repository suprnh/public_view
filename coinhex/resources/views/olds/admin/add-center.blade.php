@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('center_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('center_success') }}</div>
                </div></div>
                @endif

                @if (Session::has('center_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('center_error') }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($center)) echo "Edit Center"; else echo "Add New Center"; ?>
                </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($center)) { ?> {{ route('update-center') }} <?php } else { ?> {{ route('save-center') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>EDC Name :</label>
                        <select name="edc_name" class="form-control">
                            <option value="">Choose EDC</option>
                        <?php foreach($edcs as $edc){ ?>
                            <option value="<?php echo $edc->ID; ?>" <?php if(!empty($center)){ selected($edc->ID,$center->parent_id); }else{ selected($edc->ID,old('edc_name')); } ?>><?php echo $edc->full_name; ?></option>
                        <?php } ?>
                        </select>
                        @if($errors->has('edc_name'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('edc_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Center Name :</label>
                        <input type="text" name="center_name" class="form-control" value="<?php if(!empty($center)) echo $center->name; else  ?>{{ old('center_name') }}">
                        @if($errors->has('center_name'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('center_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Description :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($center)) echo $center->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($center) && $center->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($center) && $center->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                     <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="center_img">
                    </div>

                    <?php if(!empty($center) && $center->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($center->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;">
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Address :</label>
                        <textarea name="address" class="form-control ar-editor"><?php if(!empty($center)) echo $center->address; else  ?>{{ old('address') }}</textarea>
                        @if($errors->has('address'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('address')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <?php if(!empty($center)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-primary btn-sm-block" value="Save Center">
                        <a href="{{ route('all-center') }}" class="btn btn-primary btn-sm-block">All Center</a>
                        <input type="hidden" name="center_id" value="<?php echo $center->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $center->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_center" class="btn btn-primary btn-sm-block" value="Add Center">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
@stop