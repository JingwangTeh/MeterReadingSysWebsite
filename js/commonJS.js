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
	
	$('#pizzaMenu, #pizzaMenu div, #pizzaMenu img, #pizzaMenuExpanded').click(function(e) {
	   e.stopPropagation();
	});
});

$(document).ready(function () {
	var className = 'active_nav', // class that highlights nav
		elementGroup = 'header nav a';
	
	// on PAGE LOAD, toggle to add class to element (highlights specified header NAV element based on className) 
    if (window.location.hash == '#features') {
		__toggleClass.call(document.getElementById('nav_features'), className, elementGroup);
	} else if (window.location.hash == '#project') {
		__toggleClass.call(document.getElementById('nav_projects'), className, elementGroup);
	} else if (window.location.hash == '#issues') {
		__toggleClass.call(document.getElementById('nav_issues'), className, elementGroup);
	} else if (window.location.hash == '#clients') {
		__toggleClass.call(document.getElementById('nav_clients'), className, elementGroup);
	} else if (window.location.hash == '#team') {
		__toggleClass.call(document.getElementById('nav_team'), className, elementGroup);
	} else if (window.location.hash == '#about') {
		__toggleClass.call(document.getElementById('nav_about'), className, elementGroup);
	} else if (window.location.hash == '#contact') {		
		__toggleClass.call(document.getElementById('nav_contact'), className, elementGroup);
	}
});



function highlightNav () {
	__toggleClass.call(this, 'active_nav', 'header nav a');
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

function togglePizzaMenu () {
	var pizzaMenuExpanded = document.getElementById("pizzaMenuExpanded");

	if (window.getComputedStyle(pizzaMenuExpanded).display == "none") {
		pizzaMenuExpanded.style.display = "block";
		$('#pizzaMenuExpanded').animate({
			'width' : '200px'
		}, {
			duration: 150,
			specialEasing: {
				width: 'swing'
			}
		});
	} else {
		$('#pizzaMenuExpanded').animate({
			'width' : '0px'
		}, 150, 'swing', function () {
			pizzaMenuExpanded.style.display = "none";	
		});
	}
}

$(document).click(function(e) {
	if (window.getComputedStyle(pizzaMenuExpanded).display != "none") {
		$('#pizzaMenuExpanded').animate({
				'width' : '0px'
		}, 150, 'swing', function () {
			pizzaMenuExpanded.style.display = "none";	
		});
	}
});


$(window).on('resize', function () {
	if(window.innerWidth > 1080) {
		$('#pizzaMenuExpanded').animate({
			'width' : '0px'
		}, 150, 'swing', function () {
			pizzaMenuExpanded.style.display = "none";	
		});
	}
});




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
		
		$('#pizzaMenuExpanded').css({
			'background-color'	: 'rgba(0, 88, 98, 1)',
			'padding-top'	: '50px'
		});
	}
	else if ( (scrollPos == 0) ){
		$('header').css({
			'background-color'	: 'rgba(0, 88, 98, 1)',
			'height'		: '75px'
		});
		
		$('#pizzaMenuExpanded').css({
			'background-color'	: 'rgba(0, 88, 98, 1)',
			'padding-top'	: '75px'
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