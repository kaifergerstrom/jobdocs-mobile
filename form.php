<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

// Fetch work order ID and form ID from url
$wid = $_GET['wid'];
$fid = $_GET['fid'];
$responseID = $_GET['id'];

// Fetch form info from form ID
$form_info = DB::query("SELECT formTitle, formDesc, formJSON FROM forms WHERE formID=:formID", array(":formID"=>$fid))[0];

// Extract JSON form template
$formFile = file_get_contents("json/".$form_info['formJSON']);
$formStructure = json_decode($formFile, true);

// Load response data
$responseData = array();
if (isset($_GET['load']) && $_GET['load'] == 1) {
	if ($file = DB::query("SELECT file FROM form_response WHERE response_id=:id", array(":id"=>$responseID))) {
		$responseData  = json_decode(file_get_contents("json/responses/".$file[0]['file']), true);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-tap-highlight" content="no">
		
		<!--NVD3-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/prism.min.js"></script>

		<!-- Materialize -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
		<link rel="stylesheet" href="https://www.samclarke.com/assets/migrating-to-hugo/monokai.css" />
		
		<!-- UiKit -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/form.css" />
		<link rel="stylesheet" href="css/styles.css" />

		<!-- Custom Stepper JS -->
		<script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css">

	</head>

	<body>
		<!-- Gradient Header Bar -->
		<div class="uk-padding-small gradient-bg uk-text-bold uk-text-large uk-text-center">
			<a class="uk-link-reset" href="portal.php?wid=<?php echo $wid;?>">JobDocs <span class="uk-text-normal">Mobile</span></a>
		</div>

		<div class="uk-padding">

			<!-- Form title and description -->
			<h1 class=" uk-text-large uk-text-bold uk-margin-remove-bottom"><?php echo $form_info['formTitle']; if (isset($_GET['load']) && $_GET['load'] == 1) echo " <span class='uk-text-warning'>(Editing)</span>";?></h1>
			<p class="uk-margin-small-top uk-margin-small-bottom uk-text-meta"><?php echo $form_info['formDesc']; ?></p>
			<hr>

			<!-- Stepper Container -->
			<div class="section scrollspy" id="non-linear">
				<div class="card-content">
					<form action="" method="POST" id="formContainer">
						




						<ul class="stepper linear">
						<?php

						$i = 0;
						foreach ($formStructure["sections"] as $sectionTitle => $section) {

							echo $i==0 ? '<li class="step active">' : '<li class="step">';
							echo '  
								<div data-step-label="'.$section['description'].'" class="step-title waves-effect waves-dark">'.$sectionTitle.'</div>
								<div class="step-content">
							';

							foreach ($section['fields'] as $label => $field) {
								
								$formattedLabel = isset($field['label']) ? $field['label'] : ucwords(str_replace("_", " ", $label));
								$max_length = isset($field['max_length']) ? 'maxlength="'.$field['max_length'].'"' : "";


								// Determine properties of text inputs to preload
								$config = array('value'=>"", 'disabled'=>0, 'style'=>"");  // Array to store input settings
								$class_list = array("required", "validate", "form-control");  // Classes to input

								if (isset($_GET['load']) && $_GET['load'] == 1 && isset($responseData[$label]) && !is_array($responseData[$label]) ) {  // If there is a response being loaded, that takes priority

									$config['value'] = $responseData[$label];
									$config['disabled'] = 1;

								} else if (isset($field['prefill'])) {  // Secondly, check for prefill values
									// Extract values from JSON template
									$prefill_type = array_keys($field['prefill'])[0];
									$prefill_value = $field['prefill'][$prefill_type];

									switch ($prefill_type) {
										case "value":  // Direct value to fill in
											$config['value'] = $prefill_value == "/WID/" ? $wid : $prefill_value;
										break;

										case "column": // Column from workorders tab
											$config['value'] = DB::query("SELECT ".$prefill_value." FROM workorders WHERE WorkOrderId=:wid", array(":wid"=>$wid))[0][$prefill_value];
										break;
									}
									$config['disabled'] = 0;
									array_push($class_list, "valid");
								}
								$disabled = $config['disabled'] == 1 ? "disabled" : "";  // Check if input should be disabled

								$class_string = implode(" ", $class_list);
								$config_string = sprintf("value='%s' style='%s' %s", $config['value'], $config['style'], $disabled);

								echo '<div class="input-field col s12">';
								// Switch case to render form input based on type
								switch ($field['type']) {

									case "string":
										echo sprintf('<input name="%s" type="text" %s class="%s" %s>', $label, $max_length, $class_string, $config_string);
										echo '<label for="'.$label.'">'.$formattedLabel.'</label>';
									break;

									case "number":
										echo sprintf('<input name="%s" type="text" %s class="%s" %s>', $label, $max_length, $class_string, $config_string);
										echo '<label for="'.$label.'">'.$formattedLabel.'</label>';
									break;

									case "select":

										$multiple = isset($field['multiple']) && $field['multiple'] ? "multiple" : "";

										echo '<select '.$multiple.' name="'.$label.'" class="form-select">';
										echo '<option value="" disabled>'.$formattedLabel.'</option>';
										foreach ($field['enum'] as $option) {

											// Check if enum should be selected
											$selected = "";
											
											if (is_array($responseData[$label])) {
												if (in_array($option, $responseData[$label])) {
													$selected = "selected";
												}
											} else {
												if ($option==$responseData[$label]) {
													$selected = "selected";
												}
											}
											

											echo '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
										}
										echo '</select>';
									break;

									case "signature":
										echo '<div>
												<p class="uk-margin-small-bottom uk-text-muted mini-label">'.$formattedLabel.'</p>
												<canvas id="'.$label.'" class="signature-pad" width="400" height="150"></canvas>
												<div>
												
												<button id="'.$label.'_clear" type="button" class="uk-button uk-button-default uk-button-small uk-margin-small-top">Clear</button>
												</div>
											</div>';
									break;

									case "date":
										echo '<p class="uk-margin-remove uk-text-muted mini-label">'.$formattedLabel.'</p>';
										echo sprintf('<input name="%s" type="date" %s class="%s datepicker" %s>', $label, $max_length, $class_string, $config_string);
									break;

									case "time":
										echo '<p class="uk-margin-remove uk-text-muted mini-label">'.$formattedLabel.'</p>';
										echo sprintf('<input name="%s" type="time" %s class="%s datepicker" %s>', $label, $max_length, $class_string, $config_string);
									break;

								}
								echo '</div>';


							}
						
							
							echo '
							<div class="step-actions">
							<button class="uk-button secondary-btn uk-margin-small-right next-step">CONTINUE</button>';
							echo $i == 0 ? '' : '<button class="uk-button previous-step">BACK</button>';  // Hide back button on first step
							
							echo '
									</div>
								</div>
							</li>
							';
							$i++;

						}

							?>

							<!-- Final Submit Step -->
							<li class="step">
								<div class="step-title waves-effect waves-dark">Verify & Submit</div>
								<div class="step-content">
									<p class="uk-text-muted uk-padding-top-small uk-padding-small-bottom uk-margin-top uk-margin-remove">I confirm that all the information supplied in this form is valid and truthful.</p>
									<div class="step-actions">
										<button class="uk-button <?php echo isset($_GET['load']) && $_GET['load'] == 1 ? "" : "secondary-btn";?>" type="button" id="submitForm" <?php if (isset($_GET['load']) && $_GET['load'] == 1) echo "disabled";?>>SUBMIT</button>
									</div>
								</div>
							</li>

						</ul>

					</form>
				</div>
			</div>
		</div>
		
		<!-- Signature Pad JS -->
		<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

		<script>
		var wid = "<?php echo $wid;?>";
		var formID = "<?php echo $fid;?>";
		var responseID = "<?php echo $responseID; ?>";
		var formTitle ="<?php echo $form_info['formTitle'];?>";
		</script>
		<script src="js/stepper.js"></script>
		
		

	</body>