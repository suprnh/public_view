@extends('admin.layout.leftbar')
@section('dashboard')
            <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
        {{ _tr('Change Password') }}
        </h3>
        </div>
<div class="panel-body">
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

                <form name="frm" action="{{ route('save-cng-pwd') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>{{ _tr('Current Password') }}</label>
                    <input type="password" name="cpwd" id="cpwd" class="form-control" value="{{ old('cpwd') }}" autocomplete="off">
                    <input type="checkbox" id="ck_cpwd" onclick="fun_ck_cpwd();"> {{ _tr('Show Password') }}
                    @if($errors->has('cpwd'))
                    <span style="color:RED;"><small>{{ _tr($errors->first('cpwd')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ _tr('New Password') }}</label>
                    <input type="password" name="npwd" id="npwd" class="form-control" value="{{ old('npwd') }}" autocomplete="off">
                    <input type="checkbox" id="ck_npwd" onclick="fun_ck_npwd();"> {{ _tr('Show Password') }}
                    @if($errors->has('npwd'))
                    <span style="color:RED;"><small>{{ _tr($errors->first('npwd')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ _tr('Re-type Password') }}</label>
                    <input type="password" name="npwd_confirmation" id="rpwd" class="form-control" value="{{ old('npwd_confirmation') }}" autocomplete="off">
                    <input type="checkbox" id="ck_rpwd" onclick="fun_ck_rpwd();"> {{ _tr('Show Password') }}
                    @if($errors->has('npwd_confirmation'))
                    <span style="color:RED;"><small>{{ _tr($errors->first('npwd_confirmation')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" name="ok" class="btn btn-primary btn-sm-block" value="{{ _tr('Change Password') }}">
                </div>
                </form>
                </div>
                </div>
@stop

@push('footer-js')
<script type="text/javascript">
function fun_ck_cpwd() {
    var x1 = document.getElementById("cpwd");
    if (x1.type === "password") {
        x1.type = "text";
    } else {
        x1.type = "password";
    }
}
function fun_ck_npwd() {
    var x2 = document.getElementById("npwd");
    if (x2.type === "password") {
        x2.type = "text";
    } else {
        x2.type = "password";
    }
}
function fun_ck_rpwd() {
    var x3 = document.getElementById("rpwd");
    if (x3.type === "password") {
        x3.type = "text";
    } else {
        x3.type = "password";
    }
}
</script>
@endpush