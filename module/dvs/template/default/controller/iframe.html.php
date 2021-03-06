
    {if $sBrowser == 'mobile'}
        {template file='dvs.controller.iframe-mobile-view}
    {else}
    <header>
        <section id="select_new">
            {if $aVideoSelectYears}
                <table width="100%">
                    <tr>
                        <td>
                            <h3>{phrase var='dvs.choose_new_vehicle'}:</h3>
                        </td>
                        <td>
                            <ul id="year">
                            <li class="init"><span class="init_selected">Select Year</span>
                              <ul>
                                {foreach from=$aVideoSelectYears item=iYear}
                                <li onclick="$.ajaxCall('dvs.getMakes', 'iYear={$iYear}&amp;sDvsName={$aDvs.title_url}');">
                                  {$iYear}
                                </li>
                                {/foreach}
                              </ul>
                            </li>
                            </ul>
                        </td>

                        <td>
                            <ul id="makes">
                                <li class="init">
                                  &nbsp;&nbsp;{phrase var='dvs.select_make'}
                                  <ul>
                                    {if count($aVideoSelectYears) == 1}
                                        {foreach from=$aValidVSMakes item=aValidMake}
                                        <li onclick="$.ajaxCall('dvs.getModels', 'iDvsId={$aDvs.dvs_id}&amp;iYear={$aVideoSelectYears.0}&amp;sMake={$aValidMake.make}');">{$aValidMake.make}</li>
                                        {/foreach}
                                    {else}
                                        <li>
                                            {phrase var='dvs.please_select_a_year_first'}
                                        </li>
                                    {/if}
                                  </ul>
                                </li>
                            </ul>
                        </td>

                        <td>
                            <ul id="models">
                            <li class="init">
                              &nbsp;&nbsp;{phrase var='dvs.select_model'}
                              <ul>
                                <li>
                                  {phrase var='dvs.please_select_a_year_first'}
                                </li>
                              </ul>
                            </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            {/if}
        </section>
    </header>
    <article>
    
        <!-- HTML5 V2 RealIT Services -->
        {if $aPlayer.player_type != "2"}
          <section id="player">
            {template file='dvs.controller.player.iframe-player}
        </section>
        {else}
        <section id="player">
        {template file = 'dvs.controller.player.iframe-playerhtml5}
        </section>
        {/if}  
        

        {if $aDvs.iframe_contact_form}
        <aside>
            <div id="contact_box">
                <h2>Contact {$aDvs.dealer_name}</h2>
                {template file='dvs.block.contact-iframe}
            </div>
        </aside>
        {/if}

        <section id="dealer_links">
          <table>
          <tr>
          <td>
          {if $aDvs.inventory_url}
          <a href="{$aDvs.inventory_url}" class="dvs_inventory_link" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
            {phrase var='dvs.cta_inventory'}
          </a>
          {/if}
          </td>
          <td>&nbsp;</td>
          <td>
          {if $aDvs.specials_url}
          <a href="{$aDvs.specials_url}" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
            {phrase var='dvs.cta_specials'}
          </a>
          {/if}
          </td>
          </tr>
          </table>
        </section>

        <section id="video_information">
            <h3 id="video_name" itemprop="name">
                <a id="current_video_link" href="{$sOverrideLink}" onclick="return false;" itemprop="url" target="_parent">
                    {$aDvs.phrase_overrides.override_video_name_display}
                </a>
            </h3>
            <p class="model_description" id="car_description" itemprop="description">{$aDvs.phrase_overrides.override_video_description_display}</p>
        </section>
		
		{if $aDvs.dealer_name == 'Credit Union Services'}
		<br />
		{else}
        
        {if Phpfox::isUser()}
        <section id="dealer_links">
            <table style="border-top:1px solid #ccc;">
                <tr><td colspan="4">&nbsp;</td></tr>
                <tr>
                    <td>
                        <p><b>Dealer-Only Links:</b>&nbsp;</p>
                    </td>
                    <td>
                        <a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share" onclick="" rel="nofollow" target="_blank" style="font-size:16px;">
                        {phrase var='dvs.dealer_share_links'}
                        </a>
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        {if Phpfox::getUserId() == $aDvs.user_id || Phpfox::isAdmin()}
                        <a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}" onclick="" rel="nofollow" target="_blank"  style="font-size:16px;">
                        {phrase var='dvs.manage_sales_team'}
                        </a>
                        {/if}
                    </td>
                </tr>
                <tr><td colspan="4"><p><i>*Dealer-Only Links (and this message) are not seen by the public. You are seeing this because you are logged into the DVS backend at http://www.wtvdvs.com</i></p></td></tr>
            </table>
        </section>
        <div class="clear"></div>
        {else}
        {*if $aPlayer.player_type != "2"*}
        <section id="share_links">
            <input type="hidden" value="{$sNewParentUrl}" id="parent_url">
            <input type="hidden" value="{$sVideoUrl}" id="video_url">
            <input type="hidden" value="{$sVideoHashCode}" id="video_hash_code">
            <input type="hidden" value="{phrase var='dvs.twitter_default_share_text' video_year=$aDvs.featured_year video_make=$aDvs.featured_make video_model=$aDvs.featured_model dvs_dealer_name=$aDvs.dealer_name}" id="share_title">
            <input type="hidden" value="{$sVideoThumb}" id="video_thumbnail">
            <table cellpadding="4" cellspacing="4" border="0">
                <tr>
                    <td style="vertical-align:middle;">
                    <p style="font-size:14px;"><b>Share This:</b>&nbsp;</p>
                    </td>
                    <!--
                    <td style="vertical-align:middle;">
                        <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailFormIframe', 'height=400&amp;width=360&amp;sParentUrl=' + encodeURIComponent($('#parent_url').val().replace('WTVDVS_VIDEO_TEMP', $('#video_url').val())) + '&amp;longurl=1&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));  showEmailShare(); return false;">
                            <img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
                        </a>
                    </td>
                    -->
                    {if Phpfox::isModule('redirect')}
                   <td style="vertical-align:middle;">
                        <a href="#" onclick="window.open('https://www.facebook.com/share.php?u=' + encodeURI('{url link='share'}' + $('#video_hash_code').val() + '{$sDvsHashCode}0'), 'Facebook Share', 'width=626,height=436'); facebookShareClick('Share Links'); return false;">
                            <img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
                        </a>
                    </td>
                    {/if}
                    <td style="vertical-align:middle;padding-left:2px;padding-right:2px;">
                        <span id="twitter_button_wrapper">
                        <a href="https://twitter.com/intent/tweet?text={phrase var='dvs.twitter_default_share_text' video_year=$aFirstVideo.year video_make=$aFirstVideo.make video_model=$aFirstVideo.model dvs_dealer_name=$aDvs.dealer_name}&url={$sShareCode}1" id="twitter_share"><img src="{$sImagePath}twitter-button.png" alt="Tweet" /></a>
                        </span>
                    </td>
                    {if Phpfox::isModule('redirect')}
                    <td style="vertical-align:middle;">
                        <a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURI('{url link='share'}' + $('#video_hash_code').val() + '{$sDvsHashCode}2')); googleShareClick('Share Links'); return false;">
                            <img src="{$sImagePath}google-share.png" alt="Google+" title="Google+"/>
                        </a>
                    </td>
                    {/if}
                </tr>
            </table>
        </section>
        {*/if*}
        {/if}
        {/if}
    </article>
    <div class="clear"></div>
    <footer></footer>
    {/if}

{if $sShareSource != ''}
<iframe src="{$sShareIframeUrl}" height="1" width="1"></iframe>
{/if}

{if $sVdpIframeUrl != ''}
<iframe src="{$sVdpIframeUrl}" height="1" width="1"></iframe>
{/if}

{literal}
<script type="text/javascript">
    $Behavior.loadUrlVideo = function() {
        setInterval(function() {
            if (!bUpdatedShareUrl) {
                $.ajaxCall('dvs.updateShareUrl', 'ref-id='+ aCurrentVideoMetaData.referenceId + '&iDvsId=' + iDvsId);
                bUpdatedShareUrl = true;
            }
        }, 1000);
    }
</script>
{/literal}

{if !$aDvs.is_active}
    {template file='dvs.block.deactive'}
    <script type="text/javascript">
        $Behavior.googleDvsDeactive = function() {l}
        {if $sBrowser == 'mobile'}
            sendToGoogle('DVS Mobile', 'DVS Deactivated', 'Deactivation Message Shown');
			mixpanel.track("Deactivation Message Shown");
            {else}
            sendToGoogle('DVS iFrame', 'DVS Deactivated', 'Deactivation Message Shown');         			mixpanel.track("Deactivation Message Shown");
            {/if}
                {r}
    </script>
{/if}
