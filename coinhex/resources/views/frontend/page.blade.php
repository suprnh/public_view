<?php set_front_language(); ?>
@extends('frontend.inner-layout')
@section('site_title')
<?php get_site_title( $page->title ); ?>
@endsection
@section('breadcrumb')
<div class="brdcm_sec">
    <div class="container">
      <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>{{ $page->title }}</li>
      </ul>
    </div>
  </div>
@endsection
@section('mid_area')
<!--======================= inner page start here =======================-->
<!-- over view section start -->
<section class="inr_ovrvew_sec">
  <div class="container">
    <h1 class="inr_page_title">{{ $page->title }}</h1>
    <?php echo $page->description; ?>
  </div>
</section>
<!-- over view section end -->
<!--======================= inner page end here =======================-->
@endsection