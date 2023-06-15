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
                  <h3 class="panel-title">{{ _tr('All Translation') }}</h3>
                </div>
        
                <div class="panel-body">
                   
					
                    <form method="GET" action="{{ route('all-translation') }}" accept-charset="UTF-8">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="row">
					<div class="col-sm-2">
					<div class="form-group">
					<select name="language" class="form-control">
						<option value="en_GB" <?php if(isset($_GET['language']) && $_GET['language'] == 'en_GB') { ?> selected="selected" <?php } ?>>{{ _tr('English') }}</option>
                        <option value="ko_KR" <?php if(isset($_GET['language']) && $_GET['language'] == 'ko_KR') { ?> selected="selected" <?php } ?>>{{ _tr('Korean') }}</option>
					</select>
					</div>
					</div>
					
                     <div class="col-sm-8 ">
                     <div class="form-group">
                    <!--label>{{ _tr('Text') }}</label-->
                    <input type="text" placeholder="{{ _tr('Text') }}" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>">
                     </div>
                     </div>
                       
                    <div class="col-sm-2">
                    <div class="form-group">
                    <!--label></label><br-->
                    <button type="submit" class="btn btn-default" id="submitButton">{{ _tr('Search') }}</button>
					<?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                          <a href="{{ route('all-translation') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                    <?php } ?>
                    </div>
                    </div>
                    </div>
                    </form> 
					 
                  
				    <form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
					
					<div class="apply_action">
					   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="Bulk Delete">
					   <input type="hidden" name="table" value="translation">
					   <input type="hidden" name="grid_name" value="Translation">
					   <input name="_token" type="hidden" value="{{ csrf_token() }}">
					</div>
			   
                   <table class="table table-bordered table-striped ar-table"> 
                    <thead>
                      <tr>
					    <th style="width:15px;"><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                        <th style="width:20px;">{{ _tr('SL') }}</th>
                        <th style="width:50px;">{{ _tr('Language') }}</th>
                        <th>{{ _tr('Text') }}</th>
                        <th style="width:112px;">{{ _tr('Status') }}</th>
                        <th style="width:80px;">{{ _tr('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(!empty($all_translation) && count($all_translation) > 0)
                      {
                        $sl=1;
                        foreach($all_translation as $k=>$v)
                        {
                          ?>
                          <tr>
						     <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                            <td><?php echo $sl; ?></td>
                            <!--td><span class="at-title"><?php echo $v->language_code; ?></span></td-->
                            <td colspan="2">
							<span class="at-title">English:</span>
							<p><?php echo strip_tags(english_translation($v->ID)); ?></p>
							<span class="at-title">Korean:</span>
							<p><?php echo strip_tags(korean_translate($v->ID)); ?></p>
							</td>
							
                            <td>
                              <select class="ajx_status form-control" name="translation" id="status<?php echo tid($v->ID); ?>" data="<?php echo tid($v->ID); ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
                                  <option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                  <option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                                </select>
                            </td>
                           
                            <td>
                              <a href="{{ route('add-translation') }}/{{ tid($v->ID) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="{{ route('delete-translation') }}/{{ tid($v->ID) }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Translation ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
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
					</form>
					<div style="text-align:center;">
					<?php /*if(!empty($all_translation) && count($all_translation) > 0) { echo $all_translation->links(); }*/  ?>
					<?php echo $pagination->links(); ?>
					</div>
                </div>
              </div>

            </div>
          </div>

    
@stop