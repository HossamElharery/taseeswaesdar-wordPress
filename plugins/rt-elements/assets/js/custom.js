/**
 *
 * --------------------------------------------------------------------
 *
 * Template : Custom Js Template
 * Author : reacthemes
 * Author URI : http://www.reactheme.com/
 *
 * --------------------------------------------------------------------
 *
 **/
(function ($) {
    "use strict";

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $.fn.skillBars = function (options) {
        var settings = $.extend({
            from: 0, // number start
            to: false, // number end
            speed: 1000, // how long it should take to count between the target numbers
            interval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            onUpdate: null, // callback method for every time the element is updated,
            onComplete: null, // callback method for when the element finishes updating
            /*onComplete: function(from) {
                console.debug(this);
            }*/
            classes: {
                skillBarBar: '.skillbar-bar',
                skillBarPercent: '.skill-bar-percent',
            }
        }, options);

        return this.each(function () {
            var obj = $(this),
                to = (settings.to != false) ? settings.to : parseInt(obj.attr('data-percent'));
            if (to > 100) {
                to = 100;
            };
            var from = settings.from,
                loops = Math.ceil(settings.speed / settings.interval),
                increment = (to - from) / loops,
                loopCount = 0,
                interval = setInterval(updateValue, settings.interval);

            obj.find(settings.classes.skillBarBar).animate({
                width: parseInt(obj.attr('data-percent')) + '%'
            }, settings.speed);

            function updateValue() {
                from += increment;
                loopCount++;
                $(obj).find(settings.classes.skillBarPercent).text(from.toFixed(settings.decimals) + '%');

                if (typeof (settings.onUpdate) == 'function') {
                    settings.onUpdate.call(obj, from);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    from = to;

                    if (typeof (settings.onComplete) == 'function') {
                        settings.onComplete.call(obj, from);
                    }
                }
            }

        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
            if ($('.react-parallax-image').length) {
                gsap.to(".react-parallax-image", {
                    scrollTrigger: {
                        // trigger: ".images",
                        start: "top bottom",
                        end: "bottom top",
                        scrub: 1,
                        // markers: true
                    },
                    x: -250,
                });
            }
            if ($('.react-parallax-image2').length) {

                gsap.to(".react-parallax-image2", {
                    scrollTrigger: {
                        // trigger: ".images",
                        start: "top bottom",
                        end: "bottom top",
                        scrub: 1,
                        // markers: true
                    },
                    y: -250,
                });
            } 
            if ($('.watermark').length) {
                gsap.to(".watermark", {
                    scrollTrigger:{           
                    start: "top bottom", 
                    end: "bottom top", 
                    scrub: 1,            
                    },
                    x: 250,
                })
            }
            if ($('.images-2').length) {
              gsap.to(".images-2", {
                scrollTrigger:{
                  // trigger: ".images",
                  start: "top bottom", 
                  end: "bottom top", 
                  scrub: 1,
                  // markers: true
                },
                y: -290,
              })
            }
            if ($('.images').length) {
                gsap.to(".images", {
                    scrollTrigger:{
                      // trigger: ".images",
                      start: "top bottom", 
                      end: "bottom top", 
                      scrub: 1,
                      // markers: true
                    },
                    x: -250,
                  })
            }
        });

    });   

    // heading 
    document.addEventListener("DOMContentLoaded", function() {
        if (window.innerWidth > 768) {
            $(document).ready(function(){				
                // up spilt 	          
                $(".skew-up").each(function (index) {
                const text = new SplitType($(this), {
                    types: "checrecter, words",
                    lineClass: "word-line"
                });    let textInstance = $(this);
                let line = textInstance.find(".word-line");
                let word = line.find(".word");    let tl = gsap.timeline({
                    scrollTrigger: {
                    trigger: textInstance,
                    start: "top 85%",
                    end: "top 85%",
                    onComplete: function () {
                        $(textInstance).removeClass("skew-up");
                    }
                    }
                });    
                tl.set(textInstance, { opacity: 1 }).from(word, {
                    y: "100%",
                    skewX: "-5",
                    duration: 2,
                    stagger: 0.09,
                    ease: "expo.out"
                });
            });

            $(".split_collab").each(function (index) {
                const textInstance = $(this);
                const text = new SplitText(textInstance, {
                    type: "chars",
                });
            
                let letters = text.chars;
            
                let tl = gsap.timeline({
                    scrollTrigger: {
                    trigger: textInstance,
                    start: "top 85%",
                    end: "top 85%",
                    onComplete: function () {
                        textInstance.removeClass(".split_collab");
                    }
                    }
                });
            
                tl.set(textInstance, { opacity: 1 }).from(letters, {
                    duration: .5,
                    autoAlpha: 0,
                    x: 50,
                    // scaleY: 0,
                    // skewX: 50,
                    stagger: { amount: 1 },
                    ease: "back.out(1)"
                });
                });
            });
            // words animations
            $(".split_collab_words").each(function (index) {
                const textInstance = $(this);
                const text = new SplitText(textInstance, {
                    type: "words",  // Split by words instead of characters
                });

                let words = text.words;  // Select the words for animation

                let tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: textInstance,
                        start: "top 85%",
                        end: "top 85%",
                        onComplete: function () {
                            textInstance.removeClass("split_collab_words");
                        }
                    }
                });

                // Set opacity of the text container and animate each word
                tl.set(textInstance, { opacity: 1 }).from(words, {
                    duration: 0.5,
                    autoAlpha: 0,
                    x: 50,
                    stagger: { amount: 1 },
                    ease: "back.out(1)"
                });
            });
        }
    });

    $(document).ready(function() {
        $(window).on('load', function() {
            var hash = window.location.hash;
            if (hash) {
                var $target = $(hash);
                if ($target.length) {
                    $('html, body').animate({
                        scrollTop: $target.offset().top
                    }, 1000);
                }
            }
        });
    });

    // Cart show & hide
    $(document).on('click', '.menu-cart-area', function () {
        $(".cart-icon-total-products").addClass("visible-cart");
        $(".body-overlay-cart").addClass("overlayshow");
    });
    $(document).on('click', '.body-overlay-cart', function () {
        $(this).removeClass("overlayshow");
        $(".cart-icon-total-products").removeClass("visible-cart");
    });

    $(document).on('click', '.close-cart', function () {
        $(".cart-icon-total-products").removeClass("visible-cart");
        $(".body-overlay-cart").removeClass("overlayshow");
    });    

    document.addEventListener("DOMContentLoaded", function() {
        const circleText = document.querySelector('.circle-text');
        if (circleText) {
            const textSpans = circleText.querySelectorAll('span');
            let rotation = 0;
            const rotationStep = 360 / textSpans.length;
    
            textSpans.forEach((span, index) => {
                span.style.transform = `rotate(${rotation}deg) translateX(150px)`;
                rotation += rotationStep;
            });
        }
    });

     // feedback button click show start
    document.addEventListener('DOMContentLoaded', function() {
        var rtsBtn = document.querySelector('.button-area-box-shadow .rts-btn');
        var overlaySection = document.querySelector('.overlay-bottom-section');
        var isToggled = false;

        if (rtsBtn && overlaySection) {
            rtsBtn.addEventListener('click', function() {
                if (!isToggled) {
                    // Change margin of .rts-btn
                    rtsBtn.style.margin = '0px auto 0 auto';
                    rtsBtn.innerHTML= 'View less feedbacks';
                    // Remove the overlay-bottom-section class
                    overlaySection.classList.remove('overlay-bottom-section');
                } else {
                    // Revert margin of .rts-btn
                    rtsBtn.style.margin = '';
                    rtsBtn.innerHTML= 'View all feedbacks';
                    
                    // Add the overlay-bottom-section class back
                    overlaySection.classList.add('overlay-bottom-section');
                }
                
                // Toggle the state
                isToggled = !isToggled;
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        let headerSwitchCheckbox = document.getElementById("headerSwitchCheckbox");
        if(headerSwitchCheckbox){
			let htmlTag = document.documentElement;
			let themeMode = localStorage.theme;

			if (themeMode) {
				htmlTag.setAttribute("data-theme", themeMode);

				if (themeMode === "dark") {
					localStorage.theme === "dark"
					headerSwitchCheckbox.checked = true;
				} else {
					localStorage.theme === "light"
					headerSwitchCheckbox.checked = false;
				}
			}

			function toggleTheme(e) {
				if (headerSwitchCheckbox.checked) {
                    htmlTag.setAttribute("data-theme", "dark");
                    localStorage.theme = 'dark';
                    
                } else {
                    htmlTag.setAttribute("data-theme", "light");
                    localStorage.theme = 'light';
                }
			}

            // Add event listener for the toggle switch
            headerSwitchCheckbox.addEventListener("change", toggleTheme);
			
        }
    });
    
})(jQuery);