@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('page_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('page_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('page_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('page_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
		<h3 class="panel-title"><?php if(!empty($page)) echo _tr("Edit Page") ; else echo _tr("Add New Page"); ?>
        </h3>
</div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($page)) { ?> {{ route('update-page') }} <?php } else { ?> {{ route('save-page') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Title') }} :</label>
                        <input type="text" name="title" class="form-control" value="<?php if(!empty($page)) echo $page->title; else  ?>{{ old('title') }}">
                        @if($errors->has('title'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('title')) }}</small></span>
                        @endif
                    </div>
                    <?php if(!empty($page)) { ?>
                    <div class="form-group">
                        <label>{{ _tr('Slug') }} :</label>
                        <input type="text" name="slug" class="form-control" value="<?php if(!empty($page)) echo $page->slug; else  ?>{{ old('slug') }}" disabled="disabled">
                        <input type="hidden" name="slug" class="form-control" value="<?php if(!empty($page)) echo $page->slug; else  ?>{{ old('slug') }}">
                        @if($errors->has('slug'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('slug')) }}</small></span>
                        @endif
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>{{ _tr('Description') }} :</label>
                        <div style="margin-bottom: 10px;"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#addImage" >{{ _tr('Add Image') }}</a></div>
                        <textarea name="description" class="form-control ar-editor" id="page_description"><?php if(!empty($page)) echo $page->description; else  ?>{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <span style="color:RED;" class="err_msg"><small>{{  _tr($errors->first('description')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Publish Date') }} :</label>
                        <input type="text" name="publish_date" class="form-control datepicker" value="<?php if(!empty($page)) echo $page->publish_date; else  ?>{{ old('publish_date') }}">
                        @if($errors->has('publish_date'))
                        <span style="color:RED;" class="err_msg"><small>{{  _tr($errors->first('publish_date')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($page) && $page->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($page) && $page->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                     <div class="form-group">
                    <label>{{ _tr('Image') }}</label>
                    <input type="file" name="page_img">
                    </div>

                    <?php if(!empty($page) && $page->image_id != 0) { ?>
                    <div class="form-group">
                        <img src="<?php echo get_recource_url($page->image_id); ?>" style="width:150px;order:1px solid black; border-radius:4px;">
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <?php if(!empty($page)) { ?>
                        <input type="submit" name="update_page" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Page') }}">
                        <a href="{{ route('all-pages') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Pages') }}</a>
                        <input type="hidden" name="page_id" value="<?php echo $page->ID; ?>">
                        <input type="hidden" name="prev_img_id" value="<?php echo $page->image_id; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_page" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Page') }}">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>



<!-- Modal -->
  <div class="modal fade" id="addImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Uploaded Images</h4>
        </div>
        <div class="modal-body" id="modal_body">
          <p>Loading....</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="choosen_image" id="choosen_image" value="">
          <button type="button" class="btn btn-primary" id="select_image" disabled="disabled">Select Image</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal End-->

<script>
function setModalMaxHeight(element) {
  this.$element     = $(element);  
  this.$content     = this.$element.find('.modal-content');
  var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
  var dialogMargin  = $(window).width() < 768 ? 20 : 60;
  var contentHeight = $(window).height() - (dialogMargin + borderWidth);
  var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
  var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
  var maxHeight     = contentHeight - (headerHeight + footerHeight);

  this.$content.css({
      'overflow': 'hidden'
  });

  this.$element
    .find('.modal-body').css({
      'max-height': maxHeight,
      'overflow-y': 'auto'
  });
}

$('.modal').on('show.bs.modal', function() {
  $(this).show();
  $.get( "{{ route('all-assets') }}", function( data ) {
      $( "#modal_body" ).html( data );
  });
  setModalMaxHeight(this);
  $("#choosen_image").val('');
  $("#select_image").attr("disabled", "disabled");
});

$(window).resize(function() {
  if ($('.modal.in').length != 0) {
    setModalMaxHeight($('.modal.in'));
  }
});

$('body').on('click', '.each-asset', function() {
    $('.each-asset').removeClass('active');
    $(this).addClass('active');
    var active_image_url = $('img', this).attr("src");
    $("#choosen_image").val(active_image_url);
    $("#select_image").removeAttr('disabled');
});

$('body').on('click', '#select_image', function() {
    var choosen = $("#choosen_image").val();
    tinymce.get("page_description").execCommand('mceInsertContent', false, '<img src="'+choosen+'">');
    $(".modal").modal("hide");
});


</script>
<style>
.modal-dialog {
  position:absolute;
  top:50% !important;
  transform: translate(0, -50%) !important;
  -ms-transform: translate(0, -50%) !important;
  -webkit-transform: translate(0, -50%) !important;
  margin:auto 5%;
  width:90%;
  height:80%;
}
.modal-content {
  min-height:100%;
  position:absolute;
  top:0;
  bottom:0;
  left:0;
  right:0; 
}
.modal-body {
  position:absolute;
  top:65px;
  bottom:65px;
  left:0;
  right:0;
  overflow-y:auto;
}
.modal-footer {
  position:absolute;
  bottom:0;
  left:0;
  right:0;
}



/* uploader */

.upload_master ul{ list-style: none; font-size: 0; }
.upload_master ul li{ display: inline-block; margin: 20px 20px 0 0;cursor: pointer; }
.upload_master ul li img{ max-width: 150px; height: 150px; object-fit: cover; border: 1px solid rgba(0, 0, 0, 0.3); padding: 1px; }
.upload_master ul li.active{ box-shadow: 0 0 15px rgb(73, 175, 10); }
.upload_master ul li.active img{ border: 3px solid #49af0a; }
</style>

@stop