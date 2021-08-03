$(function(e){
	$('#model-result-btn-submit').click(function(e){
		window.location = $(this).attr('data-url');
	});
});
function addCommas(val){
    val = (val.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    return val;
}

jQuery(document).ready(function($) {
  if($('.inputdatepicker').length){
    $('.inputdatepicker').datepicker({
        format: "dd-mm-yyyy",
        language: "th",
        autoclose: true,
        toggleActive: true,
      });
  }
});