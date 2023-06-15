<!-- event and mentor section start -->
<section class="evnt_mntr_bg">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class="our_mntr_sec">
          <div class="nws_hdn">
            <h2 class="sec_hdn"><span>Our</span> Mentors</h2>
            <a class="viw_btn" href="{{ url('mentors') }}">View All</a>
          </div>
          <?php if(!empty($allmentors) && count($allmentors) > 0) { ?>
          <?php foreach($allmentors as $mentor) { ?>
          <div class="edc_itm_img">
            <?php if($mentor->image_id > 0){ ?>
            <img src="<?php echo get_recource_url($mentor->image_id); ?>" alt="">
            <?php }else{ ?>
            <img src="{{asset('/public/images/no_image3.jpg')}}" alt="">
            <?php } ?>
          </div>
          <?php $read_more = strtolower($mentor->first_name."-".$mentor->last_name."-".$mentor->ID); ?>
          <div class="edc_itm_txt">
            <h2><?php echo $mentor->salutation; ?> <?php echo $mentor->first_name; ?> <?php echo $mentor->last_name; ?></h2>
            <h3><?php echo $mentor->designation; ?></h3>
            <p><?php echo str_limit(strip_tags($mentor->description),20,'...')?></p>
            <a class="mor_lnk" href="{{ route('front-mentor-details') }}/<?php echo $read_more; ?>">Read More</a>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 pull-right">
        <div class="upcmng_evnt_sec">
          <h2 class="sec_hdn"><span>Upcoming</span> Events</h2>
          <div id="upCmngEvnt" class="owl-carousel owl-theme">
            <?php if(!empty($UpcommingEvent) && count($UpcommingEvent) > 0) { ?>
            <?php foreach($UpcommingEvent as $event) { ?>
            <div class="item">
              <p class="date"><i class="fa fa-calendar"></i> <?php echo date('jS M Y',strtotime($event->start_date))?></p>
              <p><b><?php echo $event->title;?> : </b> &nbsp;<?php echo str_limit(strip_tags($event->description),200,'...');?></p>
              <a class="mor_lnk" href="<?php echo url('/events/'.$event->slug); ?>">Read More</a>
            </div>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- event and mentor section end -->