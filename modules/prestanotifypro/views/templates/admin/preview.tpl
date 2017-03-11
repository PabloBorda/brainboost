<div>
	<div id="prestanotifypro">
		{if $prestanotifypro_type == 'image'}
			{if isset($no_file) && !empty($no_file)}
				{$no_file}
			{else}
			<a href="{$shadow_box_content_link}">
				<img src="{$prestanotifypro_img_path}{$shadow_box_content|escape:'htmlall':'UTF-8'}" alt="" width="100%" data-width="{$shadow_box_width|intval}" data-height="{$shadow_box_height|intval}"/>
			</a>
			{/if}
		{else}

		{/if}
	</div>
</div>