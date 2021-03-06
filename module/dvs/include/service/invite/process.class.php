<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		DVS
 */
class Dvs_Service_Invite_Process extends Phpfox_Service {
	public function __construct() {
		$this->_tInvite = Phpfox::getT('ko_dvs_salesteam_invites');
	}


	/**
	 * Add a sales team invite
	 * 
	 * @param int $iDvsId
	 * @param int $sEmail
	 * @return int, invite id
	 */
	public function add($iDvsId, $sEmail, $bIsManager = false) {
		$iInviteId = $this->database()->insert($this->_tInvite, array(
			'dvs_id' => (int) $iDvsId,
			'email_address' => $this->preParse()->clean($sEmail),
            'manager_invite' => ($bIsManager ? 1 : 0),
            'time_stamp' => PHPFOX_TIME
		));

		return $iInviteId;
	}


	/**
	 * Removes a sales team invite from the list of invites as well as from any user who has selected this invite
	 * 
	 * @param int $iInviteId
	 */
	public function remove($iInviteId) {
		$this->database()->delete($this->_tInvite, 'invite_id = ' . (int) $iInviteId);
	}

    public function deleteOldInvites() {
        $this->database()
            ->delete($this->_tInvite, 'time_stamp + 604800 < ' . PHPFOX_TIME);
    }
}

?>