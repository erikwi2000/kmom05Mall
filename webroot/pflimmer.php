<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }

// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";

//session_start(); 

// set the value of the session variable 'foo'
$_SESSION['foo']='  bar'; 
$tt = $_SESSION['foo'];

// echo a little message to say it is done

//echo 'Setting value of foo' . $tt; 
$acronym = isset($_SESSION['user']) ?  $_SESSION['user']->acronym : null;
//echo "user-  " . $test;




if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}


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
//$db = new CDatabase($bwix['database']);

//$db = new CDatabase($bwix['database']);
//$_SESSION['cdatabase'] = $db;
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