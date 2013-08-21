$(function(){
	$(".navbar-nav a[href='"+document.location.pathname+"']").parent().addClass('active');
	$(".navbar-nav a[href='"+document.location.href+"']").parent().addClass('active');
	
	// Rating tooltip
	$("*[data-toggle='tooltip']").tooltip();
	
	// Dedicate/Report modals
	$('.dedicate,.report').click(function(){
		$(".SongId").val($(this).data('id'));
		$(".SongTitle").text($(this).data('songtitle'));
	});
});
