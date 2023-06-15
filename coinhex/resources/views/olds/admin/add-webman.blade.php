@extends('admin.layout.leftbar')
@section('dashboard')
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
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">Add New Web Manager
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($webman)) { ?>{{ route('update-webman') }}<?php } else { ?>{{ route('save-webman') }}<?php } ?>" method="post">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Name :</label>
                        <input type="text" name="full_name" class="form-control" value="<?php if(!empty($webman)) echo $webman->full_name; else { ?>{{ old('full_name') }}<?php } ?>">
                        @if($errors->has('full_name'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('full_name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email-id :</label>
                        <input type="text" name="email" class="form-control" value="<?php if(!empty($webman)) echo $webman->email; else { ?>{{ old('email') }}<?php } ?>">
                        @if($errors->has('email'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('email')}}</small></span>
                        @endif
                    </div>

                    <?php if(empty($webman)) { ?> 
                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password" class="form-control">
                        @if($errors->has('password'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('password')}}</small></span>
                        @endif
                    </div>
                    <?php } ?>
                    
                    <div class="form-group">
                        <label>Contact Number :</label>
                        <input type="text" name="phone_no" class="form-control" value="<?php if(!empty($webman)) echo $webman->phone_no; else { ?>{{ old('phone_no') }}<?php } ?>">
                        @if($errors->has('phone_no'))
                        <span style="color:RED;" class="err_msg"><small>{{$errors->first('phone_no')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Address :</label>
                        <textarea name="user_address" class="form-control ar-editor"><?php if(!empty($webman)) echo $webman->user_address; else { ?>{{ old('user_address') }}<?php } ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($webman) && $webman->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($webman) && $webman->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <?php if(!empty($webman)) { ?>
                        <input type="submit" class="btn btn-primary btn-sm-block" value="Update Manager">
                        <input type="hidden" name="webman_id" value="<?php echo $webman->ID; ?>">
                        <a href="{{ route('add-webman') }}" class="btn btn-primary btn-sm-block">Back</a>
                        <?php } else { ?>
                        <input type="submit" class="btn btn-primary btn-sm-block" value="Add Manager">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
@stop