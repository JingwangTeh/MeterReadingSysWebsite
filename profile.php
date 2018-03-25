<?php
	require 'parseDetails.php';
	use Parse\ParseUser;
	use Parse\ParseObject;
	use Parse\ParseQuery;
	use Parse\ParseGeoPoint;
?>

<?php
	/*
	 * Function : sanitize_input
	 * Usage    : clear whitespaces, slashes, and any special characters
	 * Input	: string to be sanitized
	 * Return   : sanitized value
	 */
	function sanitize_input($user_input)
	{
		$user_input = trim($user_input);
		$user_input = htmlspecialchars($user_input);
		$user_input = stripslashes($user_input);
		
		return $user_input;
	}
	
	/*
	 * Function : inputNotEmpty
	 * Usage    : check if input is empty 
	 *			  (to handle input with value of 0, as 0 is considered as empty)
	 * Input	: input string to check
	 * Return   : boolean true/false, true if not empty, false if empty and not 0
	 */
	function inputNotEmpty($input)
	{
		return ($input === "0" || $input);
	}
	
	$stickyEmail = '';
	$resetError = '';
	$resetSuccess = '';
	
	try {
		$currentUser = ParseUser::getCurrentUser();
		if ($currentUser) {
			// No redirect if logged in
			if (isset($_POST['email'])) {
				try {
					$stickyEmail = (inputNotEmpty($_POST['email']))? sanitize_input($_POST['email']) : null;
					
					// Reset password through email
					try {
						ParseUser::requestPasswordReset($stickyEmail);
						
						// Redirect after successful reset
						//header('Location: '.'profile.php');
						$resetSuccess = 'Email for password reset has been sent.';
					} catch (Exception $error) {
						//echo $error;
						if (strpos($error, 'No user found with email')) {
							$resetError = 'Invalid email.';
						}
						else if (strpos($error, 'must provide an email')) {
							$resetError = 'Please provide an email.';
						}
					}
				} catch (Exception $error) {
					//echo $error;
				}
			}
		} else {
			// Redirect if user has not logged in
			header('Location: '.'login.php');
		}
	} catch (Exception $error) {
		//echo $error;
	}

?>


<!DOCTYPE HTML>
<html>
<head>

<!-- Common Meta & Fav-ico, 
	 Libraries (w3.css, bootstrap, jQuery, jQueryUI), 
	 Common CSS (reset, loader, layout)
	 Common JS (note: Priority before Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonTop_otherPage.php'; ?>
	<?php include 'phpCommons/layoutCommonTop_otherPage.php'; ?>

<!-- Page CSS -->

	<!-- Content Wrapper -->
	<!--<link rel="stylesheet" type="text/css" href="/css/contentProfile.css" />-->
	<link rel="stylesheet" type="text/css" href="css/contentProfile.css" />
	<!-- Misc -->
	<!--<link rel="stylesheet" type="text/css" href="/css/style.css" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- TITLE -->
	<title>Snappy : Profile</title>

<!-- Internal JavaScript -->

	<script>
	</script>

</head>
<body id="home">

<!-- Page Loader -->
<div id="loading-screen"><div id="loader"></div></div>



<!-- --------------------Page Wrapper-------------------- -->
<!--<div id="page-wrapper" class="animate-bottom">-->
<div id="page-wrapper">
	
	<!-- SIDEBAR -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutHeader_otherPage.php'; ?>
	<?php include 'phpCommons/layoutHeader_otherPage.php'; ?>
	
	<!-- CONTENT -->
	<section id="content">
		
		<!-- some content -->
		<div id="profile_top">
			<p><?=strtoupper($currentUser->getUsername())?>'s PROFILE</p>
		</div>
		<div id="profile_form">
			<h1>CHANGE/RESET PASSWORD</h1>
			<form action="profile.php" method="POST">
				<p><input type="text" name="email" placeholder="Email" value="<?=$stickyEmail?>" /></p>
				<p><button type="submit" value="Submit">Reset</button></p>
				<p class='resetError'><?=$resetError?></p>
				<p class='resetSuccess'><?=$resetSuccess?></p>
			</form>
		</div>
		
	</section>
	
	
	
	<!-- FOOTER -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutFooter_otherPage.php'; ?>
	<?php //include 'phpCommons/layoutFooter_otherPage.php'; ?>
</div>
<!-- --------------------End Page-------------------- -->



<!-- Common JS (note: After Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonBottom.php'; ?>
	<?php include 'phpCommons/layoutCommonBottom.php'; ?>
	
<!-- Internal JavaScript -->
	<script>
	</script>

</body>
</html>