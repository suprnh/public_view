@extends('admin.layout.leftbar')
@section('dashboard')
          <div class="row">
            <div class="col-sm-12">

              @if (Session::has('msg'))
              <div class="row"><div class="col-sm-12">
              <div class="alert alert-success">{{ _tr(Session::get('msg')) }}</div>
              </div></div>
              @endif


              <div class="panel panel-default">
      
                <div class="panel-heading">
                  <h3 class="panel-title">{{ _tr('All Contributions') }}</h3>
                </div>
        
                <div class="panel-body">

                  <form name="frm" action="{{ route('all-contributions') }}" method="get">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-sm-2">
						<div class="form-group ">
							<label>{{ _tr('Status') }}</label>
							<select name="status" class="form-control">
								<option value="">All</option>
								<option value="3" <?php if(isset($_GET['status'])){ selected ('3',$_GET['status']); } ?>>Accepted</option>
								<option value="0" <?php if(isset($_GET['status'])){ selected ('0',$_GET['status']); } ?>>Pending</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
					 <div class="form-group">
						<label>{{ _tr('Currency') }}</label>
						 <select class="form-control" name="currency" id="currency">
							<option value="">All</option>
							<option value="eth" <?php if(isset($_GET['currency'])){ selected ('eth',$_GET['currency']); } ?>>ETH</option>
							<option value="usdt" <?php if(isset($_GET['currency'])){ selected ('usdt',$_GET['currency']); } ?>>USDT</option>
							<option value="btc" <?php if(isset($_GET['currency'])){ selected ('btc',$_GET['currency']); } ?>>BTC</option>
							<option value="bnb" <?php if(isset($_GET['currency'])){ selected ('bnb',$_GET['currency']); } ?>>BNB</option>
							<option value="ada" <?php if(isset($_GET['currency'])){ selected ('ada',$_GET['currency']); } ?>>ADA</option>
							<option value="usd" <?php if(isset($_GET['currency'])){ selected ('usd',$_GET['currency']); } ?>>USD</option>
						</select>
					</div>
				</div>
                    <div class="col-sm-6">
                    <div class="form-group">
					 <label>{{ _tr('Email') }}</label>
                     <input type="text" name="s" class="form-control" placeholder="Email" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                    </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="form-group">
					<label class="hidden-xs"></label><br>
                      <input type="submit" name="src" class="btn btn-default" value="Search">
                      <?php if(isset($_GET['s']) || isset($_GET['status'])) { ?>
                        <a href="{{ route('all-contributions') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                      <?php } ?>
                    </div>
                    </div>
                  </form>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <form name="export-data" id="export-data" action="{{ route('export-contribution-data') }}" method="POST">
                            <div class="apply_action">
                                <input type="submit" class="btn btn-primary" name="submit_export" id="submit_export" value="{{ _tr('Export') }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            </div>
                        </form>
					    <form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					   <div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
					   <input type="hidden" name="table" value="contribution">
					   <input type="hidden" name="grid_name" value="Contribution">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
             </div>
             <div class="tablescroll-primary">
                 <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
						  <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                          <th>{{ _tr('SL') }}</th>
						  <th>{{ _tr('Date') }} </th>
                          <th>{{ _tr('Email') }} </th>
                          <th>{{ _tr('Currency') }} </th>
                          <th>{{ _tr('Amount') }} </th>
                          <th>{{ _tr('Status') }}</th>
                          <th>{{ _tr('DDT Qty') }}</th>
                          <th>{{ _tr('Bonus Amount') }}</th>
                          <th>{{ _tr('Total DDT Qty') }}</th>
						  <th>{{ _tr('Referral  Commission') }}</th>
                          
                          <th style="width:80px !important; white-space: nowrap;">{{ _tr('Action') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_contributions) && count($all_contributions) > 0)
                        {
                          $sl=1;
                          foreach($all_contributions as $k=>$v)
                          {
                            ?>
                            <tr>
							  <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                              <td><?php echo $sl; ?></td>
							  <td><?php echo date("d-m-Y",strtotime($v->created_date)); ?></td>  
                              <td>
							  <?php echo $v->email; ?>
							  <br/>
							  <?php 
							  $udetail = get_user_detail_by_id($v->submitted_by); 
							  if(isset($udetail) && !empty($udetail)){
								  echo $udetail->full_name;
							  }
							  ?>
							  </td>
								<td>
								<?php 
									echo strtoupper($v->currency); 
							  
								?>
								</td>
                              <td><?php echo number_format($v->amount,5,'.',','); ?></td>
                              <td>
							  <?php echo get_status_lable($v->status); ?>
							  <?php 
							  if($v->submitted_by > 0 && $v->status==3 ){
								$parent_id = if_has_parent_user($v->submitted_by);
								if($parent_id > 0){
									$ref_amt = total_referral_bycontribution($v->ID);
									if($ref_amt > 0){
										?>
										<p> {{ _tr('Ref Commission') }} : <?php echo number_format($ref_amt,2,'.',','); ?> </p>
										<?php
									}
								}
							  } 
							  ?>
							  </td>
							  <?php  $amnt = $v->base_amount; ?>
                              <td><?php echo number_format($amnt,2,'.',','); ?></td>
							   <td><?php echo number_format($v->bonus_amount,2,'.',','); ?></td>
							   <td>
							   <?php 
							   $bonus_amount = 0;
							   $bonus_amount = (float)$v->bonus_amount;
							   $total = $amnt+$bonus_amount;
							   echo number_format($total,2,'.',',');
							   ?>
							   </td>
							  <td><?php echo get_ref_commission($v->ID); ?></td>
							  
                              <td  style="width:80px !important; white-space: nowrap;">
                                <a href="{{ route('add-contribution') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('delete-contribution') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure to delete this contribution ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                              </td>
                            </tr>
                            <?php
                            $sl++;
                          }
                        }
                        else
                        {
                          echo "<tr><td colspan='11' style='text-align:center;'>"._tr('No Data Found')."</td></tr>";
                        }
                        ?>
                      </tbody>
                     </table>
                      </div>
                  </form>
                 </div>
                   <?php if(!empty($all_contributions) && count($all_contributions) > 0) { echo $all_contributions->appends($_GET)->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop