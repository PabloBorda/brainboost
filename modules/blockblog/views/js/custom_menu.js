/**
 * StorePrestaModules SPM LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 *
 /*
 * 
 * @author    StorePrestaModules SPM
 * @category content_management
 * @package blockblog
 * @copyright Copyright StorePrestaModules SPM
 * @license   StorePrestaModules SPM
 */

function delete_img(item_id){
	
	if(confirm("Are you sure you want to remove this item ?"))
	{
	$('#post_images_list').css('opacity',0.5);
	$.post('../modules/blockblog/ajax.php', {
		action:'deleteimg',
		item_id : item_id
	}, 
	function (data) {
		if (data.status == 'success') {
		$('#post_images_list').css('opacity',1);
		$('#post_images_list').html('');
			
		} else {
			$('#post_images_list').css('opacity',1);
			alert(data.message);
		}
		
	}, 'json');
	}

}

function tabs_custom(id){
	
	for(i=0;i<100;i++){
		$('#tab-menu-'+i).removeClass('selected');
	}
	$('#tab-menu-'+id).addClass('selected');
	for(i=0;i<100;i++){
		$('#tabs-'+i).hide();
	}
	$('#tabs-'+id).show();
}

function init_tabs(id){
	$('document').ready( function() {
		for(i=0;i<100;i++){
			$('#tabs-'+i).hide();
		}
		$('#tabs-'+id).show();
		tabs_custom(id);
	});
}

init_tabs(77);


function tabs_custom_in(id){

    for(i=0;i<103;i++){
        $('#tab-menuin-'+i).removeClass('selected');
    }
    $('#tab-menuin-'+id).addClass('selected');
    for(i=0;i<103;i++){
        $('#tabsin-'+i).hide();
    }
    $('#tabsin-'+id).show();
}





function init_tabs_in(id){
    $('document').ready( function() {
        for(i=0;i<103;i++){
            $('#tabsin-'+i).hide();
        }
        $('#tabsin-'+id).show();
        tabs_custom_in(id);
    });
}

init_tabs_in(31);




function initAccessoriesAutocomplete(){
	$('document').ready( function() {
		$('#product_autocomplete_input')
			.autocomplete('ajax_products_list.php',{
				minChars: 1,
				autoFill: true,
				max:20,
				matchContains: true,
				mustMatch:true,
				scroll:false,
				cacheLength:0,
				formatItem: function(item) {
					return item[1]+' - '+item[0];
				}
			}).result(addAccessory);
		
		$('#product_autocomplete_input').setOptions({
			extraParams: {
				excludeIds : getAccessoriesIds()
			}
		});
	});
}

function getAccessoriesIds()
{
	if ($('#inputAccessories').val() === undefined) return '';
	if ($('#inputAccessories').val() == '') return ',';
	ids = $('#inputAccessories').val().replace(/\-/g,',');
	//.replace(/\,$/,'')
	//ids = ids.replace(/\,$/,'');
	return ids;
}

function addAccessory(event, data, formatted)
{
	if (data == null)
		return false;
	//var productId = data[1];
    productId = data[data.length - 1];
	var productName = data[0];

	var $divAccessories = $('#divAccessories');
	var $inputAccessories = $('#inputAccessories');
	var $nameAccessories = $('#nameAccessories');

	/* delete product from select + add product line to the div, input_name, input_ids elements */
	$divAccessories.html($divAccessories.html() + productName + ' <span class="delAccessory" name="' + productId + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span><br />');
	$nameAccessories.val($nameAccessories.val() + productName + '¤');
	$inputAccessories.val($inputAccessories.val() + productId + '-');
	$('#product_autocomplete_input').val('');
	$('#product_autocomplete_input').setOptions({
		extraParams: {excludeIds : getAccessoriesIds()}
	});
}

function delAccessory(id)
{
	var div = getE('divAccessories');
	var input = getE('inputAccessories');
	var name = getE('nameAccessories');

	// Cut hidden fields in array
	var inputCut = input.value.split('-');
	var nameCut = name.value.split('¤');

	if (inputCut.length != nameCut.length)
		return jAlert('Bad size');

	// Reset all hidden fields
	input.value = '';
	name.value = '';
	div.innerHTML = '';
	for (i in inputCut)
	{
		// If empty, error, next
		if (!inputCut[i] || !nameCut[i])
			continue ;

		// Add to hidden fields no selected products OR add to select field selected product
		if (inputCut[i] != id)
		{
			input.value += inputCut[i] + '-';
			name.value += nameCut[i] + '¤';
			div.innerHTML += nameCut[i] + ' <span class="delAccessory" name="' + inputCut[i] + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span><br />';
		}
		else
			$('#selectAccessories').append('<option selected="selected" value="' + inputCut[i] + '-' + nameCut[i] + '">' + inputCut[i] + ' - ' + nameCut[i] + '</option>');
	}

	$('#product_autocomplete_input').setOptions({
		extraParams: {excludeIds : getAccessoriesIds()}
	});
}