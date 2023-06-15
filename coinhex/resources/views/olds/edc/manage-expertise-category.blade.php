@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">Manage Expertise Categories</h1>
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

                <form name="frm" action="<?php if(!empty($single_data) && count($single_data) > 0) { ?> {{ route('edc-upd-exp-cat') }} <?php } else { ?> {{ route('edc-add-exp-cat') }} <?php } ?>" method="post">
                {{ csrf_field() }}
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="<?php if(!empty($single_data) && count($single_data) > 0) echo $single_data->category_name; else  { ?>{{ old('category_name') }}<?php } ?>">
                            @if($errors->has('category_name'))
                            <span style="color:RED;"><small>{{$errors->first('category_name')}}</small></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="parent_id" class="form-control">
                                <option value=""></option>
                                <?php
                                if(!empty($all_data)){
                                    foreach($all_data as $v){
                                        if(!empty($single_data)) {
                                            if($v->ID != $single_data->ID){
                                ?>
                               
                                <option value="{{ $v->ID }}" <?php if(!empty($single_data) && count($single_data) > 0 && $single_data->parent_id == $v->ID) { ?> selected="selected" <?php } ?>>{{ $v->category_name }}</option>
                                <?php } ?>
                                <?php } else { ?>
                                  <option value="{{ $v->ID }}">{{ $v->category_name }}</option>  
                                <?php } ?>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <?php if(!empty($single_data) && count($single_data) > 0) { ?>
                        <input type="submit" name="save" value="SAVE" class="btn btn-primary" style="margin-top: 26px;">
                        <input type="hidden" name="cat_id" value="<?php echo $single_data->ID; ?>">
                        <a href="{{ route('edc-manage-expertise-category') }}" class="btn btn-sm btn-danger" style="margin-top: 26px;">Cancel</a>
                        <?php } else { ?>
                        <input type="submit" name="add" value="ADD" class="btn btn-primary" style="margin-top: 26px;">
                        <?php } ?>
                    </div>

                    <?php if(!empty($all_data) && empty($single_data)) { ?>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
      
                                <div class="panel-heading">
                                  <h3 class="panel-title">All Categories (<?php echo count($all_data); ?>)</h3>
                                </div>
        
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category Name</th>
                                                <th>Parent</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sl=1; ?>
                                            <?php foreach($all_data as $c) { ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td><?php echo $c->category_name; ?></td>
                                                    <td><?php echo exp_cat_name($c->parent_id); ?></td>
                                                    <td>
                                                        <a href="{{ route('edc-manage-expertise-category') }}/{{ $c->ID }}" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="{{ route('edc-del-exp-cat') }}/{{ $c->ID }}" class="btn btn-sm btn-danger" onclick="return confirm('Sure To Delete This Category ?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php $sl++; } ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </form>

                
            

            </div>
@stop