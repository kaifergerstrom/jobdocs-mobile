var stepperDiv = document.querySelector('.stepper');
console.log(stepperDiv);
var stepper = new MStepper(stepperDiv);

$(document).ready(function() {

$('select').material_select();

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


$(function(){
    $('input.form-control').change(function(e){
		$(this).closest(".input-field").find("#textfield-error").remove();
		$(this).removeClass("invalid");
		$(this).addClass("valid");
    });
});

$("#submitForm").click(function(){

	var formData = {};
	var valid = true;
	var text = "";

	// Iterate over form text fields
	$('form#formContainer input.form-control').each(function () {

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

	$('form#formContainer input.form-control').each(function () {
		if( !$(this).val() ) {
			$(this).addClass('invalid');
			$(this).closest('li.step').removeClass("done");
			$(this).closest('li.step').addClass("wrong");
			
			$('<label id="textfield-error" class="invalid" for="textfield">This field is required.</label>').insertAfter(this);
		}
	});
	

	// Iterate over form select fields
	$('form#formContainer .form-select').each(function () {
		
		var selectName = $(this).attr('name');
		
		if (typeof selectName !== "undefined") {
			
			var selectVal = $(this).val();
			if (!selectVal || selectVal === undefined || selectVal.length == 0) {
				$(this).closest('li.step').addClass("wrong");
				valid = false;
			}
			formData[selectName] = selectVal;
			text += selectName+",";
		}
		
	});
	

	if (valid) {
		
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
				UIkit.notification("<span class='uk-text-bold'>"+formTitle+"</span> completed! Redirecting...", {status:'success', pos: 'top-right'});
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
		UIkit.notification("Please answer all fields!", {status:'danger', pos: 'top-right'});
	}

}); 



});