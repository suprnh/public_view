@if(Session::get('error') !== null)
<div class="alert-box alert-primary">
	<div class="alert-txt"><em class="ti ti-alert"></em>{{ __t(Session::get('error')) }}</div>
</div><!-- .alert-box -->
@endif 
@if(Session::get('message') !== null)
<div class="alert-box alert-primary">
	<div class="alert-txt"><em class="ti ti-check"></em>{{ __t(Session::get('message')) }}</div>
</div><!-- .alert-box -->
@endif 