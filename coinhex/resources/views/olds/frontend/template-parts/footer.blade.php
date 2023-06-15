
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
<!-- Bootstrap JS -->
<script src="{{asset('/public/frontend/js/bootstrap.min.js')}}"></script>
<!-- Menu JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://cdn.rawgit.com/adnantopal/slimmenu/master/dist/js/jquery.slimmenu.min.js"></script>
<!-- Owl Carousel js -->
<script src="{{asset('/public/frontend/js/owl.carousel.min.js')}}"></script>
<!-- Custome js -->
<script src="{{asset('/public/frontend/js/custom.js')}}"></script>
<script src="{{asset('/public/sw_alt/sweetalert.js')}}"></script>

@stack('footer_script')
<script type="text/javascript">
  $(function(){
    $("#regBTN").on('click',function(){
      var nm = $("#EDCname").val();
      var em = $("#EDCemail").val();
      var pwd = $("#EDCpwd").val();
      var cpwd = $("#EDCcpwd").val();
      var token = "{{ csrf_token() }}";
      var name_regex = /^[A-Za-z ]{3,20}$/;
      var email_regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
      var isVali_nm = "F";
      var isVali_em = "F";
      var isVali_pwd = "F";
      var isVali_cpwd = "F";
      if(nm == "" || !name_regex.test(nm)){
        $("#EDCname").css('border-color','red');
        isVali_nm = "F";
      } else {
        $("#EDCname").css('border-color','black');
        isVali_nm = "T";
      } 
      if(em == "" || !email_regex.test(em)){
        $("#EDCemail").css('border-color','red');
        isVali_em = "F";
      } else {
        $("#EDCemail").css('border-color','black');
        isVali_em = "T";
      } 
      if(pwd == "" || pwd.length < 6){
        $("#EDCpwd").css('border-color','red');
        isVali_pwd = "F";
      } else {
        $("#EDCpwd").css('border-color','black');
        isVali_pwd = "T";
      } 
      if(cpwd == "" || pwd != cpwd){
        $("#EDCcpwd").css('border-color','red');
        isVali_cpwd = "F";
      } else {
        $("#EDCcpwd").css('border-color','black');
        isVali_cpwd = "T";
      } 
      if(isVali_nm == "T" && isVali_em == "T" && isVali_pwd == "T" && isVali_cpwd == "T"){
        
        var dataStr = "nm="+nm+"&em="+em+"&pwd="+pwd+"&_token="+token;
        $.ajax({
          type:"POST",
          url:"{{ route('front_edc_reg') }}",
          data:dataStr,
          cache:false,
          beforeSend:function(){
            $("#regBTN").attr('disabled','disabled');
          },
          success:function(resp){
            if(resp == 0){
              swal("Email Exist", "Sorry!! email-id already exist,try another", "error");
            } 
            if(resp == -1){
              swal("Email Exist", "Something went wrong,try again.", "error");
            }
            if(resp == 1){
              $("#EDCname").val('');
              $("#EDCemail").val('');
              $("#EDCpwd").val('');
              $("#EDCcpwd").val('');
              $("#Join_form").modal('hide');
              swal("Thankyou!", "Thanks for registration.", "success");
            }
            $("#regBTN").removeAttr('disabled');
          }
        })
      }
    });

    $("#logBTN").on('click',function(){
      var logemail = $("#logemail").val();
      var logpwd = $("#logpwd").val();
      var token = "{{ csrf_token() }}";
      if(logemail != "" && logpwd != "")
      {
        $.ajax({
          type:"POST",
          url:"{{ route('front-login') }}",
          data:"email="+logemail+"&password="+logpwd+"&_token="+token,
          cache:false,
          beforeSend:function(){
            $("#logBTN").attr('disabled','disabled');
          },
          success:function(logr){
            if(logr == 0){
              swal("Error", "Sorry!! email-id not exist", "error");
            }
            if(logr == -1){
              swal("Error", "Sorry!! password not match", "error");
            }
            if(logr == 1){
              $("#Join_form").modal('hide');
              swal("Login Successfull", "Please wait..redirecting...", "success");
              setTimeout(function(){ 
                 window.location.href = "<?php echo url('/admin'); ?>";
              }, 5000);
            }
            $("#logBTN").removeAttr('disabled');
          }
        });
      }
    });
  });
</script>
</body>
</html>