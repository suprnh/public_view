@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($single_mentor)) echo "Edit Mentor";  else echo "Add New Mentor"; ?></h1>
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

                <form name="frm" action="<?php if(!empty($single_mentor)) { ?> {{ route('edc-update-mentor') }} <?php } else { ?> {{ route('edc-save-mentor') }} <?php } ?>" method="post" enctype='multipart/form-data'>
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Salutation</label>
                        <input type="text" name="salutation" class="form-control" value="<?php if(!empty($single_mentor)) echo $single_mentor->salutation; else { ?>{{ old('salutation') }}<?php } ?>">
                        @if($errors->has('salutation'))
                        <span style="color:RED;"><small>{{$errors->first('salutation')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php if(!empty($single_mentor)) echo $single_mentor->first_name; else { ?>{{ old('first_name') }}<?php } ?>">
                        @if($errors->has('first_name'))
                        <span style="color:RED;"><small>{{$errors->first('first_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?php if(!empty($single_mentor)) echo $single_mentor->last_name; else { ?>{{ old('last_name') }}<?php } ?>">
                        @if($errors->has('last_name'))
                        <span style="color:RED;"><small>{{$errors->first('last_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" value="<?php if(!empty($single_mentor)) echo $single_mentor->designation; else { ?>{{ old('designation') }}<?php } ?>">
                    </div>

                    <div class="form-group">
                        <label>Email-id</label>
                        <input type="text" name="email" class="form-control" value="<?php if(!empty($single_mentor)) echo $single_mentor->email; else { ?>{{ old('email') }}<?php } ?>">
                        @if($errors->has('email'))
                        <span style="color:RED;"><small>{{$errors->first('email')}}</small></span>
                        @endif
                    </div>

                    <?php
                    $phArr = array();
                    if(!empty($single_mentor))
                    {
                        $phArr = unserialize($single_mentor->phone_no);
                    }
                    ?>

                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="phone_no[]" class="form-control" value="<?php if(!empty($single_mentor) && !empty($phArr)) echo $phArr[0]; ?>">
                    </div>
                    <?php 
                    if(count($phArr) > 1){
                        for($i = 1; $i<count($phArr); $i++){
                            ?>
                            <div class="form-group" id="divx<?php echo $i; ?>">
                                <label>Another Number</label>
                                <input type="text" name="phone_no[]" class="form-control" value="<?php echo $phArr[$i]; ?>">
                                <a href='javascript:void(0);' class='btn btn-xs btn-danger pull-right del' id='x<?php echo $i; ?>'>Remove</a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div id="add_more_div"></div>
                    <div><a href="javascript:void(0);" id="add_more" class="btn btn-xs btn-primary">Add More Contact Number</a></div>

                    <?php
                    $getExpArr = array();
                    if(!empty($mentor_exp))
                    {
                        foreach($mentor_exp as $exp)
                        {
                            array_push($getExpArr, $exp->category_id);
                        }
                    }
                    ?>
                    
                    <div class="form-group" style="margin-top: 10px;">
                        <label>Expertise In</label>
                        <select name="category_id[]" class="form-control chosen-select" data-placeholder="Choose a category.." multiple>
                            <option value=""></option>
                            <?php
                            if(!empty($all_exp_cat)){
                                foreach($all_exp_cat as $v){
                                    ?>
                                    <option value="<?php echo $v->ID; ?>" <?php if(!empty($getExpArr) && in_array($v->ID, $getExpArr)) { ?> selected="selected" <?php } ?>><?php echo $v->category_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>                    

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Description</label>
                        <textarea name="description" class="form-control ar-editor"><?php if(!empty($single_mentor)) echo $single_mentor->description; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($single_mentor) && $single_mentor->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($single_mentor) && $single_mentor->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="mentor_img">
                    </div>

                    <?php if(!empty($single_mentor) && $single_mentor->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($single_mentor->image_id); ?>" style="width:150px; height:110px; border:1px solid black; border-radius:4px;"><br/>
                        <input type="checkbox" name="del_img" value="yes"> Remove Image 
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <?php if(!empty($single_mentor)) { ?>
                        <input type="submit" name="update_mentor" value="Save Mentor" class="btn btn-success">
                        <input type="hidden" name="mentor_id" value="<?php echo $single_mentor->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $single_mentor->image_id; ?>">
                        <a href="{{ route('edc-all-mentor') }}" class="btn btn-primary">All Mentors</a>
                        <?php } else { ?>
                        <input type="submit" name="create_mentor" value="Create Mentor" class="btn btn-primary">
                        <?php } ?>
                    </div>

                </form>
                
            

            </div>
@stop

@push('footer-js')
    <script type="text/javascript">
    $(function(){
        var no = 1;
        $("#add_more").on('click',function(){
            var html = "<div class='form-group' id='div"+ no +"'><label>Another Number("+ no +")</label><input type='text' name='phone_no[]' class='form-control'><a href='javascript:void(0);' class='btn btn-xs btn-danger pull-right del' id='"+ no +"'>Remove</a></div>";
            $("#add_more_div").append(html);
            no++;
        });

        $("body").on('click','.del',function(){
            $("#div"+$(this).attr('id')).remove();
        });
    });
    </script>
@endpush