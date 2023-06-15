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
		
		
			<a href="{{ route('sub-transaction') }}" style="float:right">{{ __t('Subscription Transaction') }}</a>
		
		</h2>
		@include('frontend.section.msg')
		
		
		
		
		<div class="col-lg-12 mt-3">
						<div class="table_area bg-white table-responsive p-3">
							<table class="table table-hover " id="token_table" >
							  <thead>
							    <tr>
								  <th scope="col">ID</th>
							      <th scope="col">Currency<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">Crypto Amount<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">Dollar Amount<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">TxHash<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">Status<i class="bi bi-chevron-expand"></i></th>
							      <th scope="col">Date & Time<i class="bi bi-chevron-expand"></i></th>
							    </tr>
							  </thead>
							  <tbody>							  							  
								<?php
									if(!empty($curr_urt) && count($curr_urt) > 0){
										$sl=1;
										foreach($curr_urt as $k=>$v){
											?>
											<tr>
												<th scope="row"><?php echo $sl; ?></th>
												<td><?php echo strtoupper($v->currency);?></td>
												<td><?php echo $v->base_amount; ?></td>
												<td><?php echo $v->amount; ?></td>
												<td><?php echo $v->transfer_proof; ?></td>
											    <td><?php echo get_status_lable($v->status); ?></td>
												<td><?php echo $v->created_date; ?></td>
											
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
							<?php if(!empty($curr_urt) && count($curr_urt) > 0) { echo $curr_urt->links(); } ?>
						</div>
					</div>
		
		
		
		
		
		
	</div><!-- .user-panel -->
</div><!-- .user-content -->


@endsection