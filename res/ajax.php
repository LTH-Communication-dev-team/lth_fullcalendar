<?php
// Exit, if script is called directly (must be included via eID in index_ts.php)
if (!defined ('PATH_typo3conf')) die ('Could not access this script directly!');

$title = htmlspecialchars(t3lib_div::_GP("title"));
$startDate = htmlspecialchars(t3lib_div::_GP("startDate"));
$endDate = htmlspecialchars(t3lib_div::_GP("endDate"));
$startTime = htmlspecialchars(t3lib_div::_GP("startTime"));
$endTime = htmlspecialchars(t3lib_div::_GP("endTime"));
$allday = htmlspecialchars(t3lib_div::_GP("allday"));
$description = htmlspecialchars(t3lib_div::_GP("description"));
$place = htmlspecialchars(t3lib_div::_GP("place"));

$action = htmlspecialchars(t3lib_div::_GP("action"));
$uid = htmlspecialchars(t3lib_div::_GP("uid"));
$sid = htmlspecialchars(t3lib_div::_GP("sid"));

date_default_timezone_set('Europe/Stockholm');

tslib_eidtools::connectDB();

switch($action) {
    case 'listEvents':
        listEvents();
        break;
    case 'addEvent':
        addEvent($title, $startDate, $endDate, $startTime, $endTime, $allday, $description, $place);
        break;
    case 'updateEvent':
        updateEvent($uid, $title, $startDate, $endDate, $startTime, $endTime, $allday, $description, $place);
        break;
    case 'getEvent':
        getEvent($uid);
        break;
    case 'deleteEvent':
        deleteEvent($uid);
        break;
}

// List of events
function listEvents()
{
    $event_array = array();
    $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,title,FROM_UNIXTIME(start) AS start, FROM_UNIXTIME(end) AS end,allday', 'tx_lthfullcalendar_evenement', 'deleted=0 AND hidden=0', '', '');
    $row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($res);
    while ($row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($res)) {
        //$retArray[] = $row;
        
        $event_array[] = array(
                'id' => $row['uid'],
                'title' => $row['title'],
                'start' => $row['start'],
                'end' => $row['end'],
                'allDay' => $row['allday'],
            );
    }
    $GLOBALS['TYPO3_DB']->sql_free_result($res);
    echo json_encode($event_array);
}


function addEvent($title, $startDate, $endDate, $startTime, $endTime, $allday, $description, $place)
{
    $start = strtotime($startDate . ' ' . str_replace(' ','',$startTime));
    $end = strtotime($endDate . ' ' . str_replace(' ','',$endTime));
    $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_lthfullcalendar_evenement', array('title' => $title, 'start' => $start, 'end' => $end, 'description' => $description, 'place' => $place, 'crdate' => time(), 'tstamp' => time()));
}


function updateEvent($uid, $title, $startDate, $endDate, $startTime, $endTime, $allday, $description, $place)
{
    $start = strtotime($startDate . ' ' . str_replace(' ','',$startTime));
    $end = strtotime($endDate . ' ' . str_replace(' ','',$endTime));
    $GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_lthfullcalendar_evenement', 'uid='.intval($uid), array('title' => $title, 'start' => $start, 'end' => $end, 'description' => $description, 'place' => $place, 'tstamp' => time()));
}


function getEvent($uid)
{
    $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,pid,title,FROM_UNIXTIME(start) AS start, FROM_UNIXTIME(end) AS end,place,description', 'tx_lthfullcalendar_evenement', 'uid='.intval($uid));
    $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
    $GLOBALS['TYPO3_DB']->sql_free_result($res);
    echo json_encode($row);
}


function deleteEvent($uid)
{
    $GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_lthfullcalendar_evenement', 'uid='.intval($uid), array('deleted' => 1, 'tstamp' => time()));
}