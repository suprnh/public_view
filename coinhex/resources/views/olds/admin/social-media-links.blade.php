@extends('admin.layout.leftbar')
@section('dashboard')
            <?php $settings = get_settings(); ?>
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
          {{ _tr('Social Media Links') }}
        </h3>
        </div>
<div class="panel-body">
        <form name="frm" action="{{ route('save-social-media-links') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

			<div class="form-group">
                <label>{{ _tr('Telegram Link') }}</label>
                <input class="form-control" type="text" name="telegram_link" id="telegram_link" value="<?php if(!empty($settings['telegram_link'])){ echo $settings['telegram_link']; }?>">
            </div>
			
            <div class="form-group">
                <label>{{ _tr('Fb Link') }}</label>
                <input class="form-control" type="text" name="fb_link" id="fb_link" value="<?php if(!empty($settings['fb_link'])){ echo $settings['fb_link']; }?>">
            </div>

            <div class="form-group">
                <label>{{ _tr('Twitter Link') }}</label>
                <input class="form-control" type="text" name="twitter_link" id="twitter_link" value="<?php if(!empty($settings['twitter_link'])){ echo $settings['twitter_link']; }?>">
            </div>

            <?php /*<div class="form-group">
                <label>{{ _tr('G+ Link') }}</label>
                <input class="form-control" type="text" name="gplus_link" id="gplus_link" value="<?php if(!empty($settings['gplus_link'])){ echo $settings['gplus_link']; }?>">
            </div>

            <div class="form-group">
                <label>{{ _tr('Pinterest Link') }}</label>
                <input class="form-control" type="text" name="pinterest_link" id="pinterest_link" value="<?php if(!empty($settings['pinterest_link'])){ echo $settings['pinterest_link']; }?>">
            </div> */ ?>

            <div class="form-group">
                <label>{{ _tr('Instagram Link') }}</label>
                <input class="form-control" type="text" name="instagram_link" id="instagram_link" value="<?php if(!empty($settings['instagram_link'])){ echo $settings['instagram_link']; }?>">
            </div>

            <div class="form-group">
                <label>{{ _tr('Youtube Link') }}</label>
                <input class="form-control" type="text" name="youtube_link" id="youtube_link" value="<?php if(!empty($settings['youtube_link'])){ echo $settings['youtube_link']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Reddit Link') }}</label>
                <input class="form-control" type="text" name="reddit_link" id="reddit_link" value="<?php if(!empty($settings['reddit_link'])){ echo $settings['reddit_link']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Github Link') }}</label>
                <input class="form-control" type="text" name="github_link" id="github_link" value="<?php if(!empty($settings['github_link'])){ echo $settings['github_link']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Bitcointalk Link') }}</label>
                <input class="form-control" type="text" name="bitcointalk_link" id="bitcointalk_link" value="<?php if(!empty($settings['bitcointalk_link'])){ echo $settings['bitcointalk_link']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Medium Link') }}</label>
                <input class="form-control" type="text" name="medium_link" id="medium_link" value="<?php if(!empty($settings['medium_link'])){ echo $settings['medium_link']; }?>">
            </div>
			
			<div class="form-group">
                <label>{{ _tr('Linkedin Link') }}</label>
                <input class="form-control" type="text" name="linkedin_link" id="linkedin_link" value="<?php if(!empty($settings['linkedin_link'])){ echo $settings['linkedin_link']; }?>">
            </div>
            <button type="submit" class="btn btn-primary btn-sm-block">{{ _tr('Save Changes') }}</button>
            </form>
            </div>
            </div>
@stop