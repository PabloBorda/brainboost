<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_floating_style  addthis_32x32_style clearfix">
<a class="addthis_button_facebook at300b"></a>
<a class="addthis_button_twitter at300b"></a>
<a class="addthis_button_google_plusone_share at300b"></a>
<a class="addthis_button_pinterest_share at300b"></a>
<a class="addthis_button_email at300b"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript">var addthis_config = { "data_track_addressbar":true };</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid={$pubid}"></script>
<!-- AddThis Button END -->
<script>
$(document).ready(function() {
	$(window).scroll(function() {  
		var y 			= $(window).scrollTop();
		var eleTop 	= $('#usefull_link_block').offset().top-120;
		var eleOff 	= $(".addthis_toolbox");
		if (y < (eleTop-100))	eleOff.fadeIn(500); 
		else 					eleOff.fadeOut(500);
	});
});
</script>