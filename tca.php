<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_lthfullcalendar_evenement'] = array(
	'ctrl' => $TCA['tx_lthfullcalendar_evenement']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,start,end,url,allday,place,description,calendar,category'
	),
	'feInterface' => $TCA['tx_lthfullcalendar_evenement']['feInterface'],
	'columns' => array(
		'sys_language_uid' => array(		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array(		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table'       => 'tx_lthfullcalendar_evenement',
				'foreign_table_where' => 'AND tx_lthfullcalendar_evenement.pid=###CURRENT_PID### AND tx_lthfullcalendar_evenement.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array(		
			'config' => array(
				'type' => 'passthrough'
			)
		),
		'hidden' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array(
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array(
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array(
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'title' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.title',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required,trim',
			)
		),
		'start' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.start',		
			'config' => array(
				'type'     => 'input',
				'size'     => '12',
				'max'      => '20',
				'eval'     => 'datetime',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'end' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.end',		
			'config' => array(
				'type'     => 'input',
				'size'     => '12',
				'max'      => '20',
				'eval'     => 'datetime',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'url' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.url',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'allday' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.allday',		
			'config' => array(
				'type' => 'check',
			)
		),
		'place' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.place',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'description' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.description',		
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'       => 1,
						'type'          => 'script',
						'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon'          => 'wizard_rte2.gif',
						'script'        => 'wizard_rte.php',
					),
				),
			)
		),
		'calendar' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.calendar',		
			'config' => array(
				'type' => 'select',	
				'foreign_table' => 'tx_lthfullcalendar_calendar',	
				'foreign_table_where' => 'ORDER BY tx_lthfullcalendar_calendar.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_lthfullcalendar_calendar',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_lthfullcalendar_calendar',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'category' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_evenement.category',		
			'config' => array(
				'type' => 'select',	
				'foreign_table' => 'tx_lthfullcalendar_category',	
				'foreign_table_where' => 'ORDER BY tx_lthfullcalendar_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_lthfullcalendar_category',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_lthfullcalendar_category',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2, start;;;;3-3-3, end, url, allday, place, description;;;richtext[]:rte_transform[mode=ts], calendar, category')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group')
	)
);



$TCA['tx_lthfullcalendar_calendar'] = array(
	'ctrl' => $TCA['tx_lthfullcalendar_calendar']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,fe_group,title'
	),
	'feInterface' => $TCA['tx_lthfullcalendar_calendar']['feInterface'],
	'columns' => array(
		'sys_language_uid' => array(		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array(		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table'       => 'tx_lthfullcalendar_calendar',
				'foreign_table_where' => 'AND tx_lthfullcalendar_calendar.pid=###CURRENT_PID### AND tx_lthfullcalendar_calendar.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array(		
			'config' => array(
				'type' => 'passthrough'
			)
		),
		'hidden' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'fe_group' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'title' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_calendar.title',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2')
	),
	'palettes' => array(
		'1' => array('showitem' => 'fe_group')
	)
);



$TCA['tx_lthfullcalendar_category'] = array(
	'ctrl' => $TCA['tx_lthfullcalendar_category']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,fe_group,title'
	),
	'feInterface' => $TCA['tx_lthfullcalendar_category']['feInterface'],
	'columns' => array(
		'sys_language_uid' => array(		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array(		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table'       => 'tx_lthfullcalendar_category',
				'foreign_table_where' => 'AND tx_lthfullcalendar_category.pid=###CURRENT_PID### AND tx_lthfullcalendar_category.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array(		
			'config' => array(
				'type' => 'passthrough'
			)
		),
		'hidden' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'fe_group' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'title' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lth_fullcalendar/locallang_db.xml:tx_lthfullcalendar_category.title',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;;;2-2-2')
	),
	'palettes' => array(
		'1' => array('showitem' => 'fe_group')
	)
);
?>