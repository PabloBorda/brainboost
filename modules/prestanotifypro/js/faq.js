$(function() {
	$('.faq-item').click(
		function(){
			if($(this).find('.faq-content').is(':visible'))
				$(this).find('.faq-content').hide('fast');
			else
			{
				$('.faq-content').hide('fast');
				$(this).find('.faq-content').show('fast');
			}
			console.log($(this).find('.faq-content'));
		}
	);
});