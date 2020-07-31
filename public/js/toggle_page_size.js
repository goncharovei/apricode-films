$(function() {
	$('#js_toggle_page_size').change(function(){
		var size_page = $(this).val();
		if (size_page <= 0) {
			return;
		}
		
		$.cookie(
			window.pager_settings.param_name,
			size_page,
			{ expires: window.pager_settings.expires }
		);
		window.location.reload();
	});
});