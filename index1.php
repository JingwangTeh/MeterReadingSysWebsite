<!DOCTYPE HTML>
<html>
<head>

<!-- Common Meta & Fav-ico, 
	 Libraries (w3.css, bootstrap, jQuery, jQueryUI), 
	 Common CSS (reset, loader, layout)
	 Common JS (note: Priority before Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonTop.php'; ?>
	<?php include 'phpCommons/layoutCommonTop.php'; ?>
	
<!-- Page CSS -->

	<!-- Content Wrapper -->
	<!--<link rel="stylesheet" type="text/css" href="/css/content1.css" />-->
	<link rel="stylesheet" type="text/css" href="css/content1.css" />
	<!-- Misc -->
	<!--<link rel="stylesheet" type="text/css" href="/css/style.css" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- TITLE -->
	<title>Snappy : Index1</title>

<!-- Internal JavaScript -->

	<script>
	
		window.addEventListener("load", function(){
			showDivs();
			slider_total_slides = document.getElementById("philosophy-slider").children.length;
		});
			
		var slideIndex = 1;
		var slider_total_slides;
		
		function plusDivs(n) {
			slideIndex += n;
			if (slideIndex > slider_total_slides) slideIndex = 1;
			if (slideIndex < 1) slideIndex = slider_total_slides;
			showDivs(slideIndex);
		}
		function currentDiv(n) {
			showDivs(slideIndex = n);
		}

		function showDivs(target = 1){			
			var slider = document.getElementById("philosophy-slider");
			
			var slider_div = slider.children;
			var slide_width = slider_div[0].clientWidth;
			
			// range of 1 to slider_total_slides
			if (target > slider_total_slides) target = 1;
			if (target < 1) target = slider_total_slides;
			
			$('.mySlides').css({
				'display' : 'none'
			});
			
			slider_div[target-1].style.display = "-webkit-flex";
			slider_div[target-1].style.display = "flex";
			
			updateDots();
		}
		
		function updateDots(){
			var dots = document.getElementsByClassName("demo");
			
			var i;
			var dots_length = dots.length;
			for (i = 0; i < dots_length; i++) {
				dots[i].className = dots[i].className.replace(" w3-badge-sd-color", "");
			}
			dots[slideIndex-1].className += " w3-badge-sd-color";
		}
		
	</script>
	
	

</head>
<body id="home">

<!-- Page Loader -->
<div id="loading-screen"><div id="loader"></div></div>



<!-- --------------------Page Wrapper-------------------- -->
<!--<div id="page-wrapper" class="animate-bottom">-->
<div id="page-wrapper">
	<!-- HEADER -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutHeader_diffPage.php'; ?>
	<?php include 'phpCommons/layoutHeader_diffPage.php'; ?>


	
	
	
	<!-- CONTENT -->
	<section id="content">
	
		<!-- Group Name -->
		<div id="group">
			<div>
				<!--<a href="/"><img src="/img/logo.png" alt="logo" /></a>-->
				<a href="/"><img src="img/logo.png" alt="logo" /></a>
				<h1>TEAM SNAPPY</h1>
			</div>
		</div>
		
		<!-- Philosophy -->
		<div id="philosophy">
			<h1>OUR PHILOSOPHY</h1>
			<div id="philosophy-container" class="w3-content w3-display-container">
				<div id="philosophy-slider">
					<div class="mySlides">			
						<h2>VISION</h2>
						<p>
							Striving to create innovative ideas for everyday scenarios.
						</p>
					</div>
					<div class="mySlides">			
						<h2>MISSION</h2>
						<p>
							We at SmartMeter seek to improve and streamline business processes through innovative solutions. We strive to achieve a satisfying solution for all parties involved.
						</p>
					</div>
					<div class="mySlides">			
						<h2>GOAL</h2>
						<p>
							Our goal is to provide an innovative solution to energy companies in an effort to reduce operational cost of meter reading by achieving high efficiency in utility meter reading processes through our smartphone meter reading application without the reliance on unwanted Smart Meter technology.
						</p>
					</div>
				</div>
				
				<div class="w3-center w3-display-topmiddle" style="width:100%">
					<span class="w3-badge demo" onclick="currentDiv(1)"></span>
					<span class="w3-badge demo" onclick="currentDiv(2)"></span>
					<span class="w3-badge demo" onclick="currentDiv(3)"></span>
				</div>
			</div>
		</div>
		
		<!-- Design Methodology -->
		<div id="methodology">
			<h1>DESIGN METHODOLOGY</h1>
			<div>
				<img src="img/design_methodology/agile_life_cycle.png" alt="Agile_Life_Cycle"/>
				<div>
					<div>
						<p><h2>Product Backlog</h2>
							<ul><li>
								This is the list of requirements that we will implement incrementally based on its priority, 
								from the critical must-haves, to the optional stretch goals. 
								We have obtained the items for the product catalogue through the use of prototypes and getting feedback based on it.
							</li></ul>
						</p>
						<p><h2>Sprint</h2>
							<ul><li>
								This is the phase where a set of requirements are to be implemented. 
								We have allocated a duration of 1 month for each sprint, and within each sprint, 
								there will be prototype implementations, client feedback, design corrections, 
								and testing to be done. Sprint Planning is done at the start of each sprint during our weekly group meeting on Friday.
							</li></ul>
						</p>
						<p><h2>Weekly Stand-up</h2>
							<ul><li>
								Group meetings are held every Friday after meeting with client. 
								This lets our team distribute work, check up on each person’s work done as well as the work that they are going to be doing, 
								and look into problems that they are facing.
							</li></ul>
						</p>
					</div>
					<div>
						<p><h2>End-of-Sprint Review</h2>
							<ul><li>
								At the end of the sprint, our team will provide the sprint deliverable to our client for review.
							</li></ul>
						</p>
						<p><h2>Sprint Retrospective</h2>
							<ul><li>
								For the final part of the sprint, we would identify the things that went well, 
								and things that we need to improve on before starting the next sprint.
							</li></ul>
						</p>
						<p><h2>Scrum Master and the Scrum Team</h2>
							<ul>
								<li>
									Vishal Mishra is our group leader, and hence our scrum master, 
									throughout all the sprints who will be in charge of the sprint planning, 
									the sprint burndown graph, and to ensure that the project goes smoothly.
								</li>
								<li>
									The rest of the members in our team is the scrum team.
								</li>
							</ul>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Development Environment -->
		<div id="dev_environment">
			<h1>DEVELOPMENT ENVIRONMENT</h1>
			<div>
				<div>
					<h2>MOBILE</h2>
					<div id="mobile_env">
						<div>
							<div>
								<p>
									Android Studio<br/>
									<br/>
									Official Integrated Development Environment for Android
								</p>
							</div>
							<div>
								<!--<img src="/img/dev_env/android_studio.png" alt="Android_Studio"/>-->
								<img src="img/dev_env/android_studio.png" alt="Android_Studio"/>
							</div>
						</div>
						<div>
							<div>
								<!--<img src="/img/dev_env/appInventor.png" alt="MIT_App_Inventor"/>-->
								<img src="img/dev_env/appInventor.png" alt="MIT_App_Inventor"/>
							</div>
							<div>
								<p>
									MIT App Inventor<br/>
									<br/>
									Assists via visual drag and drop building blocks
								</p>
							</div>
						</div>
						<div>
							<div>
								<p>
									Adobe AIR<br/>
									<br/>
									Cross platform runtime system for building desktop and mobile applications
								</p>
							</div>
							<div>
								<!--<img src="/img/dev_env/Adobe AIR.png" alt="Adobe_AIR"/>-->
								<img src="img/dev_env/Adobe AIR.png" alt="Adobe_AIR"/>
							</div>
						</div>
					</div>
				</div>
				<div>
					<h2>WEBSITE</h2>
					<div id="website_env">
						<div>
							<div>
								<p>
									XAMPP<br/>
									<br/>
									Open Source Bundle consisting of Apache, MySQL Server, and PHP
								</p>
							</div>
							<div>
								<!--<img src="/img/dev_env/xampp.png" alt="Xampp"/>-->
								<img src="img/dev_env/xampp.png" alt="Xampp"/>
							</div>
						</div>
						<div>
							<div>
								<!--<img src="/img/dev_env/apache.png" alt="Apache"/>-->
								<img src="img/dev_env/apache.png" alt="Apache"/>
							</div>
							<div>
								<p>
									Apache Web Server<br/>
									<br/>
									Web Server for serving PHP-based webpages
								</p>
							</div>
						</div>
						<div>
							<div>
								<p>
									CakePHP<br/>
									<br/>
									Rapid Development Framework using model view controller approach
								</p>
							</div>
							<div>
								<!--<img src="/img/dev_env/cakephp.png" alt="CakePHP"/>-->
								<img src="img/dev_env/cakephp.png" alt="CakePHP"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
	</section>
	
	
	
	
	<!-- FOOTER -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutFooter_samePage.php'; ?>
	<?php include 'phpCommons/layoutFooter_samePage.php'; ?>
</div>
<!-- --------------------End Page-------------------- -->



<!-- Common JS (note: After Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonBottom.php'; ?>
	<?php include 'phpCommons/layoutCommonBottom.php'; ?>
	
<!-- Internal JavaScript -->

	<script>
		setInterval("plusDivs(1)", 5000);
	</script>
	
</body>
</html>