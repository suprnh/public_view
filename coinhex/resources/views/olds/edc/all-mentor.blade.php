@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">All Mentors</h1>
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
                  <h3 class="panel-title">Mentor List</h3>
                </div>
        
                <div class="panel-body">
                   

                   <form name="frm" action="" method="get">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-3">
                        <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>inactive</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="s" class="form-control" placeholder="Name or Email or Phone-no" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                      </div>
                      <div class="col-md-3">
                        <select name="exp_id" class="form-control">
                          <option value="">Expertise</option>
                          <?php 
                          if(!empty($allExp)){
                            foreach($allExp as $ex){
                              if(isset($_GET['exp_id']) && $_GET['exp_id'] == $ex->ID){
                              echo "<option value='".$ex->ID."' selected='selected'>".$ex->category_name."</option>";
                              } else {
                              echo "<option value='".$ex->ID."'>".$ex->category_name."</option>";
                              }
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <input type="submit" name="filter" class="btn btn-default" value="Search">
                        <?php if(isset($_GET['s'])) { ?>
                          <a href="{{ route('edc-all-mentor') }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
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
                        <th>Name</th>
                        <th>Email-id</th>
                        <th>Contact No</th>
                        <th>Expertise</th>
                        <th style="width:112px;">Status</th>
                        <th style="width:80px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($mentors) && count($mentors) > 0)
                      {
                        $sl = 1;
                        foreach($mentors as $v)
                        {
                          ?>
                          <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $v->salutation." ".$v->first_name." ".$v->last_name; ?></td>
                            <td><?php echo $v->email; ?></td>
                            <td>
                              <?php
                              $phArr = unserialize($v->phone_no);
                              if(!empty($phArr))
                              {
                                $i = 0;
                                foreach($phArr as $ph){
                                  if($i <= 1){
                                    echo $ph."<br/>";
                                  }
                                  $i++;
                                }

                                if($i > 2){
                                  echo "<span style='color:SILVER;'><small>more..</small></span>";
                                }
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if(!empty($v->expertise) && count($v->expertise))
                              {
                                $j = 0;
                                foreach($v->expertise as $exp){
                                  if($j <= 1){
                                    echo $exp->category_name."<br/>";
                                  } 
                                  $j++;
                                }

                                if($j > 2){
                                 echo "<span style='color:SILVER;'><small>more..</small></span>"; 
                                }
                              }
                              ?>
                            </td>
                            <td>
                              <select class="ajx_status form-control" name="mentors" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                            </td>
                            <td>
                              <a href="{{ route('edc-add-mentor') }}/{{ $v->ID }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="{{ route('edc-del-mentor') }}/{{ $v->ID }}" class="btn btn-xs btn-danger" onclick="return confirm('Sure To Delete This Mentor ?');"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                          </tr>
                          <?php
                          $sl++;
                        }
                      }
                      else
                      {
                        echo "<tr><td colspan='6' style='text-align:center;'>No mentor found.</td></tr>";
                      }
                      ?>
                    </tbody>
                   </table>
                   </div>
                 </div>
                 <?php if(!empty($mentors) && count($mentors) > 0) { echo $mentors->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop