@extends('admin.layout.structure')
@section('body')
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @yield('leftbar')
    </nav>

<div id="page-wrapper">
    <div class="row">
        @yield('title')
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">  
                   
            <!-- /.row -->
            <div class="col-sm-12">

            @yield('dashboard')
          
            <!-- /.row -->
            <div class="row">
          
    </div>
    <!-- /#page-wrapper -->
    </div>
</div>
</div>
@stop