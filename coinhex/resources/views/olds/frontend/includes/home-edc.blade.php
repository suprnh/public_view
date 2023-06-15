<?php if(!empty($allEdcs) && count($allEdcs) > 0) { ?>
<!-- EDC Section start -->
<section class="edc_sec">
  <div class="container">
    <div class="edc_hdn_sec">
      <div class="row">
        <div class="col-sm-9 col-xs-8">
          <h1>EDC<span>'s</span></h1>
        </div>
        <div class="col-sm-3 col-xs-4 vew_btn_clmn">
          <a href="{{ url('/edc') }}">View All</a>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach($allEdcs as $edc) { ?>
      <div class="col-sm-4 edc_itm_clmn">
        <div class="edc_itm_img">
          <?php if($edc->list_image_id > 0){ ?>
            <img src="<?php echo get_recource_url($edc->list_image_id); ?>" alt="">
          <?php }else{ ?>
            <img src="{{asset('/public/images/no_image1.jpg')}}" alt="">
          <?php } ?>
        </div>
        <div class="edc_itm_txt">
          <h2><?php echo $edc->full_name; ?></h2>
          <p><?php echo $edc->user_address; ?></p>
          <a class="mor_lnk" href="<?php echo url('/edc/'.$edc->user_slug); ?>">Read More</a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<!-- EDC Section end -->
<?php } ?>