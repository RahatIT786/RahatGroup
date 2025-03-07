(function($) {
    "use strict";
  	
	/*----------------------------------------------------*/
    /*  header scroll js
    /*----------------------------------------------------*/
	var header = $(".header");
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		if(scroll > 120) {
			header.addClass("sticky");
		} else {
			header.removeClass("sticky");
		}
	});
 
	/*----------------------------------------------------*/
    /*  mobile menu dropdown js
    /*----------------------------------------------------*/    
    $(".navbar-toggler").on('click', function() {
        $(this).toggleClass("active");
    });
    
    var subMenu = $('.sub-menu-bar .navbar-nav .sub-menu');
    
    if(subMenu.length) {
        subMenu.parent('li').children('a').append(function () {
            return '<button class="sub-nav-toggler"> <i class="fa fa-chevron-down"></i> </button>';
        });
        
        var subMenuToggler = $('.sub-menu-bar .navbar-nav .sub-nav-toggler');
        
        subMenuToggler.on('click', function() {
            $(this).parent().parent().children('.sub-menu').slideToggle();
            return false
        });
        
    }
	
	var megasubMenu = $('.sub-menu-bar .navbar-nav .mega-menu-submenu');
    
    if(megasubMenu.length) {
        megasubMenu.parent('li').children('a').append(function () {
            return '<button class="mega-sub-nav-toggler"> <i class="fa fa-chevron-down"></i> </button>';
        });
        
        var megasubMenuToggler = $('.sub-menu-bar .navbar-nav .mega-sub-nav-toggler');
        
        megasubMenuToggler.on('click', function() {
            $(this).parent().parent().children('.mega-menu-submenu').slideToggle();
            $(this).parent().parent().children('.mega-menu-submenu').css('opacity','1');
            $(this).parent().parent().children('.mega-menu-submenu').css('visibility','visible');
            return false
        });
        
    }
	
	var subsubMenu = $('.sub-menu-bar .navbar-nav .subsub-menu');
    
    if(subsubMenu.length) {
        subsubMenu.parent('li').children('a').append(function () {
            return '<button class="subsub-nav-toggler"> <i class="fa fa-chevron-down"></i> </button>';
        });
        
        var subsubMenuToggler = $('.sub-menu-bar .navbar-nav .subsub-nav-toggler');
        
        subsubMenuToggler.on('click', function() {
            $(this).parent().parent().children('.subsub-menu').slideToggle();
            return false
        });
        
    }
	
	/*---------------------------------------------------
	tooltips
	----------------------------------------------------- */
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	$("body").tooltip({selector: "[data-tooltip=\'tooltip\']",container: "body",trigger: "hover"});
	
	/*---------------------------------------------------
	popover
	----------------------------------------------------- */
	$('[data-toggle="popover"]').popover()
	
	/*----------------------------------------------------*/
    /*  bootstrap validation js
    /*----------------------------------------------------*/
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		  form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			  event.preventDefault();
			  event.stopPropagation();
			}
			form.classList.add('was-validated');
		  }, false);
		});
	}, false);
	
	/*----------------------------------------------------*/
    /*  four-item-slider
    /*----------------------------------------------------*/
	$('.four-item-slider').slick({
		infinite: true,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  autoplay: true,
	  arrows: false,
	  dots: true,
	  autoplaySpeed: 5000,
	  responsive: [
		{
		  breakpoint: 980,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			infinite: true,
		  }
		},
		{
		  breakpoint: 768,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 520,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 420,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 360,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
	  ]
	}); 
	
	$('.package-slider').slick({
		infinite: true,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  autoplay: true,
	  arrows: true,
	  dots: false,
	  autoplaySpeed: 5000,
	  responsive: [
		{
		  breakpoint: 980,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			infinite: true,
		  }
		},
		{
		  breakpoint: 768,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 520,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 420,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 360,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		}
	  ]
	}); 
	
	/*----------------------------------------------------*/
    /*  testimonial slider
    /*----------------------------------------------------*/
	$('.testimonial-slider').slick({
		infinite: true,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  autoplay: true,
	   arrows: true,
	  dots: false,
	  autoplaySpeed: 5000,
	  responsive: [
		{
		  breakpoint: 980,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			infinite: true,
		  }
		},
		{
		  breakpoint: 768,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 520,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 420,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		},
		{
		  breakpoint: 360,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
		  }
		}
	  ]
	}); 
})(jQuery);

function numbersonly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode 
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if (unicode<48||unicode>57 ) //if not a number 
		return false //disable key press 
	}
};