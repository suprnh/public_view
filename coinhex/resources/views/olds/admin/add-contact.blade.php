@extends('admin.layout.leftbar')
@section('dashboard')
                @if (Session::has('contact_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('contact_success')) }}</div>
                </div></div>
                @endif

                @if (Session::has('contact_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('contact_error')) }}</div>
                </div></div>
                @endif
                <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title"><?php if(!empty($contact)) echo _tr("Edit Contact"); else echo _tr("Add New Contact"); ?>
        </h3>
        </div>
<div class="panel-body">
                <form name="ar-frm" action="<?php if(!empty($contact)) { ?> {{ route('update-contact') }} <?php } else { ?>{{ route('save-contact') }}<?php } ?>" method="post">
                {{ csrf_field() }}
					
					<?php /*{{-- <div class="form-group">
                    <label>{{ _tr('Contact Type') }}</label>
                    <select class="form-control" name="contact_type" id="contact_type">
                        <option value="0" <?php if(!empty($contact) && $contact->contact_type == 1) { ?> selected="selected" <?php } ?>>Technical</option>
                        <option value="1" <?php if(!empty($contact) && $contact->contact_type == 2) { ?> selected="selected" <?php } ?>>General</option>
                        <option value="2" <?php if(!empty($contact) && $contact->contact_type == 3) { ?> selected="selected" <?php } ?>>Partnership / Promotion</option>

                    </select>
					</div> --}}*/ ?>
				
                    <div class="form-group">
                        <label>{{ _tr('Name') }} :</label>
                        <input type="text" name="name" class="form-control" value="<?php if(!empty($contact)) echo $contact->name; else  { ?>{{ old('name') }}<?php } ?>">
                        @if($errors->has('name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('name')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Email-id') }} :</label>
                        <input type="text" name="email" class="form-control" value="<?php if(!empty($contact)) echo $contact->email; else  { ?>{{ old('email') }}<?php } ?>">
                        @if($errors->has('email'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('email')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Contact Number') }} :</label>
                        <input type="text" name="phone" class="form-control" value="<?php if(!empty($contact)) echo $contact->phone; else  { ?>{{ old('phone') }}<?php } ?>">
                        @if($errors->has('phone'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('phone')) }}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ _tr('Message') }} :</label>
                        <textarea name="special_note" class="form-control ar-editor"><?php if(!empty($contact)) echo $contact->special_note; else{ ?>{{ old('special_note') }}<?php } ?></textarea>
                    </div>

                   

                    <div class="form-group">
                        <?php if(!empty($contact)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-primary btn-sm-block" value="{{ _tr('Save Contact') }}">
                        <a href="{{ route('all-contacts') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Contacts') }}</a>
                        <input type="hidden" name="contact_id" value="<?php echo $contact->ID; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_contact" class="btn btn-primary btn-sm-block" value="{{ _tr('Add Contact') }}">
                        <?php } ?>
                    </div>      

                </form>
                </div>
                </div>
@stop