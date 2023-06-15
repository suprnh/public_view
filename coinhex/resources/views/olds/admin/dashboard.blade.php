@extends('admin.layout.leftbar')
@section('title')
<div class="col-lg-12">
            <h1 class="page-header">{{ _tr('PAR Coin Backend Management') }}</h1>
</div>
@stop
@section('dashboard')


<style>

	.box {
    padding-bottom: 20px;
    border-radius: 25px;
    padding: 20px;
    /* min-height: 200px; */
    background-color: #eabf22;
    /* border-left: 3px solid white; */
    /* border-right: 3px solid white; */
    margin-bottom: 20px;
}

h3{
	
	
    color: black;
    font-weight: bold;
	
}

</style>


  <div class="row">
  
	<div class="col-md-4  ">
	  <div class="box">
       <h3>Total Verified User</h3>
      <h4><?php echo all_verified_user() ?></h4>   
      </div>
	</div>
	
	<div class="col-md-4  " >
	  <div class="box">
       <h3>PAR Token issued</h3>
      <h4><?php echo all_acw_token() ?> PAR</h4>   
      </div>
	</div>
	
	<div class="col-md-4   " >
		<div class="box">
      <h3>Bonus issued</h3>
        <h4><?php echo all_bonus() ?></h4>      
        </div>
	</div>
	
	<div class="col-md-4 " >
	   <div class="box">
        <h3>Total Contributiion BTC</h3>
         <h4><?php echo total_contribution_btc(); ?> BTC</h4>   
       </div>
	</div>
	
	<div class="col-md-4  " >
		<div class="box">
            <h3>Total Contribution ETH</h3>
        <h4><?php echo total_contribution_eth(); ?> ETH</h4>
        </div>
	</div>

	<div class="col-md-4   " >
	  <div class="box">
       <h3>Total Contribution USDT</h3>
      <h4><?php echo total_contribution_usdt(); ?> USDT</h4>   
      </div>
	</div>
							
</div>
					
		
			   
                
                <?php /*if(!empty($recent_activity) && count($recent_activity) > 0) {?>     
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Recent Activities</div>
                        <div class="panel-body">
                        <table class="table table-striped">
                        <?php
                        foreach($recent_activity as $activity)
                        {
                        ?>
                            <tr>
                                <td style="width:30%;">
                                    <span>
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        <strong><?php echo date('d-m-Y', strtotime($activity->from_date)); ?></strong>
                                    </span>
                                </td>
                                <td style="text-align: left;">
                                    <label><strong><?php echo $activity->title; ?></strong></label>
                                    <span><small><?php echo str_limit(strip_tags($activity->description),90,'...'); ?></small></span>
                                </td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                        </table>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(!empty($recent_story) && count($recent_story) > 0) {?>     
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Start-up Stories</div>
                        <div class="panel-body">
                        <table class="table table-striped">
                        <?php
                        foreach($recent_story as $story)
                        {
                        ?>
                            <tr>
                                <td>
                                <label><strong><?php echo $story->title; ?></strong></label>
                                <span><small><?php echo str_limit(strip_tags($story->description),120,'...'); ?></small></span>
                                </td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                        </table>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div style="clear: both;"></div>
            
            <?php if(!empty($recent_event) && count($recent_event) > 0) {?>     
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Recent Events</div>
                        <div class="panel-body">
                        <table class="table table-striped">
                        <?php
                        foreach($recent_event as $event)
                        {
                        ?>
                            <tr>
                                <td>
                                    <span>
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        <strong><?php echo date('d-m-Y', strtotime($event->start_date)); ?></strong>
                                    </span>
                                </td>
                                <td style="text-align: left;">
                                    <label><strong><?php echo $event->title; ?></strong></label>
                                    <span><small><?php echo str_limit(strip_tags($event->description),50,'...'); ?></small></span>
                                </td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                        </table>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(!empty($top_mentor) && count($top_mentor) > 0) {?>     
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Top Mentors</div>
                        <div class="panel-body">
                        <table class="table table-striped">
                        <?php
                        foreach($top_mentor as $mentor)
                        {
                            $ph = unserialize($mentor->phone_no);
                            $f = $mentor->first_name;
                            $l = $mentor->last_name;
                        ?>
                            <tr>
                                <td>
                                    <?php if($mentor->image_id != 0) {?>
                                    <img src="<?php echo get_recource_url($mentor->image_id); ?>" style="width:64px; height:64px; border:1px solid black; border-radius:50%;">
                                    <?php } else { ?>
                                    <img src="https://ui-avatars.com/api/?name=<?php echo $f; ?>+<?php echo $l; ?>&rounded=true">
                                    <?php } ?><br/>
                                </td>
                                <td><?php echo $mentor->first_name." ".$mentor->last_name; ?></td></td>
                                <td>
                                    <span class="glyphicon glyphicon-envelope"></span> <?php echo $mentor->email; ?>
                                    <br/><span class="glyphicon glyphicon-phone"></span> <?php if(!empty($ph)) echo $ph[0]; ?>
                                </td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                        </table>
                        </div>
                    </div>
                </div>
            <?php }*/ ?>
                

                
                
                

            </div>
			
			
			
			
@stop