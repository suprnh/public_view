@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $settings = get_ico_phase(); ?>
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
          {{ _tr('ICO Phase') }}
        </h3>
    </div>
	<div class="panel-body">
        <form name="frm" action="{{ route('save-ico-phase') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

			<div class="form-group">
                <label>{{ _tr('Pre Sale') }}</label>
               <input class="form-control" type="text" name="pre_sale" id="pre_sale" value="<?php if(!empty($settings['pre_sale'])){ echo $settings['pre_sale']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('ICO Phase I') }}</label>
               <input class="form-control" type="text" name="ico_phase_1" id="ico_phase_1" value="<?php if(!empty($settings['ico_phase_1'])){ echo $settings['ico_phase_1']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('ICO Phase II') }}</label>
               <input class="form-control" type="text" name="ico_phase_2" id="ico_phase_2" value="<?php if(!empty($settings['ico_phase_2'])){ echo $settings['ico_phase_2']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('ICO Phase III') }}</label>
               <input class="form-control" type="text" name="ico_phase_3" id="ico_phase_3" value="<?php if(!empty($settings['ico_phase_3'])){ echo $settings['ico_phase_3']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('ICO Extended') }}</label>
               <input class="form-control" type="text" name="ico_phase_4" id="ico_phase_4" value="<?php if(!empty($settings['ico_phase_4'])){ echo $settings['ico_phase_4']; }?>">
            </div>
			
			
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
        </form>
    </div>
</div>
@stop