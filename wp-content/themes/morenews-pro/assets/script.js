(function (e) {
  'use strict';
  var n = window.AFTHRAMPES_JS || {};
  (n.mobileMenu = {
    init: function () {
      this.toggleMenu(), this.menuMobile(), this.menuArrow();

      if (e('.aft-mobile-navigation').length) {
        var navElement = document.querySelector('.aft-mobile-navigation');
        if (navElement) {
          n.trapFocus(navElement);
        }
      }
    },
    toggleMenu: function () {
      e('#masthead').on('click', '.toggle-menu', function (event) {
        var ethis = e('.main-navigation .menu .menu-mobile');
        if (ethis.css('display') == 'block') {
          ethis.slideUp('300');
        } else {
          ethis.slideDown('300');
        }
        e('.ham').toggleClass('exit');
      });
      e('#masthead .main-navigation ').on(
        'click',
        '.menu-mobile a button',
        function (event) {
          event.preventDefault();
          var ethis = e(this),
            eparent = ethis.closest('li');
          if (eparent.find('> .children').length) {
            var esub_menu = eparent.find('> .children');
          } else {
            var esub_menu = eparent.find('> .sub-menu');
          }
          if (esub_menu.css('display') == 'none') {
            esub_menu.slideDown('300');
            ethis.addClass('active');
          } else {
            esub_menu.slideUp('300');
            ethis.removeClass('active');
          }
          return false;
        }
      );
    },
    menuMobile: function () {
      if (e('.main-navigation .menu > ul').length) {
        var ethis = e('.main-navigation .menu > ul'),
          eparent = ethis.closest('.main-navigation'),
          pointbreak = eparent.data('epointbreak'),
          window_width = window.innerWidth;
        if (typeof pointbreak == 'undefined') {
          pointbreak = 991;
        }
        if (pointbreak >= window_width) {
          ethis.addClass('menu-mobile').removeClass('menu-desktop');
          e('.main-navigation .toggle-menu').css('display', 'block');
          e('.main-navigation').addClass('aft-mobile-navigation');
        } else {
          ethis
            .addClass('menu-desktop')
            .removeClass('menu-mobile')
            .css('display', '');
          e('.main-navigation .toggle-menu').css('display', '');
          e('.main-navigation').removeClass('aft-mobile-navigation');
        }
      }
    },
    menuArrow: function () {
      if (e('#masthead .main-navigation div.menu > ul').length) {
        e('#masthead .main-navigation div.menu > ul .sub-menu')
          .parent('li')
          .find('> a')
          .append('<button class="fa fa-angle-down">');
        e('#masthead .main-navigation div.menu > ul .children')
          .parent('li')
          .find('> a')
          .append('<button class="fa fa-angle-down">');
      }
    },
  }),
    (n.trapFocus = function (element) {
      var focusableEls = element.querySelectorAll(
          'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])'
        ),
        firstFocusableEl = focusableEls[0],
        lastFocusableEl = focusableEls[focusableEls.length - 1],
        KEYCODE_TAB = 9;

      element.addEventListener('keydown', function (e) {
        var isTabPressed = e.key === 'Tab' || e.keyCode === KEYCODE_TAB;

        if (!isTabPressed) {
          return;
        }

        if (e.shiftKey) {
          /* shift + tab */ if (document.activeElement === firstFocusableEl) {
            lastFocusableEl.focus();
            e.preventDefault();
          }
        } /* tab */ else {
          if (document.activeElement === lastFocusableEl) {
            firstFocusableEl.focus();
            e.preventDefault();
          }
        }
      });
    }),
    (n.DataBackground = function () {
      var pageSection = e('.data-bg');
      pageSection.each(function (indx) {
        if (e(this).attr('data-background')) {
          e(this).css(
            'background-image',
            'url(' + e(this).data('background') + ')'
          );
        }
      });
      e('.bg-image').each(function () {
        var src = e(this).children('img').attr('src');
        e(this)
          .css('background-image', 'url(' + src + ')')
          .children('img')
          .hide();
      });
    }),
    (n.setInstaHeight = function () {
      e('.insta-slider-block').each(function () {
        var img_width = e(this)
          .find('.insta-item .af-insta-height')
          .eq(0)
          .innerWidth();
        e(this).find('.insta-item .af-insta-height').css('height', img_width);
      });
    }),
    (n.Preloader = function () {
      e('#loader-wrapper').fadeOut();
      e('#af-preloader').delay(500).fadeOut('slow');
    }),
    (n.Search = function () {
      e('.af-search-click').on('click', function () {
        e('#af-search-wrap').toggleClass('af-search-toggle');
      });
    }),
    (n.Offcanvas = function () {
      e('#sidr').addClass('aft-mobile-off-canvas');
      var offCanvasElement = document.querySelector('.aft-mobile-off-canvas');
      if (offCanvasElement) {
        n.trapFocus(offCanvasElement);
      }

      e('.offcanvas-nav').sidr({
        speed: 300,
        side: 'left',
        displace: false,
      });
      e('.sidr-class-sidr-button-close').on('click', function () {
        e.sidr('close', 'sidr');
      });
    }),
    // SHOW/HIDE SCROLL UP //
    (n.show_hide_scroll_top = function () {
      if (e(window).scrollTop() > e(window).height() / 2) {
        e('#scroll-up').fadeIn(300);
      } else {
        e('#scroll-up').fadeOut(300);
      }
    }),
    (n.scroll_up = function () {
      e('#scroll-up').on('click', function () {
        e('html, body').animate(
          {
            scrollTop: 0,
          },
          800
        );
        return false;
      });
    }),
    (n.MagnificPopup = function () {
      e('div.zoom-gallery').magnificPopup({
        delegate: 'a.insta-hover',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
          verticalFit: true,
          titleSrc: function (item) {
            return item.el.attr('title');
          },
        },
        gallery: {
          enabled: true,
        },
        zoom: {
          enabled: true,
          duration: 300,
          opener: function (element) {
            return element.find('img');
          },
        },
      });
      e('.gallery').each(function () {
        e(this).magnificPopup({
          delegate: 'a',
          type: 'image',
          gallery: {
            enabled: true,
          },
          zoom: {
            enabled: true,
            duration: 300,
            opener: function (element) {
              return element.find('img');
            },
          },
        });
      });

      e('.wp-block-gallery').each(function () {
        e(this).magnificPopup({
          delegate: 'a',
          type: 'image',
          gallery: {
            enabled: true,
          },
          zoom: {
            enabled: true,
            duration: 300,
            opener: function (element) {
              return element.find('img');
            },
          },
        });
      });
    }),
    (n.searchReveal = function () {
      jQuery('.search-overlay .search-icon').on('click', function () {
        jQuery(this).parent().toggleClass('reveal-search');
        return false;
      });

      jQuery('body').on('click', function (e) {
        if (jQuery('.search-overlay').hasClass('reveal-search')) {
          var container = jQuery('.search-overlay');
          if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass('reveal-search');
          }
        }
      });
    }),
    (n.em_sticky = function () {
      jQuery('.home #secondary.aft-sticky-sidebar').theiaStickySidebar({
        additionalMarginTop: 30,
      });
    }),
    (n.jQueryMarquee = function () {
      e('.marquee.aft-flash-slide').marquee({
        //duration in milliseconds of the marquee
        speed: 80000,
        //gap in pixels between the tickers
        gap: 0,
        //time in milliseconds before the marquee will start animating
        delayBeforeStart: 0,
        //'left' or 'right'
        // direction: 'right',
        //true or false - should the marquee be duplicated to show an effect of continues flow
        duplicated: true,
        pauseOnHover: true,
        startVisible: true,
      });
    }),
    (n.SliderAsNavFor = function () {
      if (e('.banner-single-slider-1-wrap').hasClass('no-thumbnails')) {
        return null;
      } else {
        return '.af-banner-slider-thumbnail';
      }
    }),
    (n.RtlCheck = function () {
      if (e('body').hasClass('rtl')) {
        return true;
      } else {
        return false;
      }
    }),
    (n.SlickSliderControls = function (widgetClass, controlWrap) {
      var widgetID = e(widgetClass).parents('.morenews-widget').attr('id');
      console.log(widgetID);
      return e(widgetID).find(controlWrap);
    }),
    (n.checkThumbOption = function () {
      if (e('.hasthumbslide').hasClass('side')) {
        return '.af-post-slider-thumbnail';
      } else {
        return false;
      }
    }),
    //slick slider
    (n.SlickBannerCarousel = function () {
      e('.af-banner-carousel-1')
        .not('.slick-initialized')
        .slick({
          autoplay: true,
          autoplaySpeed: 10000,
          infinite: true,
          nextArrow:
            '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
          prevArrow:
            '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
          appendArrows: e('.af-main-navcontrols'),
          rtl: n.RtlCheck(),
        });
    }),
    //Slick Carousel
    (n.SlickTrendingVerticalCarousel = function () {
      e('.aft-horizontal-trending-part .banner-vertical-slider')
        .not('.slick-initialized')
        .slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplaySpeed: 12000,
          autoplay: true,
          infinite: true,
          loop: true,
          dots: false,
          nextArrow:
            '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
          prevArrow:
            '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
          appendArrows: '.af-trending-navcontrols',
          responsive: [
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                draggable: false,
                swipeToSlide: false,
                touchMove: false,
                swipe: false,
              },
            },
          ],
        });

      e('.aft-4-trending-posts .banner-vertical-slider')
        .not('.slick-initialized')
        .slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          infinite: true,
          loop: true,
          vertical: true,
          verticalSwiping: true,
          dots: false,
          nextArrow:
            '<button type="button" class="slide-icon slide-next icon-up fas fa-angle-up" aria-label="Next slide" tabindex="0"></button>',
          prevArrow:
            '<button type="button" class="slide-icon slide-prev icon-down fas fa-angle-down" aria-label="Previous slide" tabindex="0"></button>',
          appendArrows: e('.af-trending-navcontrols'),
          responsive: [
            {
              breakpoint: 1025,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                vertical: false,
                verticalSwiping: false,
                draggable: false,
                swipeToSlide: false,
                touchMove: false,
                swipe: false,
                rtl: n.RtlCheck(),
              },
            },
            {
              breakpoint: 600,
              settings: {
                draggable: false,
                swipeToSlide: false,
                touchMove: false,
                swipe: false,
              },
            },
          ],
        });

      e('.banner-thumb-carousel')
        .not('.slick-initialized')
        .slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 14000,
          infinite: true,
          loop: true,
          dots: false,
          nextArrow:
            '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
          prevArrow:
            '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
          appendArrows: e('.af-thumb-navcontrols'),
          rtl: n.RtlCheck(),
          responsive: [
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });
    }),
    (n.SlickWidgetPostSlider = function () {
      e('.af-widget-post-slider').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            infinite: true,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-post-slider-navcontrols'),
            rtl: n.RtlCheck(),
          });
      });
    }),
    //Slick Carousel
    (n.SlickCarousel = function () {
      e('.af-featured-post-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            infinite: true,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e('.af-widget-featured-post-carousel-navcontrols'),
            rtl: n.RtlCheck(),
            responsive: [
              {
                breakpoint: 1025,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                },
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                },
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                },
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                },
              },
            ],
          });
      });
    }),
    (n.WidgetSlickCarousel = function () {
      e('#secondary .af-widget-post-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            infinite: true,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-post-carousel-navcontrols'),
            rtl: n.RtlCheck(),
            responsive: [
              {
                breakpoint: 900,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                },
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                },
              },
            ],
          });
      });

      e('.primary-footer .af-widget-post-carousel').each(function () {
        e()
          .not('.slick-initialized')
          .slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            infinite: true,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-post-carousel-navcontrols'),
            rtl: n.RtlCheck(),
          });
      });

      e('#sidr .af-widget-post-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            infinite: true,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-post-carousel-navcontrols'),
            rtl: n.RtlCheck(),
          });
      });

      e('.morenews_posts_carousel_widget .af-widget-post-carousel').each(
        function () {
          e(this)
            .not('.slick-initialized')
            .slick({
              slidesToShow: 3,
              slidesToScroll: 1,
              autoplay: true,
              autoplaySpeed: 10000,
              infinite: true,
              nextArrow:
                '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
              prevArrow:
                '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
              appendArrows: e(this)
                .parents('.morenews-widget')
                .find('.af-widget-post-carousel-navcontrols'),
              rtl: n.RtlCheck(),
              responsive: [
                {
                  breakpoint: 1025,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                  },
                },
                {
                  breakpoint: 769,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                  },
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  },
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  },
                },
              ],
            });
        }
      );
    }),
    (n.SlickWidgetTrendingVerticalCarousel = function () {
      e('.body.full-width-content #primary .af-trending-widget-carousel').each(
        function () {
          e(this)
            .not('.slick-initialized')
            .slick({
              slidesToShow: 3,
              slidesToScroll: 1,
              autoplay: true,
              infinite: true,
              loop: true,
              dots: false,
              nextArrow:
                '<button type="button"class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
              prevArrow:
                '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
              appendArrows: e(this)
                .parents('.morenews-widget')
                .find('.af-widget-trending-carousel-navcontrols'),
              rtl: n.RtlCheck(),
              responsive: [
                {
                  breakpoint: 1025,
                  settings: {
                    slidesToShow: 2,
                    draggable: false,
                    swipeToSlide: false,
                    touchMove: false,
                    swipe: false,
                  },
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 1,
                    draggable: false,
                    swipeToSlide: false,
                    touchMove: false,
                    swipe: false,
                  },
                },
              ],
            });
        }
      );

      e('#primary .af-trending-widget-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            loop: true,
            dots: false,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-trending-carousel-navcontrols'),
            rtl: n.RtlCheck(),
            responsive: [
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  draggable: false,
                  swipeToSlide: false,
                  touchMove: false,
                  swipe: false,
                },
              },
            ],
          });
      });

      e('.af-trending-widget-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            loop: true,
            vertical: true,
            verticalSwiping: true,
            dots: false,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-up fas fa-angle-up" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-down fas fa-angle-down" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-trending-carousel-navcontrols'),
            responsive: [
              {
                breakpoint: 1025,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  vertical: false,
                  verticalSwiping: false,
                  draggable: false,
                  swipeToSlide: false,
                  touchMove: false,
                  swipe: false,
                  rtl: n.RtlCheck(),
                },
              },
              {
                breakpoint: 600,
                settings: {
                  draggable: false,
                  swipeToSlide: false,
                  touchMove: false,
                  swipe: false,
                },
              },
            ],
          });
      });
    }),
    (n.SlickWidgetPopularVerticalCarousel = function () {
      e('.body.full-width-content #primary .af-popular-widget-carousel').each(
        function () {
          e(this)
            .not('.slick-initialized')
            .slick({
              slidesToShow: 3,
              slidesToScroll: 1,
              autoplay: true,
              infinite: true,
              loop: true,
              dots: false,
              nextArrow:
                '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
              prevArrow:
                '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
              appendArrows: e(this)
                .parents('.morenews-widget')
                .find('.af-widget-popular-carousel-navcontrols'),
              rtl: n.RtlCheck(),
              responsive: [
                {
                  breakpoint: 1025,
                  settings: {
                    slidesToShow: 2,
                    draggable: false,
                    swipeToSlide: false,
                    touchMove: false,
                    swipe: false,
                  },
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 1,
                    draggable: false,
                    swipeToSlide: false,
                    touchMove: false,
                    swipe: false,
                  },
                },
              ],
            });
        }
      );

      e('#primary .af-popular-widget-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            loop: true,
            dots: false,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-popular-carousel-navcontrols'),
            rtl: n.RtlCheck(),
            responsive: [
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  draggable: false,
                  swipeToSlide: false,
                  touchMove: false,
                  swipe: false,
                },
              },
            ],
          });
      });

      e('.af-popular-widget-carousel').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            loop: true,
            vertical: true,
            verticalSwiping: true,
            dots: false,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-up fas fa-angle-up" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-down fas fa-angle-down" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-popular-carousel-navcontrols'),
            responsive: [
              {
                breakpoint: 1025,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  vertical: false,
                  verticalSwiping: false,
                  draggable: false,
                  swipeToSlide: false,
                  touchMove: false,
                  swipe: false,
                  rtl: n.RtlCheck(),
                },
              },
              {
                breakpoint: 600,
                settings: {
                  draggable: false,
                  swipeToSlide: false,
                  touchMove: false,
                  swipe: false,
                },
              },
            ],
          });
      });
    }),
    //Video thumbnail
    (n.YouTubeThumbnail = function () {
      e('.af-youtube-video-carousel')
        .not('.slick-initialized')
        .slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          loop: true,
          infinite: true,
          nextArrow:
            '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
          prevArrow:
            '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
          appendArrows: e('.af-widget-featured-video-carousel-navcontrols'),
          rtl: n.RtlCheck(),
          responsive: [
            {
              breakpoint: 1025,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
              },
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });

      e('.af-youtube-slider').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            loop: true,
            infinite: true,
            nextArrow:
              '<button type="button" class="slide-icon slide-next icon-right fas fa-angle-right" aria-label="Next slide" tabindex="0"></button>',
            prevArrow:
              '<button type="button" class="slide-icon slide-prev icon-left fas fa-angle-left" aria-label="Previous slide" tabindex="0"></button>',
            appendArrows: e(this)
              .parents('.morenews-widget')
              .find('.af-widget-youtube-video-navcontrols'),
            fade: true,
            rtl: n.RtlCheck(),
            asNavFor: e(this)
              .parents('.morenews-widget')
              .find('.af-youtube-slider-thumbnail'),
          });
      });

      e('.af-youtube-slider-thumbnail').each(function () {
        e(this)
          .not('.slick-initialized')
          .slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            loop: true,
            vertical: true,
            verticalSwiping: true,
            infinite: true,
            dots: false,
            arrows: false,
            focusOnSelect: true,
            asNavFor: e(this)
              .parents('.morenews-widget')
              .find('.af-youtube-slider'),
            responsive: [
              {
                breakpoint: 1025,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  infinite: true,
                },
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  vertical: false,
                  verticalSwiping: false,
                },
              },
            ],
          });
      });

      /*JS FOR FEATURED SECTION THUMBNAILS*/
      e('.entry-header-yt-thumbnail').on('click', function (evt) {
        if (
          e(this)
            .parents('.primary-video')
            .find('.entry-header-yt-thumbnail')
            .hasClass('af-hide-item')
        ) {
          e(this)
            .parents('.primary-video')
            .find('.entry-header-yt-iframe')
            .addClass('af-hide-item');
          e(this)
            .parents('.primary-video')
            .find('.entry-header-yt-thumbnail')
            .removeClass('af-hide-item');
          e(this).parents('.primary-video').find('.vid_frame').attr('src', '');
        }

        e(this)
          .parents('.entry-header-yt-video-container')
          .find('.entry-header-yt-iframe')
          .removeClass('af-hide-item');
        e(this)
          .parents('.entry-header-yt-video-container')
          .find('.entry-header-yt-thumbnail')
          .addClass('af-hide-item');
        e(this).css('padding-top', 0);
        var video_link = e(this).attr('data-video-link');
        e(this).parent().find('.vid_frame').attr('src', video_link);
        e('.vid-container').fitVids();
      });

      e('.featured-yt-sec .slick-arrow').on('click', function (evt) {
        if (
          e(this)
            .parents('.primary-video')
            .find('.entry-header-yt-thumbnail')
            .hasClass('af-hide-item')
        ) {
          e(this)
            .parents('.primary-video')
            .find('.entry-header-yt-iframe')
            .addClass('af-hide-item');
          e(this)
            .parents('.primary-video')
            .find('.entry-header-yt-thumbnail')
            .removeClass('af-hide-item');
          e(this).parents('.primary-video').find('.vid_frame').attr('src', '');
        }
      });

      /*JS FOR WIDGET SECTION THUMBNAILS*/
      e('.widget-yt-thumbnail').on('click', function (evt) {
        if (
          e(this)
            .parents('.secondary-video')
            .find('.widget-yt-thumbnail')
            .hasClass('af-hide-item')
        ) {
          e(this)
            .parents('.secondary-video')
            .find('.widget-yt-iframe')
            .removeClass('af-hide-frame');
          e(this)
            .parents('.secondary-video')
            .find('.widget-yt-thumbnail')
            .addClass('af-hide-frame');
          e(this)
            .parents('.secondary-video')
            .find('.vid_frame')
            .attr('src', '');
        }

        e(this)
          .parents('.secondary-video')
          .find('.widget-yt-iframe')
          .removeClass('af-hide-frame');
        e(this)
          .parents('.secondary-video')
          .find('.widget-yt-thumbnail')
          .addClass('af-hide-frame');
        e(this).css('padding-top', 0);
        var video_link = e(this).attr('data-video-link');
        e(this).parent().find('.vid_frame').attr('src', video_link);
        //e(".vid-container").fitVids();
      });

      e('.slick-arrow').on('click', function (evt) {
        if (
          e(this)
            .parents('.secondary-video')
            .find('.widget-yt-thumbnail')
            .hasClass('af-hide-item')
        ) {
          e(this)
            .parents('.secondary-video')
            .find('.entry-header-yt-iframe')
            .addClass('af-hide-item');
          e(this)
            .parents('.secondary-video')
            .find('.entry-header-yt-thumbnail')
            .removeClass('af-hide-item');
          e(this)
            .parents('.secondary-video')
            .find('.vid_frame')
            .attr('src', '');
        }
      });
    }),
    (n.MasonryBlog = function () {
      if (e('.aft-masonry-archive-posts').length > 0) {
        jQuery('.aft-masonry-archive-posts').masonry();
      }
    });

  e(document).ready(function () {
    n.mobileMenu.init(),
      n.setInstaHeight(),
      n.em_sticky(),
      n.jQueryMarquee(),
      n.MagnificPopup(),
      n.Offcanvas(),
      
      n.scroll_up(),
      n.SlickBannerCarousel(),
      n.SlickWidgetPostSlider(),
      n.WidgetSlickCarousel(),
      n.SlickCarousel(),
      n.SlickTrendingVerticalCarousel(),
      n.SlickWidgetTrendingVerticalCarousel(),
      n.SlickWidgetPopularVerticalCarousel(),
      n.YouTubeThumbnail();
  }),
    e(window).scroll(function () {
      n.show_hide_scroll_top();
    }),
    e(window).load(function () {
      n.DataBackground(), n.MasonryBlog(), n.Preloader(), n.Search(), n.searchReveal();
    }),
    e(window).resize(function () {
      n.mobileMenu.menuMobile();
    });
})(jQuery);
