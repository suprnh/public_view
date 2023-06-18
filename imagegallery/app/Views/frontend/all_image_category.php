<?= $this->extend('frontend/layouts/master') ?>
<?= $this->section('body-content') ?>

<div class="container py-5">   
       <h2 class="text-center">All Category</h2>
       <hr>
       <h4 class="text-right"><a href="<?php echo site_url('imagecat')  ?>" class="btn btn-success">Add Category</a></h4>
    <div class="row justify-content-md-center">
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
       
       <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $no =1;
                foreach($categories as $category) {?>  
                    <tr>
                        <th scope="row"><?= $no ?></th>
                        <td><?=ucfirst($category['name']) ?></td>
                        <td><?=ucfirst($category['description']) ?></td>
                        <td><a href="<?= site_url('imagecat').'/'.$category['id'] ?>"><i class="bi bi-pencil-square"></a></td>
                        <td><a href="<?= site_url('delete').'/'.$category['id'] ?>"><i class="bi bi-trash"></i></a></td>
                             
                    </tr>
                <?php
                    $no++;
                 } ?>
            
            </tbody>
        </table>
    </div>
</div>    

<?= $this->endSection() ?>