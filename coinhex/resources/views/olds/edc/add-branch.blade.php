@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($center)) echo "Edit Branch"; else "Add New Branch"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                </div></div>
                @endif

                @if (Session::has('error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($center)) { ?> {{ route('edc-update-branch') }} <?php } else { ?> {{ route('edc-save-branch') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}


                    <div class="form-group">
                        <label>Center Name :</label>
                        <input type="text" name="center_name" class="form-control" value="<?php if(!empty($center)) echo $center->name; else { ?>{{ old('center_name') }}<?php } ?>">
                        @if($errors->has('center_name'))
                        <span style="color:RED;"><small>{{$errors->first('center_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Description :</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($center)) echo $center->description; else { ?>{{ old('description') }}<?php } ?></textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Status :</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($center) && $center->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($center) && $center->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image :</label>
                        <input type="file" name="center_img">
                    </div>

                    <?php if(!empty($center) && $center->image_id != '0') { ?>
                        <div class="form-group">
                            <img src="<?php echo get_recource_url($center->image_id); ?>" style="width:150px; height:110px; border:1px solid black; border-radius:4px;" /><br/>
                        <input type="checkbox" name="del_img" value="yes"> Remove Image
                        </div>
                    <?php } ?>

                    

                    <div class="form-group">
                        <label>Address :</label>
                        <textarea name="address" class="form-control ar-editor"><?php if(!empty($center)) echo $center->address; else { ?>{{ old('address') }}<?php } ?></textarea>
                        @if($errors->has('address'))
                        <span style="color:RED;"><small>{{$errors->first('address')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <?php if(!empty($center)) { ?>
                        <input type="submit" name="up_center" class="btn btn-primary" value="Save Branch">
                        <a href="{{ route('edc-all-branches') }}" class="btn btn-primary">All Branches</a>
                        <input type="hidden" name="center_id" value="<?php echo $center->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $center->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_center" class="btn btn-primary" value="Add Branch">
                        <?php } ?>
                    </div>      

                </form>
            

            </div>
@stop