<?php
require_once '../vendor/autoload.php'; // Autoloader for classes and libraries
use Classes\DB;

$formData = $_POST['formData'];
$wid = $_POST['wid'];
$form_id = $_POST['formID'];

$filename = uniqid().".json";
$filepath = "../json/responses/".$filename;

$fp = fopen($filepath, 'w');
fwrite($fp, json_encode($formData));
fclose($fp);

DB::query('INSERT INTO form_response VALUES (\'\', :wid, :form_id, :filename)', array(":wid"=>$wid, ":form_id"=>$form_id, ":filename"=>$filename));
DB::query("UPDATE wo_forms SET completed=1 WHERE wid=:wid AND formID=:form_id", array(":wid"=>$wid, ":form_id"=>$form_id));
echo 1;

?>