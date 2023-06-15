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
                  <h3 class="panel-title">{{ _tr('All AML/KYC Applications') }}</h3>
                </div>
        
                <div class="panel-body">
                  
                   <form name="frm" action="{{ route('all-kyc-applications') }}" method="get">
                    {{ csrf_field() }}
                   <div class="row">
                      <div class="form-group col-md-3">
						<label>{{ _tr('Status') }}</label>
                        <select name="status" class="form-control">
						  <option value="">All</option>
                          <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>Pending</option>
                          <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Processing</option>
                          <option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == '2') { ?> selected="selected" <?php } ?>>Rejected</option>
                          <option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == '3') { ?> selected="selected" <?php } ?>>Information missing</option>
                          <option value="4" <?php if(isset($_GET['status']) && $_GET['status'] == '4') { ?> selected="selected" <?php } ?>>Verified</option>
                        </select>
                      </div>
                      <div class="form-group col-md-7">
					    <label>{{ _tr('Applicant Name/ Email') }}</label>
                        <input type="text" name="s" class="form-control" placeholder="{{ _tr('Applicant Name/ Email') }}" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                      </div>
                      <div class="form-group col-md-2">
					  <label></label><br>
                        <input type="submit" name="filter" class="btn btn-default" value="{{ _tr('Search') }}">
                        <?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                          <a href="{{ route('all-kyc-applications') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                        <?php } ?>
                      </div>
                   </div>
                  </form>

                   <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
					<form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					   <div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
					   <input type="hidden" name="table" value="kyc">
					   <input type="hidden" name="grid_name" value="Application">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
					   </div>
             <div class="tablescroll-primary">
                     <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
						  <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                          <th style="width: 60px;">{{ _tr('SL') }}</th>
                          <th>{{ _tr('Applicant Name') }}</th>
                          <th>{{ _tr('Email') }}</th>
                          <th style="width: 100px;">{{ _tr('Nationality') }}</th>
						  <th>{{ _tr('Address') }}</th>
						  <th>{{ _tr('View user / Document') }}</th>
						  <th style="text-align:center;">{{ _tr('Active') }}</th>
                          <th style="width: 190px;">{{ _tr('Status') }}</th>
                          <th style="width: 80px;">{{ _tr('Action') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_kyc) && count($all_kyc) > 0)
                        {
                          $sl=1;
                          foreach($all_kyc as $k=>$v)
                          {
                            ?>
                            <tr>
							  <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $v->first_name; ?> <?php echo $v->last_name; ?></td>
                              <td><?php echo $v->email; ?></td>
                              <td><?php //echo get_country_lable($v->nationality); ?> <?php echo $v->nationality; ?></td>
                              <td>
                                <?php echo $v->address1; ?><br/>
                                <?php echo $v->address2; ?><br/>
                                <?php echo $v->city; ?><br/>
                                <?php echo $v->zipcode; ?><br/>
                              </td>
							  <td>
							  <a href="<?php echo route('edit-edc',$v->user_id) ?>">{{ _tr('View User') }}</a>
							  
							   <?php if(!empty($v->document_type)){ ?>
							   <br/>
								<strong><?php echo get_document_lable($v->document_type); ?></strong>
							    <?php } ?>
							  <?php if($v->document_upload_id > 0){ ?>
							  <br/>
							  <a href="<?php echo get_recource_url($v->document_upload_id); ?>" target="_blank">{{ _tr('View Doc 1') }}</a>
							  <?php } ?>
							  <?php if($v->document_upload_id_2 > 0){ ?>
							  <br/>
							  <a href="<?php echo get_recource_url($v->document_upload_id_2); ?>" target="_blank">{{ _tr('View Doc 2') }}</a>
							  <?php } ?>
							  </td>
							  <td align="center" style="text-align:center;">
							  <?php if($v->latest_one==1){  ?><div class="latest_one"></div><?php } ?>
							  </td>
							   <td>
							   <?php if($v->latest_one !=1){  $disabled = "disabled"; } else{ $disabled = ""; }?>
                                <select class="ajx_status form-control" name="kyc" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 2) { ?> style="border-color: red;" <?php } ?> <?php echo $disabled; ?>>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Pending</option>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Processing</option>
                                  <option value="2" <?php if($v->status == 2) { ?> selected="selected" <?php } ?>>Rejected</option>
                                  <option value="3" <?php if($v->status == 3) { ?> selected="selected" <?php } ?>>Information missing</option>
                                  <option value="4" <?php if($v->status == 4) { ?> selected="selected" <?php } ?>>Verified</option>
                                </select>
								<br>
								<?php echo $v->rejection_cause; ?>
								
                              </td>
                              <td>
								
									<a href="{{ route('add-kyc-application') }}/{{ $v->ID }}" class="btn btn-success btn-xs <?php echo $disabled; ?>"><span class="glyphicon glyphicon-edit"></span></a>
									<a href="{{ route('delete-kyc-application') }}/{{ $v->ID }}" class="btn btn-danger btn-xs <?php echo $disabled; ?>" onclick="return confirm('<?php echo _tr('Sure To Delete This Application ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
								
                              </td>
                            </tr>
                            <?php
                            $sl++;
                          }
                        }
                        else
                        {
                          echo "<tr><td colspan='10' style='text-align:center;'>"._tr('No Data Found')."</td></tr>";
                        }
                        ?>
                      </tbody>
                     </table>
                      </div>
                    </form>
					</div>
                  </div>
                   <?php if(!empty($all_kyc) && count($all_kyc) > 0) { echo $all_kyc->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop