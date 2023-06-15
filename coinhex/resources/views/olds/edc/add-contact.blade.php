@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header"><?php if(!empty($contact)) echo "Edit Contact"; else echo "Add New Contact"; ?></h1>
</div>
@stop
@section('dashboard')
            <div class="row">

                @if (Session::has('contact_success'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ Session::get('contact_success') }}</div>
                </div></div>
                @endif

                @if (Session::has('contact_error'))
                <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ Session::get('contact_error') }}</div>
                </div></div>
                @endif

                <form name="ar-frm" action="<?php if(!empty($contact)) { ?> {{ route('edc-update-contact') }} <?php } else { ?> {{ route('edc-save-contact') }} <?php } ?>" method="post">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label>Name :</label>
                        <input type="text" name="name" class="form-control" value="<?php if(!empty($contact)) echo $contact->name; else  { ?>{{ old('name') }}<?php } ?>">
                        @if($errors->has('name'))
                        <span style="color:RED;"><small>{{$errors->first('name')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email-id :</label>
                        <input type="text" name="email" class="form-control" value="<?php if(!empty($contact)) echo $contact->email; else  { ?>{{ old('email') }}<?php } ?>">
                        @if($errors->has('email'))
                        <span style="color:RED;"><small>{{$errors->first('email')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Contact Number :</label>
                        <input type="text" name="phone" class="form-control" value="<?php if(!empty($contact)) echo $contact->phone; else  { ?>{{ old('phone') }}<?php } ?>">
                        @if($errors->has('phone'))
                        <span style="color:RED;"><small>{{$errors->first('phone')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Any Note :</label>
                        <textarea name="special_note" class="form-control ar-editor"><?php if(!empty($contact)) echo $contact->special_note; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if(!empty($contact) && $contact->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if(!empty($contact) && $contact->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if(!empty($contact)) { ?>
                        <input type="submit" name="update_contact" class="btn btn-success" value="Save Contact">
                        <a href="{{ route('edc-all-contacts') }}" class="btn btn-primary">All Contacts</a>
                        <input type="hidden" name="contact_id" value="<?php echo $contact->ID; ?>">
                        <?php } else { ?>
                        <input type="submit" name="add_contact" class="btn btn-primary" value="Add Contact">
                        <?php } ?>
                    </div>      

                </form>
            

            </div>
@stop