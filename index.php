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
	</head>

	<body class="uk-height-1-1">
		<nav class="uk-navbar uk-navbar-container uk-margin">
			<div class="uk-navbar-left">
				<a class="uk-navbar-toggle" href="#" uk-toggle="target: #menu-offcanvas">
					<span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>
				</a>
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
		<div id="menu-offcanvas" uk-offcanvas="mode: push; overlay: true">
			<div class="uk-offcanvas-bar">
		
				<button class="uk-offcanvas-close" type="button" uk-close></button>
		
				<h3>Title</h3>
		
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		
			</div>
		</div>
	</body>

</html>