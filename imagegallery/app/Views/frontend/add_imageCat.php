<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('body-content') ?>

<div class="container">     
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="text-center">
                <h3 class="my-5">
                    Insert a Category Here
                </h3>
            </div>

            <?php 
                if(session()->get('success')){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success')?>
                    </div>
                    <?php
                }
            ?>
            <?php 
                if(session()->get('error')){
                    $error = session()->get('error');
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error['image_file'] ?>
                    </div>
                    <?php
                }
            ?>
       
            <form action="<?php  if(isset($imagecat) && !empty($imagecat)){ echo site_url('user/addImagecat')."/".$imagecat['id']; }else{ echo site_url('user/addImagecat'); } ?>" method="post">
                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" value="<?php if(isset($imagecat) && !empty($imagecat)){ echo $imagecat['name'];  }?>" name="categoryName" class="form-control" id="categoryName" >
                </div>
                <div class="form-group">
                    <label for="description">Category Description</label>
                    <input type="text" value="<?php if(isset($imagecat) && !empty($imagecat)){ echo $imagecat['description'];  }?>" name="description" class="form-control" id="description">
                </div>
                <button type="submit" class="btn btn-primary ">Insert</button>
            </form>
        </div>
    </div>
</div>    

<?= $this->endSection() ?>