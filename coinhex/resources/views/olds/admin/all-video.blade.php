@extends('admin.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">{{ _tr('All Video') }}</h1>
</div>
@stop
@section('dashboard')
          <div class="row">
            <div class="col-sm-12">

              @if (Session::has('msg'))
              <div class="row"><div class="col-sm-12">
              <div class="alert alert-success">{{  _tr(Session::get('msg')) }}</div>
              </div></div>
              @endif

              
              
              <div class="panel panel-default">
      
                <div class="panel-heading">
                  <h3 class="panel-title">{{ _tr('All Video') }}</h3>
                </div>
        
                <div class="panel-body">
                   <div>
                    <form method="GET" action="{{ route('all-video') }}" accept-charset="UTF-8">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                         
                    <div class="form-group col-sm-2">
                    <label>{{ _tr('Status') }}</label>
                       <select name="status" class="form-control">
                          <option value="">All</option>
                          <option value="1" <?php if(isset($_GET['status'])){ selected ('1',$_GET['status']); } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status'])){ selected ('0',$_GET['status']); } ?>>Inactive</option>
                       </select>

                     </div>
                       <div class="form-group col-sm-8 ">
                    <label>{{ _tr('Title/Description') }}</label>
                    <input type="text" placeholder="{{ _tr('Title/Description') }}" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>">
                     </div>
                       
                    <div class="form-group col-sm-2">
                    <label></label><br>
                    <button type="submit" class="btn btn-default" id="submitButton">{{ _tr('Search') }}</button>
					<?php if(isset($_GET['s']) || isset($_GET['status'])) { ?>
                        <a href="{{ route('all-video') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                    <?php } ?>
                    </div>
                      </form> 
                  </div>
				    <form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					   <div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
					   <input type="hidden" name="table" value="videos">
					   <input type="hidden" name="grid_name" value="Videos">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
					   </div>
					   
                   <table class="table table-bordered table-striped ar-table"> 
                    <thead>
                      <tr>
					    <th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                        <th>{{ _tr('SL') }}</th>
                        <th>{{ _tr('Description') }}</th>
                        <?php /*<th style="width:60px;">{{ _tr('Document') }}</th>
                        <th style="width:100px;">{{ _tr('Language') }}</th> */ ?>
                        <th style="width:112px;">{{ _tr('Status') }}</th>
                        <?php /* <th style="width:90px;">{{ _tr('IsFront') }}</th> */?>
                        <th style="width:80px;">{{ _tr('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($all_video) && count($all_video) > 0)
                      {
                        $sl=1;
                        foreach($all_video as $k=>$v)
                        {
                          ?>
                          <tr>
						    <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                            <td><?php echo $sl; ?></td>
                            <td><span class="at-title"><?php echo $v->title; ?></span>
                              <p><?php echo str_limit(strip_tags($v->description),150,'...'); ?></p>
                            </td>
							<?php /*
                            <td>
                                <?php if($v->image_id > 0){ ?> <a href="<?php echo get_recource_url($v->image_id); ?>" target="_blank">{{ _tr('View Document') }}</a><?php }else{ echo  _tr("No document attached"); } ?>
                            </td>
                            <td><?php if($v->video_language==1){ ?>English<?php }else if($v->video_language==2){ ?>Korean<?php } ?></td>
							*/ ?>
                            <td>
                              <select class="ajx_status form-control" name="videos" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                            </td>
							<?php /*
                            <td>
                              <select class="ckb_isfront form-control" name="videos" id="isfront<?php echo $v->ID; ?>" data-type="is_front" data="<?php echo $v->ID; ?>" <?php if($v->is_show_front == 1) { ?> style="border-color: green;" <?php } ?>>
                                  <option value="1" <?php if($v->is_show_front == 1) { ?> selected="selected" <?php } ?>>YES</option>
                                  <option value="0" <?php if($v->is_show_front == 0) { ?> selected="selected" <?php } ?>>NO</option>
                                </select>
                            </td>
							*/ ?>
                            <td>
                              <a href="{{ route('add-video') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="{{ route('delete-video') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Video ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                          </tr>
                          <?php
                          $sl++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="7" style="text-align: center;">{{ _tr('No Item Found!') }}</td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                   </table>
				   </form>
                   <?php if(!empty($all_video) && count($all_video) > 0) { echo $all_video->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop