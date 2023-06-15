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
                  <h3 class="panel-title">All News</h3>
                </div>
                <div class="panel-body">
                    <form method="GET" action="{{ route('all-news') }}" accept-charset="UTF-8">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <div>   
                    <div class="col-sm-2">
                    <div class="form-group">
                    <label>Status</label>
                       <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status'])){ selected ('1',$_GET['status']); } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status'])){ selected ('0',$_GET['status']); } ?>>Inactive</option>
                       </select>
                       </div>
                     </div>
                       <div class="col-sm-8">
                       <div class="form-group">
                    <label>Title/Description</label>
                    <input type="text" placeholder="Title/Description" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>">
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
                   <table class="table table-bordered table-striped ar-table"> 
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>News</th>
                        <th style="width:60px;">EDC</th>
                        <th style="width:100px;">Date</th>
                        <th style="width:112px;">Status</th>
                        <th style="width:90px;">IsFront</th>
                        <th style="width:80px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($all_news) && count($all_news) > 0)
                      {
                        $sl=1;
                        foreach($all_news as $k=>$v)
                        {
                          ?>
                          <tr>
                            <td><?php echo $sl; ?></td>
                            <td><span class="at-title"><?php echo $v->title; ?></span>
                              <p><?php echo str_limit(strip_tags($v->description),150,'...'); ?></p>
                            </td>
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
                            <td><?php echo date('d-m-Y',strtotime($v->publish_date)); ?></td>
                            <td>
                              <select class="ajx_status form-control" name="news" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                            </td>
                            <td>
                              <select class="ckb_isfront form-control" name="news" id="isfront<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->is_show_front == 1) { ?> style="border-color: green;" <?php } ?>>
                                  <option value="1" <?php if($v->is_show_front == 1) { ?> selected="selected" <?php } ?>>YES</option>
                                  <option value="0" <?php if($v->is_show_front == 0) { ?> selected="selected" <?php } ?>>NO</option>
                                </select>
                            </td>
                            <td>
                              <a href="{{ route('add-news') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="{{ route('delete-news') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This News ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                          </tr>
                          <?php
                          $sl++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="6" style="text-align: center;">No Item Found!</td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                   </table>
                   <?php if(!empty($all_news) && count($all_news) > 0) { echo $all_news->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop