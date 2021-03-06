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
class Dvs_Component_Controller_Customize extends Phpfox_Component {

	public function process()
	{
		Phpfox::isUser(true);

		if (($iDvsId = $this->request()->getInt('id')))
		{
			if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId()))
			{
				$this->url()->send('');
				return false;
			}

			//If there is an ID, we're editing
			$sBreadcrumb = Phpfox::getPhrase('dvs.edit_dealer_video_showroom');

			if (($aForms = Phpfox::getService('dvs.style')->get($iDvsId)))
			{
				$bIsEdit = true;
			}
			else
			{
				$bIsEdit = false;
			}
			
		}
		else
		{
			$this->url()->send('dvs');
		}

        if(!isset($aForms['font_family_id'])) {
            $aForms['font_family_id'] = 3;
        }

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

	    $iPlayerId = Phpfox::getService('dvs.player')->get($iDvsId);
        
        if (($aPlayer = Phpfox::getService('dvs.player')->get($iDvsId)))
            {
                $aDvs = Phpfox::getService('dvs')->get($iDvsId);
                
                $this->template()
                    ->assign(array(
                        'aFormss' => $aPlayer,
                        'bIsEdit' => true
                    ));
            }
            else
            //New player being created
            {
                $this->template()
                    ->assign(array(
                        'bIsEdit' => false,
                        'bCanAddPlayers' => true
                    ));
                 
            }
		
		$this->template()
			->setHeader(array(
				'colorpicker.js' => 'module_dvs',
				'eye.js' => 'module_dvs',
				'utils.js' => 'module_dvs',
				'layout.js' => 'module_dvs',
				'colorpicker.css' => 'module_dvs',
				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
				'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
				'<script type="text/javascript">var bIsDvs = true</script>',
				'<script type="text/javascript">var sFirstVideoTitleUrl = "";</script>',
				'player.js' => 'module_dvs',
				'jcarousellite.js' => 'module_dvs',
				//'add.css' => 'module_dvs',
				'settings.css' => 'module_dvs',
                'add_player.css' => 'module_dvs'
			))
			->assign(array(
                'iDvsId' => $iDvsId,
				'iPlayerId' => $iPlayerId['player_id'],
				'aDvs' => Phpfox::getService('dvs')->get($iDvsId),
				'aMakes' => Phpfox::getService('dvs.video')->getMakes(),
				'iUserId' => Phpfox::getUserId(),
				'sDefaultColor' => Phpfox::getParam('dvs.default_color_picker_color'),
				'sDvsUrl' => Phpfox::getParam('core.url_file') . 'dvs/',
				'aForms' => $aForms,
				'bIsEdit' => $bIsEdit,
				'aThemes' => Phpfox::getService('dvs.theme')->listThemes(),
				'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
                'aFontFamilies' => Phpfox::getService('dvs.style')->getFontFamilies()
			))
			->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
			->setBreadcrumb($sBreadcrumb);
	}


}

?>
