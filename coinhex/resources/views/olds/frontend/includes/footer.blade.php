<!-- footer section start -->
<footer class="main_ftr">
  <div class="container">
    <h2>Follow us on :</h2>
    <ul>
      <li><a href="<?php get_settings('fb_link'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
      <li><a href="<?php get_settings('twitter_link'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
      <li><a href="<?php get_settings('youtube_link'); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
      <li><a href="<?php get_settings('instagram_link'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
      <li><a href="<?php get_settings('pinterest_link'); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
    </ul>
    <p class="copyright"><?php echo get_settings('copyright_text'); ?></p>
  </div>
</footer>
<!-- footer section end -->


<!-- JS Start here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<!--script>window.jQuery || document.write('<script src="{{asset('/public/frontend/js/jquery.min.js')}}"><\/script>')</script>
<script src="{{asset('/public/frontend/js/jquery.min.js')}}"></script-->

<script src="{{asset('/public/frontend/js/bootstrap.min.js')}}"></script>
<!-- Menu JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://cdn.rawgit.com/adnantopal/slimmenu/master/dist/js/jquery.slimmenu.min.js"></script>
<!-- Owl Carousel js -->
<script src="{{asset('/public/frontend/js/owl.carousel.min.js')}}"></script>
<!-- Custome js -->
<script src="{{asset('/public/frontend/js/custom.js')}}"></script>
<script src="{{asset('/public/sw_alt/sweetalert.js')}}"></script>
<?php echo get_settings('footer_code'); ?>
<script type="text/javascript">
  $(function(){
    $("#newsletter_btn").on('click',function(){
      var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      if( ($("#newsletter_email").val() != "") && expr.test($("#newsletter_email").val()) )
      {
        var newsletter_email = $("#newsletter_email").val();
        var token = "{{ csrf_token() }}";
        $.ajax({
          type:"POST",
          url:"{{ route('save-newsletter') }}",
          data:"email="+newsletter_email+"&_token="+token,
          success:function(r)
          {
            if(r == 'OK')
            {
              $("#newsletter_email").val('');
              swal("Thankyou!", "You have subscribe successfully", "success");
            }

            if(r == 'EXIST')
            {
              swal("ERROR", "This email already exist", "error");
            }
          }
        })
      }
      else
      {
        swal("ERROR", "Please enter valid email-id", "error");
      }
    });
  });
</script>
@stack('footer_script')
</body>
</html>