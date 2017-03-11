{if (isset($waitObj->id) && $waitObj->id)}
    <span class="wait_container">
        <input type="submit" id="unsubscribe_me_{$waitObj->id}" class="exclusive_large waitsubmit" value="{l s='Unsubscribe me' mod='belvg_preorderproducts'}" name="waitsubmit">
        <input type="hidden" name="action" value="unsubscribe" />
        <input type="hidden" name="wait_id" value="{$waitObj->id}" />
    </span>
{else}
    <span class="wait_container">
        <input type="submit" class="exclusive_large waitsubmit" value="{l s='Notify me when back in stock' mod='belvg_preorderproducts'}" name="waitsubmit">
        <input type="hidden" name="action" value="subscribe" />
    </span>
{/if}