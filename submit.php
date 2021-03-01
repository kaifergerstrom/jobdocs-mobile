<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

date_default_timezone_set('US/Eastern');
$date = date('Y-m-d H:i:s');

$wid = $_GET['wid'];

DB::query('INSERT INTO wo_requests VALUES(\'\', :wid, 1, \'\', :request_date)', array(":wid"=>$wid, ":request_date"=>$date));

setcookie("wo_submit", "1", time() + (86400 * 30), "/");
header("Location: index.php");

?>