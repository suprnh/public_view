@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('subscriber_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('subscriber_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('subscriber_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('subscriber_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($contact)) echo _tr("Edit Subscriber") ; else echo _tr("Add New Subscriber") ; ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($subscriber)) { ?> {{ route('update-subscriber') }} <?php } else { ?> {{ route('save-subscriber') }} <?php } ?>" method="post">
                {{ csrf_field() }}

                    
                    <div class="form-group">
                        <label>{{ _tr('Subscriber Email-id') }}:</label>
                        <input type="text" name="email" class="form-control" value="<?php if(!empty($subscriber)) echo $subscriber->email; else  { ?> {{ old('email') }} <?php } ?>">
                        @if($errors->has('email'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('email')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($subscriber) && $subscriber->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($subscriber) && $subscriber->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if(!empty($subscriber)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Subscriber') }}">
                        <a href="{{ route('all-subscribers') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Subscribers') }}</a>
                        <input type="hidden" name="subscriber_id" value="<?php echo $subscriber->ID; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_subscriber" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Subscriber') }}">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
@stop