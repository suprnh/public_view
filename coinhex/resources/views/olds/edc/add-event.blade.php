@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($event_data)) echo "Edit Event"; else echo "Add New Event"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

            @if (Session::has('event_success'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-success">{{ Session::get('event_success') }}</div>
            </div></div>
            @endif

            @if (Session::has('event_error'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-danger">{{ Session::get('event_error') }}</div>
            </div></div>
            @endif
             

            <form name="ar-frm" action="<?php if(!empty($event_data)) { ?> {{ route('edc-update-event') }} <?php } else { ?> {{ route('edc-save-event') }} <?php } ?>" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="form-group">
                    <label>Event Name</label>
                    <input class="form-control" type="text" name="title" id="title" value="<?php if(!empty($event_data)) echo $event_data->title; else { ?>{{ old('title') }}<?php } ?>">
                    @if($errors->has('title'))
                    <span style="color:RED;"><small>{{$errors->first('title')}}</small></span>
                    @endif
                </div>

                <?php if(isset($event_data)){ ?>
                <div class="form-group">
                    <label>Url Path</label>
                    <input class="form-control" type="text" name="slug" id="slug" value="<?php if(!empty($event_data)) echo $event_data->slug; else { ?> {{ old('slug') }} <?php } ?>">
                    @if($errors->has('slug'))
                    <span style="color:RED;"><small>{{$errors->first('slug')}}</small></span>
                    @endif
                </div>
                <?php } ?>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control ar-editor"><?php if(!empty($event_data)) echo $event_data->description; else { ?>{{ old('description') }}<?php } ?></textarea>
                    @if($errors->has('description'))
                    <span style="color:RED;"><small>{{$errors->first('description')}}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Start Date :</label>
                    <input type="text" name="start_date" id="start_date" class="form-control datepicker" value="<?php if(!empty($event_data)) echo date('d-m-Y',strtotime($event_data->start_date)); else { ?>{{ old('start_date') }} <?php } ?>">
                    @if($errors->has('start_date'))
                    <span style="color:RED;"><small>{{$errors->first('start_date')}}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>End Date :</label>
                    <input type="text" name="end_date" id="end_date" class="form-control datepicker" value="<?php if(!empty($event_data)) echo date('d-m-Y',strtotime($event_data->end_date)); else { ?>{{ old('end_date') }} <?php } ?>">
                    @if($errors->has('end_date'))
                    <span style="color:RED;"><small>{{$errors->first('end_date')}}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" <?php if(!empty($event_data) && $event_data->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                        <option value="0" <?php if(!empty($event_data) && $event_data->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image(s)</label>
                    <input type="file" name="event_img[]" multiple="multiple">
                </div>

                <?php if(!empty($event_data) && !empty($event_imgs)) { ?>
                <div class="form-group">
                    <?php foreach($event_imgs as $img) { ?>
                        <div style="width:95px; float:left;">
                        <img src="<?php echo get_recource_url($img->upload_master_id); ?>" style="width:90px; height:80px; border:1px solid black; border-radius:4px;"><br/>
                        <input type="checkbox" name="del_img[]" value="<?php echo $img->upload_master_id; ?>"> Remove
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <div style="clear:both;"></div>
                <div class="form-group" style="margin-top: 10px;">
                    <?php if(!empty($event_data)) { ?>
                    <input type="submit" name="update_event" value="Save Event" class="btn btn-success">
                    <input type="hidden" name="event_id" value="<?php echo $event_data->ID; ?>">
                    <a href="{{ route('edc-all-events') }}" class="btn btn-primary">All Events</a>
                    <?php } else { ?>
                    <input type="submit" name="create_event" value="Create Event" class="btn btn-primary">
                    <?php } ?>
                </div>

            </form>

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

@push('footer-js')
    <script type="text/javascript">

        
    </script>
@endpush