<?php
if(!empty($allBanners) && count($allBanners) > 0) {
?>
<!-- banner section start -->
<section class="hom_bnr">
  <div id="hmBnr" class="owl-carousel owl-theme">
    <?php foreach($allBanners as $banner) { ?>
      <div class="item">
        <img src="<?php echo get_recource_url($banner->image_id); ?>" alt="">
      </div>
    <?php } ?>
  </div>
  <div class="hm_bnr_cap">
    <div class="container">
      <ul class="bnr_cap_logo">
        <?php 
		  $site_logo_id = get_settings('site_logo_id');
		  if($site_logo_id > 0){
			  $site_logo_url = get_recource_url($site_logo_id);
		  }else{
			  $site_logo_url = url('/public/frontend/images/bnr_cap_logo1.jpg');
		  }
		  
		  $alt_site_logo_id = get_settings('alt_site_logo_id');
		  if($alt_site_logo_id > 0){
			  $alt_site_logo_url = get_recource_url($alt_site_logo_id);
		  }else{
			  $alt_site_logo_url = url('/public/frontend/images/bnr_cap_logo2.jpg');
		  }
		  ?>
		  <li><a href="{{ url('/') }}"><img src="<?php echo $site_logo_url; ?>" alt=""></a></li>
		  <li><a href="{{ url('/') }}"><img src="<?php echo $alt_site_logo_url; ?>" alt=""></a></li>
		</ul>
      <?php echo get_settings('home_title');?>
      <?php echo get_settings('home_desc');?>
      <?php 
      $more_link = get_settings('more_link');
      if(!empty($more_link)){ ?>
      <a class="dflt_btn" href="<?php echo $more_link; ?>"><span>Read More</span></a>
      <?php } ?>
    </div>
  </div>
</section>
<!-- banner section end -->
<?php } ?>