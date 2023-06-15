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
                  <h3 class="panel-title">{{ _tr('All Bonus') }}</h3>
                </div>
        
                <div class="panel-body">
				
				  <?php /*
                  <form name="frm" action="" method="get">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-9">
                      <input type="text" name="s" class="form-control" placeholder="Name or Email or Contact Number" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                    </div>
                    <div class="col-md-2">
                      <input type="submit" name="src" class="btn btn-default" value="Search">
                      <?php if(isset($_GET['s']) || isset($_GET['status'])) { ?>
                        <a href="{{ route('all-bonus') }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                      <?php } ?>
                    </div>
                  </div>
                  </form>
				  */ ?>

                  <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
					<form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					   <div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
					   <input type="hidden" name="table" value="bonus_master">
					   <input type="hidden" name="grid_name" value="Bonus">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
             </div>
             <div class="tablescroll-primary">
                  
                     <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
						  <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                          <th>{{ _tr('SL') }}</th>
                          <th>{{ _tr('Bonus Type') }}</th>
                          <th>{{ _tr('Bonus Amount') }}</th>
                          <th>{{ _tr('Bonus Applicable Range (in ACW)') }}</th>
                          <th>{{ _tr('Bonus Status') }}</th>
                          <th style="width:80px;">{{ _tr('Action') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_bonus) && count($all_bonus) > 0)
                        {
                          $sl=1;
                          foreach($all_bonus as $k=>$v)
                          {
                            ?>
                            <tr>
							  <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                              <td><?php echo $sl; ?></td>
                              <td><?php if($v->bonus_type==0){ echo "Percentage"; }else{ echo "Flat"; } ?></td>
                              <td><?php echo $v->bonus_amount; ?></td>
                              <td><?php echo $v->lower_range; ?> <?php if($v->no_higher=='0'){ ?>- <?php echo $v->higher_range; ?> <?php }else{ ?>+<?php } ?></td>
                              <td><?php if($v->status==1){echo "Active"; }else{ echo "Inactive"; } ?></td>
                              <td>
                                <a href="{{ route('add-bonus') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('delete-bonus') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Bonus ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                              </td>
                            </tr>
                            <?php
                            $sl++;
                          }
                        }
                        else
                        {
                          echo "<tr><td colspan='7' style='text-align:center;'>"._tr('No Data Found')."</td></tr>";
                        }
                        ?>
                      </tbody>
                     </table>
                      </div>
					</form>
				  </div>
                 </div>
                   <?php if(!empty($all_bonus) && count($all_bonus) > 0) { echo $all_bonus->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop