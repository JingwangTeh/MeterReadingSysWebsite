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
	<!--<link rel="stylesheet" type="text/css" href="/css/content.css" />-->
	<link rel="stylesheet" type="text/css" href="css/content.css" />
	<!-- Misc -->
	<!--<link rel="stylesheet" type="text/css" href="/css/style.css" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- TITLE -->
	<title>Snappy : Index</title>

<!-- Internal JavaScript -->

	<script>
	
		window.addEventListener("load", function(){
			showDivs();
			showScreenshots();
			slider_total_slides = document.getElementById("slider").children[0].children.length;
			screenshot_total_slides = document.getElementById("feature-screenshot-slider").children.length;
		});
		
		var slideIndex = 1;
		var screenshotIndex = 1;
		var slider_total_slides;
		var screenshot_total_slides;
		
		function plusDivs(n) {
			slideIndex += n;
			if (slideIndex > slider_total_slides) slideIndex = 1;
			if (slideIndex < 1) slideIndex = slider_total_slides;
			showDivs(slideIndex);
		}
		function plusScreenshot(n) {
			screenshotIndex += n;
			if (screenshotIndex > screenshot_total_slides) screenshotIndex = 1;
			if (screenshotIndex < 1) screenshotIndex = screenshot_total_slides;
			showScreenshots(screenshotIndex);
		}
		function currentDiv(n) {
			showDivs(slideIndex = n);
		}
		function currentScreenshot(n) {
			showScreenshots(screenshotIndex = n);
		}

		function showDivs(target = 1){
			var slider = document.getElementById("slider");
			var slider_ul = slider.children[0];
			
			var slider_li = slider_ul.children;
			//var slider_total_slides = slider_li.length;
			var slide_width = slider_li[0].clientWidth;
			
			// range of 1 to slider_total_slides
			if (target > slider_total_slides) target = 1;
			if (target < 1) target = slider_total_slides;
			
			slider_ul.style.left = "-" + ((target - 1) * slide_width) + "px";
			
			updateDots("team-navcircle");
		}
		function showScreenshots(target = 1){			
			var slider = document.getElementById("feature-screenshot-slider");
			
			var slider_div = slider.children;
			var slide_width = slider_div[0].clientWidth;
			
			// range of 1 to screenshot_total_slides
			if (target > screenshot_total_slides) target = 1;
			if (target < 1) target = screenshot_total_slides;
			
			$('.feature-screenshot-slides').css({
				'display' : 'none'
			});
			
			slider_div[target-1].style.display = "-webkit-flex";
			slider_div[target-1].style.display = "flex";
			
			updateScreenshotDots("screenshot-navcircle");
		}
		
		function updateDots(navcircle_className){
			var dots = document.getElementsByClassName(navcircle_className);
			
			var i;
			var dots_length = dots.length;
			for (i = 0; i < dots_length; i++) {
				dots[i].className = dots[i].className.replace(" w3-badge-sd-color", "");
			}
			dots[slideIndex-1].className += " w3-badge-sd-color";
		}
		function updateScreenshotDots(navcircle_className){
			var dots = document.getElementsByClassName(navcircle_className);
			
			var i;
			var dots_length = dots.length;
			for (i = 0; i < dots_length; i++) {
				dots[i].className = dots[i].className.replace(" w3-badge-sd-color", "");
			}
			dots[screenshotIndex-1].className += " w3-badge-sd-color";
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
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutHeader_samePage.php'; ?>
	<?php include 'phpCommons/layoutHeader_samePage.php'; ?>



	
	
	
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
	
		<!-- Feature -->
		<div id="features">
			<h1>SnapMeter</h1>
			
			<div>
				<!-- Left Feature -->
				<div>
					<div>
						<!--<img src="/img/feature/meter.png" alt="screenshot"/><br/>-->
						<img src="img/feature/meter.png" alt="screenshot"/><br/>
						<h2>METER READING</h2>
						<br/>
						<p>
							SnapMeter is able to scan analog, digital and heat meters to extract its readings through the use of visual processing optical character recognition libraries.
						</p>
					</div>
					<div>
						<!--<img src="/img/feature/analytics.png" alt="screenshot"/><br/>-->
						<img src="img/feature/analytics.png" alt="screenshot"/><br/>
						<h2>PAST READINGS &amp; ANALYTICS</h2>
						<br/>
						<p>
							Our application also keeps a history of meter readings that allows users to view through previous utility consumptions and provide analytics for future consumption trend.
						</p>
					</div>
				</div>
				
				<!-- Screenshot -->
				<div>
					<div id="feature-screenshot-container" class="w3-content w3-display-container">
						<div id="feature-screenshot-slider">
							<div class="feature-screenshot-slides">
								<!--<img src="/img/screenshot/screenshot_1.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_1.png" alt="screenshot"/>
							</div>
							<div class="feature-screenshot-slides">			
								<!--<img src="/img/screenshot/screenshot_2.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_2.png" alt="screenshot"/>
							</div>
							<div class="feature-screenshot-slides">			
								<!--<img src="/img/screenshot/screenshot_3.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_3.png" alt="screenshot"/>
							</div>
							<div class="feature-screenshot-slides">			
								<!--<img src="/img/screenshot/screenshot_4.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_4.png" alt="screenshot"/>
							</div>
							<div class="feature-screenshot-slides">			
								<!--<img src="/img/screenshot/screenshot_2.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_2.png" alt="screenshot"/>
							</div>
							<div class="feature-screenshot-slides">			
								<!--<img src="/img/screenshot/screenshot_3.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_3.png" alt="screenshot"/>
							</div>
							<div class="feature-screenshot-slides">			
								<!--<img src="/img/screenshot/screenshot_4.png" alt="screenshot"/>-->
								<img src="img/screenshot/screenshot_4.png" alt="screenshot"/>
							</div>
						</div>
				
						<div class="w3-center w3-display-topmiddle" style="width:100%">
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(1)"></span>
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(2)"></span>
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(3)"></span>
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(4)"></span>
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(5)"></span>
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(6)"></span>
							<span class="w3-badge screenshot-navcircle" onclick="currentScreenshot(7)"></span>
						</div>
						
						<div id="product_link_div" class="w3-center w3-display-bottommiddle" style="width:100%">
							<!--<a href="/login.php"><img width="150px" height="10px" src="/img/product_link_image.png" alt="product_link_image"/></a>-->
							<a href="login.php"><img width="150px" height="10px" src="img/product_link_image.png" alt="product_link_image"/></a>
						</div>
					</div>
				</div>
				
				<!-- Right Feature -->
				<div>
					<div>
						<!--<img src="/img/feature/gps.png" alt="screenshot"/><br/>-->
						<img src="img/feature/gps.png" alt="screenshot"/><br/>
						<h2>GPS SUPPORT</h2>
						<br/>
						<p>
							The application is capable of tracking user position via GPS for address input.
						</p>
					</div>
					<div>
						<!--<img src="/img/feature/voice.png" alt="screenshot"/><br/>-->
						<img src="img/feature/voice.png" alt="screenshot"/><br/>
						<h2>VOICE FEEDBACK</h2>
						<br/>
						<p>
							The application also provides voice feedback for confirmation messages.
						</p>
					</div>
				</div>				
			</div>
		</div>
	
		
		<!--
		<div id="promo_video">
			<div>
				<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ"></iframe>
				<iframe width="560" height="315" src=""></iframe>
			</div>
		</div>-->
		
		
		
		<!-- Project -->
		<div id="project">
			<div>
				<!-- Project Aim & Problem Statement -->
				<div>
					<div>
						<h1>PROJECT AIM</h1>
						<p>
							The Aim of the project is to provide an effective solution for meter reading 
							without relying on smart meters that people do not want.
						</p>
					</div>
					<div>
						<h1>PROBLEM STATEMENT</h1>
						<p>
							In NSW Australia, smart meters were implemented in the past and gained much disatisfication 
							from the people due to a wide variety of reasons ranging from health problems to 
							personal problems and biases.
						</p>
					</div>
				</div>
				<!-- Target Market -->
				<div>
					<h1>TARGET MARKET</h1>
					<p>
						Australian energy companies have previously conducted a mass rollout of Smart Meters. <br/>
						<br/>
						Due to many reasons (e.g. radiation poisoning), customers have protested against these technologies. 
						The target market for our application is similar to that of Smart Meters, 
						where the customers sticking to the traditional meters would find our solution much more appealing than Smart Meters. <br/>
						<br/>
						As such, the market remains unexplored in Australia.<br/>
						<br/>
						This alternative solution would fit the target market well as it complements and improve the already existing processes.
					</p>
				</div>
			</div>
		</div>
		
		<!-- Issue -->
		<div id="issues">
			<h1>WHAT ISSUE DOES THIS SOLVE?</h1>
			
			<div>
				<!-- In Each Issue Div -->
				<div>
					<div>
						<!--<img src="/img/issue/time.png" alt="image" /><br/>-->
						<img src="img/issue/time.png" alt="image" /><br/>
						<h2>TIME CONSUMING</h2>
						<p>
							Current practice is time consuming as it takes 2:30 minutes to read a single meter. 
							Meter readers have to move from street to street reading meters as well.<br/>
							<br/>
							Doing the same process over and over, the meter reader would only be able to read 
							approximately 200 utility meters in an 8-hour work period. By using our application, 
							we can reduce it down to approximately 10 seconds.
						</p>
					</div>
				</div>
				<!-- In Each Issue Div -->
				<div>
					<div>
						<!--<img src="/img/issue/money.png" alt="image" /><br/>-->
						<img src="img/issue/money.png" alt="image" /><br/>
						<h2>EXPENSIVE</h2>
						<p>
						A Meter Reader's annual pay is $39,933 AUD to $55,728 AUD, 
						and there are 160 meter readers employed by AusGrid.
						This costs the energy company $8 million AUD per annum, 
						which is really expensive.<br/>
						<br/>
						It is our target to reduce this immensely high cost with our application 
						by reducing the number of meter readers required.
						</p>
					</div>
				</div>
				<!-- In Each Issue Div -->
				<div>
					<div>
						<!--<img src="/img/issue/book.png" alt="image" /><br/>-->
						<img src="img/issue/book.png" alt="image" /><br/>
						<h2>LACK OF KNOWLEDGE</h2>
						<p>
							The typical customers in homes do not understand the meaning of each of the dials in the utility meter, 
							which makes it difficult for the person to read and figure out any useful information (e.g. total cost) from it.<br/>
							<br/>
							With our easy-to-use application, all that the customer needs to do is to point the smartphone 
							at the utility meter to read the details for it without knowing the how-to.
						</p>
					</div>
				</div>
				<!-- In Each Issue Div -->
				<div>
					<div>
						<!--<img src="/img/issue/error.png" alt="image" /><br/>-->
						<img src="img/issue/error.png" alt="image" /><br/>
						<h2>HUMAN ERROR</h2>
						<p>
							With the pressure of reading as many utility meters as possible, 
							employees can often make a lot of mistakes. 
							This also results in lower accuracy in the data extracted.<br/>
							<br/>
							Through our application, the reliance in smartphone vision processing prevents human error from occuring, 
							along with checks to ensure that data is being read correctly.
						</p>
					</div>
				</div>
			</div>
		</div>
	
		<!-- Client -->
		<div id="clients">
			<h1>WHO IS INVOLVED?</h1>
		
			<div>
				<div>
					<div>
						<h2>PRIMARY CLIENT/SUPERVISOR</h2>
						<p>
							Dr. Koren is our primary client and is also our supervisor. <br/>
							<br/>
							She has proposed this project as a solution to the Smart Meter problem that the region is facing.
							It is our responsibility to uphold the task in providing an optimal solution
							through the use of vision processing libraries in smartphone technology. <br/>
							<br/>
							We also meet up with our Client every Friday.
						</p>
					</div>
				</div>
				<div>
					<div>
						<h2>ORGANISATION</h2>
						<p>
							Energy Companies, such as AusGrid, AusGreen, and Energy Australia, would also benefit 
							from the use of our application due to the many benefit to gain from using our application,  
							such as decreasing cost while increasing efficiency, which in turn increases revenue. <br/>
							<br/>
							It is our intention to develop this application for these energy companies in order to 
							reduce the human resource cost and ultimately provide an alternative solution to Smart Meters.
						</p>
					</div>
				</div>
				<div>
					<div>
						<h2>END-USER</h2>
						<p>
							Customers who are reluctant to switch to Smart Meters due to its many reasons would be willing 
							to use our application as well. <br/>
							<br/>
							They would be able to read the utility meter readings and paying information for their utility consumption 
							linked to their account. <br/>
							<br/>
							The customer version of our easy-to-use application is entirely beneficial and efficient 
							for customers paying for their utility consumption.
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Team Member -->
		<div id="team">
			<h1>MEMBERS</h1>
			<div id="slider-container" class="w3-content w3-display-container">
			
				<div id="slider">
					<ul>
						<li>
							<!-- Member #1 -->
							<div class="mySlides">
								<!--<img src="/img/about_us/profile_vishal.jpg" alt="member_1" />-->
								<img src="img/about_us/profile_vishal.jpg" alt="member_1" />
								<p>
									Vishal Mishra<br/>
									- Leader | Mobile Developer -
								</p><br/>
								<p>
									Vishal is an International student currently undertaking Bachelor of Computer Science - Dean scholar degree from university of Wollongong main campus. 
									Has worked for maker space and as a mobile developer for a start-up before joining UOW. <br/>
									<br/>
									Has the ability to work under given time limit thus meeting close deadlines, possesses great communication skills, flexible in terms of availability and a good team leader. 
									Also has completed course ranging from simple webpage development to using PHP, along with other courses like algorithm and design and Human computer interface which are also key requirement for this project. 
									Has a modern and innovative approach to solve complex problems. <br/>
									<br/>
									Responsibility as Project Leader and as Developer for the Mobile Application, Interface Design, and Team Decisions.
								</p>
							</div>
						</li><li>
							<!-- Member #2 -->
							<div class="mySlides">
								<!--<img src="/img/about_us/profile_chrisDeng.jpg" alt="member_5" />-->
								<img src="img/about_us/profile_chrisDeng.jpg" alt="member_5" />
								<p>
									Chris Deng<br/>
									- Mobile Developer -
								</p><br/>
								<p>
									Chris Deng is enrolled in Bachelor of Information Technology, 3rd Year Major in E-business in University of Wollongong. <br/>
									<br/>
									Capable in researching new ideas and concepts. <br/>
									<br/>
									Responsibility as Business and Network Analyst, and Researcher.
								</p>
							</div>
						</li><li>
							<!-- Member #3 -->
							<div class="mySlides">
								<!--<img src="/img/about_us/profile_philip.jpg" alt="member_2" />-->
								<img src="img/about_us/profile_philip.jpg" alt="member_2" />
								<p>
									Jingwang Teh<br/>
									- Web Developer -
								</p><br/>
								<p>
									Jingwang Teh, 21 year's old, Chinese Malaysian. <br/>
									<br/>
									Enrolled in Bachelor of Computer Science, 3rd Year Software Engineering Major in University of Wollongong. 
									Often gets lost in thought and comes up with strange yet interesting ideas. <br/>
									<br/>
									Responsibility as a Developer in Full Stack Web Development, Interface Design, Tech Decisions and Ideas for new features.
								</p>
							</div>
						</li><li>
							<!-- Member #4 -->
							<div class="mySlides">
								<!--<img src="/img/about_us/profile_chrisTan.jpg" alt="member_4" />-->
								<img src="img/about_us/profile_chrisTan.jpg" alt="member_4" />
								<p>
									Chris Tan<br/>
									- Web Developer -
								</p><br/>
								<p>
									Christopher Tan, 24 year's old, Chinese Malaysian. <br/>
									<br/>
									Enrolled in Bachelor of Information Technology, 3rd Year Double Major in Network Design Management and E-business in University of Wollongong. 
									Specialises in managing networks as well as developing IT strategies for businesses. <br/>
									<br/>
									Responsibility as a Research Analyst, Business Planner and Communications.
								</p>
							</div>
						</li><li>
							<!-- Member #5 -->
							<div class="mySlides">
								<!--<img src="/img/about_us/profile_adu.png" alt="member_3" />-->
								<img src="img/about_us/profile_adu.png" alt="member_3" />
								<p>
									Adu<br/>
									- UI &amp; Graphics Designer -
								</p><br/>
								<p>
									Adu is an innovative IT professional offering vast experience leveraging software engineering and Dev-Ops methodologies to deliver highly effective and creative solutions to business and technology challenges. <br/>
									<br/>
									He utilises highly attuned analytical skills to develop IT and business strategies employing cutting-edge technologies to increase productivity. <br/>
									<br/>
									Responsibility as a Business and Network Analyst, Photo Editor and Researcher.
								</p>
							</div>
						</li>
					</ul>
				</div>

				<button class="w3-btn w3-text-white w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
				<button class="w3-btn w3-text-white w3-display-right" onclick="plusDivs(1)">&#10095;</button>
				
				<div class="w3-center w3-display-topmiddle" style="width:100%">
					<span class="w3-badge team-navcircle" onclick="currentDiv(1)"></span>
					<span class="w3-badge team-navcircle" onclick="currentDiv(2)"></span>
					<span class="w3-badge team-navcircle" onclick="currentDiv(3)"></span>
					<span class="w3-badge team-navcircle" onclick="currentDiv(4)"></span>
					<span class="w3-badge team-navcircle" onclick="currentDiv(5)"></span>
				</div>
			</div>
		</div>
		
		<!-- About Us -->
		<div id="about">
			<h1>ABOUT US</h1>
			<div>
				<p>
					Our group consists of 5 undergraduate students from University of Wollgongong in Australia. <br/>
					We are enrolled in a variety of courses but undertaking the same subject, CSIT321 Project, <br/>
					in an effort to gain experience in developing software for a respectable client. <br/>
					<br/>
					In this project, our subject coordinator is Dr. Mark Freeman, and our client/supervisor is Dr. Koren.
				</p>
			</div>
		</div>
		
		<!-- Contact Us -->
		<div id="contact">
			<h1>CONTACT US</h1>
			
			<div>
				<form>
					<p><input type="text" placeholder="Name" /></p>
					<p><input type="text" placeholder="Email" /></p>
					<p><textarea placeholder="Message"></textarea></p>
					<div><input type="submit" value="SUBMIT"/></div>
				</form>
			</div>
		</div>
		
	</section>
	
	
	
	<!-- FOOTER -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutFooter_diffPage.php'; ?>
	<?php include 'phpCommons/layoutFooter_diffPage.php'; ?>
</div>
<!-- --------------------End Page-------------------- -->



<!-- Common JS (note: After Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonBottom.php'; ?>
	<?php include 'phpCommons/layoutCommonBottom.php'; ?>
	
<!-- Internal JavaScript -->
	<script>
		setInterval("plusScreenshot(1)", 5000);
	</script>
	
</body>
</html>