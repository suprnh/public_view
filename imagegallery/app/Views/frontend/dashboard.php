<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('body-content') ?>
<?php use App\Models\CategoryModel; ?>
<div class="container my-5">     
    <div class="row justify-content-md-center">
        <div>
          <style>
             #category {
              list-style-type: none;
             }

             #category > li {
              display:inline;
              margin:10px;
             }
          </style>
          <ul id="category">
              <?php
                $categoryModel = new CategoryModel();
                $all_category = $categoryModel->findAll();
          
              foreach($all_category as $cat){
              ?>
                  <li><a class="data_fetch" data-id="<?php echo $cat['id'] ?>" href="<?php echo site_url('user/profile')."/".$cat['id']?>"><?= ucfirst($cat['name'])?></a></li>
              <?php }?>  
          </ul>
        </div>
     
        <div class="col-md-12 mb-4 mb-lg-0 ml-20">
          <div class="row ap">
            <?php foreach($images as $image)

            { ?>
                <figure class="col-md-4 rm" >
                    <a href="#" data-size="500x500">
                      <img style="height:300px;width:300px" class="small" alt="picture" src="<?= base_url().'public/uploads/'.$image['name'] ?>" 
                        class="img-fluid">
                    </a>
                </figure>
              <?php  } ?>
            </div>     
       </div>    
    </div>      
</div>  

<script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/2.2.3/jquery.elevatezoom.min.js"></script>

<script>
    $(document).ready(function() {
       $('.small').elevateZoom();
    });   
    
    $(document).ready(function() {
       $('.data_fetch').click(function(){
          let url=$(this).attr("href");
          let getid= $(this).data("id"); // GET DATA ATTRIBUTES VALUE 
          $.ajax({
             url:url,
             method:'get',
             dataType:'json',
             success:function(getData){
              $('.rm').remove();
              
              getData.forEach(printData);
                  
                  
              function printData(item, index){
                $('.ap').append(`<div>
                                    <figure class="col-md-4 rm">
                                        <a href="#" data-size="500x500">
                                            <img style="height:300px;width:300px"  class="small" src="<?= base_url().'public/uploads/'?>/${item.name}" />
                                        </a>
                                    </figure>
                                 </div>`);
              }
              $('.small').elevateZoom();
             }
          })
          return false;
       });
    });   


</script>
  
<?= $this->endSection() ?>
