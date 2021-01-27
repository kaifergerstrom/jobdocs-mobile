<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$forms = DB::query("SELECT formID, completed FROM wo_forms WHERE wid=:wid",array(":wid"=>$wid));

?>
<div>   
    <h1 class="uk-heading-bullet uk-text-lead uk-text-bold uk-margin-medium-top">Required Work Order Forms <span class="uk-badge secondary-bg uk-text-bold">5</span></h1>

    <ul class="uk-subnav" uk-margin>
        <li><a href="#">Add Form</a></li>
        <li><a href="#">Remove Form</a></li>
    </ul>

    <?php
    foreach ($forms as $form) {

        $form_info = DB::query("SELECT formTitle, formDesc FROM forms WHERE formID=:formID", array("formID"=>$form['formID']))[0];
        $complete_text = $form['completed'] == 0 ? "In Progress" : "Completed";
        $complete_style = $form['completed'] == 0 ? "secondary-bg" : "success-bg";
        $complete_text_style = $form['completed'] == 0 ? "secondary-color" : "disable-link uk-text-muted";

        echo '
        <div>
            <a class="uk-link-heading '.$complete_text_style.' uk-text-lead uk-margin-remove" href="form.php?wid='.$wid.'&fid='.$form['formID'].'">'.$form_info['formTitle'].' <span class="uk-badge '.$complete_style.' uk-float-right uk-text-bold">'.$complete_text.'</span></a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <hr>
        ';
    }

    ?>
</div>

