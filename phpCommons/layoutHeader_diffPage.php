<!-- Header -->
<header>
	<!-- Header Main -->
	<div>
		<!--<p id="logo"><a href="/"><img src="/img/logo.png" alt="logo" /></a></p>-->
		<p id="logo"><a href="index.php"><img src="img/logo.png" alt="logo" /></a></p>
		<p id="logo-desc"><a href="index.php">TEAM SNAPPY</a></p>
	</div>
	
	<!-- Header Nav -->
	<nav>
		<ul>
			<li><a href="#philosophy" 		id="nav_philosophy"			onclick="highlightNav.call(this)">OUR PHILOSOPHY</a></li>
			<li><a href="#methodology" 		id="nav_methodology" 		onclick="highlightNav.call(this)">DESIGN METHODOLOGY</a></li>
			<li><a href="#dev_environment" 	id="nav_dev_environment" 	onclick="highlightNav.call(this)">DEVELOPMENT ENVIRONMENT</a></li>
		</ul>
	</nav>
	
	<div id="pizzaMenu" onclick="togglePizzaMenu()">
		<!--<div><img src="/img/burgerMenu.png" alt="burger menu" /></div>-->
		<div><img src="img/burgerMenu.png" alt="burger menu" /></div>
	</div>
</header>

<div id="pizzaMenuExpanded">
	<ul>
		<a href="#philosophy" 		id="nav_philosophy"			onclick="highlightNav.call(this)"><li>OUR PHILOSOPHY</li></a>
		<a href="#methodology" 		id="nav_methodology" 		onclick="highlightNav.call(this)"><li>DESIGN METHODOLOGY</li></a>
		<a href="#dev_environment" 	id="nav_dev_environment" 	onclick="highlightNav.call(this)"><li>DEVELOPMENT ENVIRONMENT</li></a>
	</ul>
</div>
