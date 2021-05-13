

function resize() {

	//set col to be same height
    if($('.four-column .listing-item').length > 0) {
        var maxHeight = 0;
        $(".four-column .listing-item").each(function() {
            $(".four-column .listing-item").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
	  //set col to be same height
    if($('.four-column .one-column').length > 0) {
        var maxHeight = 0;
        $(".four-column .one-column").each(function() {
            $(".four-column .one-column").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
    //set col to be same height
    if($('.two-column .listing-item').length > 0) {
        var maxHeight = 0;
        $(".two-column .listing-item").each(function() {
            $(".two-column .listing-item").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
 //set col to be same height
    if($('.three-column .listing-item').length > 0) {
        var maxHeight = 0;
        $(".three-column .listing-item").each(function() {
            $(".three-column .listing-item").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
     //set col to be same height
    if($('.three-blocks .listing-item').length > 0) {
        var maxHeight = 0;
        $(".three-blocks .listing-item").each(function() {
            $(".three-blocks .listing-item").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
     //set col to be same height
    if($('.second-three-column .listing-item').length > 0) {
        var maxHeight = 0;
        $(".second-three-column .listing-item").each(function() {
            $(".second-three-column .listing-item").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
    
     //set col to be same height
    if($('.module-50-50 .module').length > 0) {
        var maxHeight = 0;
        $(".module-50-50 .module").each(function() {
            $(".module-50-50 .module").css('height','auto');
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight();
            }
        }).height(maxHeight);
    }
   
}


$(window).on("resize touchstart touchmove touchend", resize); 
$(window).on("orientationchange", function(){ setTimeout(resize, 150);});
resize();


$(document).ready(function() {

$( "#gform_wrapper_3" ).show();
		
		var youtube = document.getElementById("yt_vid");
		var playVideo = document.getElementById("playvideo");
		var vidWindow = document.getElementsByClassName("video");
		var player = document.getElementById('player');

		$(playVideo).hide();
		$(youtube).click(function(){

    	$(youtube).hide();
    	$(playVideo).show();
    	$(player).api('play');
    	$(vidWindow).height("auto");
  			});

		var arrow = document.getElementsByClassName("arrow");
		var i;
		for (i = 0; i < arrow.length; i++) {
		  arrow[i].addEventListener("click", function() {
		  	this.classList.toggle("active");
		    var subMenu = this.nextElementSibling;
  			subMenu.classList.add("menu-opened");
  			//alterheight("menu-opened");

		  });
		}
		var subPrevious = document.getElementsByClassName("sub-previous");
		var n;
			
		for (n = 0; n < subPrevious.length; n++) {
		  subPrevious[n].addEventListener("click", function() {
		  	//this.classList.toggle("active");
		    var subMenu = this.parentElement;
  			subMenu.classList.remove("menu-opened");
  			// $("div.menu-opened").parentsUntil("div.mobile-menu").remove("menu-opened");
  
		  });
		}
		var subSubPrevious = document.getElementsByClassName("sub-sub-previous");
		var w;
			
		for (w = 0; w < subSubPrevious.length; w++) {
		  subSubPrevious[w].addEventListener("click", function() {
		  	this.classList.toggle("active");
		    var subMenu = this.parentElement;
  			subMenu.classList.remove("menu-opened");
  
		  });
		}
		var subSubSubPrevious = document.getElementsByClassName("sub-sub-sub-previous");
		var x;
			
		for (x = 0; x < subSubSubPrevious.length; x++) {
		  subSubSubPrevious[x].addEventListener("click", function() {
		  	this.classList.toggle("active");
		    var subMenu = this.parentElement;
  			subMenu.classList.remove("menu-opened");
  
		  });
		}
	var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
		  acc[i].addEventListener("click", function() {
			/* Toggle between adding and removing the "active" class,
			to highlight the button that controls the panel */
			this.classList.toggle("active");

			/* Toggle between hiding and showing the active panel */
			var panel = this.nextElementSibling;
			if (panel.style.display === "block") {
			  panel.style.display = "none";
			//alterheight("accordion");
			} else {
			  panel.style.display = "block";
				//alterheight("accordion");
			}
		  });
		}

	function alterheight(classname) {
		if (classname) {
		  var maxHeight = -1;
		  $('.' + classname).each(function() {
		    maxHeight = ( maxHeight > $(this).height() ) ? maxHeight : $(this).height();
		    minHeight = maxHeight + 5;
		  });
		  $('.' + classname).each(function() {
		    $(this).css('min-height',minHeight);
		  });
		}
	}
	//toggle mobile nav
	$('.hamburger-nav').click(function() {
		if ($(this).hasClass('closed')) {
		  $("html").addClass('no-scroll-mobile');
		  $('.mobile-menu').addClass('mobile-opened');
		 
		}
		else {
		  $("html").removeClass('no-scroll-mobile');
		}
		$('.brand-nav').removeClass("hide");
		$('.open-brand-nav').addClass("closed");
		$('.open-brand-nav').removeClass("opened");
		$('.brand-nav-mobile').removeClass('nav-opened');
		$('.mobile-nav').toggleClass('nav-opened');
		$('.hamburger-nav').toggleClass('nav-opened');
		$('.hamburger-nav').toggleClass('closed');
		$('#header .drop-shadow').toggleClass('hide');
		$('.immediate-help-modal').removeClass('menu-opened');
		$("html").removeClass('no-scroll');
	});
	
	//toggle dropdown nav
	$('.dropdown').mouseenter(function() {
		$(this).addClass("active");
		$(this).removeClass("inactive");
		$('.dropdown').not($(this)).removeClass("active");
		$('.dropdown').not($(this)).addClass("inactive");
		$('.main-menu').addClass('menu-opened');
	});
	$('.dropdown').mouseleave(function() {
		$(this).removeClass("active");
		$('.dropdown').not($(this)).removeClass("inactive");
		$('.main-menu').removeClass('menu-opened');
		$('.sub-menu').removeClass('menu-opened');
		$('.sub-sub-menu').removeClass('menu-opened');
	});
	//toggle immediate help modal
	$('.help').click(function() {
		$('.immediate-help-modal').addClass('menu-opened');
	});
	$('.immediate-help-alt').click(function() {
		$('.immediate-help-modal').addClass('menu-opened');
	});
	$('.primary-nav .help').click(function() {
		$("html").addClass('no-scroll');
		$('.brand-nav').addClass("hide");
		$('#header .primary-nav').addClass('modal-opened');
	});
	$('.mobile-nav .help').click(function() {
		$('.brand-nav').addClass("hide");
		$('.mobile-nav').removeClass('nav-opened');
		$('.hamburger-nav').removeClass('nav-opened');
		$('.hamburger-nav').addClass('closed');
		$('#header .drop-shadow').toggleClass('hide');
		$("html").addClass('no-scroll');
	});
	$('.immediate-help-modal .exit').click(function() {
		$('.brand-nav').removeClass("hide");
		//$('#brand-site #header .primary-nav.drop-shadow').removeClass("show");
		$('.immediate-help-modal').removeClass('menu-opened');
		$('#header .primary-nav').removeClass('modal-opened');
		$("html").removeClass('no-scroll');
		$("html").removeClass('no-scroll-mobile');
	});
	
	//pagination page select
	$('.pagination-block .page').click(function() {
		$('.pagination-block .page').addClass('active');
		$('.pagination-block .page').not($(this)).removeClass("active");
	});
	
	//toggle mobile brand nav
	$('.open-brand-nav').click(function() {
		if ($(this).hasClass('closed')) {
		  $(this).addClass("opened");
		  $(this).removeClass("closed");
		}
		else {
		  $(this).removeClass("opened");
		  $(this).addClass("closed");
		}
		$('.brand-nav-mobile').toggleClass('nav-opened');
		$("html").toggleClass('no-scroll-mobile');
	});
	
	//brand-nav becomes sticky after scroll
	var height = window.innerHeight;
	$(window).scroll(function(){
		if($('.no-scroll-mobile').length == 0){ 
			var width = window.innerWidth;
			var scroll = $(window).scrollTop();
			if (scroll > 450) {
				$('.brand-nav').addClass('nav-sticky').removeClass('nav-unsticky');
				$('#brand-site #header').addClass('brand-nav-added');
			}
			if (scroll < 450) {
		        $('.brand-nav').removeClass('nav-sticky');
		        $('#brand-site #header').removeClass('brand-nav-added');
		        $('.brand-nav').removeClass('nav-down');
			}
		}
	});
	
	/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
	var prevScrollpos = window.pageYOffset;
	$(window).scroll(function(){
		if($('.no-scroll-mobile').length == 0){ 
		  var currentScrollPos = window.pageYOffset;
		  if (prevScrollpos > currentScrollPos) {
		    $('#brand-site #header.brand-nav-added').removeClass('nav-up');
		    $('.brand-nav.nav-sticky').addClass('nav-down');
		  } else {
		    $('#brand-site #header.brand-nav-added').addClass('nav-up');
		    $('.brand-nav.nav-sticky').removeClass('nav-down');
		  }
		  prevScrollpos = currentScrollPos;
		}
		else if($('.no-scroll-mobile').length > 0 && $('.nav-down').length > 0){ 
		  var currentScrollPos = window.pageYOffset;
		  if (prevScrollpos > currentScrollPos) {
		    $('#brand-site #header.brand-nav-added').addClass('nav-up');
		    $('.brand-nav.nav-sticky').removeClass('nav-down');
		  } else {
		    $('#brand-site #header.brand-nav-added').removeClass('nav-up');
		    $('.brand-nav.nav-sticky').addClass('nav-down');
		  }
		  prevScrollpos = currentScrollPos;
		}
	});		
    
    //var root_url = document.body.getAttribute("data-root");
    //if (null == root_url) {
  	//  var root_url = 'https://www.mhamd.org';
    //}

    // sliders
    $('.featured.slider').slick({
	  dots: true,
	  infinite: true,
	  slide: '.slide',
	  arrows:true,
	  prevArrow: '<div class="prev"></div>',
	  nextArrow: '<div class="next"></div>'
	});
	$('.listing-block .slider').slick({
	  dots:true,
	  centerMode: true,
	  centerPadding: '52px',
      slidesToShow: 1,
	  infinite: true,
	  slide: '.listing-item',
	  arrows:true,
	  prevArrow: '<div class="prev"></div>',
	  nextArrow: '<div class="next"></div>'
	});
	
	// make each slide the same height
	//var stHeight = $('.listing-block.gray-bg .slider .slick-track').height();
	//$('.listing-block.gray-bg .slider .slick-slide .content').css('height',stHeight - 80 + 'px');
	//var stHeight2 = $('.listing-block.white-bg .slider .slick-track').height();
	//$('.listing-block.white-bg .slider .slick-slide .content').css('height',stHeight2 - 80 + 'px');
	
	// form select box
	var x, i, j, selElmnt, a, b, c;
	/* Look for any elements with the class "custom-select": */
	x = document.getElementsByClassName("custom-select");
	for (i = 0; i < x.length; i++) {
	  selElmnt = x[i].getElementsByTagName("select")[0];
	  /* For each element, create a new DIV that will act as the selected item: */
	  a = document.createElement("DIV");
	  a.setAttribute("class", "select-selected");
	  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
	  x[i].appendChild(a);
	  /* For each element, create a new DIV that will contain the option list: */
	  b = document.createElement("DIV");
	  b.setAttribute("class", "select-items select-hide");
	  for (j = 1; j < selElmnt.length; j++) {
	    /* For each option in the original select element,
	    create a new DIV that will act as an option item: */
	    c = document.createElement("DIV");
	    c.innerHTML = selElmnt.options[j].innerHTML;
	    c.addEventListener("click", function(e) {
	        /* When an item is clicked, update the original select box,
	        and the selected item: */
	        var y, i, k, s, h;
	        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
	        h = this.parentNode.previousSibling;
	        for (i = 0; i < s.length; i++) {
	          if (s.options[i].innerHTML == this.innerHTML) {
	            s.selectedIndex = i;
	            h.innerHTML = this.innerHTML;
	            y = this.parentNode.getElementsByClassName("same-as-selected");
	            for (k = 0; k < y.length; k++) {
	              y[k].removeAttribute("class");
	            }
	            this.setAttribute("class", "same-as-selected");
	            break;
	          }
	        }
	        h.click();
	    });
	    b.appendChild(c);
	  }
	  x[i].appendChild(b);
	  a.addEventListener("click", function(e) {
	    /* When the select box is clicked, close any other select boxes,
	    and open/close the current select box: */
	    e.stopPropagation();
	    closeAllSelect(this);
	    this.nextSibling.classList.toggle("select-hide");
	    this.classList.toggle("select-arrow-active");
	  });
	}
	
	function closeAllSelect(elmnt) {
	  /* A function that will close all select boxes in the document,
	  except the current select box: */
	  var x, y, i, arrNo = [];
	  x = document.getElementsByClassName("select-items");
	  y = document.getElementsByClassName("select-selected");
	  for (i = 0; i < y.length; i++) {
	    if (elmnt == y[i]) {
	      arrNo.push(i)
	    } else {
	      y[i].classList.remove("select-arrow-active");
	    }
	  }
	  for (i = 0; i < x.length; i++) {
	    if (arrNo.indexOf(i)) {
	      x[i].classList.add("select-hide");
	    }
	  }
	}
	
	/* If the user clicks anywhere outside the select box,
	then close all select boxes: */
	document.addEventListener("click", closeAllSelect);
//(jQuery); // end jQuery
});//(document).ready

