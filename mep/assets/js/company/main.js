$(function(e){
	// $('#form-company-add').submit(function(e){
	// 	var formData = new FormData(this);
	// 	var form = $(this);
	// 	$.ajax({
	// 		url: form.attr('action'),
	// 		type: 'POST',
	// 		dataType: 'json',
	// 		data: formData,
	// 		cache: false,
	//         contentType: false,
	//         processData: false
	// 	})
	// 	.done(function(json) {
	// 		$('#model-result').modal('toggle');
	// 		$('#model-result-title').text(json.result);
	// 		$('#model-result-text').text(json.result_text);
	// 		$('#model-result-btn-submit').attr('data-url','index.php?route=home');
	// 		console.log("success");
	// 	})
	// 	.fail(function(xhr, ajaxOptions, thrownError) {
	// 		console.log(xhr.responseText);
	// 		console.log(xhr);
	// 		console.log(ajaxOptions);
	// 		console.log(thrownError);
	// 	})
	// 	.always(function() {
	// 		console.log("complete");
	// 	});
	// 	e.preventDefault();
	// });
	$('#form-company-edit').submit(function(e){
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.done(function(json) {
			$('#model-result').modal('toggle');
			if(json.result == "success"){
				$('#model-result-title').text(json.result);
				$('#model-result-text').text(json.result_text);
				$('#model-result-btn-submit').attr('data-url','index.php?route=home');
			}else{
				$('#model-result-title').text(json.result);
				$('#model-result-text').text(json.result_text);
				$('#model-result-btn-submit').attr('data-url','index.php?route=editCompany&id_company='+$id_company);
			}
			console.log("success");
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		e.preventDefault();
	});
});