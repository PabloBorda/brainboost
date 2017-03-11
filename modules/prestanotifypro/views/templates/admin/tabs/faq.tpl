<h3>{l s='Frequently Asked Questions' mod='prestanotifypro'}</h3>
<div class="faq items">
	<ul id="basics" class="faq-items">
		<li class="faq-item">
			<a class="faq-trigger" >1. What I have to do to configure a pop up in my store?</a>
			<div class="faq-content">
				- First, Upload a picture from Image manager tab. You can upload different images for each language!<br />
				- Create a notification on configuration tab. Click on Add a notification button.<br />
				- Select an image and fill a link for each language. <br />
				- Enable notification from the notification list. <br />
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger" >2. What size do I need to make the graphic?</a>
			<div class="faq-content">
				The maximal filesize for the image depends on your server settings. <br />
				You can see the maximal filesize allowed by your server on Image manager tab / Upload images / Image to upload <br />
				<img src="{$img_path}FAQ-2.png">
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger" >3. What dimension do I set up?</a>
			<div class="faq-content">
				The default dimension is 500x500 px. However you can set up any other dimensions that suit better to your image. 
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger" >4. How often the pop up will be displayed in my store for the same visitor?</a>
			<div class="faq-content">
				In order to apply the recommended best practices for these advertising formats, once the visitor closes the pop-in, it will no longer be displayed in this browser session.
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger" >5. The pop up will be displayed only on the home page? Or will it appears if the customer reachs another page directly?</a>
			<div class="faq-content">
				The popup will be displayed ONCE per session (see below for session definition) whatever the customer's first page is.
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger" >6. My Popup doesnt show?</a>
			<div class="faq-content">
				Please make sure you activated the popup in the configuration tab. It's the first setting.<br />
				<img src="{$img_path}FAQ-6.png">
				Also, the module has 2 special features :<br />
				- A 15 minutes cache.<br />
				- A session cookie.<br /><br />
				Please, note that the pop up is displayed only once per browser session. So, you need to use the "CLEAR CACHE" button and refresh your front office in order to see your pop up again in the same browser session.<br /><br />
				If you still cannot see the pop up, go to contact tab and send us in your message an access to your backoffice and FTP. 
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger">7. What's the cache and what about the 15 minutes thing?</a>
			<div class="faq-content">
				The cache is a saving system that increases the module's performance so that if you have a lot of traffic, the loading is better.<br />
				The 15 minutes means we delete and regenerate the cache every 15 minutes in case you make modifications on your popups.
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger">8. What's a session cookie?</a>
			<div class="faq-content">
				The session cookie allows us to display the popup once per session to avoid spaming the customers.<br />
				A session starts when the customer reachs your website, to the moment he closes his browser.<br />
				So when the customer leaves your website and comes back (without closing browser), the popup WILL NOT show again.<br />
				But if he closes his browser, the popup will show up.
			</div> 
		</li>
		<li class="faq-item">
			<a class="faq-trigger">9. I've made modifications to my active popup but it's not applied in Front Office!</a>
			<div class="faq-content">
				Yes. It is normal. It's because of the 15 minutes cache. In this case, remember to use the "CLEAR CACHE" button.
		</li>
		<li class="faq-item">
			<a class="faq-trigger">10. Popup comes, but only a white image appears. Why is it happening? </a>
			<div class="faq-content">
				Please make sure you uploaded a picture for each language activated on your shop.
		</li>
		<li class="faq-item">
			<a class="faq-trigger">11. I got a message error regarding server permissions. What I have to do? </a>
			<div class="faq-content">
				Please, change file rights on your server using your FTP details, go to modules/prestanotifypro and then check that rights are set to 777 in the cache directory (right click > properties > permissions). Please make sure you applied the rights recursively.
		</li>
		<li class="faq-item">
			<a class="faq-trigger">12. When I try to save an image or add a new notification, the module does nothing.</a>
			<div class="faq-content">
				Please, check that the exif_imagetype function is enabled on your server.
		</li>
	</ul>
</div>
