<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_GET['wid'];

$wo = getWorkOrder($wid);


function getWorkOrder($id) {
    if (!(is_numeric($id) && strlen($id) == 6)) {  // If the wid is not numeric and not of length five
        //header("Location: index.php"); // redirect to homepage
    }
    $wo = DB::query("SELECT * FROM workorders WHERE WorkOrderId=:wid", array(":wid"=>$id));
    return $wo ? $wo[0] : "";  // If the work order exists, return it
}

$address_full = $wo['StreetAddress']." ".$wo['City'].", ".$wo['State']." ".$wo['Zip'];


?>

<!DOCTYPE html>
<html lang="en" class="uk-height-1-1">
	<head>
		<title>JobDocs - Work Order #<?php echo $wid;?></title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- UiKit -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>
        
        <!-- Leaflet Maps -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
        
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

        <!-- Custom Stylesheets -->
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/portal.css" />
    </head>
    
	<body class="uk-height-1-1">

		<div class="uk-padding-small gradient-bg uk-text-bold uk-text-large uk-text-center">
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

            <!-- Work Order Details Tab -->
			<li>
				<div id='workorder-map'></div>
            </li>

            <!-- Form Requirements Tab -->
			<li>
                <div class="uk-container uk-container-large">
                    <?php include("includes/forms.php");?>
                </div>
            </li>

            <!-- Photo/File Upload Tab -->
			<li>
            </li>
            
		</ul>

        <script src="js/wo-map.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
        
    </body>
</html>