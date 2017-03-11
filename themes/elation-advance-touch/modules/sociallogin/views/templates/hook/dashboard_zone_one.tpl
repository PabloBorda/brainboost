{*
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*}

<section id="sociallogin" class="panel widget{if $allow_push} allow_push{/if}">
    <div class="panel-heading">
		<i class="icon-time"></i> {l s='Social Login Registering' mod='sociallogin'}
	</div>
    <section id="_customers" class="loading">
    		<header><i class="icon-user"></i> {l s='Customers & Social Networks' mod='sociallogin'} <span class="subtitle small" id="social-customers-subtitle"></span></header>
    		<ul class="data_list">
    			<li>
    				<span class="data_label"><a href="{$link->getAdminLink('AdminCustomers')|escape:'html':'UTF-8'}">{l s='New Customers' mod='sociallogin'}</a></span>
    				<span class="data_value size_md">
    					<span id="social_new_customers"></span>
    				</span>
    			</li>
                <li>
                    <span class="data_label">{l s='Networks' mod='sociallogin'}</span>
                    <ul class="data_list_small">
                        {foreach $networks as $network}
            			<li>
            				<span class="data_label">{$network|escape:'htmlall':'UTF-8'|capitalize}</span>
            				<span class="data_value size_md">
            					<span id="{$network|escape:'htmlall':'UTF-8'}"></span>
            				</span>
            			</li>
                        {/foreach}
                    </ul>
                </li>
    		</ul>
    	</section>
</section>
<script type="text/javascript">
	date_subtitle = "{$date_subtitle|escape:'html':'UTF-8'}";
	date_format   = "{$date_format|escape:'html':'UTF-8'}";
</script>
{literal}
<script type="text/javascript">
    $(document).ready(function() {
    	if (typeof date_subtitle === "undefined")
    		var date_subtitle = '(from %s to %s)';

    	if (typeof date_format === "undefined")
    		var date_format = 'Y-mm-dd';

    	$('#date-start').change(function() {
    		start = Date.parseDate($('#date-start').val(), 'Y-m-d');
    		end = Date.parseDate($('#date-end').val(), 'Y-m-d');
    		$('#social-customers-subtitle').html(sprintf(date_subtitle, start.format(date_format), end.format(date_format)));
    	});

    	$('#date-end').change(function() {
    		start = Date.parseDate($('#date-start').val(), 'Y-m-d');
    		end = Date.parseDate($('#date-end').val(), 'Y-m-d');
    		$('#social-customers-subtitle').html(sprintf(date_subtitle, start.format(date_format), end.format(date_format)));
    	});
    });
</script>
{/literal}