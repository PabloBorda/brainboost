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

function init_tabs(id){
    $('document').ready( function() {



        if(id == 1){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#urlrewrite"]').tab('show');

        }

        if(id == 2){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#categoriessettings"]').tab('show');

        }

        if(id == 3){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#postssettings"]').tab('show');

        }

        if(id == 4){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#commentssettings"]').tab('show');

        }

        if(id == 5){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#blockssettings"]').tab('show');

        }

        if(id == 6){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#blockpositions"]').tab('show');

        }

        if(id == 7){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#rssfeed"]').tab('show');

        }

        if(id == 8){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#emailsettings"]').tab('show');

        }

        if(id == 9){
            $('#navtabs16 a[href="#blogsettings"]').tab('show');
            $('#blognavtabs16 a[href="#sitemap"]').tab('show');

        }


    });
}


function tabs_custom(id){



    if(id == 101){
        $('#navtabs16 a[href="#blogsettings"]').tab('show');
        $('#blognavtabs16 a[href="#sitemap"]').tab('show');

    }





}
