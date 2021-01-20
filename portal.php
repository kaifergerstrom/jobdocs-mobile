<?php
require_once 'vendor/autoload.php';  // Autoloader for classes and libraries

use Classes\DB;

$wid = $_GET['wid'];

$wo = getWorkOrder($wid);


function getWorkOrder($id) {
    if (!(is_numeric($id) && strlen($id) == 6)) {  // If the wid is not numeric and not of length five
        //header("Location: index.php"); // redirect to homepage
    }
    $wo = DB::query("SELECT * FROM workorders WHERE WorkOrderId=:wid", array(":wid"=>$id));
    return $wo ? $wo[0] : "";  // If the work order exists, return it
}

$address_full = $wo['StreetAddress']." ".$wo['City'].", ".$wo['State']." ".$wo['Zip'];


if(isset($_POST["submitDropzone"])) {  
    // Do something    
    print_r($_POST);
}


?>

<!DOCTYPE html>
<html lang="en" class="uk-height-1-1">
	<head>
		<title>Title</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
		<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

        <script src="js/dropzone/dist/dropzone.js"></script>
        <link rel="stylesheet" href="js/dropzone/dist/dropzone.css"/>

		<link rel="stylesheet" href="css/portal.css" />
	</head>
	<body class="uk-height-1-1">
		<div class="uk-padding-small gradient-bg uk-text-bold uk-text-large">
			JobDocs <span class="uk-text-normal">Mobile</span>
		</div>
		<div class="uk-padding uk-padding-remove-bottom">
			<h1 class="uk-text-lead uk-margin-remove uk-text-bold">Work Order <span class="uk-text-normal secondary-color">#<?php echo $wid; ?></span></h1>
			<div class="uk-margin-small-top"><span uk-icon="location"></span> <?php echo $address_full; ?></div>
			<ul class="uk-child-width-expand" uk-switcher="connect: .info-tab; swiping: false;" uk-tab>
				<li><a href="#">Details</a></li>
				<li><a href="#">Forms</a></li>
				<li><a href="#">Uploads</a></li>
			</ul>
		</div>
		<ul class="uk-switcher info-tab uk-margin">
			<li>
				<div id='workorder-map'></div>
				wassup
			</li>
			<li>
				hi
			</li>
			<li>
                <div class="uk-padding">
                   
                   
                <form id="dropzone-form" method="POST" enctype="multipart/form-data">

    <div class="uk-margin">
        <input class="uk-input" type="text" name="name" palceholder="Name" />
    </div>
    
    <div class="uk-margin">
        <input class="uk-input" type="email" name="email" palceholder="Email Address" />
    </div>

    <div id="dropzone" class="dropzone"></div>

    <div class="uk-margin-top">
        <input id="submit-dropzone" class="uk-button uk-button-primary" type="submit" name="submitDropzone" value="Submit" />
    </div>

</form>

                </div>


                <script>


                // disable autodiscover
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#dropzone", {
    url: "scripts/upload.php",
    method: "POST",
    paramName: "file",
    autoProcessQueue : false,
    acceptedFiles: "image/*",
    maxFiles: 5,
    maxFilesize: 1.0, // MB
    uploadMultiple: true,
    parallelUploads: 100, // use it with uploadMultiple
    createImageThumbnails: true,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
    addRemoveLinks: true,
    timeout: 180000,
    dictRemoveFileConfirmation: "Are you Sure?", // ask before removing file
    // Language Strings
    dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
    dictInvalidFileType: "Invalid File Type",
    dictCancelUpload: "Cancel",
    dictRemoveFile: "Remove",
    dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
    dictDefaultMessage: "Drop files here to upload",
});

myDropzone.on("addedfile", function(file) {
    //console.log(file);
});

myDropzone.on("removedfile", function(file) {
    // console.log(file);
});

// Add mmore data to send along with the file as POST data. (optional)
myDropzone.on("sending", function(file, xhr, formData) {
    formData.append("dropzone", "1"); // $_POST["dropzone"]
});

myDropzone.on("error", function(file, response) {
    console.log(response);
});

// on success
myDropzone.on("successmultiple", function(file, response) {
    // get response from successful ajax request
    console.log(response);
    // submit the form after images upload
    // (if u want yo submit rest of the inputs in the form)
    document.getElementById("dropzone-form").submit();
});


/**
 *  Add existing images to the dropzone
 *  @var images
 *
 */
 
var images = [
    /*
	{name:"image_1.jpg", url: "example/image1.jpg", size: "12345"},
	{name:"image_2.jpg", url: "example/image2.jpg", size: "12345"},
	{name:"image_2.jpg", url: "example/image2.jpg", size: "12345"},
    */
] 

for(let i = 0; i < images.length; i++) {

    let img = images[i];
    //console.log(img.url);

    // Create the mock file:
    var mockFile = {name: img.name, size: img.size, url: img.url};
    // Call the default addedfile event handler
    myDropzone.emit("addedfile", mockFile);
    // And optionally show the thumbnail of the file:
    myDropzone.emit("thumbnail", mockFile, img.url);
    // Make sure that there is no progress bar, etc...
    myDropzone.emit("complete", mockFile);
    // If you use the maxFiles option, make sure you adjust it to the
    // correct amount:
    var existingFileCount = 1; // The number of files already uploaded
    myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;

}

// button trigger for processingQueue
var submitDropzone = document.getElementById("submit-dropzone");
submitDropzone.addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.files != "") {
        // console.log(myDropzone.files);
        myDropzone.processQueue();
    } else {
	// if no file submit the form    
        document.getElementById("dropzone-form").submit();
    }

});

                </script>

			</li>
		</ul>
		<script>
			var mymap = L.map('workorder-map').setView([39.112560, -77.179110], 15);
			
			var marker = L.marker([39.112560, -77.179110]).addTo(mymap);
			
			L.tileLayer('https://tile.jawg.io/jawg-light/{z}/{x}/{y}.png?access-token=t98cJvo5COpONHFHYvQtU51EtTGrzzYLVqE8P5azaYjZyNOs8Ntae6a7RRlknB6U', {}).addTo(mymap);
			mymap.attributionControl.addAttribution("<a href=\"https://www.jawg.io\" target=\"_blank\">&copy; Jawg</a> - <a href=\"https://www.openstreetmap.org\" target=\"_blank\">&copy; OpenStreetMap</a>&nbsp;contributors")
		</script>
	</body>
</html>