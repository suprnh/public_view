@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">Change Password</h1>
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

                <form name="frm" action="{{ route('edc-save-cng-pwd') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="cpwd" id="cpwd" class="form-control" value="{{ old('cpwd') }}" autocomplete="off">
                    <input type="checkbox" id="ck_cpwd" onclick="fun_ck_cpwd();"> Show Password 
                    @if($errors->has('cpwd'))
                    <span style="color:RED;"><small>{{$errors->first('cpwd')}}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="npwd" id="npwd" class="form-control" value="{{ old('npwd') }}" autocomplete="off">
                    <input type="checkbox" id="ck_npwd" onclick="fun_ck_npwd();"> Show Password
                    @if($errors->has('npwd'))
                    <span style="color:RED;"><small>{{$errors->first('npwd')}}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Re-type Password</label>
                    <input type="password" name="npwd_confirmation" id="rpwd" class="form-control" value="{{ old('npwd_confirmation') }}" autocomplete="off">
                    <input type="checkbox" id="ck_rpwd" onclick="fun_ck_rpwd();"> Show Password
                    @if($errors->has('npwd_confirmation'))
                    <span style="color:RED;"><small>{{$errors->first('npwd_confirmation')}}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" name="ok" class="btn btn-primary" value="Change Password">
                </div>
                </form>
            

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