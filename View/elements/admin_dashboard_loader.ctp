$(document).ready(function(){
	//load content
	$.get('/admin/seo/dashboard', null, function(data){
		$('#content .dashboard h2').after(data);
	});

});