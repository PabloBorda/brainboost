/*
 * 2007-2013 PrestaShop 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 *         DISCLAIMER   *
 * *************************************** */
/* Do not edit or add to this file if you wish to upgrade Prestashop to newer
 * versions in the future.
 * ****************************************************
 * @category   Belvg
 * @package    Belvg_PreOrderProducts
 * @author    Alexander Simonchik <support@belvg.com>
 * @site    
 * @copyright  Copyright (c) 2010 - 2013 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt 
 */


//JS Object : update the cart by ajax actions
var ajaxPreorder = {

    serverTime : function(){
        var time = null; 
        $.ajax({url: baseDir + 'modules/belvg_preorderproducts/controllers/serverTime.php', 
            async: false, dataType: 'text', 
            success: function(text) { 
                time = new Date(text); 
            }, error: function(http, message, exc) { 
                time = new Date(); 
        }}); 
        return time; 
    },
    
    switchStatus : function(){
        var form_data = $('#buy_block').serialize();

        $.ajax({
            url: baseDir + 'modules/belvg_preorderproducts/controllers/AjaxController.php',
            data: form_data+"&action=switchStatus",
            type: "POST",
            async: false,
            beforeSend: function() {
                $('#oosHook').html(belvg_pp_str1+'<img src="{/literal}{$base_dir}{literal}img/admin/ajax-loader.gif"/>');
            },
            success: function( data ) {
                window.location.reload();
                //$('#preorderproducts_content').html(data);
            }
        });
        //return false;
    },
    
    initWaitingList : function(){
        $('input[name="waitsubmit"]').live("click", function(){
            var objWait = this;
            if (!isLogged) {
                alert(belvg_w1_str);
                return false;
            }
            
            var form_data = $('#buy_block').serialize();
            $.ajax({
                url: baseDir + 'modules/belvg_preorderproducts/controllers/AjaxController.php',
                data: form_data+"&action=subscribe",
                type: "POST",
                async: false,
                beforeSend: function() {
                    //$(objWait).parents('.reloadWaitContent').html('<br>'+belvg_w2_str+' <img src="img/admin/ajax-loader.gif"/>');
                    $(objWait).fadeOut();
                },
                success: function( data ) {
                    $(objWait).parents('.reloadWaitContent').html( data );
                }
            })
            
            return false;
        });
    },

    findCombinationOnLoad : function(){
		setTimeout(function() {
		//console.log('findCombinationOnLoad');
		//console.log("#pp_" + $('#idCombination').val() * 1);
			$(".pp_countdown_container").hide();
			$("#pp_" + $('#idCombination').val() * 1).fadeIn("slow");
		}, 200)
    },
    
    findCombination : function(){
        $('#attributes .attribute_select, #attributes .color_pick').unbind('change').change(function() {
            setTimeout(function() {
                ajaxPreorder.findCombinationAction()
            }, 200)
        });
        $('#attributes .color_pick').unbind('click').click(function() {
            setTimeout(function() {
                ajaxPreorder.findCombinationAction()
            }, 200)
        });
    },
    
    findCombinationAction : function(){
		//console.log('findCombinationAction');
		//console.log("#pp_" + $('#idCombination').val());
        //console.log($('#idCombination').val());
        $(".pp_countdown_container").hide();
        $("#pp_" + $('#idCombination').val()).fadeIn("slow");
    },
    
	overrideButtonsInTheList : function(){
		if ($('#product_list .ajax_block_product').length > 0){
            var id_product_pp=[];
            $('#product_list .belvg_pp_product').each(function() {
                id_product_pp.push($(this).val());
            });
       
            var form_data = 'ajax=1&id_products='+JSON.stringify(id_product_pp);
            $.ajax({
                url: baseDir + 'modules/belvg_preorderproducts/controllers/AjaxController.php',
                data: form_data+"&action=checkPPExists",
                type: "POST",
                async: false,
                success: function( jsonArray ) {
                    var dataArray = JSON.parse(jsonArray);
                    console.log(dataArray);
                    for(var i=0; i<dataArray.length; i++) {
                        $("#belvg_pp_product_"+dataArray[i]).parent(".ajax_block_product").find(".price").append('<p class="pp_available_home">'+belvg_pp_str2+"</p>");
                    }
                }
            });
        }
	},
    
	overrideButtonsInTheHome : function(){
		if ($('#featured-products_block_center .ajax_add_to_cart_button').length > 0){
            var id_product_pp=[];
            $('#featured-products_block_center .belvg_pp_product').each(function() {
                id_product_pp.push($(this).val());
            });
       
            var form_data = 'ajax=1&id_products='+JSON.stringify(id_product_pp);
            $.ajax({
                url: baseDir + 'modules/belvg_preorderproducts/controllers/AjaxController.php',
                data: form_data+"&action=checkPPExists",
                type: "POST",
                async: false,
                success: function( jsonArray ) {
                    var dataArray = JSON.parse(jsonArray);
                    console.log(dataArray);
                    for(var i=0; i<dataArray.length; i++) {
                        $("#belvg_pp_product_"+dataArray[i]).parent(".ajax_block_product").find(".price").append('<p class="pp_available_home">'+belvg_pp_str2+"</p>");
                    }
                }
            });
        }
	},
    
    //override every button in the page in relation to the cart
	overrideButtonsInThePage : function(){
		//for product page 'preorder' button...
		$('body#product #oosHook input.add_to_preorder').unbind('click').click(function(){
			ajaxPreorder.add( $('#product_page_product_id').val(), $('#idCombination').val(), true, null, $('#quantity_wanted').val(), null);
			return false;
		});
	},
	
	add : function(idProduct, idCombination, addedFromProductPage, callerElement, quantity, whishlist){
		ajaxCart.add(idProduct, idCombination, addedFromProductPage, callerElement, quantity, whishlist);
	},

};

//when document is loaded...
$(document).ready(function(){   
    //oosHookJsCodeFunctions.push(ppFindCombination);
	ajaxPreorder.findCombination();
	ajaxPreorder.findCombinationOnLoad();
	ajaxPreorder.overrideButtonsInThePage();
	ajaxPreorder.overrideButtonsInTheList();
	ajaxPreorder.overrideButtonsInTheHome();
	ajaxPreorder.initWaitingList();
	ajaxCart.refresh();
});
            
function serverTime() {
    var time = null; 
    $.ajax({url: baseDir + 'modules/belvg_preorderproducts/controllers/serverTime.php', 
        async: false, dataType: 'text', 
        success: function(text) { 
            time = new Date(text); 
        }, error: function(http, message, exc) { 
            time = new Date(); 
    }}); 
    return time; 
}