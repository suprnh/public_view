@extends('admin.layout.leftbar')

@section('dashboard')
                @if (Session::has('bonus_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('bonus_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('bonus_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('bonus_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($bonus)) echo _tr("Edit Bonus"); else echo _tr("Add New Bonus"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($bonus)) { ?> {{ route('update-bonus') }} <?php } else { ?>{{ route('save-bonus') }}<?php } ?>" method="post">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>{{ _tr('Bonus Type') }}</label>
                        <select class="form-control" name="bonus_type" id="bonus_type">
                            <option value="0" <?php if(!empty($bonus) && $bonus->bonus_type == 0) { ?> selected="selected" <?php } ?>>Percentage</option>
							<option value="1" <?php if(!empty($bonus) && $bonus->bonus_type == 1) { ?> selected="selected" <?php } ?>>Flat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Bonus Amount') }} :</label>
                        <input type="text" name="bonus_amount" class="form-control" value="<?php if(!empty($bonus)) echo $bonus->bonus_amount; else  { ?>{{ old('bonus_amount') }}<?php } ?>">
                        @if($errors->has('bonus_amount'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('bonus_amount')) }}</small></span>
                        @endif
                    </div>
					
					 <div class="form-group">
                        <label>{{ _tr('Lower Range') }} :</label>
                        <input type="text" name="lower_range" class="form-control" value="<?php if(!empty($bonus)) echo $bonus->lower_range; else  { ?>{{ old('lower_range') }}<?php } ?>">
                        @if($errors->has('lower_range'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('lower_range')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('If no higher range (check this and keep empty next field)') }}:</label>
						<input type="checkbox" name="no_higher" id="no_higher" value="1" <?php if(!empty($bonus) && $bonus->no_higher==1){  echo 'checked="checked"';  }else{ ''; } ?>>
					</div>
					<div class="form-group">
                        <label>{{ _tr('Higher Range') }} :</label>
                        <input type="text" name="higher_range" class="form-control" value="<?php if(!empty($bonus)) echo $bonus->higher_range; else  { ?>{{ old('higher_range') }}<?php } ?>">
                        @if($errors->has('higher_range'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('higher_range')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Priority (integer, higher the number higher will be the priority)') }} :</label>
                        <input type="number" name="priority" class="form-control" value="<?php if(!empty($bonus)) echo $bonus->priority; else  { ?>{{ old('priority') }}<?php } ?>">
                        @if($errors->has('priority'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('priority')) }}</small></span>
                        @endif
                    </div>
					
					<div class="form-group">
                        <label>{{ _tr('Bonus Status') }}</label>
                        <select class="form-control" name="status" id="status">
							<option value="1" <?php if(!empty($bonus) && $bonus->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($bonus) && $bonus->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <?php if(!empty($bonus)) { ?>
                        <input type="submit" name="update_bonus" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Bonus') }}">
                        <a href="{{ route('all-bonus') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Bonus') }}</a>
                        <input type="hidden" name="bonus_id" value="<?php echo $bonus->ID; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_bonus" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Bonus') }}">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
@stop