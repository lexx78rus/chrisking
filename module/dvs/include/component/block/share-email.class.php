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
class Dvs_Component_Block_Share_Email extends Phpfox_Component {
	public function process() {
        $iDvsId = $this->request()->getInt('iDvsId');       
        $aDvs  = Phpfox::getService('dvs')->get($iDvsId);
        $phone = '';
        if($aDvs['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin()){
            $phone = $aDvs['phone'];
        }
        
		$this->template()
            ->setHeader(array('share_email.css' => 'style_css'))
			->assign(array(
                'aVideo' => Phpfox::getService('dvs.video')->get($this->request()->get('sRefId')),
                'aDvs' => Phpfox::getService('dvs')->get($this->request()->getInt('iDvsId'), false),
		        'your_name' => Phpfox::getUserBy('full_name'),
		        'your_email' => Phpfox::getUserBy('email'),
                'your_tel'   => $phone,
                'bSaveGa' => $this->request()->get('bSaveGa', 1)
		    ));
	}

}

?>