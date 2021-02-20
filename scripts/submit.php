<?php
require_once '../vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_POST['wid'];

if (DB::query("SELECT id FROM wo_forms WHERE wid=:wid AND completed=0", array(":wid"=>$wid))) {
	echo "Complete all assigned forms!";
} else {
	$upload_count = count(DB::query("SELECT id FROM uploads WHERE wid=:wid", array(":wid"=>$wid)));
	if ($upload_count == 0) {
		echo "No files uploaded...";
	} else {
		echo 1;
	}
}
/*
if (DB::query("SELECT id FROM wo_requests WHERE wid=:wid", array(":wid"=>$wid))) {
	DB::query("UPDATE wo_requests SET status=1 WHERE wid=:wid", array(":wid"=>$wid));
} else {
	DB::query('INSERT INTO wo_requests VALUES(\'\', :wid, 1, \'\')', array(":wid"=>$wid));
}
header("Location: index.php");
*/

?>