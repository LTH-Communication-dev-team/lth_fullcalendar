<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Tomas Havner <tomas.havner@kansli.lth.se>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

// require_once(PATH_tslib . 'class.tslib_pibase.php');

/**
 * Plugin 'LTH Fullcalendar' for the 'lth_fullcalendar' extension.
 *
 * @author	Tomas Havner <tomas.havner@kansli.lth.se>
 * @package	TYPO3
 * @subpackage	tx_lthfullcalendar
 */
class tx_lthfullcalendar_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_lthfullcalendar_pi1';		// Same as class name
	public $scriptRelPath = 'pi1/class.tx_lthfullcalendar_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'lth_fullcalendar';	// The extension key.
	public $pi_checkCHash = TRUE;
	
	/**
	 * The main method of the Plugin.
	 *
	 * @param string $content The Plugin content
	 * @param array $conf The Plugin configuration
	 * @return string The content that is displayed on the website
	 */
	public function main($content, array $conf) {
            $this->conf = $conf;
            $this->pi_setPiVarDefaults();
            $this->pi_loadLL();
            
            $this->pi_initPIflexForm();
            $piFlexForm = $this->cObj->data["pi_flexform"];
            $index = $GLOBALS["TSFE"]->sys_language_uid;
            $sDef = current($piFlexForm["data"]);       
            $lDef = array_keys($sDef);
            $calendar_name = $this->pi_getFFvalue($piFlexForm, "calendar_name", "sDEF", $lDef[$index]);
            $record_storage = $this->pi_getFFvalue($piFlexForm, "record_storage", "sDEF", $lDef[$index]);

            $GLOBALS["TSFE"]->additionalHeaderData["fullcalendar_css"] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/typo3conf/ext/lth_fullcalendar/vendor/fullcalendar.css\" />";
            $GLOBALS["TSFE"]->additionalHeaderData["lth_fullcalendar_css"] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/typo3conf/ext/lth_fullcalendar/res/lth_fullcalendar.css\" />";
            $GLOBALS["TSFE"]->additionalHeaderData["moment_js"] = '<script type="text/javascript" src="typo3conf/ext/lth_fullcalendar/vendor/moment.min.js"></script>';
            $GLOBALS["TSFE"]->additionalHeaderData["fullcalendar_js"] = '<script type="text/javascript" src="typo3conf/ext/lth_fullcalendar/vendor/fullcalendar.min.js"></script>';
            $GLOBALS["TSFE"]->additionalHeaderData["lth_fullcalendar_js"] = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"/typo3conf/ext/lth_fullcalendar/res/lth_fullcalendar.js\"></script>"; 
            $GLOBALS["TSFE"]->additionalHeaderData["jquery-ui_css"] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/fileadmin/templates/css/jquery-ui.min.css\" />";
            $GLOBALS["TSFE"]->additionalHeaderData["lth_fullcalendar_sv_js"] = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"/typo3conf/ext/lth_fullcalendar/vendor/sv.js\"></script>"; 

            $GLOBALS["TSFE"]->additionalHeaderData["jquery-timepicki_js"] = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"/typo3conf/ext/lth_fullcalendar/vendor/timepicki.js\"></script>"; 
            $GLOBALS["TSFE"]->additionalHeaderData["jquery-timepicki_css"] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/typo3conf/ext/lth_fullcalendar/vendor/timepicki.css\" />";
          
            
            
            $modalBox = "<div id=\"calEventDialog\">
                <form>
                    <fieldset>
                    <div><label for=\"eventTitle\">Title</label></div>
                    <div><div><input type=\"text\" name=\"eventTitle\" id=\"eventTitle\" /></div>
                    <div><label for=\"eventStartDate\">Start Date</label></div>
                    <div><div><input type=\"text\" name=\"eventStartDate\" id=\"eventStartDate\"></div><div><input type=\"text\" class=\"eventStartTime\" name=\"eventStartTime\" id=\"eventStartTime\" /></div></div>
                    <div><label for=\"eventEndDate\">End Date</label></div>
                    <div><div><input type=\"text\" name=\"eventEndDate\" id=\"eventEndDate\" /></div><div><input type=\"text\" class=\"eventEndTime\" name=\"eventEndTime\" id=\"eventEndTime\" /></div></div>
                    <div><div><input type=\"radio\" id=\"allday\" name=\"allday\" value=\"1\">All Day</div></div>
                    <div><label for=\"eventPlace\">Place</label></div>
                    <div><div><input type=\"text\" name=\"eventPlace\" id=\"eventPlace\" /></div></div>
                    <div><label for=\"eventDescription\">eventDescription</label></div>
                    <div><div><textarea name=\"eventDescription\" id=\"eventDescription\" rows=\"4\" cols=\"20\"></textarea></div></div>
                    <input type=\"hidden\" name=\"eventUid\" id=\"eventUid\" />
                    <input type=\"hidden\" name=\"pid\" id=\"pid\" value=\"$record_storage\" />
                    </fieldset>
                </form>
            </div>";
            $content = "
                    <div id=\"lthFullCalendar\"></div><input type=\"hidden\" name=\"calendar_name\" id=\"calendar_name\" value=\"$calendar_name\" /><noscript></noscript>$modalBox
            ";

            return $content;
	}
}



if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/lth_fullcalendar/pi1/class.tx_lthfullcalendar_pi1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/lth_fullcalendar/pi1/class.tx_lthfullcalendar_pi1.php']);
}

?>