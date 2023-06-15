@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $settings = get_landing_page_video(); ?>
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
          {{ _tr('Landing Page Video') }}
        </h3>
    </div>
	<div class="panel-body">
        <form name="frm" action="{{ route('save-landing-page-video') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

			<div class="form-group">
                <label>{{ _tr('Video 1') }}</label>
               <input class="form-control" type="text" name="video_1" id="video_1" value="<?php if(!empty($settings['video_1'])){ echo $settings['video_1']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Video 2') }}</label>
               <input class="form-control" type="text" name="video_3" id="video_3" value="<?php if(!empty($settings['video_3'])){ echo $settings['video_3']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Video 3') }}</label>
               <input class="form-control" type="text" name="video_2" id="video_2" value="<?php if(!empty($settings['video_2'])){ echo $settings['video_2']; } ?>">
            </div>
			
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
        </form>
    </div>
</div>
@stop