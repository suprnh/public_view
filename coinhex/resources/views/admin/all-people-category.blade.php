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
                  <h3 class="panel-title">{{ _tr('All Categories') }}</h3>
                </div>
        
                <div class="panel-body">
                  
                   <form name="frm" action="{{ route('all-people-category') }}" method="get">
                    {{ csrf_field() }}
                   <div class="row">
                      <div class="col-md-3">
                      <div class="form-group">
                      <label>{{ _tr('Status') }}</label>
                        <select name="status" class="form-control">
							<option value="">All</option>
							<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Active</option>
							<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-md-7">
                      <div class="form-group">
                      <label>{{ _tr('Category Name') }}</label>
                        <input type="text" name="s" class="form-control" placeholder="{{ _tr('Category Name') }}" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                      </div>
                      </div>
                      <div class="col-md-2">
                      <div class="form-group">
                      <label></label><br />
                        <input type="submit" name="filter" class="btn btn-default" value="{{ _tr('Search') }}">
                        <?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                          <a href="{{ route('all-people-category') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
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
					   <input type="hidden" name="table" value="people_category">
					   <input type="hidden" name="grid_name" value="People Category">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
					   </div>
					   
                     <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
						  <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                          <th style="width: 60px;">{{ _tr('SL') }}</th>
                          <th>{{ _tr('Category Name') }}</th>
                          <th style="width: 112px;">{{ _tr('Order') }}</th>
                          <th style="width: 112px;">{{ _tr('Status') }}</th>
                          <th style="width: 80px;">{{ _tr('Action') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_people_cat) && count($all_people_cat) > 0)
                        {
                          $sl=1;
                          foreach($all_people_cat as $k=>$v)
                          {
                            ?>
                            <tr>
							  <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $v->name; ?></td>
							  <td>
                                <input class="ajax_update_text form-control" type="text" data-id="<?php echo $v->ID; ?>" data-name="people_category" name="order" id="order_<?php echo $v->ID; ?>" value="<?php echo $v->order; ?>">
                              </td>
                              <td>
                                <select class="ajx_status form-control" name="activity_plan" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                              </td>
                             
                              <td>
                                <a href="{{ route('add-people-category') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('delete-people-category') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Category ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                              </td>
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
					</form>
					</div>
                  </div>
                   <?php if(!empty($all_people_cat) && count($all_people_cat) > 0) { echo $all_people_cat->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop