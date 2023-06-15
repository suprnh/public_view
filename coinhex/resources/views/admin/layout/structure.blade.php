<?php set_admin_language(); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title><?php echo __t(get_settings('admin_title')); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/images/faviconn.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/images/faviconn.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/images/faviconn.png') }}">
	<link rel="manifest" href="{{ url('/public/frontend/images/favicon/site.webmanifest') }}">
    <link rel="stylesheet" href="{{asset('/public/admin_css/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/fonts/fonts.css')}}" />

    <link rel="stylesheet" href="{{asset('/public/plugins/fancybox/jquery.fancybox.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/plugins/Data Table/jquery.dataTables.min.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <!--script src="http://demo.startlaravel.com/sb-admin-laravel/assets/scripts/frontend.js" type="text/javascript"></script-->
    
    <script src="{{asset('/public/admin_css/js/frontend.js')}}"></script>
    <script src="{{asset('/public/plugins/fancybox/jquery.fancybox.min.js')}}"></script> 
    <script src="{{asset('/public/plugins/Data Table/jquery.dataTables.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('/public/jquery/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/chosen_v1.8.7/chosen.min.css')}}" />
    <script src="{{asset('public/jquery/jquery-ui.js')}}"></script>

    <style type="text/css">
        .ar-table tbody td{
            font-size: 14px;
        }
        .ar-table thead th{
            font-size: 14px;
        }
        .at-title, .ar-table tbody td.at-title{
            font-size: 14px;
            font-weight: 700;
        }
        .ar-table tbody td p{
            font-size: 13px;
        }
    </style>

</head>
<body>
	@yield('body')


    <script type="text/javascript">
        $(function(){
            $( ".datepicker" ).datepicker({
                //minDate:0,
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
				yearRange: "-100:+0"
            });
        });
    </script>
    <script type="text/javascript" src="{{asset('public/chosen_v1.8.7/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $(".chosen-select").chosen();
        });
    </script>

<!--script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=roahpptpcflvquiqh7srro0o8ub5a7n2sxu4c93r7gyhdnth"></script-->
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wwcgmct0f342q9q2w4t04tscw9dx5ce10h40celnpa4bt0zr"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '.ar-editor',
        height: 200,
        theme: 'modern',
        menubar:false,
        statusbar: false,
        contextmenu: false,
        browser_spellcheck: true,
        gecko_spellcheck: false,
        relative_urls : false,
        remove_script_host : false,
        /*document_base_url : "<?php //echo url('/'); ?>",*/
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        //toolbar: " undo redo | removeformat | bold italic | link | code",
        //toolbar: "styleselect | undo redo | removeformat | bold italic underline |  aligncenter alignjustify  | bullist numlist outdent indent | link | print | fontselect fontsizeselect",
        toolbar : "styleselect | undo redo | bold italic underline | aligncenter alignjustify | bullist numlist | link | code"
    });
</script>

<script type="text/javascript">
$(function(){
    $(".ajx_status").on('change',function(){
        if($(this).val() != ""){
            var tabName = $(this).attr('name');
            var status = $(this).val();
            var ID = $(this).attr('data');
            var token = "{{ csrf_token() }}";
            $.ajax({
                type:"POST",
                url:"{{ route('ajx-status-change') }}",
                data:"tab_name="+tabName+"&status="+status+"&_token="+token+"&ID="+ID,
                beforeSend:function(){
                    $("#status"+ID).attr('disabled','disabled');
                },
                success:function(rst){
                    if(rst == 'OK'){
                        $("#status"+ID).removeAttr('disabled');
                        if(status == 0){
                            $("#status"+ID).css('border-color','red');
                        } else {
                            $("#status"+ID).css('border-color','green');
                        }     
                    }
                }
            });
        }
    });
	
	$(".ajx_is_done").on('change',function(){
        if($(this).val() != ""){
            var tabName = $(this).attr('name');
            var status = $(this).val();
            var ID = $(this).attr('data');
            var token = "{{ csrf_token() }}";
            $.ajax({
                type:"POST",
                url:"{{ route('ajx-done-change') }}",
                data:"tab_name="+tabName+"&status="+status+"&_token="+token+"&ID="+ID,
                beforeSend:function(){
                    $("#status"+ID).attr('disabled','disabled');
                },
                success:function(rst){
                    if(rst == 'OK'){
                        $("#status"+ID).removeAttr('disabled');
                        if(status == 0){
                            $("#status"+ID).css('border-color','red');
                        } else {
                            $("#status"+ID).css('border-color','#ccc');
                        }     
                    }
					location.reload();
                }
            });
        }
    });
	
	$("#choose_lang").on('change',function(){
		if($(this).val() != ""){
			 var language_code = $(this).val();
			 var token = "{{ csrf_token() }}";
			 $.ajax({
                type:"POST",
                url:"{{ route('set-language') }}",
                data:"language_code="+language_code+"&_token="+token,
                beforeSend:function(){
                    //$("#status"+ID).attr('disabled','disabled');
                },
                success:function(rst){
					/*
                    if(rst == 'OK'){
                        $("#status"+ID).removeAttr('disabled');
                        if(status == 0){
                            $("#status"+ID).css('border-color','red');
                        } else {
                            $("#status"+ID).css('border-color','#ccc');
                        }     
                    }*/
					
					location.reload();
                }
            });
		}
	});
});


