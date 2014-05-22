<?php 
/**
 * This is a Bwix pagecontroller.
 *
 */
// Include the essential config-file which also creates the $anax variable with its defaults.
include(__DIR__.'/config.php'); 

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Login";


if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
  //echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  //echo "logge new";
}


$fromdb = $log->GetDBaseLogin($bwix['database']);
//echo "GetDBaseLogin04<br>";
 
$bwix['main'] = <<<EOD
{$fromdb}
{$bwix['byline']}

EOD;

include(BWI_THEME_PATH);