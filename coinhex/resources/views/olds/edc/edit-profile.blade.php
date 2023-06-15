@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">Edit Profile</h1>
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


            <form name="frm" action="{{ route('edc-save-edt-profile') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label>EDC Name</label>
                <input class="form-control" type="text" name="edc_name" id="edc_name" value="<?php if(!empty($udata)) echo $udata->full_name; ?>">
                @if($errors->has('edc_name'))
                <span style="color:RED;"><small>{{$errors->first('edc_name')}}</small></span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Description</label>
               <textarea class="form-control ar-editor" name="edc_description" id="edc_description"><?php if(!empty($udata)) echo $udata->user_bio; ?></textarea>
               @if($errors->has('edc_description'))
                <span style="color:RED;"><small>{{$errors->first('edc_description')}}</small></span>
                @endif
            </div>

            <div class="form-group">
                <label>Overview</label>
               <textarea class="form-control ar-editor" name="edc_overview" id="edc_overview"><?php if(!empty($udata)) echo $udata->overview; ?></textarea>
               @if($errors->has('edc_overview'))
                <span style="color:RED;"><small>{{$errors->first('edc_overview')}}</small></span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Email Id:</label>
                <input class="form-control" type="text" name="edc_email" id="edc_email" value="<?php if(!empty($udata)) echo $udata->email; ?>">
                 @if($errors->has('edc_email'))
                <span style="color:RED;"><small>{{$errors->first('edc_email')}}</small></span>
                @endif
            </div>

            <div class="form-group">
                <label>Phone No:</label>
                <input class="form-control" type="text" name="edc_phone" id="edc_phone" value="<?php if(!empty($udata)) echo $udata->phone_no; ?>">
            </div>

            <div class="form-group">
                <label>EDC Address</label>
               <textarea class="form-control ar-editor" name="edc_address" id="edc_address"><?php if(!empty($udata)) echo $udata->user_address; ?></textarea>
            </div>


            <div class="form-group">
                <label>Logo</label>
                <input type="file" name="logo" accept="image/*">
                <?php 
                if($udata->logo_id > 0){
                ?>
                    <br/><img src="<?php echo get_recource_url($udata->logo_id); ?>" style="width:150px;">
                    <input type="checkbox" name="remove_logo" id="remove_logo" value="yes">
                    Remove Logo
                <?php
                }
                ?>
                <input type="hidden" name="saved_logo_id" value="<?php if(!empty($udata)) echo $udata->logo_id; ?>">
            </div>

            <div class="form-group">
                <label>Listing Image</label>
                <input type="file" name="listing_image" accept="image/*">
                <?php 
                if($udata->list_image_id > 0){
                ?>
                    <br/><img src="<?php echo get_recource_url($udata->list_image_id); ?>" style="width:150px;">
                    <input type="checkbox" name="remove_list_image" id="remove_list_image" value="yes">
                    Remove Image
                <?php
                }
                ?>
                <input type="hidden" name="saved_list_image_id" value="<?php if(!empty($udata)) echo $udata->list_image_id; ?>">
            </div>
            
            <div class="form-group">
                <label>Banner Image</label>
                <input type="file" name="banner_image" accept="image/*">
                <?php 
                if($udata->banner_id > 0){
                ?>
                    <br/><img src="<?php echo get_recource_url($udata->banner_id); ?>" style="width:150px;">
                    <input type="checkbox" name="remove_banner" id="remove_banner" value="yes">
                    Remove Banner
                <?php
                }
                ?>   
                <input type="hidden" name="saved_banner_id" value="<?php if(!empty($udata)) echo $udata->banner_id; ?>">           
            </div>

            <div class="form-group">
                <label>Website</label>
                <input class="form-control" type="text" name="edc_website" id="edc_website" value="<?php if(!empty($udata)) echo $udata->website; ?>">
            </div>
            <?php
            $fblink = "";
            $twlink = "";
            $gplink = "";
            if(!empty($udata))
            {
                $arr = unserialize($udata->social_links);
                if(!empty($arr))
                {
                    $fblink = $arr['fb_link'];
                    $twlink = $arr['twitter_link'];
                    $gplink = $arr['gplus_link'];
                }
            }
            ?>
            <div class="form-group">
                <label>Fb Link</label>
                <input class="form-control" type="text" name="fb_link" id="fb_link" value="<?php echo $fblink; ?>">
            </div>

            <div class="form-group">
                <label>Twitter Link</label>
                <input class="form-control" type="text" name="twitter_link" id="twitter_link" value="<?php echo $twlink; ?>">
            </div>

            <div class="form-group">
                <label>G+ Link</label>
                <input class="form-control" type="text" name="gplus_link" id="gplus_link" value="<?php echo $gplink; ?>">
            </div>

            
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <input type="hidden" name="rowID" value="<?php if(!empty($udata)) echo $udata->ID; ?>">
            
            </form>

            </div>
@stop