(function( $ ) {
    "use strict";
    $(function() {
    	// Info Boxes
    	$('#user_login').attr( {'placeholder':'Username', "required":"true"} );
	    $('#user_pass').attr( {'placeholder': 'Password' , "required":"true"} );
	    $('#wp-submit').addClass('readmore_button');
	    $( ".info_box .delete" ).click(function() {
	        $(this).parent('.info_box').parent().animate({ opacity: 'hide' }, "slow");
	    });
	    // Toggle Content
	 	 $(".toggle_content").hide();
	           $("strong.trigger").click(function(){
	         $(this).toggleClass("active").next().slideToggle("slow");
	      
	    });
/* ----------------------------------
/* Image Text Boxes */
$('.widget_kaya-image-text-boxes').each(function(){
	$(this).next(this).prev(this).css('margin-bottom','30px');
	var content_height = $(this).find('.overlay_content').height();
	$(this).find('.overlay_content.vertical_align_middle').css('margin-top',-(Math.ceil((content_height/2))+30));
});
/* ----------------------------------
Gallery Widget
------------------------------------*/
$('.gallery_image_wrapper').each(function(){
  var grayscale = $(this).data('grayscale');
  if( grayscale == 'on' ){
    $(this).find('ul li, .image_gallery_slider').addClass('gray_scale_img');
    $(this).find('ul li, .image_gallery_slider').hover(function(){
      $(this).removeClass('gray_scale_img');
    },function(){
      $(this).addClass('gray_scale_img');
    });
  }
  $(this).find('ul li, .image_gallery_slider').hover(function(){
    $(this).find('.image_hover_bg_color').stop(true,true).fadeIn('slow');
    $(this).find('.mouse_over_on_image').stop(true,true).css('bottom', "0px");
  },function(){
    $(this).find('.image_hover_bg_color').stop(true,true).fadeOut('slow');
    $(this).find('.mouse_over_on_image').stop(true,true).css('bottom', "-100%");
  }); 
  var bg_color = $(this).find('.image_hover_bg_color').data('img-bg');
   if( (bg_color != 'transparent')){
    $(this).find('ul li, .image_gallery_slider').hover(function(){
      $(this).find('img').css('opacity',0.5);
    },function(){
      $(this).find('img').css('opacity',1);
    }); 
  }
});

function gallery_widget_slider(){
$('.gallery_image_wrapper').each(function(){
	var columns = $(this).data('columns');
	var autoplay = $(this).data('autoplay');
	var margin = $(this).data('margin');
	var colum = $(this).find('#gallery_widget_slider').data('colum');
	var buttons = $(this).find('#gallery_widget_slider').data('buttons');
	var animationin = $(this).find('#gallery_widget_slider').data('animationin');
	var animationout = $(this).find('#gallery_widget_slider').data('animationout');
	var responsive2_column = ( (columns == '4') || (columns == '3') ) ? '2' :columns;
   $(this).find('#gallery_widget_slider').owlCarousel({
	    nav:buttons,	   
	    navText: [ '', '' ],
	    autoplay : autoplay,
		autoHeight : false,
		animateOut: animationout,
		animateIn: animationin,
		navigation:false,
		loop : true,
		margin:margin,
    onInitialized: function() {  
        $('.image_gallery_slider_wrapper').css('height','');     
        $('#gallery_widget_slider').css('display','block');
       $('.gallery_image_wrapper .owl-carousel.owl-loaded').css('visibility', 'visible');   
       $('.slider_bg_loading_img').hide();
            },
		responsive: {
			0:{
            items:1,
	        },
	        480:{
	            items:1,
	        },
	        768:{
	            items:responsive2_column,
	            loop : false,
	        },
	        1024:{
	            items:columns,
	            loop : true,
	        },
		}, 
		  //loop : true,
   });
});
}
$(window).load(function() {
     gallery_widget_slider();
      $('.gallery_image_wrapper').each(function(){
        var radius = $(this).data('radius');
        $(this).find('.owl-item').css('border-radius', radius+'%');
      });
  });
//end gallery widget  
/*----------------------------------  */ 	           
  /* Portfolio Slider Width */
   
  function fluid_script(){
   var $content_width= $('#fluid_layout .widget_kaya-promobox, #fluid_layout .promobox-video > div').width($(window).width());
		var $container_fluid = Math.ceil( (($(window).width()  - parseInt($('.container').css('width'))) / 2) );
		$(' #fluid_layout .widget_kaya-promobox').css({
		   'margin-left' : -$container_fluid,
		   //width : $content_width+'25',
		});
		var $promo_content_height = $('.promobox_content').height() / 2;
		$('.promobox_content').css({'margin-top': -$promo_content_height, 'top':'50%'});
		var $vals = $('#box_layout').css('width');
		$('#box_layout .widget_kaya-promobox, #box_layout .promobox-video > div').css({
		   'width' : $vals,
		});
		$('#box_layout .widget_kaya-promobox').css({
		   'margin-left' : -30,
		   		});
		//alert();
		$('.widget_kaya-promobox').css({
		   'position' : 'absolute',
		   'top' : 0,
		   'overflow' : 'hidden',
		   'height' : '100%',
		  });
        }
 /*------------------------------*/
 /*----------------------------------
Icon Box 
---------------------------------*/
function iconbox_widget(){
  $('.widget_iconbox-widget').each(function(){
    var iconbox_rotate = $(this).find('.iconbox').data('rotate');
    var hover_rotate = Math.ceil(360-iconbox_rotate);
    var iconbox_icon_rotate_hover =$(this).find('.iconbox').data('rotate-hover');
    //alert(hover_rotate);
    $(this).find('.iconbox_bg').css({
      transform: 'rotate('+iconbox_rotate+'deg)',
      MozTransform: 'rotate('+iconbox_rotate+'deg)',
      WebkitTransform: 'trotate('+iconbox_rotate+'deg)',
      msTransform: 'rotate('+iconbox_rotate+'deg)'
    });

    $(this).find('.iconbox_bg .iconbox_iconbg_conatiner > div, .iconbox_iconbg_conatiner img').css({
      transform: 'rotate(-'+iconbox_rotate+'deg)',
      MozTransform: 'rotate(-'+iconbox_rotate+'deg)',
      WebkitTransform: 'trotate(-'+iconbox_rotate+'deg)',
      msTransform: 'rotate(-'+iconbox_rotate+'deg)'
    });
      var iconbox_bg_color =$(this).find('.iconbox').data('bgcolor');
      var iconbox_color =$(this).find('.iconbox').data('icon');
      var iconbox_hoverbg =$(this).find('.iconbox').data('hoverbg');
      var iconbox_hovericon =$(this).find('.iconbox').data('hovericon');
      var iconbox_hovericon_color =  iconbox_hovericon ? iconbox_hovericon :iconbox_color;
      var iconbox_bg_hover_color =  iconbox_hoverbg ? iconbox_hoverbg :iconbox_bg_color;

      var iconboxs_border_hover_color = $(this).find('.iconbox').data('border-hover');
      var iconboxs_border_color = $(this).find('.iconbox').data('border-color');
      var iconbox_border_color = iconboxs_border_color ? '1px solid '+iconboxs_border_color:'';
      var iconbox_border_hover_color = iconboxs_border_hover_color ? '1px solid '+iconboxs_border_hover_color : iconbox_border_color;

   $(this).mouseover(function(){
      $(this).find('.iconbox_bg').css({'border':iconbox_border_hover_color });
      $(this).find('.iconbox_bg .iconbox_iconbg_conatiner').css({'color':iconbox_hovericon_color, 'background-color':iconbox_bg_hover_color });
      if( iconbox_icon_rotate_hover == 'on' ){
        $(this).find('.iconbox_bg .iconbox_iconbg_conatiner > div, .iconbox_iconbg_conatiner img').css({
        transform: 'rotate('+hover_rotate+'deg)',
        MozTransform: 'rotate('+hover_rotate+'deg)',
        WebkitTransform: 'rotate('+hover_rotate+'deg)',
        msTransform: 'rotate('+hover_rotate+'deg)',
        });       
      }
    });
    $(this).mouseout(function(){
      $(this).find('.iconbox_bg').css({'border':iconbox_border_color});
      $(this).find('.iconbox_bg .iconbox_iconbg_conatiner').css({'background-color':iconbox_bg_color, 'color':iconbox_color});
      if( iconbox_icon_rotate_hover == 'on' ){
          $(this).find('.iconbox_bg .iconbox_iconbg_conatiner > div, .iconbox_iconbg_conatiner img').css({
          transform: 'rotate(-'+iconbox_rotate+'deg)',
          MozTransform: 'rotate(-'+iconbox_rotate+'deg)',
          WebkitTransform: 'rotate(-'+iconbox_rotate+'deg)',
          msTransform: 'rotate(-'+iconbox_rotate+'deg)'
        });
      }
    }); 

  });
}
iconbox_widget();         
/* ----------------------------------
Window Resize
------------------------------------*/
 fluid_script();
   $(window).resize(function(){
	  fluid_script();
	});

});
})(jQuery);