<h3>
	<i class="icon-link"></i> {l s='Configure' mod='prestanotifypro'}
</h3>

<div class="form-group clearfix">
	<label for="form-field-1" class="col-sm-2 control-label">
		{l s='Select your lang' mod='prestanotifypro'}
	</label>
	<div class="col-sm-2">
		<select id="img_select_lang" name="img_select_lang" class="selectpicker show-menu-arrow show-tick" data-show-subtext="true">
			{foreach $lang_select as $lang}
				<option value="{$lang.id|intval}" {if !empty($lang.subtitle)}data-subtext="{$lang.subtitle|escape:'htmlall':'UTF-8'}"{/if} data-icon="icon-flag" {if $default_lang == $lang.id}selected="selected"{/if}>{$lang.title|escape:'htmlall':'UTF-8'}</option>
			{/foreach}
		</select>
	</div>
</div>
<div class="clearfix"/></div>


<div class="table-responsive clearfix">
	<div class="row-fluid">
		<div class="col-sm-12 col-md-12 col-lg-12">
			{include file='../table/table.tpl' role='images' type=$default_lang}
			<div id="footer-table-images" class="panel-footer">
				<a data-role="upload" data-type="image" data-table="table-images" href="#" class="btn btn-default pull-right"><i class="process-icon-new icon-plus"></i> {l s='Upload images' mod='prestanotifypro'}</a>
			</div>
		</div>
	</div>
</div>
<!-- <div id="table-notif-1" class="panel-footer{if $uncinq} panel-footer-uncinq{/if}">
	<a data-role="upload" data-type="image" href="#" class="btn btn-default pull-right"><i class="process-icon-new {if $ps_version == 0}icon-plus{/if}"></i> {l s='Upload images' mod='prestanotifypro'}</a>
</div> -->