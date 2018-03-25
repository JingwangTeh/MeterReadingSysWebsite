window.addEventListener("load", function(){
	var loading_screen = document.getElementById("loading-screen");
	var page_wrapper = document.getElementById("page-wrapper");
	
	// remove loading screen
	if(loading_screen) {
		loading_screen.style.display = "none";
		loading_screen.style.zIndex = -1000;
	}
	// display page content
	if(page_wrapper) {
		page_wrapper.style.zIndex = 1;
	}
	
});



function showMeterChart (targetElementId) {
	var targetElement = document.getElementById(targetElementId);
	if (targetElement) {
		__toggleClass.call(targetElement, 'meterWrapperDisplay', '.meterWrapper');
	}
}

function __toggleClass(className, elementGroup) {
	if(this !== window) {
		$(elementGroup).removeClass(className);
		$(this).addClass(className);
	}
	else {
		$(elementGroup).removeClass(className);
	}
}



$(document).ready(function(){
	var root = $('html, body');

	/* On load, prevent link from going straight to target element by resetting window position to top */
	// to top right away
	scroll(0,0);
	// void some browsers issue
	setTimeout( function() { scroll(0,0); }, 1);

	// time delay for items to be loaded
	setTimeout(function() {
		if(window.location.hash) {
			/* On page reload, send back to top again */
			//scroll(0,0);
			//setTimeout( function() { scroll(0,0); }, 1);
			
			// check if element exists with that hash
			if ($(window.location.hash).offset()) {
				// smooth scroll to the anchor id
				root.animate({
					scrollTop: ($(window.location.hash).offset().top - 50) + 'px'
				}, 1000, 'swing');
			}
		}
	}, 500);
	
	
	/* Animate scroll on # href */
	$('a[href^="#"]').on('click',function (e) {
		e.preventDefault();
		 
		var target = this.hash,		// this.hash is anchor href url#hash
			$target = $(target);	// target element

	    root.animate({
	        'scrollTop': ($target.offset().top - 50)	// offset 50px (height of header)
	    }, 900, 'swing', function () {
//			window.location.hash = target;	// update url
			if(history.pushState) {
				history.pushState(null, null, target);
			}
			else {
				location.hash = target;
			}
	    });
	});
});


$(window).scroll(function() {
	var scrollPos = $(this).scrollTop();
	
	// change header bg-color & height when scrolling
	if ( (scrollPos > 1) ){
		$('header').css({
			'background-color'	: 'rgba(0, 88, 98, 1)',
			'height'		: '50px'
		});
	}
	else if ( (scrollPos == 0) ){
		$('header').css({
			'background-color'	: 'rgba(0, 88, 98, 1)',
			'height'		: '75px'
		});
	}
	
	// display backToTop
	if (scrollPos > ( $(document).height() -  $(window).height() - $('footer').height() - 100)){
		$('.backToTop').css({
			'display'		: 'block'
		});
	}
	else {
		$('.backToTop').css({
			'display'		: 'none'
		});
	}
});