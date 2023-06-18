<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css'); ?>">
</head>
<body>  
        
 <div class="container">     
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="text-center">
                <h1 class="my-5">
                    Login Here
                </h1>
            </div>
        
            <form action="<?php echo site_url('login') ?>" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" >
                </div>
                <div class="form-group">
                    <label for="passwd">Password</label>
                    <input type="password" name="password" class="form-control" id="passwd">
                </div>
                <button type="submit" class="btn btn-primary ">Submit</button>
            </form>
        </div>
    </div>
</div>    
</body>
</html>
