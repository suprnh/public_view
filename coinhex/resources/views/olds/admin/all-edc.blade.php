@extends('admin.layout.leftbar')
@section('dashboard')


    
      
       <div class="row">
       <div class="col-sm-12">     
       <div class="panel panel-default">
      
        <div class="panel-heading">
        <h3 class="panel-title">{{ _tr('All Users') }}</h3>
        </div>
          @if(Session::get('success') !== null)
            <div class="alert alert-success" style="text-align:center;">
                {{ _tr(Session::get('success')) }}
            </div>
           @endif 
		   @if(Session::get('msg') !== null)
            <div class="alert alert-success" style="text-align:center;">
                {{ _tr(Session::get('msg')) }}
            </div>
           @endif
        
          <div class="panel-body">
                    
              <div>
                <form method="GET" action="{{ route('all-edcs') }}" accept-charset="UTF-8">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                     
                <div class="form-group col-sm-2">
                <label>{{ _tr('Status') }}</label>
                   <select name="status" class="form-control">
					  <option value="">{{ _tr('All') }}</option>
                      <option value="1" <?php if(isset($_GET['status'])){ selected ('1',$_GET['status']); } ?>>{{ _tr('Active') }}</option>
                      <option value="0" <?php if(isset($_GET['status'])){ selected ('0',$_GET['status']); } ?>>{{ _tr('Inactive') }}</option>
                   </select>

                 </div>
                   <div class="form-group col-sm-8 ">
					<label>{{ _tr('User Name/Email') }}</label>
					<input type="text" placeholder="{{ _tr('User Name/Email') }}" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>">
				   </div>
                   
                    <div class="form-group col-sm-2">
                    <label></label><br>
                    <button type="submit" class="btn btn-default" id="submitButton">{{ _tr('Search') }}</button>
					<?php if(isset($_GET['s']) || isset($_GET['status'])) { ?>
                        <a href="{{ route('all-edcs') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                    <?php } ?>
                    </div>
                  </form> 
              </div>
            <?php //print_r($users); ?>
              <form name="export-data" id="export-data" action="{{ route('export-users-data') }}" method="POST">
                  <div class="apply_action">
                      <input type="submit" class="btn btn-primary" name="submit_export" id="submit_export" value="{{ _tr('Export') }}">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                  </div>
              </form>
			<form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
			   <div class="apply_action">
			   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
			   <input type="hidden" name="table" value="users">
			   <input type="hidden" name="grid_name" value="User">
			   <input name="_token" type="hidden" value="{{ csrf_token() }}">
               </div>
               <div class="tablescroll-primary">
                  
            <table class="table table-bordered ar-table">
                <thead>
                    <tr>
					    <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                        <th>{{ _tr('User Name') }} <?php sort_html('full_name'); ?></th>                                                
                        <th>{{ _tr('User Email') }} <?php sort_html('email'); ?></th>
                        <th>{{ _tr('Referral user') }}</th>
                        <th>{{ _tr('Subscription Type') }}</th>
                        <th>{{ _tr('Token Amount') }}</th>
                        <th>{{ _tr('Registered On') }} <?php sort_html('created_date'); ?></th>
                        <th style="width: 112px;">{{ _tr('Status') }}</th>
                        <th style="width: 90px;">{{ _tr('Verified') }}</th>
                        <th style="width: 80px;">{{ _tr('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($users) > 0){ ?>
                    @foreach($users as $user)
                    <tr>
					    <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $user->ID; ?>" value="<?php echo $user->ID; ?>" class="select_each"></td>
                        <td>{{ $user->full_name }}</td> 
                        <td> {{ $user->email }} <br/> {{ $user->phone_no }} </td>
						<td><a href="<?php echo route('all-referrals',$user->ID); ?>"><?php echo total_referral($user->ID); ?> {{ _tr('user(s)') }}</a></td>
						<td>
						<?php $sub_plan_details = subscriber_plan_details($user->ID);  ?>
						<?php 
						if(!empty($sub_plan_details)){
						if($sub_plan_details->plan_id == 1){echo 'Monthly Subscriber';} if($sub_plan_details->plan_id == 2){echo 'Yearly Subscriber';}
						}else{
							echo "Not a Subscriber";
						}
						?></h6></td>
						<td><?php echo get_p2p_by_user_id($user->ID); ?> DDT</td>
						<td>{{ $user->created_date }}</td>
                        <td>
                          <select class="ajx_status form-control" name="users" id="status<?php echo $user->ID; ?>" data="<?php echo $user->ID; ?>" <?php if($user->status == 0) { ?> style="border-color: red;" <?php }else{ ?> style="border-color: green;" <?php } ?>>
                            <option value="1" <?php if($user->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if($user->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                          </select>
                        </td>
                        <td>
                          <select class="ckb_isfront form-control" name="users" id="isfront<?php echo $user->ID; ?>" data="<?php echo $user->ID; ?>" <?php if($user->is_activated == 1) { ?> style="border-color: green;" <?php }else{ ?> style="border-color: red;" <?php } ?>>
                              <option value="1" <?php if($user->is_activated == 1) { ?> selected="selected" <?php } ?>>YES</option>
                              <option value="0" <?php if($user->is_activated == 0) { ?> selected="selected" <?php } ?>>NO</option>
                            </select>
                        </td>
                        <td>  
                            <a class="btn btn-xs btn-success" href="{{ route('edit-edc',$user->ID) }}"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="delete_user('{{ $user->ID }}')"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>
                    @endforeach
                    <?php }else{ ?>
                    <tr>
                        <td width="100%" align="center" colspan="8"> {{ _tr('No User Found !') }}</td>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
                    </div>
            </form>
			<div class="text-center">
            <?php if(!empty($users) && count($users) > 0) { echo $users->appends($_GET)->links(); } ?>
                
            </div>      
                </div>
    </div>
        </div>
    </div>
    <script>
    function delete_user(user_id){
      var con = confirm('<?php echo _tr('Are you sure about deletion ?'); ?>');
      if(con===true){
      window.location.href = '<?php echo url("iamadmin/dashboard/delete-user")?>/'+user_id;
      }
    }
    </script>
@stop