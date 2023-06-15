<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>EDCN Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel="icon" type="image/png" href="{{asset('/public/images/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('/public/admin_css/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/fonts/fonts.css')}}" />

    <link rel="stylesheet" href="{{asset('/public/plugins/fancybox/jquery.fancybox.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/plugins/Data Table/jquery.dataTables.min.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <script src="http://demo.startlaravel.com/sb-admin-laravel/assets/scripts/frontend.js" type="text/javascript"></script>
    <script src="{{asset('/public/plugins/fancybox/jquery.fancybox.min.js')}}"></script> 
    <script src="{{asset('/public/plugins/Data Table/jquery.dataTables.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('/public/jquery/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/chosen_v1.8.7/chosen.min.css')}}" />
    <script src="{{asset('public/jquery/jquery-ui.js')}}"></script>

    <link rel="stylesheet" href="{{asset('/public/calendar/fullcalendar.css')}}" />

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
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
    <script type="text/javascript" src="{{asset('public/chosen_v1.8.7/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $(".chosen-select").chosen();
        });
    </script>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=rq7tfapuy401frf8s5dlxqlkcvvec2emj95g4dluqoz6x4xy"></script>
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

<script type="text/javascript" src="{{asset('public/calendar/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/calendar/fullcalendar.min.js')}}"></script>

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
                            $("#status"+ID).css('border-color','#ccc');
                        }     
                    }
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
            var token = "{{ csrf_token() }}";
            $.ajax({
                type:"POST",
                url:"{{ route('ajx-isfront-change') }}",
                data:"tab_name="+tabName+"&is_show_front="+is_show_front+"&_token="+token+"&ID="+ID,
                beforeSend:function(){
                    $("#isfront"+ID).attr('disabled','disabled');
                },
                success:function(rst){
                    if(rst == 'OK'){
                        $("#isfront"+ID).removeAttr('disabled');
                        if(is_show_front == 0){
                            $("#isfront"+ID).css('border-color','red');
                        } else {
                            $("#isfront"+ID).css('border-color','#ccc');
                        }     
                    }
                }
            });
        }
    });
});
</script>

    @stack('footer-js')

</body>
</html>