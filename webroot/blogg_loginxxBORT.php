<?php 
/**
 * This is a Bwix pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Login";


if(isset($_SESSION['loggeb'])) {
  $log = $_SESSION['loggeb'];
  //echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['loggeb'] = $log;
  //echo "logge new";
}

/*
echo "DUMP av SESSION start<br>";
dumpa($_SESSION);
echo "DUMP av SESSION stop<br>";
*/

$fromdb = $log->GetDBaseLoginBlogg($bwix['database2']);

/*
echo "DUMP av SESSION startAFTER<br>";
dumpa($_SESSION);
echo "DUMP av SESSION stop<br>";
*/
/*
echo "<br><br>blogglogin<br><br>";
echo $_SESSION[$bwix['database2']['dsn']]['loggedin'];
echo "<br>database  (Movie)<br><br>";
echo $_SESSION[$bwix['database']['dsn']]['loggedin'];
echo "<br>-blogglogin<br><br>";
*/
 
     $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
//echo "pluppaInside bllgn  " . $acronym;
 
 
$bwix['main'] = <<<EOD
{$fromdb}
{$bwix['byline']}

EOD;

include(BWI_THEME_PATH);