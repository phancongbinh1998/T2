(function($) { "use strict";

	$(window).load(function() {
	  $("#remove-class").removeClass("preload");
	});

	
	//Preloader

            Royal_Preloader.config({
                mode           : 'number',
                showProgress   : true,
                showPercentage : false,
                text_colour    : '#777777',
                background     : '#FFFFFF'
            });	


	/* Scroll animations */
	
      window.scrollReveal = new scrollReveal();
	  
	//Home text fade on scroll	
	
	$(window).scroll(function () { 
        var $Fade = $('.fade-elements');
        //Get scroll position of window 
        var windowScroll = $(this).scrollTop();
        //Slow scroll and fade it out 
        $Fade.css({
            'margin-top': -(windowScroll / 0) + "px",
            'opacity': 1 - (windowScroll / 500)
        }); 
        var $Fade = $('.fade-fast');
        //Get scroll position of window 
        var windowScroll = $(this).scrollTop();
        //Slow scroll and fade it out 
        $Fade.css({
            'margin-top': -(windowScroll / 0) + "px",
            'opacity': 1 - (windowScroll / 100)
        });
        var $Fade = $('.fade-slow');
        //Get scroll position of window 
        var windowScroll = $(this).scrollTop();
        //Slow scroll and fade it out 
        $Fade.css({
            'margin-top': -(windowScroll / 0) + "px",
            'opacity': 1 - (windowScroll / 800)
        });
    });		

	
	/* animated icons */
	
	var options = {
	  duration: 200, 
	  type: 'oneByOne',
	  animTimingFunction: Vivus.EASE
	};

	var vivus = new Vivus('svg-icon-1',	options, onComplete);
				new Vivus('svg-icon-2',	options, onComplete);
				new Vivus('svg-icon-3',	options, onComplete);

	function onComplete() {}

	
	/* Scroll Too */
	
			$(window).load(function(){"use strict";
				
				/* Page Scroll to id fn call */
				$("ul.slimmenu li a,a[href='#top'],a[data-gal='m_PageScroll2id']").mPageScroll2id({
					highlightSelector:"ul.slimmenu li a",
					offset: 78,
					scrollSpeed:800,
					scrollEasing: "easeInOutCubic"
				});
				
				/* demo functions */
				$("a[rel='next']").click(function(e){
					e.preventDefault();
					var to=$(this).parent().parent("section").next().attr("id");
					$.mPageScroll2id("scrollTo",to);
				});
				
			});	



	
	$(document).ready(function() {

	
			/* slider revolution */
			
					var tpj=jQuery;				
					var revapi42;
					tpj(document).ready(function() {
						if(tpj("#rev_slider_42_1").revolution == undefined){
							revslider_showDoubleJqueryError("#rev_slider_42_1");
						}else{
							revapi42 = tpj("#rev_slider_42_1").show().revolution({
								sliderType:"hero",
								jsFileLocation:"../js/",
								sliderLayout:"fullwidth",
								dottedOverlay:"none",
								delay:9000,
								navigation: {
								},
								viewPort: {
									enable:true,
									outof:"pause",
									visible_area:"80%"
								},
								responsiveLevels:[1240,1024,778,480],
								gridwidth:[1240,1024,778,480],
								gridheight:[600,500,400,350],
								lazyType:"none",
								parallax: {
									type:"scroll",
									origo:"enterpoint",
									speed:400,
									levels:[5,10,15,20,25,30,35,40,45,50],
								},
								shadow:0,
								spinner:"off",
								autoHeight:"off",
								disableProgressBar:"on",
								hideThumbsOnMobile:"off",
								hideSliderAtLimit:0,
								hideCaptionAtLimit:0,
								hideAllCaptionAtLilmit:0,
								debugMode:false,
								fallbacks: {
									simplifyAll:"off",
									disableFocusListener:false,
								}
							});
						}
					});	/*ready*/


			
			
		//Navigation	

		"use strict";

		$('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
		//Checks if li has sub (ul) and adds class for toggle icon - just an UI


		$('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
		//Checks if drodown menu's li elements have anothere level (ul), if not the dropdown is shown as regular dropdown, not a mega menu (thanks Luka Kladaric)

		$(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\"></a>");

		//Adds menu-mobile class (for mobile toggle menu) before the normal menu
		//Mobile menu is hidden if width is more then 1199px, but normal menu is displayed
		//Normal menu is hidden if width is below 1199px, and jquery adds mobile menu
		//Done this way so it can be used with wordpress without any trouble

		$(".menu > ul > li").hover(function (e) {
			if ($(window).width() > 1183) {
				$(this).children("ul").stop(true, false).fadeToggle(300);
				e.preventDefault();
			}
		});
		//If width is more than 943px dropdowns are displayed on hover

		$(".menu > ul > li").click(function () {
			if ($(window).width() <= 1183) {
				$(this).children("ul").fadeToggle(300);
			}
		});
		//If width is less or equal to 943px dropdowns are displayed on click (thanks Aman Jain from stackoverflow)

		$(".menu-mobile").click(function (e) {
			$(".menu > ul").toggleClass('show-on-mobile');
			e.preventDefault();
		});
		//when clicked on mobile-menu, normal menu is shown as a list, classic rwd menu story (thanks mwl from stackoverflow)


				
	
		//Tooltip

		$(".tipped").tipper();


		/* Logos Carousel */		
		
		$("#owl-logos").owlCarousel({
			items : 5,
			itemsDesktop : [1000,4], 
			itemsDesktopSmall : [900,3],
			itemsTablet: [600,2], 
			itemsMobile : false, 
			navigation: false,
			pagination : false,
			autoPlay : 3000,
			slideSpeed : 300
		});
		
	
		/* Product Carousels */
	 
		$("#owl-product").owlCarousel({
			navigation: false,
			pagination : true,
			transitionStyle : "fade",
			slideSpeed : 500,
			paginationSpeed : 500,
			singleItem:true,
			autoPlay: 4000
		});
	
		//Parallax
		
		$('.parallax-nav').parallax("50%", 0.2); 
		
		
		//Full Accordion	
	
		$(".accordion").smk_Accordion({
			closeAble: true 
		});

	});	


	
  })(jQuery); 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 





	