<?php

if (isset($_POST['wid-btn'])) {
	header("Location: portal.php?wid=".$_POST['wid']);
}

?>

<!DOCTYPE html>
<html lang="en" class="uk-height-1-1">

	<head>
		<title>JobDocs - Home</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- UiKit -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>
		
		<!-- Custom Stylesheets -->
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="css/index.css" />

		<!-- JQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery.cookie@1.4.1/jquery.cookie.min.js"></script>
	</head>

	<body class="uk-height-1-1">
		<nav class="uk-navbar uk-navbar-container uk-margin">
			<div class="uk-navbar-left">
			<!--
				<a class="uk-navbar-toggle" href="#" uk-toggle="target: #menu-offcanvas">
					<span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>
				</a>
				-->
			</div>
		</nav>
		<div>
			<div class="uk-position-center uk-position-z-index">
				<div>
					<h1 class="uk-text-bold">JobDocs <span class="uk-text-light secondary-color">Mobile</span></h1>
					<p class="uk-text-muted">Built for Contractors by Contractors.</p>
				</div>
				
				<form action="index.php" method="POST">
					<div class="uk-margin">
						<input class="gradient-input uk-input uk-form-large" type="text" placeholder="Enter Work Order ID" name="wid">
					</div>
					<div class="uk-margin">
						<button class="uk-button uk-button-default uk-width-1-1 uk-button-large" type="submit" name="wid-btn">Open Work Order</button>
					</div>
				</form>
			</div>
			<div class="footer gradient-bg uk-position-bottom">
				<div id="stars"></div>
				<div id="stars2"></div>
				<div id="stars3"></div>
			</div>
		</div>
	</body>

	<!-- This is the modal with the default close button -->
	<div id="complete-modal" uk-modal>
		<div class="uk-modal-dialog uk-modal-body uk-text-center" style="z-index: 99999999;">
			<button class="uk-modal-close-default" type="button" uk-close></button>
			<h2 class="uk-modal-title uk-text-bold">Submitted Work Order</h2>
			<p class="uk-margin-remove-bottom uk-text-italic">All requirements are complete. Now sit back, and a relax...</p>
			<img src="img/relax.jpg" style="height: 300px;">
		</div>
	</div>

	
	<script>

	if ($.cookie("wo_submit")) {
		UIkit.modal("#complete-modal").show();
		$.removeCookie('wo_submit', { path: '/' });
	}
	
	</script>



</html>