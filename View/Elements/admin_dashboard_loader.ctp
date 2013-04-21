$(document).ready(function(){
	//load content
	$.get('/admin/seo/dashboard', null, function(data){
		$('#inner-content').after(data);
	});

});