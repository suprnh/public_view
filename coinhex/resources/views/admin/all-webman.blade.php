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
                  <h3 class="panel-title">All Contacts</h3>
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
                    <label>{{ _tr('Email') }}</label>
                      <input type="text" name="s" class="form-control" placeholder="Name or Email or Contact Number" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>">
                    </div>
                    </div>
                    <div class="col-md-2">
                      <label></label><br />
                      <input type="submit" name="src" class="btn btn-default" value="Search">
                      <?php if(isset($_GET['s']) || isset($_GET['status'])) { ?>
                        <a href="{{ route('all-webman') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                      <?php } ?>
                    </div>
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
                          <th>Contacts</th>
                          <th style="width:112px;">Status</th>
                          <th style="width:80px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($all_webmans) && count($all_webmans) > 0)
                        {
                          $sl=1;
                          foreach($all_webmans as $k=>$v)
                          {
                            ?>
                            <tr>
                              <td><?php echo $sl; ?></td>
                              <td><?php echo $v->full_name; ?></td>
                              <td><?php echo "<span class='glyphicon glyphicon-envelope'></span> ".$v->email; ?><br/>
                                <?php echo "<span class='glyphicon glyphicon-phone'></span> ".$v->phone_no; ?></td>
                              <td>
                                <select class="ajx_status form-control" name="users" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                              </td>
                              <td>
                                <a href="{{ route('add-webman') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ route('delete-webman') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Contact ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                              </td>
                            </tr>
                            <?php
                            $sl++;
                          }
                        }
                        else
                        {
                          echo "<tr><td colspan='5' style='text-align:center;'>No Web Managers Found.</td></tr>";
                        }
                        ?>
                      </tbody>
                     </table>
                  </div>
                 </div>
                   <?php if(!empty($all_webmans) && count($all_webmans) > 0) { echo $all_webmans->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop