<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

include_once(t3lib_extMgm::extPath($_EXTKEY).'/res/class.tx_sampleflex_addFieldsToFlexForm.php');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform'; //New
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:lth_fullcalendar/flexform_ds_pi1.xml'); //New

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:lth_fullcalendar/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_extMgm::allowTableOnStandardPages('tx_lthfullcalendar_evenement');


t3lib_extMgm::addToInsertRecords('tx_lthfullcalendar_evenement');

$TCA['tx_lthfullcalendar_evenement'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement',		
		'label'     => 'uid',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array(		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_lthfullcalendar_evenement.gif',
	),
);


t3lib_extMgm::allowTableOnStandardPages('tx_lthfullcalendar_calendar');


t3lib_extMgm::addToInsertRecords('tx_lthfullcalendar_calendar');

$TCA['tx_lthfullcalendar_calendar'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_calendar',		
		'label'     => 'uid',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array(		
			'disabled' => 'hidden',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_lthfullcalendar_calendar.gif',
	),
);


t3lib_extMgm::allowTableOnStandardPages('tx_lthfullcalendar_category');


t3lib_extMgm::addToInsertRecords('tx_lthfullcalendar_category');

$TCA['tx_lthfullcalendar_category'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_category',		
		'label'     => 'uid',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array(		
			'disabled' => 'hidden',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_lthfullcalendar_category.gif',
	),
);
?>