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

function blockblog_list(id,action,value,type_action){

    if(action == 'active') {
        $('#activeitem' + id).html('<img src="../img/admin/../../modules/blockblog/views/img/loader.gif" />');
    }

    $.post('../modules/blockblog/ajax_admin.php',
        { id:id,
            action:action,
            value: value,
            type_action: type_action
        },
        function (data) {
            if (data.status == 'success') {


                var data = data.params.content;

                var text_action = '';
                if(type_action == 'category'){
                    text_action = 'category';
                } else if(type_action == 'post'){
                    text_action = 'post';
                } else if(type_action == 'comment'){
                    text_action = 'comment';
                }

                if(action == 'active'){

                    $('#activeitem'+id).html('');
                    if(value == 0){
                        var img_ok = 'ok';
                        var action_value = 1;
                    } else {
                        var img_ok = 'no_ok';
                        var action_value = 0;
                    }
                    var html = '<span class="label-tooltip" data-original-title="Click here to activate or deactivate '+text_action+' on your site" data-toggle="tooltip">'+
                            '<a href="javascript:void(0)" onclick="blockblog_list('+id+',\'active\', '+action_value+',\''+type_action+'\');" style="text-decoration:none">'+
                        '<img src="../img/admin/../../modules/blockblog/views/img/'+img_ok+'.gif" />'+
                        '</a>'+
                    '</span>';
                    $('#activeitem'+id).html(html);


                }

            } else {
                alert(data.message);

            }
        }, 'json');
}







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


function addAccessory(event, data, formatted)
{
    if (data == null)
        return false;
    var productId = data[data.length - 1];
    var productName = data[0];


    var $divAccessories = $('#divAccessories');
    var $inputAccessories = $('#inputAccessories');
    var $product_autocomplete_input = $('#product_autocomplete_input');

     $product_autocomplete_input.val('');
    $product_autocomplete_input.val(productName);

    $inputAccessories.val('');
    $inputAccessories.val(productId);


}

function getAccessoriesIds()
{
    if ($('#inputAccessories').val() === undefined) return '';
    if ($('#inputAccessories').val() == '') return ',';
    ids = $('#inputAccessories').val().replace(/\-/g,',');


    return ids;
}


function initCustomersAutocomplete(){
    $('document').ready( function() {
        $('#customer_autocomplete_input')
            .autocomplete('ajax-tab.php',{
                minChars: 1,
                max: 20,
                width: 500,
                selectFirst: false,
                scroll: false,
                dataType: 'json',


                formatItem: function(data, i, max, value, term) {
                    return value;
                },
                parse: function(data) {
                    var items = new Array();
                    for (var i = 0; i < data.length; i++) {
                        items[items.length] = {
                            data: data[i],
                            value: data[i].cname + ' (' + data[i].email + ')'
                        };

                    }


                    return items;
                }

            }).result(function(event, data, formatted) {
                $('#inputCustomers').val(data.id_customer);
                $('#customer_autocomplete_input').val(data.cname + ' (' + data.email + ')');

            });

        var inputCustomersToken = $('#inputCustomersToken').val();
        $('#customer_autocomplete_input').setOptions({
            extraParams: {
                controller: 'AdminCartRules',
                customerFilter: 1,
                token: inputCustomersToken
            }
        });
    });
}



// remove add new comment button //
$('document').ready( function() {

    $('#desc-blog_comments-new').css('display','none');


});
// remove add new comment button //


