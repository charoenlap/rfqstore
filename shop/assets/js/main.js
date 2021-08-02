$(function(e){
	$('#model-result-btn-submit').click(function(e){
		window.location = $(this).attr('data-url');
	});
});
function addCommas(val){
    val = (val.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    return val;
}

$(window).on('scroll', function () {
	var scroll = $(window).scrollTop();
	if (scroll < 200) {
		$("#header-sticky").removeClass("sticky-menu");
		$("#line-area").addClass("line");
		
	} else {
		$("#header-sticky").addClass("sticky-menu");
		$("#line-area").removeClass("line");
	}
});
