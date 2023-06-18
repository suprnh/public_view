<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('body-content') ?>

<div class="container">     
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="text-center">
                <h1 class="my-5">
                    Upload Image
                </h1>
            </div>
        
            <form action="<?php echo site_url('user/upload') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categoryName">Select Category</label>
                    <select class="custom-select" aria-label="Default select example" name="category">
                        <option selected>Open this select menu</option>
                        <?php foreach($categories as $category) {?>
                        <option value="<?= $category['id'] ?>"><?= ucfirst( $category['name'] )?></option>
                    
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image_file">Select Image</label>
                    <input type="file" name="image_file" class="form-control" id="image_file">
                </div>
                <button type="submit" class="btn btn-primary ">Submit</button>
            </form>
                            <br>
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

           
        </div>
    </div>
</div>    

<?= $this->endSection() ?>