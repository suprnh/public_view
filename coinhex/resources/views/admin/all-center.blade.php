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
                  <h3 class="panel-title">All Centers</h3>
                </div>
        
                <div class="panel-body">
                   
                    <form method="GET" action="{{ route('all-center') }}" accept-charset="UTF-8">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="row">     
                    <div class="col-sm-2">
                    <div class="form-group">
                    <label>Status</label>
                       <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status'])){ selected ('1',$_GET['status']); } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status'])){ selected ('0',$_GET['status']); } ?>>Inactive</option>
                       </select>
                     </div>
                     </div>
                       <div class="col-sm-8 ">
                       <div class="form-group">
                    <label>EDC</label>
                    <select name="edc_name" class="form-control">
                            <option value="">Choose EDC</option>
                        <?php foreach($edcs as $edc){ ?>
                            <option value="<?php echo $edc->ID; ?>" <?php if(isset($_GET['edc_name'])){ selected($edc->ID,$_GET['edc_name']); } ?>><?php echo $edc->full_name; ?></option>
                        <?php } ?>
                        </select>
                     </div>
                     </div>
                       
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label></label><br>
                    <button type="submit" class="btn btn-default" id="submitButton">Search</button>
                    </div>
                    </div>
                    </div>
                      </form> 
                 
                  <div class="tablescroll-primary">
                  <table class="table table-bordered table-striped ar-table"> 
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>EDC Name</th>
                        <th>Center Name</th>
                        <th>Address</th>
                        <th style="width:112px;">Status</th>
                        <th style="width:80px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($all_center) && count($all_center) > 0)
                      {
                        $sl=1;
                        foreach($all_center as $k=>$v)
                        {
                          ?>
                          <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo get_edc_name_by_id($v->parent_id); ?></td>
                            <td><?php echo $v->name; ?></td>
                            <td><?php echo $v->address; ?></td>
                            <td>
                              <select class="ajx_status form-control" name="centers" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                              </select>
                            </td>
                            <td>
                              <a href="{{ route('add-center') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="{{ route('delete-center') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Center ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                          </tr>
                          <?php
                          $sl++;
                        }
                      }else{
                      ?>
                      <tr>
                        <td colspan="5" style="text-align: center;">No Item Found</td>
                      </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                   </table>
                    </div>
                   <?php if(!empty($all_center) && count($all_center) > 0) { echo $all_center->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop