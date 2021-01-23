<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_GET['wid'];
$fid = $_GET['fid'];

?>

<!DOCTYPE html>
<html lang="en" class="uk-height-1-1">
	<head>
    <title>Title</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- UiKit -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>
        
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

        <!-- Custom Stylesheets -->
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/portal.css" />
    </head>
    
	<body class="uk-height-1-1">
		
        <div class="uk-padding-small gradient-bg uk-text-bold uk-text-large uk-text-center">
			<a class="uk-link-reset" href="portal.php?wid=<?php echo $wid;?>">JobDocs <span class="uk-text-normal">Mobile</span></a>
		</div>

        <div class="uk-container uk-container-xlarge uk-margin-top">

            <div uk-grid>

                <!-- Form Content Cell -->
                <div class="uk-width-1-3@m">

                    <div class="uk-card uk-card-default uk-card-body">
                        <table class="uk-table uk-table-divider uk-margin-remove">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th class="uk-text-right">Progress</th>
                                </tr>
                            </thead>
                            <tbody class="uk-text-small">
                                
                                    <tr>
                                        <td class="uk-table-link secondary-color"><a class="uk-link-reset" href="#">Table Data</a></td>
                                        <td class="uk-text-right uk-text-danger">6/10</td>
                                    </tr>
                                
                                <tr>
                                    <td class="uk-table-link secondary-color"><a class="uk-link-reset" href="#">Table Data</a></td>
                                    <td class="uk-text-right uk-text-warning">5/10</td>
                                </tr>
                                <tr>
                                    <td class="uk-table-link secondary-color"><a class="uk-link-reset" href="#">Table Data</a></td>
                                    <td class="uk-text-right uk-text-success">0/10</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Form Body Cell -->
                <div class="uk-width-expand@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h2 class="uk-text-bold">WSSC Septage Manifest</h2>

                        <div class="form-group">
                            <h1 class="uk-heading-bullet uk-text-lead secondary-color">Basic Information</h1>
                            <div class="uk-margin">
                                <input class="uk-input" type="text" placeholder="Input">
                            </div>

                            <div class="uk-margin">
                                <select class="uk-select">
                                    <option>Option 01</option>
                                    <option>Option 02</option>
                                </select>
                            </div>

                            <div class="uk-margin">
                                <textarea class="uk-textarea" rows="5" placeholder="Textarea"></textarea>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        
        
	</body>
</html>