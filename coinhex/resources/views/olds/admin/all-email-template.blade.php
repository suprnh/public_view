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
                  <h3 class="panel-title">{{ _tr('All Email Template') }}</h3>
                </div>
        
                <div class="panel-body">
                   <div>
					<?php 
					/*
                    <form method="GET" action="{{ route('all-email-template') }}" accept-charset="UTF-8">
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
                    </div>
                    </form> 
					*/ ?>
                  </div>
				  <form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
				   <div class="apply_action">
				   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
				   <input type="hidden" name="table" value="email_template">
				   <input type="hidden" name="grid_name" value="Email template">
				   <input name="_token" type="hidden" value="{{ csrf_token() }}">
				   </div>
           <div class="tablescroll-primary">
                
                   <table class="table table-bordered table-striped ar-table"> 
                    <thead>
                      <tr>
						<th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
                        <th style="width: 50px;" >{{ _tr('SL') }}</th>
                        <th style="width: 220px;">{{ _tr('Template Subject') }}</th>
						<th style="width:90px;">{{ _tr('Email Identifier') }}</th>
                        <th style="width:80px;">{{ _tr('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($all_email_template) && count($all_email_template) > 0)
                      {
                        $sl=1;
                        foreach($all_email_template as $k=>$v)
                        {
                          ?>
                          <tr>
						    <td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->ID; ?>" value="<?php echo $v->ID; ?>" class="select_each"></td>
                            <td><?php echo $sl; ?></td>
                            <td><span class="at-title"><?php echo $v->title; ?></span></td>
                            <td><span class="at-title"><?php echo $v->slug; ?></span></td>
                            <td>
                              <a href="{{ route('add-email-template') }}/{{ $v->ID }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="{{ route('delete-email-template') }}/{{ $v->ID }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Template ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                          </tr>
                          <?php
                          $sl++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="6" style="text-align: center;">{{ _tr('No Item Found!') }}</td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                   </table>
                    </div>
                   <?php if(!empty($all_email_template) && count($all_email_template) > 0) { echo $all_email_template->links(); } ?>
                  </form>
				</div>
              </div>

            </div>
          </div>

    
@stop