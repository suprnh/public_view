@extends('admin.layout.leftbar')
@section('dashboard')
          <div class="row">
            <div class="col-sm-12">

              @if (Session::has('msg'))
              <div class="row"><div class="col-sm-12">
              <div class="alert alert-success">{{ Session::get('msg') }}</div>
              </div></div>
              @endif

              
              
              <div class="panel panel-default">
      
                <div class="panel-heading">
                  <h3 class="panel-title">All Events</h3>
                </div>
        
                <div class="panel-body">
                   
                  <form name="frm" action="" method="get">
                    {{ csrf_field() }}
                   <div class="row">
                      <div class="col-md-3">
                      <div class="form-group">
                      <label>{{ _tr('Status') }}</label>
                        <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-md-7 ">
                      <div class="form-group">
                      <label>{{ _tr('Event name or description') }}</label>
                        <input type="text" name="s" class="form-control" placeholder="Event name or description" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                      </div>
                      </div>
                      <div class="col-md-2">
                      <div class="form-group">
                        <label></label><br />
                        <input type="submit" name="filter" class="btn btn-default" value="Search">
                        <?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                          <a href="{{ route('all-events') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                        <?php } ?>
                      </div>
                      </div>
                   </div>
                  </form>

                   <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                    <div class="tablescroll-primary">
                     <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Event Name</th>
                          <th style="width:60px;">EDC</th>
                          <th style="width:100px;">Dates</th>
                          <th style="width:112px;">Status</th>
                          <th style="width:90px;">IsFront</th>
                          <th style="width:80px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_events) && count($all_events) > 0)
                        {
                          $sl=1;
                          foreach($all_events as $k=>$v)
                          {
                            ?>
                            <tr>
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $v->title; ?></td>
                              <td>
                                <?php
                                $eid = $v->is_edc_id;
                                if($eid != "" && $eid !="0"){
                                  $edc_logo_id = getEDC_logoid($eid);
                                  $edc_name = getUserName($eid);
                                  $tim_thimb_url = url('timthumb.php');
                                  if($edc_logo_id != 0 && $edc_logo_id != ""){
                                    $logo = $tim_thimb_url.'?src='.get_recource_url($edc_logo_id).'&w=60&h=60&zc=2&q=100';
                                    echo "<a href='#' data-toggle='tooltip' data-placement='bottom' title='".$edc_name."'>";
                                    echo "<img src='".$logo."' />";
                                    echo "</a>";
                                  } 
                                }
                                ?>
                              </td>
                              <td>
                                <?php echo date('d-m-Y', strtotime($v->start_date)); ?><br/>
                                <?php echo date('d-m-Y', strtotime($v->end_date)); ?>
                                </td>
                              <td>
                                <select class="ajx_status form-control" name="events" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                              </td>
                              <td>
                                <select class="ckb_isfront form-control" name="events" id="isfront<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->is_show_front == 1) { ?> style="border-color: green;" <?php } ?>>
                                  <option value="1" <?php if($v->is_show_front == 1) { ?> selected="selected" <?php } ?>>YES</option>
                                  <option value="0" <?php if($v->is_show_front == 0) { ?> selected="selected" <?php } ?>>NO</option>
                                </select>
                              </td>
                              <td>
                                <a href="{{ route('add-event') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('delete-event') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Event ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                              </td>
                            </tr>
                            <?php
                            $sl++;
                          }
                        }
                        else
                        {
                          echo "<tr><td colspan='5' style='text-align:center;'>No events found.</td></tr>";
                        }
                        ?>
                      </tbody>
                     </table>
                    </div>
                    </div>
                  </div>
                   <?php if(!empty($all_events) && count($all_events) > 0) { echo $all_events->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop