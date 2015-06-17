<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class tx_sampleflex_addFieldsToFlexForm {
    
    function getCalendars($config) 
    {
        $optionList = array();
        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,title', 'tx_lthfullcalendar_calendar', 'deleted=0 AND hidden = 0', '', 'title');
        while ($row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($res)) {
            $optionList[0] = array(0 => $row['title'], 1 => $row['uid']);
        }
        $GLOBALS['TYPO3_DB']->sql_free_result($res);

        $config['items'] = array_merge($config['items'],$optionList);
        return $config;
    }
}