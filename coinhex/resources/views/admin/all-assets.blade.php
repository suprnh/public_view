<div class="upload_master">
<?php
if(!empty($all_assets) && count($all_assets) > 0)
{
  	?>
  	<ul class="media_window">
  	<?php
    foreach($all_assets as $k=>$v)
    {
    	$image_url = get_recource_url($v->ID);
    	if(is_url_exist($image_url)){
    		$image_src = '<img src="'.$image_url.'">';
    	}else{
    		$image_src = '';
    	}
    	?>
    	<li class="each-asset"><?php echo $image_src; ?></li>
    	<?php
    }
    ?>
    </ul>
    <?php
}
?>
</div> 