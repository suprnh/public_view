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
                  <h3 class="panel-title">{{ _tr('All Contacts') }}</h3>
                </div>
        
                <div class="panel-body">

                  <form name="frm" action="" method="get">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label>{{ _tr('Name or Email or Contact Number') }}</label>
                      <input type="text" name="s" class="form-control" placeholder="{{ _tr('Name or Email or Contact Number') }}" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                    </div>
                    </div>
                    <div class="col-md-2">
                    <div class="form-group">
                    <label></label><br />
                      <input type="submit" name="src" class="btn btn-default" value="{{ _tr('Search') }}">
                      <?php if(isset($_GET['s']) || isset($_GET['status'])) { ?>
                        <a href="{{ route('all-contacts') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                      <?php } ?>
                    </div>
                  </div>
                  </div>
                  </form>

                  <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
					
					<form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					   <div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
					   <input type="hidden" name="table" value="contact">
					   <input type="hidden" name="grid_name" value="Contact">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
             </div>
             <div class="tablescroll-primary">
                <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
						  <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                          <th>{{ _tr('SL') }}</th>
                          <th>{{ _tr('Name') }}</th>
                          <th>{{ _tr('Plan Amount') }}</th>
						  <th style="width:80px;">{{ _tr('Action') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_plans) && count($all_plans) > 0)
                        {
                          $sl=1;
                          foreach($all_plans as $k=>$v)
                          {
                            ?>
                            <tr>
							  <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>" class="select_each"></td>
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $v->name; ?></td>
                              <td><?php echo "<span class='glyphicon glyphicon-envelope'></span> ".$v->plan_name; ?><br/>
                              </td>
                              <td>
                                <?php echo $v-> plan_amount; ?>
                              </td>
                              <td>
                                <a href="{{ route('add-plan') }}/{{ $v->id }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('delete-plan') }}/{{ $v->id }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Contact?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
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
                   <?php if(!empty($all_plans) && count($all_plans) > 0) { echo $all_plans->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop