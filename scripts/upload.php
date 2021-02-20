<?php
require_once '../vendor/autoload.php'; // Autoloader for classes and libraries
use Classes\DB;

$wid = $_POST['id'];

$uploadDir = '../../jobdocs/uploads/' . $wid;

if (!file_exists($uploadDir))
{
    mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES))
{
    $tmpFile = $_FILES['file']['tmp_name'];

    // Format filename
    $filename = time() . '-' . $_FILES['file']['name'];
    $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
    $filename = mb_ereg_replace("([\.]{2,})", '', $filename);

    $filepath = $uploadDir . '/' . $filename;
    if (move_uploaded_file($tmpFile, $filepath))
    {
        DB::query('INSERT INTO uploads VALUES(\'\', :wid, :path, :description, :type, :date)', array(
            ":wid" => $wid,
            ":path" => $filename,
            ":description" => "Detailed Work Site Image",
            ":type" => "Image",
            ":date" => date('Y-m-d H:i:s')
        ));
    }
}

?>
