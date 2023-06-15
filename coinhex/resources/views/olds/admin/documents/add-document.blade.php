@extends('admin.layout.leftbar')
@section('dashboard')
    @if (Session::has('success'))
        <div class="row"><div class="col-sm-12">
                <div class="alert alert-success">{{ _tr(Session::get('success')) }}</div>
            </div></div>
    @endif

    @if (Session::has('error'))
        <div class="row"><div class="col-sm-12">
                <div class="alert alert-danger">{{ _tr(Session::get('error')) }}</div>
            </div></div>
    @endif
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">
                <?php if(!empty($doc)) echo _tr("Edit Document") ; else echo _tr("Add New Document") ; ?>
            </h3>
        </div>
        <div class="panel-body">
            <form name="ar-frm" action="<?php if(!empty($doc)) { ?> {{ route('update-doc') }} <?php } else { ?> {{ route('save-doc') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                    <label>{{ _tr('Document Name') }}</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?php if(!empty($doc)) echo $doc->name; else { ?>{{ old('name') }}<?php } ?>">
                    @if($errors->has('name'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('name')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ _tr('Upload Document') }}</label>
                    <input type="file" name="document">
					 @if($errors->has('document'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('document')) }}</small></span>
                    @endif
                    <?php
                    if(!empty($doc->upload_master_id) && $doc->upload_master_id > 0){
                    ?>
                    <br/>
                    <a href="<?php echo get_recource_url($doc->upload_master_id); ?>" target="_blank">View File</a>
                    <?php
                    }
                    ?>
                    <input type="hidden" name="saved_privacy_policy" value="<?php if(!empty($doc->upload_master_id)){ echo $doc->upload_master_id; }?>">
                </div>

                <div class="form-group">
                    <label>{{ _tr('Status') }}</label>
                    <select class="form-control" name="status" id="status">

                        <option value="1" <?php if(!empty($doc) && $doc->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                        <option value="0" <?php if(!empty($doc) && $doc->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>

                    </select>
                </div>

                <div class="form-group">
                    <label>{{ _tr('Show on Landing Page Top') }}</label>
                    <select class="form-control" name="is_show_front" id="is_show_front">
                        <option value="0" <?php if(!empty($doc) && $doc->is_show_front == 0) { ?> selected="selected" <?php } ?>>No</option>
						<option value="1" <?php if(!empty($doc) && $doc->is_show_front == 1) { ?> selected="selected" <?php } ?>>Yes</option>
                    </select>
                </div>
				
			   <div class="form-group">
					<label>{{ _tr('Order') }} :</label>
					<input type="text" name="order" class="form-control" value="<?php if(!empty($doc)) echo $doc->order; else  ?>{{ old('order') }}">
				</div>
				
			   <div class="form-group">
					<label>{{ _tr('Overwrite Existing File') }} :</label>
					<select class="form-control" name="oexf">
                        <option value="0">No</option>
						<option value="1">Yes</option>
                    </select>
				</div>


                <div class="form-group">
                    <?php if(!empty($doc)) { ?>
                    <input type="submit" name="update_doc" value="{{ _tr('Save Document') }}" class="btn btn-primary btn-sm-block">
                    <input type="hidden" name="doc_id" value="<?php echo $doc->id; ?>">

                    <a href="{{ route('all-docs') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Documents') }}</a>
                    <?php } else { ?>
                    <input type="submit" name="create_doc" value="{{ _tr('Create Document') }}" class="btn btn-primary btn-sm-block">
                    <?php } ?>
                </div>

            </form>
        </div>
    </div>
    <script>
        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }

        $("#slug").keyup(function(){
            var Text = string_to_slug($(this).val());
            $("#slug").val(Text);
        });
    </script>
@stop