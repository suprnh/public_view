(function($) {
  'use strict';
      /*======================= 
        01. Wow Active 
      ======================*/
      new WOW().init();

 

  
     // Hero slides Style 2 
      //   $("#hero-slider").vegas({
      //   overlay: true,
      //   autoHeight: true,
      //   transition: 'fade',
      //   transitionDuration: 2000,
      //   delay: 4000,
      //   color: '#000',
      //   animation: 'random',
      //   animationDuration: 20000,
      //   slides: [
      //     {
      //       src: 'images/hero/thumb1.jpg'
      //     },
      //     {
      //       src: 'images/hero/thumb2.jpg'
      //     },
      //     {
      //       src: 'images/hero/thumb3.jpg'
      //     },
      //     {
      //       src: 'images/hero/thumb4.jpg'
      //     },
      //     {
      //       src: 'images/hero/thumb5.jpg'
      //     }
      //   ]
      // });
  
      if($('.roadmap-live-slider').length){
        $('.roadmap-live-slider').slick({
          centerMode: true,
          slidesToShow: 4,
          arrows: true,
          dots: false,
          responsive: [
            {
              breakpoint: 1199,
              settings: {
                arrows: true,
                dots: false,
                centerMode: true,
                slidesToShow: 3
              }
            },
            {
              breakpoint: 768,
              settings: {
                arrows: true,
                dots: false,
                centerMode: true,
                slidesToShow: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                dots: true,
                centerMode: true,
                slidesToShow: 1
              }
            }
          ]
        });
      }
      

      /*===============================
        07. Mobile Menu
      ==================================*/
      if($(window).width() < 767){
        jQuery('.menu-icon').on("click", function() {
          jQuery(this).toggleClass('active');
          jQuery('nav').slideToggle();
          jQuery('nav ul li a').on("click", function(){
            jQuery('.menu-icon').removeClass('active');
            jQuery('nav').hide();
          });
        });
      }

      setTimeout(function(){
          jQuery('.video-section').addClass('loaded');
      }, 1500);

     if($('.fancybox-media').length){
        $('.fancybox-media').fancybox({
          openEffect  : 'none',
          closeEffect : 'none',
          helpers : {
            media : {}
          }
        });
      }
      
})(jQuery);
 
$(window).load(function() {
  equalheight('.benefit-box');
});


$(window).resize(function(){
  equalheight('.benefit-box');
});
 


 $(document).ready(function($) {
     /*======================= 
      02. Timer
    ======================*/
    var ClockDate = $('#clock').data( "date" );
    $('#clock').countdown(ClockDate, function(event) {
      var $this = $(this).html(event.strftime(''
        + '<ul>'
        + '<li><span>%D<em>days</em></span></li>'
        + '<li><span>%H<em>hours </em></span></li>'
        + '<li><span>%M<em>minutes</em></span></li>'
        + '<li><span>%S<em>seconds</em></span></li>'
        + '</ul>'
        ));
    });

});