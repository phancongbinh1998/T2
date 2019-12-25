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
            'opacity': 1 - (windowScroll / 600)
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
			
                var tpj = jQuery;

                var revapi626;
                tpj(document).ready(function() {
                    if (tpj("#rev_slider_626_1").revolution == undefined) {
                        revslider_showDoubleJqueryError("#rev_slider_626_1");
                    } else {
                        revapi626 = tpj("#rev_slider_626_1").show().revolution({
                            sliderType: "standard",
                            jsFileLocation: "//server.local/revslider/wp-content/plugins/revslider/public/assets/js/",
                            sliderLayout: "fullscreen",
                            dottedOverlay: "none",
                            delay: 9000,
                            navigation: {
                                keyboardNavigation: "off",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "off",
                                mouseScrollReverse: "default",
                                onHoverStop: "off",
                                touch: {
                                    touchenabled: "on",
                                    swipe_threshold: 75,
                                    swipe_min_touches: 1,
                                    swipe_direction: "horizontal",
                                    drag_block_vertical: false
                                }
								,
								arrows: {
									style:"metis",
									enable:true,
									hide_onmobile:false,
									hide_onleave:false,
									tmp:'',
									left: {
										h_align:"left",
										v_align:"center",
										h_offset:0,
										v_offset:0
									},
									right: {
										h_align:"right",
										v_align:"center",
										h_offset:0,
										v_offset:0
									}
								}
                            },
                            responsiveLevels: [1240, 1024, 778, 480],
                            visibilityLevels: [1240, 1024, 778, 480],
                            gridwidth: [1240, 1024, 778, 480],
                            gridheight: [900, 768, 960, 720],
                            lazyType: "single",
                            parallax: {
                                type: "mouse",
                                origo: "slidercenter",
                                speed: 300,
                                levels: [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 49, 50, 51, 55],
                                type: "mouse",
                            },
                            shadow: 0,
                            spinner: "spinner2",
                            stopLoop: "on",
                            stopAfterLoops: 0,
                            stopAtSlide: 1,
                            shuffle: "off",
                            autoHeight: "off",
                            fullScreenAutoWidth: "off",
                            fullScreenAlignForce: "off",
                            fullScreenOffsetContainer: "",
                            fullScreenOffset: "",
                            disableProgressBar: "on",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false,
                            }
                        });
                    }
                }); /*ready*/	


			
			
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
		
	
		/* Separate Carousels */
	 
		$("#owl-sep-1").owlCarousel({
			navigation: false,
			pagination : true,
			transitionStyle : "fade",
			slideSpeed : 500,
			paginationSpeed : 500,
			singleItem:true,
			autoPlay: 5000
		});
	
		//Parallax
		
		$('.parallax-5').parallax("50%", 0.3); 




	/* Portfolio Sorting */

	(function ($) { 
		
		
		var container = $('#shop-grid');
		
		
		function getNumbColumns() { 
			var winWidth = $(window).width(), 
				columnNumb = 1;
			
			
			if (winWidth > 1500) {
				columnNumb = 4;
			} else if (winWidth > 1200) {
				columnNumb = 3;
			} else if (winWidth > 900) {
				columnNumb = 2;
			} else if (winWidth > 600) {
				columnNumb = 2;
			} else if (winWidth > 300) {
				columnNumb = 1;
			}
			
			return columnNumb;
		}
		
		
		function setColumnWidth() { 
			var winWidth = $(window).width(), 
				columnNumb = getNumbColumns(), 
				postWidth = Math.floor(winWidth / columnNumb);

		}
		
		$('.portfolio-filter #filter a').click(function () { 
			var selector = $(this).attr('data-filter');
			
			$(this).parent().parent().find('a').removeClass('current');
			$(this).addClass('current');
			
			container.isotope( { 
				filter : selector 
			});
			
			setTimeout(function () { 
				reArrangeProjects();
			}, 300);
			
			
			return false;
		});
		
		function reArrangeProjects() { 
			setColumnWidth();
			container.isotope('reLayout');
		}
		
		
		container.imagesLoaded(function () { 
			setColumnWidth();
			
			
			container.isotope( { 
				itemSelector : '.shop-item', 
				layoutMode : 'masonry', 
				resizable : false 
			} );
		} );
		
		
	
		
	
		$(window).on('debouncedresize', function () { 
			reArrangeProjects();
			
		} );
		
	
	} )(jQuery);

	
});	
	// (function ($) { 
		
		
	// 		var container = $('#shop-grid');
			
			
	// 		function getNumbColumns() { 
	// 			var winWidth = $(window).width(), 
	// 				columnNumb = 1;
				
				
	// 			if (winWidth > 1500) {
	// 				columnNumb = 4;
	// 			} else if (winWidth > 1200) {
	// 				columnNumb = 3;
	// 			} else if (winWidth > 900) {
	// 				columnNumb = 2;
	// 			} else if (winWidth > 600) {
	// 				columnNumb = 2;
	// 			} else if (winWidth > 300) {
	// 				columnNumb = 1;
	// 			}
				
	// 			return columnNumb;
	// 		}
			
			
	// 		function setColumnWidth() { 
	// 			var winWidth = $(window).width(), 
	// 				columnNumb = getNumbColumns(), 
	// 				postWidth = Math.floor(winWidth / columnNumb);

	// 		}
			
	// 		$('.portfolio-filter #filter a').click(function () { 
	// 			var selector = $(this).attr('data-filter');
				
	// 			$(this).parent().parent().find('a').removeClass('current');
	// 			$(this).addClass('current');
				
	// 			container.isotope( { 
	// 				filter : selector 
	// 			});
				
	// 			setTimeout(function () { 
	// 				reArrangeProjects();
	// 			}, 300);
				
				
	// 			return false;
	// 		});
			
	// 		function reArrangeProjects() { 
	// 			setColumnWidth();
	// 			container.isotope('reLayout');
	// 		}
			
			
	// 		container.imagesLoaded(function () { 
	// 			setColumnWidth();
				
				
	// 			container.isotope( { 
	// 				itemSelector : '.shop-item', 
	// 				layoutMode : 'masonry', 
	// 				resizable : false 
	// 			} );
	// 		} );
			
			
		
			
		
	// 		$(window).on('debouncedresize', function () { 
	// 			reArrangeProjects();
				
	// 		} );
			
		
	// 	} )(jQuery);

		
	// });	

	

	/* DebouncedResize Function */
		(function ($) { 
			var $event = $.event, 
				$special, 
				resizeTimeout;
			
			
			$special = $event.special.debouncedresize = { 
				setup : function () { 
					$(this).on('resize', $special.handler);
				}, 
				teardown : function () { 
					$(this).off('resize', $special.handler);
				}, 
				handler : function (event, execAsap) { 
					var context = this, 
						args = arguments, 
						dispatch = function () { 
							event.type = 'debouncedresize';
							
							$event.dispatch.apply(context, args);
						};
					
					
					if (resizeTimeout) {
						clearTimeout(resizeTimeout);
					}
					
					
					execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
				}, 
				threshold : 150 
			};
		} )(jQuery);	
	
	
	
	
	 // Portfolio Ajax
	 
			$(window).load(function() {
			'use strict';		  
			  var loader = $('.expander-wrap');
			if(typeof loader.html() == 'undefined'){
				$('<div class="expander-wrap"><div id="expander-wrap" class="container clearfix relative"><p class="cls-btn"><a class="close">X</a></p><div/></div></div>').css({opacity:0}).hide().insertAfter('.portfolio');
				loader = $('.expander-wrap');
			}
			$('.expander').on('click', function(e){
				e.preventDefault();
				e.stopPropagation();
				var url = $(this).attr('href');



				loader.slideUp(function(){
					$.get(url, function(data){
						var portfolioContainer = $('.portfolio');
						var topPosition = portfolioContainer.offset().top;
						var bottomPosition = topPosition + portfolioContainer.height();
						$('html,body').delay(600).animate({ scrollTop: bottomPosition - 70}, 800);
						var container = $('#expander-wrap>div', loader);
						
						container.html(data);
						
						$("#owl-portfolio-slider").owlCarousel({
							  
							pagination:true,
							slideSpeed : 300,
							autoPlay : 5000,
							singleItem:true							
						 
						});
						
						$(".container").fitVids();
						
						$('.vimeo a,.youtube a').click(function (e) {
							e.preventDefault();
							var videoLink = $(this).attr('href');
							var classeV = $(this).parent();
							var PlaceV = $(this).parent();
							if ($(this).parent().hasClass('youtube')) {
								$(this).parent().wrapAll('<div class="video-wrapper">');
								$(PlaceV).html('<iframe frameborder="0" height="333" src="' + videoLink + '?autoplay=1&showinfo=0" title="YouTube video player" width="547"></iframe>');
							} else {
								$(this).parent().wrapAll('<div class="video-wrapper">');
								$(PlaceV).html('<iframe src="' + videoLink + '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;color=6dc234" width="500" height="281" frameborder="0"></iframe>');
							}
						});	
						
						loader.slideDown(function(){
							if(typeof keepVideoRatio == 'function'){
								keepVideoRatio('.container > iframe');
							}
						}).delay(1000).animate({opacity:1}, 200);
					});
				});
			});
			
			$('.close', loader).on('click', function(){
				loader.delay(300).slideUp(function(){
					var container = $('#expander-wrap>div', loader);
					container.html('');
					$(this).css({opacity:0});
					
				});
				var portfolioContainer = $('.portfolio');
					var topPosition = portfolioContainer.offset().top;
					$('html,body').delay(0).animate({ scrollTop: topPosition - 70}, 500);
			});

	});	
	
  })(jQuery); 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 





	