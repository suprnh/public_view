@extends('admin.layout.leftbar')
@section('dashboard')

                @if (Session::has('email_template_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('email_template_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('email_template_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('email_template_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
        <?php if(!empty($email_template)) echo _tr("Edit Email Template"); else echo _tr("Add New Email Template"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($email_template)) { ?> {{ route('update-email-template') }} <?php } else { ?> {{ route('save-email-template') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Subject') }} :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($email_template)) echo $email_template->title; else  ?>{{ old('title') }}">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('title')) }}</small></span>
                        @endif
                    </div>

                    <?php if(!empty($email_template)){ ?>
                    <div class="form-group">
                        <label>{{ _tr('Identifier') }} :</label>
                        <input type="text" name="slug" class="form-control" id="slug" value="<?php if(!empty($email_template)) echo $email_template->slug; else  ?>{{ old('slug') }}" readonly>
                        @if($errors->has('slug'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('slug')) }}</small></span>
                        @endif
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>{{ _tr('Body') }} :</label>
                        <textarea rows="18" name="description" class="form-control ar-editor-1"><?php if(!empty($email_template)) echo $email_template->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('description')) }}</small></span>
                        @endif
                    </div>

                    <!--div class="form-group">
                        <label>Publish Date :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($email_template)) echo $email_template->publish_date; else  ?>{{ old('publish_date') }}">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;"><small>{{$errors->first('publish_date')}}</small></span>
                        @endif
                    </div-->

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($email_template) && $email_template->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($email_template) && $email_template->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

					<?php /*
                    <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="email_template_img">
                    </div>

                    <?php if(!empty($email_template) && $email_template->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($email_template->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;">
                    </div>
                    <?php } ?>
					*/ ?>


                    <div class="form-group">
                        <?php if(!empty($email_template)) { ?>
                        <input type="submit" name="update_email_template" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Email Template') }}">
                        <a href="{{ route('all-email-template') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Email Template') }}</a>
                        <input type="hidden" name="email_template_id" value="<?php echo $email_template->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $email_template->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_email_template" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Email Template') }}">
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