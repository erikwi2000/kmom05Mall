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

/*
// Do it and store it all in variables in the Anax container.
//$bwix['title'] = "Logout";
$_SESSION['logge']->pricken = 171717;
//echo $_SESSION['logge']->pricken;
echo $_SESSION['logge']->pricken . " pricken  In movie_logout <br>";
*/
//-----------------------------------

$fromdb = $log->GetDBaseLogout($bwix['database']);

$bwix['main'] = <<<EOD
{$fromdb}
{$bwix['byline']}

EOD;


// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);