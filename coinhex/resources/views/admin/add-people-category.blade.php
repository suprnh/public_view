@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('cat_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('cat_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('cat_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('cat_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">
        <?php if(!empty($kyc)) echo _tr("Edit Category") ; else echo _tr("Add New Category") ; ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($people_cat)) { ?> {{ route('update-people-category') }} <?php } else { ?> {{ route('save-people-category') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
				
				
                <div class="form-group">
                        <label>{{ _tr('Category Name') }}</label>
                        <input class="form-control" type="text" name="cat_name" id="cat_name" value="<?php if(!empty($people_cat)) echo $people_cat->name; else { ?>{{ old('cat_name') }}<?php } ?>">
                        @if($errors->has('cat_name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('cat_name')) }}</small></span>
                        @endif
                </div>
				
                <div class="form-group">
                    <label>{{ _tr('Status') }}</label>
                    <select class="form-control" name="status" id="status">
     
                        <option value="1" <?php if(!empty($people_cat) && $people_cat->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
						<option value="0" <?php if(!empty($people_cat) && $people_cat->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                     
                    </select>
                </div>


                <div class="form-group">
                    <?php if(!empty($people_cat)) { ?>
                    <input type="submit" name="update_category" value="{{ _tr('Save Category') }}" class="btn btn-primary btn-sm-block">
                    <input type="hidden" name="cat_id" value="<?php echo $people_cat->ID; ?>">
                
                    <a href="#" class="btn btn-primary btn-sm-block">{{ _tr('All Categories') }}</a>
                    <?php } else { ?>
                    <input type="submit" name="create_category" value="{{ _tr('Create Category') }}" class="btn btn-primary btn-sm-block">
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