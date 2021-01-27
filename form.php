<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_GET['wid'];
$fid = $_GET['fid'];




$date = date("D M d, Y G:i A", time());

$form_info = DB::query("SELECT formTitle, formDesc, formJSON FROM forms WHERE formID=:formID", array(":formID"=>$fid))[0];

$formFile = file_get_contents("json/".$form_info['formJSON']);
$formStructure = json_decode($formFile, true);
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
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
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

        <div class="uk-padding-small gradient-bg uk-text-bold uk-text-large uk-text-center">
			<a class="uk-link-reset" href="portal.php?wid=<?php echo $wid;?>">JobDocs <span class="uk-text-normal">Mobile</span></a>
</div>

        <div class="uk-padding">

        <h1 class=" uk-text-large uk-text-bold uk-margin-remove-bottom"><?php echo $form_info['formTitle'];?></h1>
        <p class="uk-margin-small-top uk-margin-small-bottom uk-text-meta"><?php echo $form_info['formDesc']; ?></p>

        <hr>

            <div class="section scrollspy" id="non-linear">
                <div class="card-content">
                    <form action="" type="POST">
                        <ul class="stepper">

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

                                echo '
                                <div class="input-field col s12">';

                                switch ($field['type']) {
                                    case "string":
                                        echo '<input name="'.$label.'" type="text" class="validate" '.$max_length.' required>';
                                        echo '<label for="'.$label.'">'.$formattedLabel.'</label>';
                                    break;

                                    case "number":
                                        echo '<input name="'.$label.'" type="text" class="validate" '.$max_length.' required>';
                                        echo '<label for="'.$label.'">'.$formattedLabel.'</label>';
                                    break;

                                    case "select":
                                        $multiple = isset($field['multiple']) && $field['multiple'] ? "multiple" : "";
                                        echo '<select '.$multiple.' required>';
                                        echo '<option value="" disabled selected>'.$formattedLabel.'</option>';
                                        foreach ($field['enum'] as $option) {
                                            echo '<option value="'.$option.'">'.$option.'</option>';
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
                                        echo '<input name="'.$label.'" type="date" class="datepicker" required>';
                                    break;

                                    case "time":
                                        echo '<p class="uk-margin-remove uk-text-muted mini-label">'.$formattedLabel.'</p>';
                                        echo '<input name="'.$label.'" type="time" class="datepicker" required>';
                                    break;

                                    case "time":
                                        echo '<p class="uk-margin-remove uk-text-muted mini-label">'.$formattedLabel.'</p>';
                                        echo '<input name="'.$label.'" type="time" class="datepicker" required>';
                                    break;
                                }

                                echo '</div>';

                                $i++;
                                
                            }
                            

                            echo '
                            <div class="step-actions">
                                <button class="uk-button secondary-btn uk-margin-small-right next-step">CONTINUE</button>
                                <button class="uk-button previous-step">BACK</button>
                            </div>
                                </div>
                            </li>
                            ';
                        }
                        
                        ?>

                        <li class="step">
                            <div class="step-title waves-effect waves-dark">Verify & Submit</div>
                            <div class="step-content">
                                <p class="uk-text-muted uk-margin-top uk-margin-remove-bottom">I confirm that all the information supplied in this form is valid and truthful.</p>
                                <div class="step-actions">
                                    <button class="uk-button secondary-btn next-step" type="submit">SUBMIT</button>
                                </div>
                            </div>
                        </li>
                            
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
        $(document).ready(function() {
            $('select').material_select();
        });
        </script>
        <script src="js/stepper.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

        <script>

var signature_pads = document.getElementsByClassName("signature-pad");
Array.prototype.forEach.call(signature_pads, function(el) {
    var signaturePad = new SignaturePad(el, {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
        });
        console.log(document.getElementById(el.id+'_clear'));
        document.getElementById(el.id+'_clear').addEventListener('click', function (event) {
            signaturePad.clear();
        });

});




        </script>
	</body>
</html>