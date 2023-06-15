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
                  <h3 class="panel-title">{{ _tr('All Languages') }}</h3>
                </div>
        
                <div class="panel-body">
                   <div>
					<?php /*
                    <form method="GET" action="{{ route('all-language') }}" accept-charset="UTF-8">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                         
                    <div class="form-group col-sm-2">
                    <label>Status</label>
                       <select name="status" class="form-control">
                          <option value="1" <?php if(isset($_GET['status'])){ selected ('1',$_GET['status']); } ?>>Active</option>
                          <option value="0" <?php if(isset($_GET['status'])){ selected ('0',$_GET['status']); } ?>>Inactive</option>
                       </select>

                     </div>
                       <div class="form-group col-sm-8">
                    <label>Title/Description</label>
                    <input type="text" placeholder="Title/Description" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>">
                     </div>
                       
                    <div class="form-group col-sm-2">
                        <label></label><br>
                    <button type="submit" class="btn btn-default" id="submitButton">Search</button>
					<?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                          <a href="{{ route('all-roadmap') }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    <?php } ?>
                    </div>
                      </form> 
					  */ ?>
                  </div>
				    <form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					
					<!--div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="Bulk Delete">
					   <input type="hidden" name="table" value="roadmap">
					   <input type="hidden" name="grid_name" value="Roadmap">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
					</div-->
          <div class="tablescroll-primary">
                   <table class="table table-bordered table-striped ar-table"> 
                    <thead>
                      <tr>
					    <!--th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th-->
                        <th style="width:20px;">{{ _tr('SL') }}</th>
                        <th>{{ _tr('Language') }}</th>
                        <th>{{ _tr('Writing System') }}</th>
                        <th style="width:100px;">{{ _tr('Flag') }}</th>
                        <th style="width:100px;">{{ _tr('Default') }}</th>
                        <th style="width:112px;">{{ _tr('Status') }}</th>
                        <th style="width:80px;">{{ _tr('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(!empty($all_language) && count($all_language) > 0)
                      {
                        $sl=1;
                        foreach($all_language as $k=>$v)
                        {
                          ?>
                          <tr>
						     <!--td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td-->
                            <td><?php echo $sl; ?></td>
                            <td><span class="at-title"><?php echo $v->language; ?>( <?php echo $v->language_code; ?> )</span></td>
                            <td><?php echo $v->writing_system; ?></td>
							<td><?php if($v->flag_id > 0) { ?> <img src="<?php echo get_recource_url($v->flag_id);?>"> <?php } ?></td>
							<td style="text-align:center;">
                         
								<input type="radio" name="is_dafualt" id="is_default_<?php echo $v->ID; ?>" <?php if($v->is_default == 1) { ?>checked="checked" <?php } ?> value="<?php echo $v->is_default; ?>">
                            </td>
							
                            <td>
                              <select class="ajx_status form-control" name="language" id="status<?php echo $v->ID; ?>" data="<?php echo $v->ID; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                            </td>
                           
                            <td>
                              <a href="{{ route('add-language') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                              <!--a href="{{ route('delete-language') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This language ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a-->
                            </td>
                          </tr>
                          <?php
                          $sl++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="8" style="text-align: center;">{{ _tr('No Item Found!') }}</td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                   </table>
                    </div>
					</form>
				  <?php if(!empty($all_language) && count($all_language) > 0) { echo $all_language->links(); } ?>
                </div>
              </div>

            </div>
          </div>

    
@stop