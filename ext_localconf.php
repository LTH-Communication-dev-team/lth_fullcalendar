<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

//***********************************************AJAX*******************************************************************
$TYPO3_CONF_VARS['FE']['eID_include']['lth_fullcalendar'] = 'EXT:lth_fullcalendar/res/ajax.php'; //New

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_lthfullcalendar_pi1.php', '_pi1', 'list_type', 1);

t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_lthfullcalendar_evenement=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_lthfullcalendar_calendar=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_lthfullcalendar_category=1
');
?>