<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>iPortfolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('public/assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('public/assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('vendor/aos/aos.css') ?>" >
  <link href="<?= base_url('/vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('/vendor/twbs/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('public/assets/css/style.css') ?>" rel="stylesheet">
  <script src="<?= base_url('public/assets/js/code.jquery.com_jquery-3.7.0.min.js') ?>"></script>
  
  

  <!-- =======================================================
  * Template Name: iPortfolio
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="<?= base_url('public/assets/img/profile-img.jpg') ?>" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">Alex Smith</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>/
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="<?= site_url('user/profile') ?>" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="<?= site_url('user/allcat') ?>" class="nav-link scrollto"><i class="bx bx-server"></i> <span>All Category</span></a></li>
          <li><a href="<?= site_url('user/add') ?>" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Add Image</span></a></li>
          <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          <li><a href="<?= site_url('logout') ?>" class="nav-link scrollto"><i class="bi bi-box-arrow-in-right"></i> <span>Logout</span></a></li>
         
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->


<body>
    <main id="main">
        <?= $this->renderSection("body-content") ?>
    <main>
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        
      </div>
      <div class="credits">
       
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
  <script src="<?= base_url('vendor/purecounter/purecounter_vanilla.js') ?>"></script>
  <script src="<?= base_url('vendor/aos/aos.js') ?>"></script>

  <script src="<?= base_url('vendor/glightbox/js/glightbox.min.js') ?>"></script>
  <script src="<?= base_url('vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
  <script src="<?= base_url('vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('vendor/typed.js/typed.umd.js') ?>"></script>
  <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('vendor/waypoints/noframework.waypoints.js') ?>"></script>
  <script src="<?= base_url('vendor/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('public/assets/js/main.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/jquery.jqzoom-core.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/jquery.jqzoom-core-pack.js') ?>"></script>
 
 
 
  
  

</body>

</html>


