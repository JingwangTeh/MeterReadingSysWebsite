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
			<li><a href="#features"	id="nav_features"	onclick="highlightNav.call(this)">FEATURES</a></li>
			<li><a href="#project"	id="nav_projects"	onclick="highlightNav.call(this)">PROJECT</a></li>
			<li><a href="#issues"	id="nav_issues"		onclick="highlightNav.call(this)">ISSUES</a></li>
			<li><a href="#clients"	id="nav_clients"	onclick="highlightNav.call(this)">CLIENTS</a></li>
			<li><a href="#team"		id="nav_team"		onclick="highlightNav.call(this)">TEAM</a></li>
			<li><a href="#about"	id="nav_about"		onclick="highlightNav.call(this)">ABOUT</a></li>
			<li><a href="#contact"	id="nav_contact"	onclick="highlightNav.call(this)">CONTACT</a></li>
		</ul>
	</nav>
	
	<div id="pizzaMenu" onclick="togglePizzaMenu()">
		<!--<div><img src="/img/burgerMenu.png" alt="burger menu" /></div>-->
		<div><img src="img/burgerMenu.png" alt="burger menu" /></div>
	</div>
</header>

<div id="pizzaMenuExpanded">
	<ul>
		<a href="#features"	id="nav_features"	onclick="highlightNav.call(this)"><li>FEATURES</li></a>
		<a href="#project"	id="nav_projects"	onclick="highlightNav.call(this)"><li>PROJECT</li></a>
		<a href="#issues"	id="nav_issues"		onclick="highlightNav.call(this)"><li>ISSUES</li></a>
		<a href="#clients"	id="nav_clients"	onclick="highlightNav.call(this)"><li>CLIENTS</li></a>
		<a href="#team"		id="nav_team"		onclick="highlightNav.call(this)"><li>TEAM</li></a>
		<a href="#about"	id="nav_about"		onclick="highlightNav.call(this)"><li>ABOUT</li></a>
		<a href="#contact"	id="nav_contact"	onclick="highlightNav.call(this)"><li>CONTACT</li></a>
	</ul>
</div>