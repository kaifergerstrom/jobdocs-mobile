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
									$load_value = "";
									$config = array('value'=>"", 'disabled'=>0, 'style'=>"");  // Array to store input settings

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
												$config['disabled'] = 1;
											break;

											case "column": // Column from workorders table
												$query = "SELECT ".$prefill_value." FROM workorders WHERE WorkOrderId=:wid";
												$config['value'] = DB::query($query, array(":wid"=>$wid))[0][$prefill_value];
												$config['disabled'] = 1;
											break;
										}
									}
									$disabled = $config['disabled'] == 1 ? "disabled" : "";  // Check if input should be disabled
									$config_string = 'value="'.$config['value'].'" style="'.$config['style'].'" '.$disabled;  // Prepare configuration string

									echo '<div class="input-field col s12">';
									// Switch case to render form input based on type
									switch ($field['type']) {

										case "string":
											echo '<input name="'.$label.'" type="text" class="form-field validate" '.$max_length.' '.$config_string.'>';
											echo '<label for="'.$label.'">'.$formattedLabel.'</label>';
										break;

										case "number":
											echo '<input name="'.$label.'" type="text" class="form-field validate" '.$max_length.' '.$config_string.'>';
											echo '<label for="'.$label.'">'.$formattedLabel.'</label>';
										break;

										case "select":

											$multiple = isset($field['multiple']) && $field['multiple'] ? "multiple" : "";

											echo '<select '.$multiple.' name="'.$label.'" class="form-select" required="" aria-required="true">';
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
											echo '<input name="'.$label.'" type="date" class="form-field datepicker" '.$config_string.'>';
										break;

										case "time":
											echo '<p class="uk-margin-remove uk-text-muted mini-label">'.$formattedLabel.'</p>';
											echo '<input name="'.$label.'" type="time" class="form-field datepicker" '.$config_string.'>';
										break;

									}
									echo '</div>';
								}
								

								echo '
								<div class="step-actions"><button class="uk-button secondary-btn uk-margin-small-right next-step">CONTINUE</button>';
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
										<button class="uk-button secondary-btn" type="button" id="submitForm">SUBMIT</button>
									</div>
								</div>
							</li>
							
						</ul>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Custom Stepper JS -->
		<script src="js/stepper.js"></script>
		<!-- Signature Pad JS -->
		<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
		<script>


		var stepper = document.querySelector('.stepper');



			// Initialize materilize select inputs
			$(document).ready(function() {
				$('select').material_select();
			});

			// Initialize signature pads based on class name
			var signature_pads = document.getElementsByClassName("signature-pad");
			Array.prototype.forEach.call(signature_pads, function(el) {
				var signaturePad = new SignaturePad(el, {
					backgroundColor: 'rgba(255, 255, 255, 0)',
					penColor: 'rgb(0, 0, 0)'
				});
				document.getElementById(el.id + '_clear').addEventListener('click', function(event) {
					signaturePad.clear();
				});
			});


			$(document).ready(function() {

				$("#submitForm").click(function(){

					var formData = {};
					var valid = true;
					var text = "";

					// Iterate over form text fields
					$('form#formContainer .form-field').each(function () {

						var inputName = $(this).attr('name');
						var inputVal = $(this).val();

						if ($(this).val() === '') {
							// TODO: Notify user
							valid = false;
						}
						formData[inputName] = inputVal;
						text += inputName+",";


						console.log($(this).attr('name') +":" +$(this).val());
					});

					// Iterate over form select fields
					$('form#formContainer .form-select').each(function () {
						
						var selectName = $(this).attr('name');
						
						if (typeof selectName !== "undefined") {
							
							var selectVal = $(this).val();
							if (!selectVal || selectVal === undefined || selectVal.length == 0) {
								$(this).closest('li.step').addClass("wrong");
								valid = false;
								console.log(this);
							}
							formData[selectName] = selectVal;
							text += selectName+",";
						}

						//console.log($(this).attr('name') +":" +);
					});


					if (valid) {
						var wid = "<?php echo $wid;?>";
						var formID = "<?php echo $fid;?>";
						var responseID = "<?php echo $responseID; ?>";
						// Save response
						$.ajax({
							url: "scripts/save_response.php",
							type: "POST",
							data: {
								formData: formData,
								wid: wid,
								formID: formID,
								responseID: responseID
							},
							success: function (response, textStatus, jqXHR) {
								console.log(response);
								UIkit.notification("<span class='uk-text-bold'><?php echo $form_info['formTitle'];?></span> completed! Redirecting...", {status:'success', pos: 'top-right'});
								setTimeout(function(){
									window.location.href = 'portal.php?wid='+wid+"&tab=1";
								}, 2000);
							},
							error: function (jqXHR, textStatus, errorThrown) {
								console.log("Connection error...");
								return false;
							},
						});
					} else {
						UIkit.notification("Please answer all choice fields!", {status:'danger', pos: 'top-right'});
					}

				}); 



			});

		</script>
	</body>
</html>