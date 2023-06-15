<!-- Stories and news section start -->
<section class="stri_nws_bg">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class="ltst_stori_sec">
          <h2 class="sec_hdn"><span>Start-Up</span> Stories</h2>
          <div id="stories" class="owl-carousel owl-theme">
            <?php if(!empty($sStories) && count($sStories) > 0) { ?>
          <?php foreach($sStories as $sStory) { ?>
              <div class="item">
              <p><b><?php echo $sStory->title;?> : </b> &nbsp;<?php echo str_limit(strip_tags($sStory->description),200,'...');?></p>
              <h3 class="athr"><?php echo $sStory->alumni_name;?></h3>
              <h4 class="dsig"><?php echo $sStory->alumni_designation;?></h4>
              <a class="mor_lnk" href="<?php echo url('/stories/'.$sStory->slug); ?>">Read more</a>
            </div>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 pull-right">
        <div class="ltst_nws_sec">
          <div class="nws_hdn">
            <h2 class="sec_hdn"><span>Latest</span> News</h2>
            <a class="viw_btn" href="{{ url('news') }}">View All</a>
          </div>
          <?php if(!empty($allNews) && count($allNews) > 0) { ?>
          <?php foreach($allNews as $news) { ?>
          <div class="ltst_nws_txt">
            <p class="date"><i class="fa fa-calendar"></i> <?php echo date('jS M Y',strtotime($news->publish_date))?></p>
            <p><b><?php echo $news->title;?> : </b> &nbsp;<?php echo str_limit(strip_tags($news->description),200,'...');?></p>
            <a class="mor_lnk" href="<?php echo url('/news/'.$news->slug); ?>">Read more</a>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Stories and news section end -->