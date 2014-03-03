<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		DVS
 */

?>
<script>
	{literal}
	$('#contact_dealer').submit(function(event){
		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
		$.ajaxCall('dvs.contactDealer', $('#contact_dealer').serialize());
		setTimeout(function() {
			tb_remove();
		}, 3000);
	});
{/literal}
</script>
<style>
	input.dvs_form_button {l}
		background-color: #{$aDvs.button_background};
		background-image: -webkit-linear-gradient(top, #{$aDvs.button_top_gradient}, #{$aDvs.button_bottom_gradient});
		background: -moz-linear-gradient( center top, #{$aDvs.button_top_gradient} 5%, #{$aDvs.button_bottom_gradient} 100% );
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_top_gradient}', endColorstr='#{$aDvs.button_bottom_gradient}');
		border: 1px solid #{$aDvs.button_border};
		color: #{$aDvs.button_text};
	{r}
	
	input.dvs_form_button:hover {l}
		background-image: -webkit-linear-gradient(top, #{$aDvs.button_bottom_gradient}, #{$aDvs.button_top_gradient});
		background: -moz-linear-gradient( center top, #{$aDvs.button_bottom_gradient} 5%, #{$aDvs.button_top_gradient} 100% );
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_bottom_gradient}', endColorstr='#{$aDvs.button_top_gradient}');
		background-color: #{$aDvs.button_background};
		border: 1px solid #{$aDvs.button_border};
		color: #{$aDvs.button_text};
	{r}
</style>

<form id="contact_dealer" name="contact_dealer" action="javascript:void(0);">
	<fieldset>
		<p>Thank you for your interest in the <strong>{$aVideo.year} {$aVideo.make} {$aVideo.model}</strong>!</p>
		<p>We're happy to help you find your next car or answer any questions you might have. Please fill out the form below:</p>
		<ul>
			<li>
				<input type="text" name="val[contact_name]" id="name" placeholder="{phrase var='dvs.get_price_placeholder_name'}" required/>
			</li>
			<li>
				<input type="email" name="val[contact_email]" id="email" placeholder="{phrase var='dvs.get_price_placeholder_email'}" required/>
			</li>
			<li>
				<input type="text" name="val[contact_phone]" id="phone" placeholder="{phrase var='dvs.get_price_placeholder_phone'}" required/>
			</li>
			<li>
				<input type="text" name="val[contact_zip]" id="zip" placeholder="{phrase var='dvs.get_price_placeholder_zip'}" required/>
			</li>
			<li>
				<textarea id="comments" name="val[contact_comments]" cols="16" rows="3" placeholder="{phrase var='dvs.get_price_placeholder_comments'}" required></textarea>
			</li>
		</ul>

		<input type="hidden" name="val[contact_video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
		<input type="hidden" name="val[contact_dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
	</fieldset>
	<fieldset>
		<input type="submit" value="{phrase var='dvs.send'}" class="dvs_form_button" />
	</fieldset>
</form>
<div id="dvs_contact_success" style="display:none;">
	{phrase var='dvs.contact_request_sent_thank_you'}
</div>