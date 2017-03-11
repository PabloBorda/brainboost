<script type="text/javascript">

//function getCookie        
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    document.cookie = cname + "=" + cvalue +"; path=/";
}
{literal}

	popup_id = "{/literal}{$popup_id}{literal}";


document.addEventListener('DOMContentLoaded', function(){
		var c = getCookie('prestanotifypro');

        if (c.length == 0)
        {
			Shadowbox.init({
				skipSetup: true
			});

	        var sb_content = $('#prestanotifypro').html();
			setTimeout(function(){

				setCookie("prestanotifypro", popup_id);

				// open a welcome message as soon as the window loads
				Shadowbox.open({
					content: sb_content,
					player: 'html',
					height: "{/literal}{$shadow_box_height|intval}{literal}",
					width: "{/literal}{$shadow_box_width|intval}{literal}"
				})}, "{/literal}{$shadow_box_delay_time|intval}{literal}" /* The number of milliseconds to wait before executing the code */
			);
		}
	}, false);
{/literal}
</script>