$(function(){
    $(".ckb_isfront").on('change',function(){
        if($(this).val() != ""){
            var tabName = $(this).attr('name');
            var is_show_front = $(this).val();
            var ID = $(this).attr('data');
            var ID_type = $(this).attr('data-type');
            var token = "{{ csrf_token() }}";
            $.ajax({
                type:"POST",
                url:"{{ route('ajx-isfront-change') }}",
                data:"tab_name="+tabName+"&is_show_front="+is_show_front+"&_token="+token+"&ID="+ID+"&ID_type="+ID_type,
                beforeSend:function(){
                    $("#isfront"+ID).attr('disabled','disabled');
                },
                success:function(rst){
                    if(rst == 'OK'){
                        $("#isfront"+ID).removeAttr('disabled');
                        if(is_show_front == 1){
                            $("#isfront"+ID).css('border-color','green');
                        } else {
                            $("#isfront"+ID).css('border-color','red');
                        }     
                    }
                }
            });
        }
    });
});


$(function(){
    $(".ajax_update_text").on('blur',function(){
        if($(this).val() != ""){
            var tabName = $(this).attr('data-name');
            var val = $(this).val();
            var ID = $(this).attr('data-id');
            var token = "{{ csrf_token() }}";
            $.ajax({
                type:"POST",
                url:"{{ route('ajx-order-change') }}",
                data:"tab_name="+tabName+"&val="+val+"&_token="+token+"&ID="+ID,
                beforeSend:function(){
                    //$("#isfront"+ID).attr('disabled','disabled');
                },
                success:function(rst){
                    if(rst == 'OK'){
                        /*$("#isfront"+ID).removeAttr('disabled');
                        if(val == 1){
                            $("#isfront"+ID).css('border-color','green');
                        } else {
                            $("#isfront"+ID).css('border-color','#ccc');
                        }
						*/
						location.reload();
                    }
                }
            });
        }
    });
});

$(function(){
	$("#select_all").click(function(){
		if($(this).prop('checked')==true){
			$(".select_each").attr('checked','checked');
			$(".select_each").prop('checked',true);
		}else{
			$(".select_each").removeAttr('checked');
		}
	});
	$("#submit_bulk_delete").click(function(){
		var length = $("input.select_each:checked").length;
		if(length > 0 ){
		var con = confirm("<?php echo _tr('Are you sure about deletion ?'); ?>");
		if(con==true){
			$('#apply_action').submit();
		}
		}else{
			alert("<?php echo _tr('No Item Selected !'); ?>");
		}
	});
	$(".select_each").click(function(){
		checkall();
	});
});
function checkall(){
	var all_checked = true;
	$(".select_each").each(function(){
		if($(this).prop('checked')==true){
		
		}else{
		all_checked = false;
		}
	});
	if(all_checked==true){
	$("#select_all").attr('checked','checked');
	$("#select_all").prop('checked',true);
	}else{
	$("#select_all").removeAttr('checked');
	}
}

</script>

<script>
	(function($){
		
		$("input").focus(function() {
			if($(this).next('.err_msg').length > 0){
				$(this).next('.err_msg').remove();
			}
		});
		$("input").change(function() {
			if($(this).next('.err_msg').length > 0){
				$(this).next('.err_msg').remove();
			}
		});
		$("select").change(function() {
			if($(this).next('.err_msg').length > 0){
				$(this).next('.err_msg').remove();
			}
		});
		$('input[type="checkbox"]').change(function() {
			if($(this).next().next('.err_msg').length > 0){
				$(this).next().next('.err_msg').remove();
			}
			if($(this).next().next().next('.err_msg').length > 0){
				$(this).next().next().next('.err_msg').remove();
			}
		});
		$("#submitted_by").change(function(){
			var email = $(':selected', this).data('email');
			$("#show_email").val(email);
			$("#email").val(email);
			$("#show_email").change();
			$("#email").change();
		});
	})(jQuery);
	</script>

    @stack('footer-js')
</body>
</html>