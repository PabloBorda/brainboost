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

function blockblog_like_post(id,like){

    $('.post-like-'+id).css('opacity',0.5);

    $.post(baseDir+'modules/blockblog/ajax.php', {
            action:'like',
            id : id,
            like : like
        },
        function (data) {
            if (data.status == 'success') {

                $('.post-like-'+id).css('opacity',1);

                var count = data.params.count;
                if(like == 1){
                    $('.post-like-'+id).html('');
                    $('.post-like-'+id).append('<i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number">'+count+'</span>)');

                    if($('.post-like1-'+id)){
                        $('.post-like1-'+id).html('');
                        $('.post-like1-'+id).append('<i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number">'+count+'</span>)');
                    }
                } else {
                    $('.post-unlike-'+id).html('');
                    $('.post-unlike-'+id).append('<i class="fa fa-thumbs-down fa-lg"></i>&nbsp;(<span class="the-number">'+count+'</span>)');

                    if($('.post-unlike1-'+id)){
                        $('.post-unlike1-'+id).html('');
                        $('.post-unlike1-'+id).append('<i class="fa fa-thumbs-down fa-lg"></i>&nbsp;(<span class="the-number">'+count+'</span>)');
                    }
                }


            } else {
                $('.post-like-'+id).css('opacity',1);
                alert(data.message);
            }

        }, 'json');
}


