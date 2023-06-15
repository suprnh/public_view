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
                    <h3 class="panel-title">{{ _tr('All Documents') }}</h3>
                </div>

                <div class="panel-body">

                    <form name="frm" action="{{ route('all-docs') }}" method="get">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ _tr('Status') }}</label>
                                    <select name="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') { ?> selected="selected" <?php } ?>>Active</option>
                                        <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') { ?> selected="selected" <?php } ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>{{ _tr('Document Name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ _tr('Document Name') }}" value="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label></label><br />
                                    <input type="submit" name="filter" class="btn btn-default" value="{{ _tr('Search') }}">
                                    <?php if(isset($_GET['status']) || isset($_GET['s'])) { ?>
                                    <a href="{{ route('all-docs') }}" class="btn btn-xs btn-danger">{{ _tr('Clear') }}</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <form name="apply_action" id="apply_action" action="{{ route('bulk-delete') }}" method="POST">
								<div class="apply_action">
								   <input type="button" class="btn btn-primary" name="submit_bulk_delete" id="submit_bulk_delete" value="{{ _tr('Bulk Delete') }}">
								   <input type="hidden" name="table" value="documents">
								   <input type="hidden" name="grid_name" value="Documents">
								   <input name="_token" type="hidden" value="{{ csrf_token() }}">
								</div>

								<table class="table table-bordered table-striped ar-table">
									<thead>
									<tr>
										<th><input type="checkbox" name="select_all" id="select_all" value="1" class="select_all"></th>
										<th>{{ _tr('SL') }}</th>
										<th>{{ _tr('Document Name') }}</th>
										<th>{{ _tr('File') }}</th>
										<th>{{ _tr('Show on Top Section') }}</th>
										<th style="width:60px;">{{ _tr('Order') }}</th>
										<th>{{ _tr('Status') }}</th>
										<th>{{ _tr('Action') }}</th>
									</tr>
									</thead>
									<tbody>
									<?php
									if(!empty($all_docs) && count($all_docs) > 0)
									{
									$sl=1;
									foreach($all_docs as $k=>$v)
									{
									?>
									<tr>
										<td style="width:15px;"><input type="checkbox" name="ids[]" id="ids_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>" class="select_each"></td>
										<td><?php echo $sl; ?></td>
										<td><?php echo $v->name; ?></td>
										<td>
											<a href="<?php echo get_recource_url($v->upload_master_id); ?>" target="_blank">View File</a>
										</td>
										<td>
											<?php if($v->is_show_front == 1) { ?> 
												Yes
											<?php }else{ ?> 
												No
											<?php } ?> 
												
												
										</td>
										<td>
											<input class="ajax_update_text form-control" type="text" data-id="<?php echo $v->id; ?>" data-name="documents" name="order" id="order_<?php echo $v->id; ?>" value="<?php echo $v->order; ?>">
										</td>
										<td>
											<select class="ajx_status form-control" name="documents" id="status<?php echo $v->id; ?>" data="<?php echo $v->id; ?>" <?php if($v->status == 0) { ?> style="border-color: red;" <?php } ?>>
												<option value="1" <?php if($v->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
												<option value="0" <?php if($v->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
											</select>
										</td>

										<td>
											<a href="{{ route('add-doc') }}/{{ $v->id }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											<a href="{{ route('delete-doc') }}/{{ $v->id }}" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo _tr('Sure To Delete This Document ?'); ?>');"><span class="glyphicon glyphicon-remove"></span></a>
										</td>
									</tr>
									<?php
									$sl++;
									}
									}
									else
									{
										echo "<tr><td colspan='6' style='text-align:center'>"._tr('No Data Found')."</td></tr>";
									}
									?>
									</tbody>
								</table>
							</form>
                        </div>
                    </div>
                    <?php if(!empty($all_docs) && count($all_docs) > 0) { echo $all_docs->links(); } ?>
                </div>
            </div>

        </div>
    </div>


@stop