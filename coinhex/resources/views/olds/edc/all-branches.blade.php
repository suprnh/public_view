@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">All Branches</h1>
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
                  <h3 class="panel-title">All Branches</h3>
                </div>
        
                <div class="panel-body">
                   
                  <form name="ar-filter" action="" method="get">
                  {{ csrf_field() }}
                   <div class="row">
                      <div class="col-md-3">
                        <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select> 
                      </div>
                      <div class="col-md-7">
                        <input type="text" name="s" class="form-control" placeholder="Search by name, address, description.." value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                      </div>
                      <div class="col-md-2">
                        <input type="submit" name="filter" class="btn btn-default" value="Search">
                        <?php if(isset($_GET['s']) && isset($_GET['status'])) { ?>
                        <a href="{{ route('edc-all-branches') }}" class="pull-right"><span class="glyphicon glyphicon-remove-circle"></span></a>
                        <?php } ?>
                      </div>
                   </div>
                  </form>


                   <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                     <table class="table table-bordered table-striped ar-table"> 
                      <thead>
                        <tr>
                          <th style="width:50px;">SL</th>
                          <th>Center Name</th>
                          <th>Address</th>
                          <th style="width:112px;">Status</th>
                          <th style="width:80px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_centers) && count($all_centers) > 0)
                        {
                          $sl=1;
                          foreach($all_centers as $k=>$v)
                          {
                            ?>
                            <tr>
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $v->name; ?></td>
                              <td><?php echo $v->address; ?></td>
                              <td>
                                <select class="ajx_status form-control" name="centers" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                              </td>
                              <td>
                                <a href="{{ route('edc-add-branch') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('edc-del-branch') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('Sure To Delete This Branch ?');"><span class="glyphicon glyphicon-remove"></span></a>
                              </td>
                            </tr>
                            <?php
                            $sl++;
                          }
                        }else{
                        ?>
                        <tr>
                          <td colspan="5" style="text-align: center;">No Branch Found</td>
                        </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                     </table>
                     <?php if(!empty($all_centers) && count($all_centers) > 0) { echo $all_centers->links(); } ?>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

    
@stop