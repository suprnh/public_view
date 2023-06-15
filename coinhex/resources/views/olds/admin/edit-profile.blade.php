@extends('admin.layout.leftbar')
@section('dashboard')
            <div class="row">

            @if (Session::has('success'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-success">{{ _tr(Session::get('success')) }}</div>
            </div></div>
            @endif

            @if (Session::has('error'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-danger">{{ _tr(Session::get('error')) }}</div>
            </div></div>
            @endif

            <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
        {{ _tr('Edit Profile') }}
        </h3>
        </div>
<div class="panel-body">
            <form name="frm" action="{{ route('save-edt-profile') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label>{{ _tr('Admin Name') }}</label>
                <input class="form-control" type="text" name="edc_name" id="edc_name" value="<?php if(!empty($udata)) echo $udata->full_name; ?>">
                @if($errors->has('edc_name'))
                <span style="color:RED;"><small>{{ _tr($errors->first('edc_name')) }}</small></span>
                @endif
            </div>
            
           
            
            <div class="form-group">
                <label>{{ _tr('Email Id') }}:</label>
                <input class="form-control" type="text" name="edc_email" id="edc_email" value="<?php if(!empty($udata)) echo $udata->email; ?>">
                 @if($errors->has('edc_email'))
                <span style="color:RED;"><small>{{ _tr($errors->first('edc_email')) }}</small></span>
                @endif
            </div>

            
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
            <input type="hidden" name="rowID" value="<?php if(!empty($udata)) echo $udata->ID; ?>">
            
            </form>
            </div>
             </div>
            </div>
@stop