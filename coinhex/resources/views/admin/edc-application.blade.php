@extends('admin.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">Applications For EDC</h1>
</div>
@stop
@section('dashboard')
          <div class="row">

          	<?php
          	if(!empty($applications) && count($applications) > 0){
          	?>

          		<div class="panel-group">
          		<?php echo "<span class='edc_tot'>Total Applications :".count($applications)."</span>"; ?>
				  <?php
				  foreach($applications as $v){
				  ?>
				  <div class="panel panel-default" id="panel<?php echo $v->ID; ?>">
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-10">
				    			<h4 class="edc_title">
				    				<span class="fa fa-university fa-fw"></span><?php echo $v->full_name; ?>
				    			</h4>
				    			<p>
				    				<span class="ar-dt">Applied date : 
				    				<?php echo date('d-m-Y', strtotime($v->created_date)); ?></span>
				    				<span>&nbsp;|&nbsp;</span>
				    				<span class="ar-dt">From : 
				    				<?php echo $v->email; ?></span>
				    			</p>
				    		</div>
				    		<div class="col-md-2">
				    			<input type="button" id="aBTN<?php echo $v->ID; ?>" class="btn btn-lg btn-primary approveBTN" value="Approve" data="<?php echo $v->ID; ?>">
				    		</div>
				    	</div>
				    </div>
				  </div>
				  <?php } ?>
				</div>

          	<?php 
          	}
          	?>
          </div>
        
          
@stop

@push('footer-js')
    <script type="text/javascript">
    $(function(){
    	$(".approveBTN").on('click',function(){
    		var ID = $(this).attr('data');
    		var token = "{{ csrf_token() }}";
    		if(ID != "" && ID != null && ID != "undefined"){

    			$.ajax({
    				type:"POST",
    				url:"{{ route('edc-approve') }}",
    				data:"ID="+ID+"&_token="+token,
    				cache:false,
    				beforeSend:function(){
    					$("#panel"+ID).css('opacity','0.4');
    				},
    				success:function(r){
    					if(r != 0){
    						$("#panel"+ID).remove();
    					}
    				}
    			});
    		}
    	});
    });
        
    </script>
@endpush