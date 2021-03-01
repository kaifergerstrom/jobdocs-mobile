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

?>

<!DOCTYPE html>
<html lang="en" class="uk-height-1-1">
	<head>
		<title>JobDocs - Work Order #<?php echo $wid;?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- UiKit -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.10/dist/js/uikit-icons.min.js"></script>
		
		<!-- Leaflet Maps -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
		<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
		
		<!-- JQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

		<!-- Custom Stylesheets -->
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="css/portal.css" />

		<!-- DropZone.js -->
		<link rel="stylesheet" href="js/dropzone/dist/dropzone.css"/>
		<script src="js/dropzone/dist/dropzone.js"></script>

	</head>
	
	<body class="uk-height-1-1">

		<div class="uk-padding-small gradient-bg uk-text-bold uk-text-large uk-text-center">
			JobDocs <span class="uk-text-normal">Mobile</span>
		</div>
		
		<div class="uk-padding uk-padding-remove-bottom">
			<h1 class="uk-text-lead uk-margin-remove uk-text-bold">Work Order <span class="uk-text-normal secondary-color">#<?php echo $wid; ?></span></h1>
			<div class="uk-margin-small-top"><span uk-icon="location"></span> <?php echo $address_full; ?></div>
			<ul class="uk-child-width-expand" uk-switcher="connect: .info-tab; swiping: false;" uk-tab>
				<li id="details-tab"><a href="#">Details</a></li>
				<li id="forms-tab"><a href="#">Forms</a></li>
				<li id="uploads-tab"><a href="#">Uploads</a></li>
				<li id="submit-tab"><a href="#">Verify & Submit</a></li>
			</ul>
		</div>
		
		<ul id="mobile-switcher" class="uk-switcher info-tab uk-margin">

			<!-- Work Order Details Tab -->
			<li>
				<div id='workorder-map'></div>

				<div class="uk-grid-divider uk-child-width-1-4@m uk-grid-small uk-grid-match uk-padding uk-text-center" uk-grid>
					<div>
						<div>
							<h3 class="uk-card-title secondary-color uk-margin-small-bottom">Work Requested</h3>
							<p class="uk-margin-remove-top uk-text-italic"><?php echo $wo['WorkRequested']; ?></p>
						</div>
					</div>
					<div>
						<div>
							<h3 class="uk-card-title secondary-color uk-margin-small-bottom">Site Name</h3>
							<p class="uk-margin-remove-top uk-text-italic"><?php echo $wo['SiteName']; ?></p>
						</div>
					</div>
					<div>
						<div>
							<h3 class="uk-card-title secondary-color uk-margin-small-bottom">Work Order Status</h3>
							<p class="uk-margin-remove-top uk-text-italic"><?php echo $wo['WOStatus']; ?></p>
						</div>
					</div>
					<div>
						<div>
							<h3 class="uk-card-title secondary-color uk-margin-small-bottom">Work Code</h3>
							<p class="uk-margin-remove-top uk-text-italic"><?php echo $wo['WorkCode']; ?></p>
						</div>
					</div>
				</div>

			</li>

			<!-- Form Requirements Tab -->
			<li>
				<div class="uk-container uk-container-large">
					<?php include("includes/forms.php");?>
				</div>
			</li>

			<!-- Photo/File Upload Tab -->
			<li>

				<div class="uk-container uk-container-large">
					<h1 class="uk-heading-bullet uk-text-lead uk-text-bold uk-margin-medium-top">File Upload</h1>
					<p class="uk-text-meta">Attach all work order related content (images & videos)</p>
					 

					<?php
						// Load uploaded images
						$result = [];
						if ($uploads = DB::query("SELECT path FROM uploads WHERE wid=:wid", array(":wid"=>$wid))) {
							$uploads_path = "../jobdocs/uploads/".$wid;
							foreach ($uploads as $upload) {
								$obj['name'] = $upload['path'];
								$obj['size'] = filesize($uploads_path."/".$upload['path']);
								$result[] = $obj;
							}       
						}
					?>

					<form action="scripts/upload.php" class="dropzone" id="workorder-upload">
						<div class="dz-message" data-dz-message>
							<span class="uk-margin-small-right uk-text-large uk-display-block uk-margin-small-bottom" uk-icon="icon: upload; ratio: 2"></span>
							<p class="uk-margin-small-top uk-margin-small-bottom">Drag files to upload</p>
							<p class="uk-margin-remove uk-text-meta">Or, <span class="secondary-color">click here</span> to select a file</p>
						</div>
					</form>

					<script>
					
					/* ---- Preload images ---- */
					var myDropzone = new Dropzone("#workorder-upload", { url: "scripts/upload.php", 
						// Send wid in post
						init: function() {
							this.on("sending", function(file, xhr, formData){
									formData.append("id", "<?php echo $wid;?>");
							});
						}
					});

					myDropzone.on("addedfile", function(file) {
						$("#file-upload-count").text($(".dz-preview").length);
						$("#no-uploads").replaceWith('<span class="uk-margin-small-right" uk-icon="check"></span>');
						$("#file-upload-td").removeClass('uk-text-danger');
						$("#file-upload-td").addClass("uk-text-success");
					});
			
					var files = JSON.parse(`<?php echo json_encode($result); ?>`);

					$.each(files, function(key,value){

						var ext = value.name.split('.').pop();
						var valid = ["gif", "jpeg", "jpg", "png", "webp"]

						var mockFile = { name: value.name, size: value.size };
						myDropzone.emit("addedfile", mockFile);

						if (valid.includes(ext)) {
							myDropzone.emit("thumbnail", mockFile, "../jobdocs/uploads/<?php echo $wid;?>/"+mockFile.name);
						}
						myDropzone.emit("processing", mockFile);
						
						myDropzone.emit("complete", mockFile);

					});
					</script>

				</div>

			</li>
				<div class="uk-container uk-container-large">
					<h1 class="uk-heading-bullet uk-text-lead uk-text-bold uk-margin-medium-top">Verify & Submit Work Order</h1>
					<table class="uk-table uk-table-divider  uk-table-hover">
						<tbody>
							<?php
								$upload_count = count(DB::query("SELECT id FROM uploads WHERE wid=:wid", array(":wid"=>$wid)));
								$completed_count = count(DB::query("SELECT id FROM wo_forms WHERE wid=:wid AND completed=1", array(":wid"=>$wid)));
								$form_count = count(DB::query("SELECT id FROM wo_forms WHERE wid=:wid", array(":wid"=>$wid)));
							?>
							<tr>
								<td class="uk-text-italic">Required Forms</td>
								<td class="uk-text-bold <?php echo $completed_count==$form_count ? "uk-text-success" : "uk-text-danger";?>"><?php echo $completed_count;?>/<?php echo $form_count;?> <?php echo $completed_count==$form_count ? '<span class="uk-margin-small-right" uk-icon="check"></span>' : '<span class="uk-margin-small-right" uk-icon="close"></span>';?></td>
							</tr>
							<tr>
								<td class="uk-text-italic">Uploads</td>
								<td id="file-upload-td" class="uk-text-bold <?php echo $upload_count == 0 ? 'uk-text-danger' : 'uk-text-success';  ?>"><span id="file-upload-count"><?php echo $upload_count; ?></span> Files <?php echo $upload_count == 0 ? '<span class="uk-margin-small-right" uk-icon="close" id="no-uploads"></span>' : '<span class="uk-margin-small-right" uk-icon="check"></span>'; ?></td>
							</tr>
						</tbody>
					</table>

					<?php
					$disabled = False; 
					if ($completed = DB::query("SELECT status FROM wo_requests WHERE wid=:wid ORDER BY request_date DESC", array(":wid"=>$wid))) {
						if ($completed[0]['status'] == 1 || $completed[0]['status'] == 3) {
							$disabled = True;
						}
					}
					?>

					<button class="uk-button <?php echo $disabled ? "" : "secondary-btn";?>" id="submitWorkOrder" <?php echo $disabled ? "disabled" : "";?>>Submit Work Order</button>
				</div>
			<li>

			</div>
			
		</ul>

		<script>
		
		$(document).ready(function() {

		$("#submitWorkOrder").click(function(){

			$.ajax({
				url: "scripts/submit_check.php",
				type: "POST",
				data: {
					wid: "<?php echo $wid; ?>",
				},
				success: function (response, textStatus, jqXHR) {
					if (response == "1") {
						UIkit.modal("#submit-workorder-modal").show();
					} else {
						UIkit.notification(response, {status:'danger', pos: 'top-right'});
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log("Connection error...");
					return false;
				},
			});

		}); 

		

		
		var tab = <?php echo isset($_GET['tab']) ? $_GET['tab'] : "-1";?>;
		if (tab != -1 && tab < 4) {
			$("#details-tab").removeAttr('class', 'uk-active');
			UIkit.switcher("#mobile-switcher").show(tab);
			switch(tab) {
				case 0:
					$("#details-tab").attr('class', 'uk-active');
					break;
				case 1:
					$("#forms-tab").attr('class', 'uk-active');
					break;
				case 2:
					$("#uploads-tab").attr('class', 'uk-active');
					break;
				case 3:
					$("#submit-tab").attr('class', 'uk-active');
					break;
				default:
					$("#details-tab").attr('class', 'uk-active');

			}
			
		}
	



	});

	
		
		</script>

		<script src="js/wo-map.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
		
		<div id="submit-workorder-modal" uk-modal>
			<div class="uk-modal-dialog">
				<button class="uk-modal-close-default" type="button" uk-close></button>
				<div class="uk-modal-header">
					<h2 class="uk-modal-title">Are You Sure?</h2>
				</div>
				<div class="uk-modal-body">
					<p>Take a moment to verify all provided information is correct.</p>
				</div>
				<div class="uk-modal-footer uk-text-right">
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
					<a href="submit.php?wid=<?php echo $wid;?>" class="uk-button secondary-btn" uk-toggle>Submit</a>
				</div>
			</div>
		</div>

	</body>
</html>