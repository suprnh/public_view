@extends('admin.layout.leftbar')
@section('dashboard')
          <div class="row">
            <div class="col-sm-12">

              @if (Session::has('msg'))
              <div class="row"><div class="col-sm-12">
              <div class="alert alert-success">{{ Session::get('msg') }}</div>
              </div></div>
              @endif

<?php $tim_thimb_url = url('timthumb.php'); ?>              

              <div class="panel panel-default">
      
                <div class="panel-heading">
                  <h3 class="panel-title">All Uploads</h3>
                </div>
        
                <div class="panel-body">
                   <div>
                    <form method="GET" action="{{ route('all-uploads') }}" accept-charset="UTF-8">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                         
                  
                    <div class="form-group col-sm-8">
                    <label>Title/Description</label>
                    <input type="text" placeholder="Title/Description" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>">
                     </div>
                       
                    <div class="form-group col-sm-2">
                        <label></label><br>
                    <button type="submit" class="btn btn-default" id="submitButton">Search</button>
                    </div>
                      </form> 
                  </div>

                  <div class="clearfix"></div>
                   <div class="upload_master">
                  <?php
                  
                  if(!empty($all_uploads) && count($all_uploads) > 0)
                  {
                      ?>
                      <ul class="media_window">
                      <?php
                      foreach($all_uploads as $k=>$v)
                      {
                        $image_url = get_recource_url($v->ID);
                        $image_name = $v->name;
                        $image_type = $v->type;
                        $image_path = public_path('/'.$v->url.'/'.$image_name);
                        $size = image_size($image_path);

                        list($width, $height) = getimagesize($image_path);
                        $dimention = $width.' px X '.$height.' px';

                        if(is_url_exist($image_url)){
                          $image_src = '<img src="'.$tim_thimb_url.'?src='.$image_url.'&w=150&h=150&zc=1&q=100" data-dimention="'.$dimention.'" data-size="'.$size.'" data-url="'.$image_url.'" data-name="'.$image_name.'" data-type="'.$image_type.'" data-ID="'.$v->ID.'">';
                        }else{
                          $image_src = '';
                        }
                        ?>
                        <li class="each-asset"><?php echo $image_src; ?></li>
                        <?php
                      }
                      ?>
                      </ul>
                      <?php
                  }
                  ?>
                  </div>
                  <?php if(!empty($all_uploads) && count($all_uploads) > 0) { echo $all_uploads->links(); } ?>


                </div>
              </div>

            </div>
          </div>


  <div class="modal fade" id="addImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image Detail</h4>
        </div>
        <div class="modal-body" id="modal_body">

        <div class="row">
          Loading.....
        </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="choosen_image" id="choosen_image" value="">
          <button type="button" class="btn btn-danger" id="delete_image" data-image_id="0">Delete</button>
        </div>
      </div>
      
    </div>
  </div>


<style>
.upload_master ul{ list-style: none; font-size: 0; padding-left: 0; }
.upload_master ul li{ display: inline-block; margin: 20px 20px 0 0;cursor: pointer; }
.upload_master ul li img{ max-width: 145px; height: 150px; object-fit: cover; border: 1px solid rgba(0, 0, 0, 0.3); padding: 1px; }
.upload_master ul li.active{ box-shadow: 0 0 15px rgb(73, 175, 10); }
.upload_master ul li.active img{ border: 3px solid #49af0a; }
.modal_img_clmn img{ border: 1px solid rgba(0, 0, 0, 0.3); padding: 2px; }
.modal_txt_clmn p span{ width: 100px; display: inline-block; font-weight: bold; }
.modal_txt_clmn p input{ width: 75%; }
</style>

<script>
$(".each-asset").click(function(){
  
});

$('body').on('click', '.each-asset', function() {
    $('.each-asset').removeClass('active');
    $(this).addClass('active');
    var active_image_url = $('img', this).attr("src"); 
    var image_type = $('img', this).attr("data-type"); 
    var image_name = $('img', this).attr("data-name"); 
    var image_url = $('img', this).attr("data-url"); 
    var image_size = $('img', this).attr("data-size"); 
    var image_dimention = $('img', this).attr("data-dimention"); 
    var image_ID = $('img', this).attr("data-ID");

    var data = '<div class="row">\
          <div class="col-md-3 modal_img_clmn">\
            <img src="'+active_image_url+'">\
          </div>\
          <div class="col-md-9 modal_txt_clmn">\
            <p><span>Type:</span> '+image_type+'</p>\
            <p><span>Size:</span> '+image_size+' </p>\
            <p><span>Dimention:</span> '+image_dimention+' </p>\
            <p><span>Title:</span> '+image_name+' </p>\
            <p><span>URL:</span> <input type="text" name="show_url" id="show_url" value="'+image_url+'"></p>\
          </div>\
        </div>';
    $( "#modal_body" ).html( data );
    $("#delete_image").attr('data-image_id',image_ID);
    $(".modal").modal("show");
});

$('body').on('click', '#delete_image', function() {
  var img_id = $(this).attr("data-image_id");
  var con = confirm('<?php echo _tr('Are you sure about deletion ?'); ?>');
  if(con===true){
    window.location.href="<?php echo route('delete-upload'); ?>/"+img_id;
  }
});
</script>
    
@stop