(function($) {
    "use strict";
    
    //search 
     $('.sticky_search').on('click', function(event) {        
        $('.sticky_form').animate({ opacity: 'toggle' }, 500);;
        $( '.sticky_form input' ).focus();
    });

    $('.sticky_search').on('click', function() {
        $('body').removeClass('search-active').removeClass('search-close');
          if ($(this).hasClass('close-full')) {
            $('body').addClass('search-close');
             $('.sticky_form').fadeOut('show');
        }
        else {
            $('body').addClass('search-active');
        }
        return false;
    });
   
    $('.nav-link-container').on('click', function(e){
        $('body.on-offcanvas').removeClass('on-offcanvas');
        setTimeout(function(){ $('body').addClass('on-offcanvas'); },500);        
    });
  
    $('.sticky_form_search').on('click', function() {      
        $('body, html').removeClass('reactheme-search-active').removeClass('reactheme-search-close');
          if ($(this).hasClass('close-search')) {
          $('body, html').addClass('reactheme-search-close');

        }
        else {
          $('body, html').addClass('reactheme-search-active');
        }
        return false;
    });  


    $(function() {
        $('a[href*=#]:not([href=#])').on('click', function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 120 // Apply 120px offset here
                    }, 1000); // 1000ms for smooth scroll duration
                    return false;
                }
            }
        });
    });


    $(document).ready(function(){
        $(".menu-button, .close-button").on('click', function() {
            $(".nav-toggle, .menu-ofcn, .close-button, body").toggleClass("off-open");
        });   
        
        $("#mobile_menu li a").on('click', function() {
            $(".nav-toggle, .menu-ofcn, .close-button, body").toggleClass("off-open");
        });
    });
   
    // Canvas Menu Js
    $( ".nav-link-container > a" ).off("click").on("click", function(event){
        event.preventDefault();
        $(".nav-link-container").toggleClass("nav-inactive-menu-link-container");
        $(".mobile-menus").toggleClass("nav-active-menu-container");
    });    
    
    $(".nav-close-menu-li > a").on('click', function(event){
        $(".mobile-menus").toggleClass("nav-active-menu-container");
        $(".content").toggleClass("inactive-body");
    });

    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });    
     //Videos popup jQuery activation code
    $('.popup-videos').magnificPopup({
        disableOn: 10,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
  
    //preloader
    $(window).on( 'load', function() {
    $("#bizgen-load").delay(300).fadeOut(100);
    $(".bizgen-loader").delay(300).fadeOut(100);       

    if($(window).width() < 992) {
        $('.reactheme-menu').css('height', '0');
        $('.reactheme-menu').css('opacity', '0');
        $('.reactheme-menu').css('z-index', '-1');
        $('.reactheme-menu-toggle').on( 'click', function(){
            $('.reactheme-menu').css('opacity', '1');
            $('.reactheme-menu').css('z-index', '1');
        });
        }
    })   
     
    // scrollTop init
    var win=$(window);
    var totop = $('#top-to-bottom');    
    win.on('scroll', function() {
        if (win.scrollTop() > 150) {
            totop.fadeIn();
            $('.rts_header__switch').addClass('btt__enable');
            $('#top-to-bottom').addClass('scroll_visible');  
        } else {
            totop.slideDown(400);
            $('.rts_header__switch').removeClass('btt__enable');
            $('#top-to-bottom').removeClass('scroll_visible');
            
        }
    });

    totop.on('click', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    }); 

    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });


    $( ".comment-body, .comment-respond" ).wrap( "<div class='comment-full'></div>" );    

    //mobile menu
    $.fn.menumaker = function(options) {      
        var mobile_menu = $(this), settings = $.extend({
          format: "dropdown",
          sticky: false
        }, options);
           return this.each(function() {
           mobile_menu.find('li ul').parent().addClass('has-sub');
           var multiTg = function() {
              mobile_menu.find(".has-sub").prepend('<span class="submenu-button"></span>');
              mobile_menu.find(".hash").parent().addClass('hash-has-sub');
              mobile_menu.find('.submenu-button').on('click', function() {
                  $(this).toggleClass('submenu-opened');
                  if ($(this).siblings('ul').hasClass('open-sub')) {
                      $(this).siblings('ul').removeClass('open-sub').hide('fadeToggle');
                      $(this).siblings('ul').hide('fadeToggle');                                     
                  }
                  else {
                      $(this).siblings('ul').addClass('open-sub').hide('fadeToggle');
                      $(this).siblings('ul').slideToggle().show('fadeToggle');
                  }
              });
           };
          if (settings.format === 'multitoggle') multiTg();
          else mobile_menu.addClass('dropdown');
          if (settings.sticky === true) mobile_menu.css('position', 'fixed');
          var resizeFix = function() {
               if ($( window ).width() > 991) {
                   mobile_menu.find('ul').show('fadeToggle');
                   mobile_menu.find('ul.sub-menu').hide('fadeToggle');
               }          
           };
          resizeFix();
          return $(window).on('resize', resizeFix);
          });
      };

      $(document).ready(function(){
        $("#mobile_menu").menumaker({
           format: "multitoggle"
        });        
    }); 

    if($('.rt-scrl-marquee').length) { 
        $(document).ready(function(){
        gsap.registerPlugin(ScrollTrigger);
        const marqueeAnimation = () => {
          const sections = document.querySelectorAll(".rt-scrl-marquee");
          sections.forEach((section) => {
            const marqueeText = section.querySelector(".scrl-marquee-text");
            const w = marqueeText; // Assign marqueeText element to w


            const [x, xEnd] = ['0%', (w.scrollWidth - section.offsetWidth) * -0.1];

            gsap.fromTo(w, { x }, {
              x: xEnd,
              scrollTrigger: {
                trigger: section,
                scrub: 0.1
              }
            });
          });
        };
        marqueeAnimation();
        });
    }

})(jQuery);