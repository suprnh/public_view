<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
<?php $user_detail = get_user_detail_by_id(get_current_front_user_id());


 ?>                               
<div class="user-content">
	<div class="user-panel">
		<h2 class="user-panel-title">
		<?php if(what_my_role_logged_in()=='partner'){ ?>
		{{ __t('Investment Proof') }}
		<?php }else{ ?>
		{{ __t('Transaction Information') }}
		<?php } ?>
		</h2>
		@include('frontend.section.msg')
		
		
		
		
		<div class="col-lg-12 mt-3">
						<div class="table_area bg-white table-responsive p-3">
							<table class="table table-hover " id="token_table" >
							  <thead>
							    <tr>
								  <th scope="col">ID</th>
							      <th scope="col">Amount<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">Transaction ID<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">Transaction Date<i class="bi bi-chevron-expand"></i></th>
							      
							    </tr>
							  </thead>
							  <tbody>							  							  
								<?php
								
									
									if(!empty($sub_tran) && count($sub_tran) > 0){
										$sl=1;
										foreach($sub_tran as $k=>$v){
											?>
											<tr>
												<th scope="row"><?php echo $sl; ?></th>
												<td><?php echo strtoupper($v->amount);?></td>
												<td><?php echo $v->transaction_id; ?></td>
												<td><?php echo $v->created_at; ?></td>
											</tr>
								<?php
									$sl++;
									}
									}
									else
									{
										echo "<tr><td colspan='6' style='text-align:center'>"._tr('No Data Found')."</td></tr>";
									}
									?>
							  </tbody>
							</table>
							<?php if(!empty($sub_tran) && count($sub_tran) > 0) { echo $sub_tran ->links(); } ?>
						</div>
					</div>
		
		
		
		
		
		
	</div><!-- .user-panel -->
</div><!-- .user-content -->


@endsection