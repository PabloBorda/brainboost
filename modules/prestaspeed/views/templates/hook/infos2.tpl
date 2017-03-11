{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* No redistribute in other sites, or copy.
*
*  @author RSI <rsi_2004>
*  @copyright  2007-2016 RSI
*} 
{literal}
	<script>
		var bar = $('span');
var p = $('p');

var width = bar.attr('style');
width = width.replace("width:", "");
width = width.substr(0, width.length-1);


var interval;
var start = 0; 
var end = parseInt(width);
var current = start;

var countUp = function() {
  current++;
  p.html(current + "%");
  
  if (current === end) {
    clearInterval(interval);
  }
};

interval = setInterval(countUp, (1000 / (end + 1)));
	</script>
	
	<style type="text/css">
div.meter {
  position: relative;
  width: 510px;
  height: 25px;
  border: 1px solid #b0b0b0;
 
  /* viewing purposes */
  -webkit-box-shadow: inset 0 3px 5px 0 #d3d0d0;
  -moz-box-shadow: inset 0 3px 5px 0 #d3d0d0;
  box-shadow: inset 0 3px 5px 0 #d3d0d0;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
}
div.meter span {
  display: block;
  height: 100%;
  animation: grower 1s linear;
  -moz-animation: grower 1s linear;
  -webkit-animation: grower 1s linear;
  -o-animation: grower 1s linear;
  position: relative;
  top: -1px;
  left: -1px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: inset 0px 3px 5px 0px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: inset 0px 3px 5px 0px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0px 3px 5px 0px rgba(0, 0, 0, 0.2);
  border: 1px solid #3c84ad;
  background: #6eb2d1;
  background-image: -webkit-gradient(linear, 0 0, 100% 100%, color-stop(0.25, rgba(255, 255, 255, 0.2)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.2)), color-stop(0.75, rgba(255, 255, 255, 0.2)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
  background-image: -ms-linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
  background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
  -webkit-background-size: 45px 45px;
  -moz-background-size: 45px 45px;
  -o-background-size: 45px 45px;
  background-size: 45px 45px;
}
div.meter span:before {
  content: '';
  display: block;
  width: 100%;
  height: 50%;
  position: relative;
  top: 50%;
  background: rgba(0, 0, 0, 0.03);
}
div.meter p {
  position: absolute;
  top: 0;
  margin: 0 10px;
  line-height: 25px;
  font-family: 'Helvetica';
  font-weight: bold;
  -webkit-font-smoothing: antialised;
  font-size: 15px;
  color: #333;
  text-shadow: 0 1px rgba(255, 255, 255, 0.6);
}

@keyframes grower {
  0% {
    width: 0%;
  }
}

@-moz-keyframes grower {
  0% {
    width: 0%;
  }
}

@-webkit-keyframes grower {
  0% {
    width: 0%;
  }
}

@-o-keyframes grower {
  0% {
    width: 0%;
  }
}
	</style>

    {/literal}
<div class="alert alert-message"> 

<div class="meter">
  <span style="width:{$percent|escape:'htmlall':'UTF-8'}%"></span>
 <p>{l s='Site load time:' mod='prestaspeed'}{$loadtime|string_format:"%.2f"|escape:'htmlall':'UTF-8'}{l s=' seconds' mod='prestaspeed'}</p>
</div>
<p>{l s='Speed time on front office' mod='prestaspeed'}</p>
<br/>
<p><span style="color:#093; font-weight:bolder">Tip: </span>{l s='If enable back office optimization, sometimes you dont see the changes in cms. Simply, disable BO optimization.' mod='prestaspeed'}</p>
<p><span style="color:#093; font-weight:bolder">Tip: </span>{l s='If you get 0kb optimized in images, run the module without ssl and disable media servers. If still gets 0kb, use the cron option to optimize the images' mod='prestaspeed'}</p>
<p><span style="color:#093; font-weight:bolder">Tip: </span>{l s='If the optimization process of the images don`t finish, and you see a white screen or an internal server error, just press F5 until you back to the module configuration.Remember, image optimization uses smushit service, if the service is down, Prestaspeed can`t optimize the images.' mod='prestaspeed'}</p><br/>
<center><img src="{$module_dir|escape:'htmlall':'UTF-8'}views/img/readme.png" style="  width: 31px;margin: 5px;" /><a href="{$module_dir|escape:'htmlall':'UTF-8'}moduleinstall.pdf" target="_blank">README</a> / 
		<img src="{$module_dir|escape:'htmlall':'UTF-8'}views/img/terms.png" style="  width: 31px;margin: 5px;" /><a href="{$module_dir|escape:'htmlall':'UTF-8'}termsandconditions.pdf" target="_blank">TERMS</a></center><br/>

</div>
