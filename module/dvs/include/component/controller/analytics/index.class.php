<?php

class Dvs_Component_Controller_Analytics_Index extends Phpfox_Component {
    public function process() {
        if (($iDvsId = $this->request()->getInt('id'))) {
            if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId())) {
                $this->url()->send('');
                return false;
            }
            $aDvs = Phpfox::getService('dvs')->get($iDvsId);
        } else {
            $this->url()->send('');
            return false;
        }

//        $aDvs['title_url'] = 'commonwealthhonda';
//        $aDvs['dealer_name'] = 'Commonwealth Honda';

        $sTab = $this->request()->get('tab', 'overall');
        $iDays = $this->request()->get('day', 30);
        $sDateFrom = $iDays.'daysAgo';
        $sFullPath = $this->url()->makeUrl('dvs.analytics', array('id' => $iDvsId, 'tab' => $sTab, 'day' => 'tempdays'));

        $this->setParam('aDvs', $aDvs);
        $this->setParam('sDateFrom', $sDateFrom);

        $this->template()
            ->setTitle($aDvs['dealer_name'] . ' Report')
            ->setBreadcrumb($aDvs['dealer_name'] . ' Report')
            ->setHeader(array(
                'analytics.css' => 'module_dvs',
                'analytics-'. $sTab .'.js' => 'module_dvs'
            ))
            ->assign(array(
                'aDvs' => $aDvs,
                'iDays' => $iDays,
                'sTab' => $sTab,
                'sGlobalJavascript' =>
                    '<script type="text/javascript">' .
                        'var iDvsId = ' . $iDvsId . ';' .
                        'var sFullPath = "' . $sFullPath . '";' .
                        'var iExportDay = ' . $iDays . ';' .
                    '</script>'
            ));
    }
}

?>