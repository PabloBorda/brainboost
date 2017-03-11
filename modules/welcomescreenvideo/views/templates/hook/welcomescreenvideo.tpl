{*
* 2007-2015 PrestaShop
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
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author  PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="wsc_video_container">
    <div class="video-container" style="{if (isset($bl_bg_color) && $bl_bg_color && isset($bg_color) && $bg_color != "")}background-color:{$bg_color|escape:'htmlall':'UTF-8'};{/if}{if (isset($bl_bg_image) && $bl_bg_image && isset($bg_image_url) && $bg_image_url != "")} background-image:url('{$bg_image_url|escape:'htmlall':'UTF-8'}{if (isset($bg_image_stamp) && $bg_image_stamp != '')}?{$bg_image_stamp|escape:'htmlall':'UTF-8'}{/if}');{/if}">
        {if (isset($bl_bg_video) && $bl_bg_video && isset($bg_video_url) && $bg_video_url != "")}
            {if (isset($youtube_video_id) && $youtube_video_id != "")}
                <div id="wsc_youtube_player"></div>
                <script>
                    // Load the IFrame Player API code asynchronously.
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/player_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    // Replace the 'ytplayer' element with an <iframe> and
                    // YouTube player after the API code downloads.
                    var player;
                    function onYouTubePlayerAPIReady() {
                        player = new YT.Player('wsc_youtube_player', {
                            height: '100%',
                            width: '100%',
                            videoId: '{$youtube_video_id|escape:'htmlall':'UTF-8'}',
                            playerVars: { 'autoplay': 1, 'controls': 0{if (isset($bl_video_loop) && $bl_video_loop)}, 'loop': 1, 'playlist': '{$youtube_video_id|escape:'htmlall':'UTF-8'}'{/if} },
                            events: {
                                'onReady': onPlayerReady
                            }
                        });
                        function onPlayerReady(event) {
                            {if (isset($bl_video_mute) && $bl_video_mute)}
                                event.target.mute();
                            {/if}
                        }
                    }
                </script>
            {elseif (isset($vimeo_video_id) && $vimeo_video_id != "")}
                <iframe id="wsc_vimeo_player" src="https://player.vimeo.com/video/{$vimeo_video_id|escape:'htmlall':'UTF-8'}?autoplay=1{if (isset($bl_video_loop) && $bl_video_loop)}&loop=1{/if}&badge=0&color=000000&title=0&byline=0&portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                {if (isset($bl_video_mute) && $bl_video_mute)}
                <script>
                    $(function() {
                        var player = $('#wsc_vimeo_player');
                        var playerOrigin = '*';

                        // Listen for messages from the player
                        if (window.addEventListener) {
                            window.addEventListener('message', onMessageReceived, false);
                        }
                        else {
                            window.attachEvent('onmessage', onMessageReceived, false);
                        }

                        // Handle messages received from the player
                        function onMessageReceived(event) {
                            // Handle messages from the vimeo player only
                            if (!(/^https?:\/\/player.vimeo.com/).test(event.origin)) {
                                return false;
                            }
                            
                            if (playerOrigin === '*') {
                                playerOrigin = event.origin;
                            }
                            
                            var data = JSON.parse(event.data);
                            
                            switch (data.event) {
                                case 'ready':
                                    onReady();
                                    break;
                            }
                        }

                        // Helper function for sending a message to the player
                        function post(action, value) {
                            var data = {
                              method: action
                            };
                            
                            if (value) {
                                data.value = value;
                            }
                            
                            var message = JSON.stringify(data);
                            player[0].contentWindow.postMessage(message, playerOrigin);
                        }

                        function onReady() {
                            post('setVolume', '0');
                        }
                    });
                </script>
                {/if}
            {else}
                <video {if (isset($bl_video_loop) && $bl_video_loop)} loop="loop"{/if}{if (isset($bl_video_mute) && $bl_video_mute)} muted="muted"{/if} autoplay="autoplay">
                    <source {if (isset($bg_video_type) && $bg_video_type != "")}type="{$bg_video_type|escape:'htmlall':'UTF-8'}"{/if} src="{$bg_video_url|escape:'htmlall':'UTF-8'}{if (isset($bg_video_stamp) && $bg_video_stamp != '')}?{$bg_video_stamp|escape:'htmlall':'UTF-8'}{/if}" />
                </video>
            {/if}
        {/if}
        {if (isset($bl_mask) && $bl_mask)}
            <div class="wsc_mask"{if (isset($wsc_mask_bgc) && $wsc_mask_bgc != "")} style="background:{$wsc_mask_bgc|escape:'htmlall':'UTF-8'}"{/if}></div>
        {/if}
        {if (isset($bl_content) && $bl_content && isset($wsc_content) && $wsc_content != "")}
            <div class="wsc_content{if (isset($v_align) && $v_align != "")} v_{$v_align|escape:'htmlall':'UTF-8'}{/if}{if (isset($h_align) && $h_align != "")} h_{$h_align|escape:'htmlall':'UTF-8'}{/if}"{if (isset($text_color) && $text_color != "")} style="color:{$text_color|escape:'htmlall':'UTF-8'};"{/if}>
                {*HTML CONTENT*}{$wsc_content|html_entity_decode}
            </div>
        {/if}
        <div class="wsc_scroll_button"{if (isset($text_color) && $text_color != "")} style="border-color:transparent {$text_color|escape:'htmlall':'UTF-8'} {$text_color|escape:'htmlall':'UTF-8'} transparent;"{/if}></div>
    </div>
</div>