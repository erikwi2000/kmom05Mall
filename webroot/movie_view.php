<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";

// Do it and store it all in variables in the BWi container.
//$bwix['title'] = "Pflimmer";
//echo getCurrentUrl();
 $db = new CDatabase($bwix['database']);
 
 
if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}


if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
  //echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
 // echo "loggenew";
}

/////////////////////////////////////
$check = $log->IsUserAuthenticated();

$pluppas = $log->CheckLoggedIn($bwix['database']);
//echo $pluppas;

//$fromdb = $handle->GetDBaseMovieView($bwix['database']);
//-----------------------------------------


 

/*
try {

  $pdo = new PDO([$dsn],[$login], [$password], [$options]);
 //	  $pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	

}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}

 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 */
 /*
if(isset($_SESSION['CDatabase'])) {
  $db = $_SESSION['CDatabase'];
}
else {

//echo "ZZZZNoDB";
	$db = new CDatabase($bwix['database']);
  $_SESSION['CDatabase'] = $db;
}
*/


$fromdb = $db->GetDBaseMovieView($bwix['database']);
$trxx = $fromdb;

//dumpa($trxx);

//echo "<br>Tillbaka <br>";
$bwix['main'] = <<<EOD
{$pluppas}
{$trxx}

{$bwix['byline']}

EOD;


// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);