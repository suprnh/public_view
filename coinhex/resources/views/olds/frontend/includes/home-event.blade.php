<?php if(!empty($pastEvent) && count($pastEvent)) { ?>
<!-- Latest Events Section start -->
<section class="ltst_evnts_sec">
  <div class="container">
    <h2 class="sec_hdn"><span>Latest</span> Events</h2>
    <div class="row">
      
      <?php 
      foreach($pastEvent as $pe) { 
        $arr = $pe->event_imgs;
        $image_id = 0;
        if(!empty($arr))
        {
          $image_id = $arr->image_id;
        }
      ?>
      
      <div class="col-sm-4 ltst_evnt_clmn">
        <div class="ltst_evnt_itm">
          <?php $tim_thimb_url = url('timthumb.php');?>
          <?php if($image_id > 0){ ?>
          <img src="<?php if(isset($image_id))  echo $tim_thimb_url.'?src='.get_recource_url($image_id).'&w=300&h=200&zc=1&q=100'; else echo asset("public/no-image.png"); ?>" alt="">
          <?php }else{ ?>
          <img src="{{ asset('/public/images/no_image2.jpg') }}">
          <?php } ?>
          <div class="ltst_evnt_txt">
            <h3 class="date"><?php echo date('j F Y', strtotime($pe->start_date)); ?></h3>
            <h4 class="title"><a href="<?php echo url('/events/'.$pe->slug); ?>"><?php echo $pe->title; ?></a></h4>
          </div>
        </div>
      </div>
      <?php } ?>
      
    </div>
  </div>
</section>
<!-- Latest Events Section end -->
<?php } ?>