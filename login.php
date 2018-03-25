<?php
	require 'parseDetails.php';
	use Parse\ParseUser;
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
	
	$stickyUser = '';
	$stickyPW = '';
	$loginError = '';
	
	try {
		$currentUser = ParseUser::getCurrentUser();
		if ($currentUser) {
			// redirect if already logged in
			header('Location: '.'profile.php');
		} else {
			if (isset($_POST['username']) && isset($_POST['password'])) {
				try {
					$stickyUser = (inputNotEmpty($_POST['username']))? sanitize_input($_POST['username']) : null;
					$stickyPW = (inputNotEmpty($_POST['password']))? sanitize_input($_POST['password']) : null;
					//$stickyUser = "my name";
					//$stickyPW = "my pass";
					
					// Login, then check username and password match
					try {
						
						$user = ParseUser::logIn($stickyUser, $stickyPW);
						
						// Redirect after successful login
						header('Location: '.'profile.php');
						
					} catch (Exception $error) {
						// Username/Password did not match
						if (strpos($error, 'Invalid username/password')) {
							$loginError = 'Invalid username/password.';
						}
						else if (strpos($error, 'empty name')) {
							$loginError = 'Please provide a name.';
						}
						else if (strpos($error, 'empty password')) {
							$loginError = 'Please provide a password.';
						}
					}
				} catch (Exception $error) {
					//echo $error;
				}
			}
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
	<!--<link rel="stylesheet" type="text/css" href="/css/contentLogin.css" />-->
	<link rel="stylesheet" type="text/css" href="css/contentLogin.css" />
	<!-- Misc -->
	<!--<link rel="stylesheet" type="text/css" href="/css/style.css" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- TITLE -->
	<title>Snappy : Login</title>

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
	
	
	
	<!-- CONTENT -->
	<section id="content">
		
		<!-- Login Form -->
		<div id="loginForm">
			<form action="login.php" method="POST">
				<p><input type="text" name="username" placeholder="Username" value="<?=$stickyUser?>" /></p>
				<p><input type="password" name="password" placeholder="Password" value="<?=$stickyPW?>" /></p>
				<p><button type="submit" value="Submit">Login</button></p>
				<p class='loginError'><?=$loginError?></p>
			</form>
		</div>
		
	</section>
	
	
	
	<!-- FOOTER -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutFooter_otherPage.php'; ?>
	<?php include 'phpCommons/layoutFooter_otherPage.php'; ?>
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