(function($) {
  "use strict";
  $(function() {
// Post Social Sharing
$(window).load(function(){$('body').width($('body').width()+1).width('auto')});
$('.social_sharing_list').hide().removeClass('fallback');
$('.blog_post_share').hover(
    function () {
        $('.social_sharing_list', this).stop(true,true).slideDown(100);
    },
    function () {
        $('.social_sharing_list', this).stop(true,true).slideUp(100);
    }
);
$('.gallery-item a').attr('data-gal', 'prettyPhoto[gallery]');
$("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
// toogle search
$('.search-toggle').click(function(){
  $('.toggle_search_wrapper').slideToggle(100);
});
//lightbox
$("[rel^='prettyPhoto']").prettyPhoto();
 // Search toggle.
$('.more-link').addClass("readmore");
$('#mid_container').animate({opacity:1},1200);
$('#main_slider').animate({opacity:1},1200);
$('.Portfolio_gallery').animate({opacity:1},2000);
$(".panel-grid-cell:not(.panel-row-style)").parent('.panel-grid').addClass("no-panel-row-style");
$('#wp-calendar a').parent().addClass('cal-blog');
$('.widget_iconbox-widget, .widget_kaya-client, .widget_kaya-skillset' ).parent().addClass('kaya_widegts_parent');
$('.footer_widgets > div').addClass('footer_widgets_column');
$('.widget_sudo_slider #controls').addClass('widget_controls');
$('.widget_kaya-skillset').parent().addClass('widget_kaya-skillset-parent');
$('.widget_kaya-testimonials').parent().addClass("kaya-testimoial-parent");  // Testimonial
$('.widget_dropcap-widget').parent().addClass("kaya-drocap-parent");  // Testimonial
$('.widget_kaya-rolling').parent().addClass("kaya-rollnumber-parent");  // Rolling numbers 
$('.panel-row-style').parent().addClass("panel-row-style-parent");
$( ".promobox_video_bg" ).next('.panel-row-style-parent').prev('.promobox_video_bg').addClass('promobox_bottom');
$('.widget_kaya-portfolio-slider-widget').parent().parent().next('.panel-row-style-parent').prev().addClass('portfolio_slider_container');
$('.widget_kaya-portfolio-slider-widget').parent().parent().css({"padding-bottom":"0","position":"relative","z-index":"3"} );
$('.panel-row-style-parent:last-child').parent().parent().parent().parent().parent('#mid_container').css('padding-bottom','0').addClass('panel-row-style-last');
$('.panel-row-style-parent:first-child').parent().parent().parent().parent().parent('#mid_container').css('padding-top','0').addClass('panel-row-style-first');
$('.entry-content div.panel-row-style-parent:last-child').parent().parent().parent().parent().addClass("panel-row-style-parent-last");
$('.entry-content div.panel-row-style-parent:nth-child(1)').parent().parent().parent().parent().addClass("panel-row-style-parent-first");
$('.entry-content').closest('div[class^="panel-row-style-parent"]').parent().parent().addClass('test');
$('footer .widget_container ul li:first').css({"border-top":"0",  "padding-top":"0"});
$('#mid_container, #slider_wrapper, #homeslider, .single_img  ul.isotope_gallery, footer .Portfolio_gallery').animate({opacity:1},5000);
$( ".panel-row-style" ).append( "<div class='container_bg'> </div>" );
$('span#controls .prevBtn, span#controls .nextBtn').css('display','block');
$(".widget_kaya-vspace").parent().parent().css("cssText", "margin-bottom: 0px !important;");
//$(".widget_kaya-title").parent().parent('.no-panel-row-style').css("cssText", "margin-bottom: 30px;");
$('.widget_kaya-slider').animate({opacity:1},5000);
// Pricing table
$('.widget_lavan-pricing-table').parent().addClass('pricing_table_parent');
$('.pricing_table_parent').next('.pricing_table_parent').css('padding','0').prev('.pricing_table_parent').css('padding-right','0');
// Responsive Menu Nav
    var menu_go_to = $('.nav_wrap nav').data('mobile-menu');
	 $("<select />").appendTo(".menu");
  // Create default option "Go to..."
  $("<option />", {
  "selected": "selected",
  "value"   : "",
  "text"    : menu_go_to
  }).appendTo(".menu select");
  // Populate dropdowns with the first menu items
  $(".menu ul li a").each(function() {
  var el = $(this);
  if($(this).parents("ul.sub-menu").length > 0){
  $("<option />",{
  "value"   : el.attr("href"),
  //"text"    : '\xa0'+ '\xa0'+ '\xa0'+ el.text()
  "text"    : " -- "+ el.text()
  }).appendTo(".menu select");
  }else{
  $("<option />", {
  "value"   : el.attr("href"),
  "text"    : el.text()
  }).appendTo(".menu select");
  }
  });
  //make responsive dropdown menu actually work     
  $(".menu select").change(function() {
  window.location = $(this).find("option:selected").val();
  });

  $('.item_thumb_gallery, .meta_info, .gallery-item, .isotope_gallery li').hover(
  //Gallery
  function() {
  $(this).find('img').stop().animate({opacity:0.7},1200);
  $(this).find('.image, .meta_info .post_link').css({"left":"0px"}).stop().animate({"left":"50%",opacity:1},600); 

  },function() {
  $(this).find('.image, .post_link').stop().animate({opacity:0},400);
  $(this).find('img').stop().animate({opacity:1},1200);
  });
  // $ slide menu 
  $('.menu ul:first > li').addClass("main-links");
  $(".menu ul li.main-links:last-child").css("border-right","none");

/****************** masonry code **************/
if (jQuery().isotope){
$(window).load(function(){
$(function (){
  var isotopeContainer = $('.isotope-container, .portfolio_gallery, .blog-isotope-container, .widget-isotope-container, .gallery-images');
  isotopeContainer.isotope({
    masonry:{
                   columnWidth:    1,
                    isAnimated:     true,
                    isFitWidth:     true
                }
  });
});
});
}
// Scroll Top
 $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('.scroll_top').fadeIn();
    } else {
        $('.scroll_top').fadeOut();
    }
});
 $('.scroll_top').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
// Slider Arrows Hide / Show
$('.widget_controls .prevBtn, .widget_sudo_slider .nextBtn, .slides-navigation').hide();
$('#sudo_slider_wrapper, #slides').hover(function(){
     $('.widget_controls .prevBtn, .widget_controls .nextBtn, .slides-navigation', this).fadeIn();
},function(){
     $('.widget_controls .prevBtn, .widget_controls .nextBtn, .slides-navigation', this).fadeOut();
});
// parallax Image
 $(window).resize(function(){
     var $header_wrapper = jQuery("#header_wrapper").height()+100;
    var windowHeight = (Math.ceil($(window).height()) - $header_wrapper);
    $("#parallax_single_image").height(windowHeight);
  });
 var $header_wrapper = jQuery("#header_wrapper").height()+100;
var windowHeight = (Math.ceil($(window).height()) - $header_wrapper);
$("#parallax_single_image").height(windowHeight);
//Fit Videos
$("#mid_container_wrapper").fitVids({ customSelector: "iframe[src^='http://socialcam.com']"});
function extend( a, b ) {
    for( var key in b ) { 
      if( b.hasOwnProperty( key ) ) {
        a[key] = b[key];
      }
    }
    return a;
  }
  function DotNav( el, options ) {
    this.nav = el;
    this.options = extend( {}, this.options );
      extend( this.options, options );
      this._init();
  }
  DotNav.prototype.options = {};
  DotNav.prototype._init = function() {
    // special case "dotstyle-hop"
    var hop = this.nav.parentNode.className.indexOf( 'bx-controls' ) !== -1;
    var dots = [].slice.call( this.nav.querySelectorAll( 'div' ) ), current = 0, self = this;
    dots.forEach( function( dot, idx ) {
      dot.addEventListener( 'click', function( ev ) {
        ev.preventDefault();
        if( idx !== current ) {
          dots[ current ].className = '';
          // special case
          if( hop && idx < current ) {
            dot.className += ' current-from-right';
          }
          setTimeout( function() {
            dot.className += ' current';
            current = idx;
            if( typeof self.options.callback === 'function' ) {
              self.options.callback( current );
            }
          }, 25 );            
        }
      } );
    } );
  }
  // add to global namespace
  window.DotNav = DotNav;
      [].slice.call( document.querySelectorAll( '.bx-controls .bx-pager' ) ).forEach( function( nav ) {
        new DotNav( nav, {
          callback : function( idx ) {
            //console.log( idx )
          }
        });
      });
  if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
                    $(".owl-item .slider_items a").dblclick(function(event) {
           event.preventDefault();
                return true;
            });
        }
/* Shooping Cart */
$('.shop-product-items li .shop-produt-image, .related-product-slider .shop-produt-image, .upsells-product-slider .shop-produt-image').hover(function(){
    $(this).find('.product-cart-button').stop(true, true).fadeIn(400);
},function(){
     $(this).find('.product-cart-button').stop(true, true).fadeOut(400);
})
$('.widget_shopping_cart_content .buttons a').removeClass('wc-forward');
$('.button, .form-submit #submit, .widget_shopping_cart_content .buttons a').not('.wc-forward').addClass('primary-button');
$('.checkout-button, #place_order, .cart-sussess-message a').addClass('seconadry-button');
$('.related.products li, .upsells.products li, .cross-sells ul.products li').removeClass('first last');
$('.add_to_wishlist').removeClass('single_add_to_wishlist button alt primary-button');
$('i.icon-align-right').removeClass('icon-align-right').addClass('fa fa-heart');
});
})(jQuery);