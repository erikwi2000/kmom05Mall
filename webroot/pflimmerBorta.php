<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 

/*
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
session_start();
*/
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";




/*
if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}

*/
//*

/*
if(isset($_SESSION['CDatabase'])) {
  $db = $_SESSION['CDatabase'];
		//dumpa($db);
}
else {
	$db = new CDatabase($bwix['database']);
//	dumpa($db);
  $_SESSION['CDatabase'] = $db;
}

*/
//$fromdb = $handle->GetDBasePflimmerStart($bwix['database']);

$bwix['title'] = "STARTA FILMANDE";

$bwix['main']  = <<<EOD
<h1>{$bwix['title']}</h1>
EOD;




$bwix['main'] = <<<EOD

{$bwix['byline']}

EOD;


// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);