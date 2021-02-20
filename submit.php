<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_GET['wid'];


if (DB::query("SELECT id FROM wo_requests WHERE wid=:wid", array(":wid"=>$wid))) {
	DB::query("UPDATE wo_requests SET status=1 WHERE wid=:wid", array(":wid"=>$wid));
} else {
	DB::query('INSERT INTO wo_requests VALUES(\'\', :wid, 1, \'\')', array(":wid"=>$wid));
}
//header("Location: index.php");

?>