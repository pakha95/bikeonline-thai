/*
 * Custom code goes here.
 * A template should always ship with an empty custom.js
 */
 
/* --------------------------- TmplateTrip JS ------------------------------ */
/* ----------- Start Page-loader ----------- */
	$(window).load(function() 
	{ 
		$(".ttloading-bg").fadeOut("slow");
	})
	/* ----------- End Page-loader ----------- */
$(document).ready(function() {
				   
/* Go to Top JS START */
		if ($('#goToTop').length) {
			var scrollTrigger = 100, // px
				backToTop = function () {
					var scrollTop = $(window).scrollTop();
					if (scrollTop > scrollTrigger) {
						$('#goToTop').addClass('show');
					} else {
						$('#goToTop').removeClass('show');
					}
				};
			backToTop();
			$(window).on('scroll', function () {
				backToTop();
			});
			$('#goToTop').on('click', function (e) {
				e.preventDefault();
				$('html,body').animate({
					scrollTop: 0
				}, 700);
			});
		}
	/* Go to Top JS END */
	
	/*-----------start menu toggle ------------*/
	$('.topmenu .title_block').click(function() { 
		$('.topmenu .title_block').toggleClass('active'); 
		$('.topmenu .menu.js-top-menu').slideToggle("slow"); 
	}); 

	/*-----------End menu toggle ------------*/
	
	
	/* -------------- Start Footer-Bottom Js ------------------- */

	$("#footer .footer-container .links.link-list").prependTo($(".bottom-footer .container"));
	
	/* -------------- End Footer-Bottom Js ------------------- */
	
	/*---------------- Start Search ---------------- */


		$(".ttsearch_button ").click(function() {
			
		$('.ttsearchtoggle').parent().toggleClass('active');
		$('.ttsearchtoggle').toggle('fast', function() {
		});
		$('#search_query_top').attr('autofocus', 'autofocus').focus();
		});
	/*---------------- End Search ---------------- */
	
	/* -------------- Start Homepage Tab ------------------- */

	$("#hometab").prepend("<div class='tabs'><ul class='nav nav-tabs'></ul></div>");
	$("#hometab .ttfeatured-products .tab-title").wrap("<li class='nav-item'><a class='nav-link' data-toggle='tab' href='#ttfeatured-content'></a></li>");
	$("#hometab .ttbestseller-products .tab-title").wrap("<li class='nav-item'><a class='nav-link' data-toggle='tab' href='#ttbestseller-content'></a></li>");
	$("#hometab .ttnew-products .tab-title").wrap("<li class='nav-item'><a class='nav-link' data-toggle='tab' href='#ttnew-content'></a></li>");
	$("#hometab .tabs ul.nav-tabs").append($("#hometab > section li.nav-item"));

	$("#hometab > section.ttfeatured-products").wrap("<div class='tab-pane row fade' id='ttfeatured-content'>");
	$("#hometab > section.ttbestseller-products").wrap("<div class='tab-pane row fade' id='ttbestseller-content'>");
	$("#hometab > section.ttnew-products").wrap("<div class='tab-pane row fade' id='ttnew-content'>");
	$("#hometab > .tab-pane").wrapAll("<div class='home-tab-content' id='home-tab-content' />");
	$("#hometab").append($("#hometab > .home-tab-content"));
	
	$('#hometab .tabs ul.nav-tabs > li:first-child a').addClass('active');
	$('#hometab #home-tab-content .tab-pane:first-child').addClass('in active');

	/* -------------- End Homepage Tab ------------------- */
	
	/* ------------ Start Add Product Bootsrap class JS --------------- */
	
	colsCarousel = $('#right-column, #left-column').length;
	if (colsCarousel == 2) {
		ci=4;
	} else if (colsCarousel == 1) {
		ci=4;
	} else {
		ci=4;
	}

	
		var cols_count = $('#right-column, #left-column').length;
		if (cols_count == 2) {
			$('#content .products .product-miniature, #content-wrapper .products .product-miniature').attr('class', 'product-miniature js-product-miniature product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
		} else if (cols_count == 1) {
			$('#content .products .product-miniature, #content-wrapper .products .product-miniature').attr('class', 'product-miniature js-product-miniature product-grid col-lg-3 col-md-4 col-sm-6 col-xs-12');
		} else {
			$('#content .products .product-miniature, #content-wrapper .products .product-miniature').attr('class', 'product-miniature js-product-miniature product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
		}
		
	/* ------------ End Add Product Bootsrap class JS --------------- */
	
	
	
	/* ----------- Start Carousel For FeatureProduct / BestsellerProduct / NewProduct / SpecialProduct / ViewProduct / CategoryProduct ----------- */
	
	$(".ttfeatured-products .products, .ttbestseller-products .products, .ttnew-products .products, .crossselling-product .products, .view-product .products, .category-products .products, .product-accessories .products").owlCarousel({
		navigation:true,
		navigationText: [
			"<i class='material-icons'>&#xE5CB;</i>",
			"<i class='material-icons'>&#xE5CC;</i>"],
		items: ci, //10 items above 1000px browser width
		itemsDesktop : [1200,3], 
		itemsDesktopSmall : [991,3], 
		itemsTablet: [767,2], 
		itemsMobile : [480,1] 
	});
	
	/* ----------- End Carousel For FeatureProduct / BestsellerProduct / NewProduct / SpecialProduct / ViewProduct / CategoryProduct ----------- */
	 
	 /* ----------- Start Carousel For SpecialProduct ----------- */
	 $(".ttspecial-products .products").owlCarousel({
		navigation:true,
		navigationText: [
			"<i class='material-icons'>&#xE5CB;</i>",
			"<i class='material-icons'>&#xE5CC;</i>"],
		items: 3, //10 items above 1000px browser width
		itemsDesktop : [1200,2], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [767,2], 
		itemsMobile : [480,1] 
	});
	 /* ----------- End Carousel For SpecialProduct ----------- */
	 
	/* ----------- Start Carousel For Productpage Thumbs ----------- */
	
		$("#ttproduct-thumbs").owlCarousel({
		navigation:true,
		navigationText: [
			"<i class='material-icons'>&#xE5CB;</i>",
			"<i class='material-icons'>&#xE5CC;</i>"],
		items: 4, //10 items above 1000px browser width
		itemsDesktop : [1200,4], 
		itemsDesktopSmall : [991,3], 
		itemsTablet: [767,2], 
		itemsMobile : [480,1] 
	});
	
	/* ----------- End Carousel Productpage Thumbs ----------- */
	/* -----------Start carousel For TT- brand logo ----------- */
	 var ttbrandlogo = $("#ttbrandlogo-carousel");
		  ttbrandlogo.owlCarousel({
			navigation:true,
			navigationText: [
					"<i class='material-icons'>&#xE5CB;</i>",
					"<i class='material-icons'>&#xE5CC;</i>"],
		  autoPlay : true,
			 items :4, //10 items above 1000px browser width
			 itemsDesktop : [1200,3], 
			 itemsDesktopSmall : [991,3], 
			 itemsTablet: [767,3], 
			 itemsMobile : [480,2] 
		  });
	
	/* -----------End carousel For TT brand logo ----------- */

	/* -----------Start carousel For TT- cms Testimonial ----------- */
 
	 var tttestimonial = $("#tttestimonial-carousel");
      tttestimonial.owlCarousel({
  		 navigation: true,
		 navigationText: [
			"<i class='material-icons'>&#xE5CB;</i>",
			"<i class='material-icons'>&#xE5CC;</i>"],
		 autoPlay:true,
     	 items : 1, //10 items above 1000px browser width
     	 itemsDesktop : [1200,1], 
     	 itemsDesktopSmall : [991,1], 
     	 itemsTablet: [767,1], 
     	 itemsMobile : [480,1] 
      });

/* -----------End carousel For TT- cms Testimonial ----------- */
/* ----------- Start carousel For ttcmsoffers ----------- */

	var ttcmsoffers = $("#ttcmsoffers-carousel");
      ttcmsoffers.owlCarousel({	
		 autoPlay:true,
     	 items : 1, //10 items above 1000px browser width
     	 itemsDesktop : [1200,1], 
     	 itemsDesktopSmall : [991,1], 
     	 itemsTablet: [767,1], 
     	 itemsMobile : [480,1] 
      });
/* ----------- End carousel For ttcmsoffers ----------- */

/* ----------- Start Templatetrip user info ----------- */

$('.ttuserheading').click(function(event){
			$(this).toggleClass('active');
			event.stopPropagation();
			$(".user-info").slideToggle("fast");
		});
		$(".user-info").on("click", function (event) {
			event.stopPropagation();
		});
/* ----------- End Templatetrip user info ----------- */


 /* ----------- Start Templatetrip AddToCart Button ----------- */
 
$( ".tt-button-container .add-to-cart" ).mousedown(function() {
  var form_className = $(this).parent().attr('class');
  $(this).parent().attr('id',form_className);

  var hidden_page_className = $(this).parent().find('.product-quantity .product_page_product_id').attr('class');
  $(this).parent().find('.product-quantity .product_page_product_id').attr('id',hidden_page_className);

  var customization_className = $(this).parent().find('.product-quantity .product_customization_id').attr('class');
  $(this).parent().find('.product-quantity .product_customization_id').attr('id',customization_className);

  var quantity_className = $(this).parent().find('.product-quantity .quantity_wanted').attr('class');
  $(this).parent().find('.product-quantity .quantity_wanted').attr('id',quantity_className);
});

$( ".tt-button-container .add-to-cart" ).mouseup(function() {
  $(this).parent().removeAttr('id');
  $(this).parent().find('.product-quantity > input').removeAttr('id');
});

$('.header-top .position-static #ttcmstopbanners').prependTo('#wrapper');
$('#_mobile_cart').prependTo('.header-top .position-static .row');
$('#_mobile_logo').prependTo('.header-top .position-static .row');


/* ----------- End Templatetrip AddToCart Button ----------- */
	
});	 

/* Start Homepage header JS */

function header() {	
 if (jQuery(window).width() > 1200){
     if (jQuery(this).scrollTop() > 400)
        {    
            jQuery('.header-top').addClass("fixed");
 
    	}else{
      	 jQuery('.header-top').removeClass("fixed");
      	}
    } else {
      jQuery('.header-top').removeClass("fixed");
      }
}
 
$(document).ready(function(){header();});
jQuery(window).resize(function() {header();});
jQuery(window).scroll(function() {header();});

/* End Homepage header JS */
/*--------- Start js for tttop-link-block -------------*/
function accordionMenu(status)
{
	if ($(document).width() <= 991)
	{
		$('.header-top #tttop-link-block ul.block_content li').appendTo('#mobile_top_menu_wrapper ul.top-menu[data-depth="0"]');	
	}
	else if($(document).width() >= 992)	
	{		
		$('#wrapper #_desktop_top_menu ul li.tttoplink').prependTo('.header-top .position-static #tttop-link-block ul.block_content');	
	}
}

$(document).ready(function(){accordionMenu();});
$(window).resize(function(){accordionMenu();});
/*--------- End js for tttop-link-block -------------*/

function bindGrid()
{
	var view = localStorage.getItem('display');
	if (view == 'list')
		display(view);
	else
		$('.display').find('#ttgrid').addClass('active');
	//Grid	
	$(document).on('click', '#ttgrid', function(e){
		e.preventDefault();
		display('grid');
	});
	//List
	$(document).on('click', '#ttlist', function(e){
		e.preventDefault();
		display('list');		
	});	
}

$("#products .product-list .thumbnail-container .ttproduct-image .ttproducthover").each(function(){
    $(this).appendTo($(this).parent().parent().find(".ttproduct-desc"));
});
$("#products .product-grid .thumbnail-container .ttproduct-desc .ttproducthover").each(function(){
    $(this).appendTo($(this).parent().parent().parent().find(".ttproduct-image"));
});
/* -----------Start ttspecial product js ----------- */
 
$(".ttspecial-products .thumbnail-container .ttproducthover").each(function(){
	$(this).appendTo($(this).parent().parent().find(".ttproduct-desc"));
});

/* -----------End ttspecial product js ----------- */
function display(view)
{
	if (view == 'list')
	{
		$('#ttgrid').removeClass('active');
		$('#ttlist').addClass('active');
		$('#content-wrapper .products.product-thumbs .product-miniature').attr('class', 'product-miniature js-product-miniature product-list col-xs-12');
		$('#content-wrapper .products.product-thumbs .product-miniature .ttproduct-image').attr('class', 'ttproduct-image col-xs-5 col-sm-5 col-md-3');
		$('#content-wrapper .products.product-thumbs .product-miniature .ttproduct-desc').attr('class', 'ttproduct-desc col-xs-7 col-sm-7 col-md-9');
		$("#products .product-list .thumbnail-container .ttproduct-image .ttproducthover").each(function(){
			$(this).appendTo($(this).parent().parent().find(".ttproduct-desc"));
		});

		$('#ttlist').addClass('active');
		$('.grid-list').find('#ttlist').addClass('selected');
		$('.grid-list').find('#ttgrid').removeAttr('class');
		localStorage.setItem('display', 'list');
	}
	else
	{
		$('#ttlist').removeClass('active');
		$('#ttgrid').addClass('active');

		var cols_count = $('#right-column, #left-column').length;
		if (cols_count == 2) {
			$('#js-product-list .products.product-thumbs .product-miniature').attr('class', 'product-miniature js-product-miniature product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
		} else if (cols_count == 1) {
			$('#js-product-list .products.product-thumbs .product-miniature').attr('class', 'product-miniature js-product-miniature product-grid col-lg-3 col-md-4 col-sm-6 col-xs-12');
		} else {
			$('#js-product-list .products.product-thumbs .product-miniature').attr('class', 'product-miniature js-product-miniature product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
		}
		$("#products .product-grid .thumbnail-container .ttproduct-desc .ttproducthover").each(function(){
			$(this).appendTo($(this).parent().parent().parent().find(".ttproduct-image"));
		});

		$('#content-wrapper .products.product-thumbs .product-miniature .ttproduct-image').attr('class', 'ttproduct-image');
		$('#content-wrapper .products.product-thumbs .product-miniature .ttproduct-desc').attr('class', 'ttproduct-desc');
		
		$('.grid-list').find('#ttgrid').addClass('selected');
		$('.grid-list').find('#ttlist').removeAttr('class');
		localStorage.setItem('display', 'grid');
	}
}
$(document).ready(function(){
	bindGrid();
});


/* ------------ End Grid List JS --------------- */


