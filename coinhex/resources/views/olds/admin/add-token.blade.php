@extends('admin.layout.leftbar')
@section('title')
@section('dashboard')
                @if (Session::has('token_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('token_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('token_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('token_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($token)) echo _tr("Edit Token Platform & Distribution"); else echo _tr("Add New Token Platform & Distribution"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($token)) { ?> {{ route('update-token') }} <?php } else { ?> {{ route('save-token') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Title') }} :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($token)) echo $token->title; else  ?>{{ old('title') }}">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('title')) }}</small></span>
                        @endif
                    </div>
					 <div class="form-group">
                        <label>{{ _tr('Sub Title') }} :</label>
                        <input type="text" name="subtitle" class="form-control" value="<?php if(!empty($token)) echo $token->subtitle; else  ?>{{ old('subtitle') }}">
                        @if($errors->has('subtitle'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('subtitle')) }}</small></span>
                        @endif
                    </div>
					
                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($token) && $token->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($token) && $token->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Order') }} :</label>
                        <input type="text" name="order" class="form-control" value="<?php if(!empty($token)) echo $token->order; else  ?>{{ old('order') }}">
                        @if($errors->has('order'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('order')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <?php if(!empty($token)) { ?>
                        <input type="submit" name="update_token" class="btn btn-primary btn-sm-block" value="{{ _tr('Save') }}">
                        <a href="{{ route('all-token') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Token Platform & Distribution') }}</a>
                        <input type="hidden" name="token_id" value="<?php echo $token->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $token->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_token" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Token') }}">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
<script>
function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}

$("#slug").keyup(function(){
        var Text = string_to_slug($(this).val());
        $("#slug").val(Text);        
});
</script>
@stop