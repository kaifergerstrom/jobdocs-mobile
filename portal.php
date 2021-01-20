<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_GET['wid'];

$wo = getWorkOrder($wid);


function getWorkOrder($id) {
    if (!(is_numeric($id) && strlen($id) == 6)) {  // If the wid is not numeric and not of length five
        header("Location: index.php"); // redirect to homepage
    }
    $wo = DB::query("SELECT * FROM workorders WHERE WorkOrderId=:wid", array(":wid"=>$id));
    return $wo ? $wo[0] : header("Location: index.php");  // If the work order exists, return it
}

$address_full = $wo['StreetAddress']." ".$wo['City'].", ".$wo['State']." ".$wo['Zip'];




?>

<!DOCTYPE html>
<html lang="en" class="uk-height-1-1">
	<head>
		<title>Title</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
		<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
		<link rel="stylesheet" href="css/portal.css" />
	</head>
	<body class="uk-height-1-1">
		<div class="uk-padding-small gradient-bg uk-text-bold uk-text-large">
			JobDocs <span class="uk-text-normal">Mobile</span>
		</div>
		<div class="uk-padding uk-padding-remove-bottom">
			<h1 class="uk-text-lead uk-margin-remove uk-text-bold">Work Order <span class="uk-text-normal secondary-color">#<?php echo $wid; ?></span></h1>
			<div class="uk-margin-small-top"><span uk-icon="location"></span> <?php echo $address_full; ?></div>
			<ul class="uk-child-width-expand" uk-switcher="connect: .info-tab; swiping: false;" uk-tab>
				<li><a href="#">Details</a></li>
				<li><a href="#">Forms</a></li>
				<li><a href="#">Uploads</a></li>
			</ul>
		</div>
		<ul class="uk-switcher info-tab uk-margin">
			<li>
				<div id='workorder-map'></div>
				wassup
			</li>
			<li>
				hi
			</li>
			<li>
				Multiple upload script here
			</li>
		</ul>
		<script>
			var mymap = L.map('workorder-map').setView([39.112560, -77.179110], 15);
			
			var marker = L.marker([39.112560, -77.179110]).addTo(mymap);
			
			L.tileLayer('https://tile.jawg.io/jawg-light/{z}/{x}/{y}.png?access-token=t98cJvo5COpONHFHYvQtU51EtTGrzzYLVqE8P5azaYjZyNOs8Ntae6a7RRlknB6U', {}).addTo(mymap);
			mymap.attributionControl.addAttribution("<a href=\"https://www.jawg.io\" target=\"_blank\">&copy; Jawg</a> - <a href=\"https://www.openstreetmap.org\" target=\"_blank\">&copy; OpenStreetMap</a>&nbsp;contributors")
		</script>
	</body>
</html>