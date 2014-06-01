<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";

$db = new CDatabase($bwix['database']);
// Put results into a HTML-table
//echo "GetDBaseLogin01<br>";


if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "loggenew";
}

//Check of logged in
//$pluppas = $user->CheckLoggedIn($bwix['database']);


        
 $rrc = array(0 => "D",);
$rrc = $user->GetUserLoginStatus();
  $output = $rrc[0];
  $way = $rrc[1];  


$sql = "SELECT * FROM VMovie;";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);


$tr = "<p>Resultatet från SQL-frågan:</p>";
$tr .= $output;
$tr .= "<p><code>{$sql}</code></p>";
$tr .= "<table><tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th>Genre</th></tr>";

foreach($res AS $key => $val) {
$tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40'"
. " src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td>"
. "<td>{$val->year}</td><td>{$val->genre}</td></tr>";
}
$tr .= "</table>";
$bwix['main'] = <<<EOD
{$tr}
{$bwix['byline']}

EOD;

// Finally, leave it all to the rendering phase of BWi.
include(BWI_THEME_PATH);

/*

$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
echo $acronym;
*/


/*BEHIND
$hej = $bwix['database'];
//----------------------------------------
try {
  $pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	
}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
*/
//--------------------------------------
//=========================================

   

 //   $pluppas = isset($_SESSION['user']) ? "Du är inloggad!" : "Du är INTE inloggad!";
//echo "pluppa2" . $pluppas;




/*
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
echo $acronym;

*/
//-----------------------------------------------


//echo getCurrentUrl();

/*
if(isset($_SESSION['cdatabase'])) {
  $db = $_SESSION['cdatabase'];
}
else {
	$db = new CDatabase($bwix['database']);
  $_SESSION['cdatabase'] = $db;
}
*/
/*
if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}
*/