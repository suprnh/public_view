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
            <h3 class="panel-title"><?php if(!empty($faq)) echo _tr("Edit Faq"); else echo _tr("Add New Faq"); ?>
            </h3>
        </div>
        <div class="panel-body">
            <form name="ar-frm" action="<?php if(!empty($faq)) { ?> {{ route('update-faq') }} <?php } else { ?> {{ route('save-faq') }} <?php } ?>" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>{{ _tr('Question') }}</label>
                    <input class="form-control" type="text" name="question" id="question" value="<?php if(!empty($faq)) echo $faq->question; else { ?>{{ old('question') }}<?php } ?>">
                    @if($errors->has('question'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('question')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ _tr('Answer') }} :</label>
                    <textarea name="answer" class="form-control ar-editor"><?php if(!empty($faq)) echo $faq->answer; else  ?>{{ old('answer') }}</textarea>
                    @if($errors->has('answer'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('answer')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ _tr('Order') }} :</label>
                    <input type="text" name="order" class="form-control" value="<?php if(!empty($faq)) echo $faq->order; else  ?>{{ old('order') }}">
                    @if($errors->has('order'))
                        <span style="color:RED;" class="err_msg"><small>{{ _tr($errors->first('order')) }}</small></span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ _tr('Status') }}</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" <?php if(!empty($faq) && $faq->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
                        <option value="0" <?php if(!empty($faq) && $faq->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
                    </select>
                </div>



                <div class="form-group">
                    <?php if(!empty($faq)) { ?>
                    <input type="submit" name="update_faq" value="{{ _tr('Save Faq') }}" class="btn btn-primary btn-sm-block">
                    <input type="hidden" name="faq_id" value="<?php echo $faq->id; ?>">
                    <a href="{{ route('all-faqs') }}" class="btn btn-primary btn-sm-block">{{ _tr('All Faqs') }}</a>
                    <?php } else { ?>
                    <input type="submit" name="create_faq" value="{{ _tr('Create Faq') }}" class="btn btn-primary btn-sm-block">
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