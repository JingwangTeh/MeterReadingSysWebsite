<?php
	require './vendor/parse/autoload.php';
	session_start();

	use Parse\ParseClient;
	use Parse\ParseUser;
	
	$app_id = '8mAHLrA77NSsHIOO1RjkUZR20ispu5otVdNahwgU';
	$rest_key = 'PbPoCeCVJ1ApHZIZgomnPJJe3Qp5uO6oNlIMtnUb';
	$master_key = 'MyLnALFqUjZTkIMzDV4HzyqopVlkol4ysRxDyXWM';
	
	ParseClient::initialize( $app_id, $rest_key, $master_key );
	// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
	ParseClient::setServerURL('https://parseapi.back4app.com', '/');
	
	ParseUser::logOut();
?>

<?php
	// redirect to login page after logout
	header('Location: '.'login.php');
?>


<!DOCTYPE HTML>
<html>
<head>

<!-- Common Meta & Fav-ico, 
	 Libraries (w3.css, bootstrap, jQuery, jQueryUI), 
	 Common CSS (reset, loader, layout)
	 Common JS (note: Priority before Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonTop_otherPage.php'; ?>
	<?php //include 'phpCommons/layoutCommonTop_otherPage.php'; ?>

<!-- TITLE -->
	<title>Snappy : Logout</title>

</head>
<body id="home">

<!-- Page Loader -->
<div id="loading-screen"><div id="loader"></div></div>



<!-- --------------------Page Wrapper-------------------- -->
<!--<div id="page-wrapper" class="animate-bottom">-->
<div id="page-wrapper">
	
	
	
	<!-- CONTENT -->
	<section id="content">
		
		<!-- -->
		<div id="">
		</div>
		
	</section>
	
	
	
</div>
<!-- --------------------End Page-------------------- -->



<!-- Common JS (note: After Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonBottom.php'; ?>
	<?php //include 'phpCommons/layoutCommonBottom.php'; ?>
	
<!-- Internal JavaScript -->
	<script>
	</script>

</body>
</html>