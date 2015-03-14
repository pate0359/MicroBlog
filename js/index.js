//MyWidget Script
/**************************
Add a link for a CSS file that styles .mywidget
Add a script tag that points to CDN version of jQuery 1.*
Add a script tag that loads your script file from http://m.edumedia.ca/
**************************/
document.addEventListener("DOMContentLoaded", function(){

	//carousel
	$('#carousel').carousel({ interval: 3000, cycle: true });
	
	//Drop down selection
	$(".dropdown-menu li a").click(function(){
		  $(this).parents(".input-group-btn").find('.btn').text($(this).text());
		  $(this).parents(".input-group-btn").find('.btn').val($(this).data('value'));
		});
	
	var jumboHeight = $('.jumbotron').outerHeight();
		function parallax(){
			var scrolled = $(window).scrollTop();
			$('.bg').css('height', (jumboHeight-scrolled) + 'px');
		}
		
		$(window).scroll(function(e){
			parallax();
		});
});