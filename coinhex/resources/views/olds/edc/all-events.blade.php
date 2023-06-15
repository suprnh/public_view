@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">All Events</h1>
</div>
@stop
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
                        <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                      </div>
                      <div class="col-md-7">
                        <input type="text" name="s" class="form-control" placeholder="Event name or description" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                      </div>
                      <div class="col-md-2">
                        <input type="submit" name="filter" class="btn btn-default" value="Search">
                        <?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                          <a href="{{ route('edc-all-events') }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        <?php } ?>
                      </div>
                   </div>
                  </form>

                   <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                     <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Event Name</th>
                          <th style="width:100px;">Start Date</th>
                          <th style="width:100px;">End Date</th>
                          <th style="width:112px;">Status</th>
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
                              <td><?php echo date('d-m-Y', strtotime($v->start_date)); ?></td>
                              <td><?php echo date('d-m-Y', strtotime($v->end_date)); ?></td>
                              <td>
                                <select class="ajx_status form-control" name="events" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                              </td>
                              <td>
                                <a href="{{ route('edc-add-event') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('edc-delete-event') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('Sure To Delete This Event ?');"><span class="glyphicon glyphicon-remove"></span></a>
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
                   <?php if(!empty($all_events) && count($all_events) > 0) { echo $all_events->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop