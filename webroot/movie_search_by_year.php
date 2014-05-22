<?php 
/**
 * This is a BWi pagecontroller.
 *
 */

include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";


if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}

$db = new CDatabase($bwix['database']);
// Get parameters
$year1 = isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null;
$year2 = isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null;

// Do SELECT from a table
if($year1 && $year2) {
  $sql = "SELECT * FROM VMovie WHERE year >= ? AND year <= ?;";
  $params = array(
    $year1,
    $year2,
  );  
} 
elseif($year1) {
  $sql = "SELECT * FROM VMovie WHERE year >= ?;";
  $params = array(
    $year1,
  );  
} 
elseif($year2) {
  $sql = "SELECT * FROM VMovie WHERE year <= ?;";
  $params = array(
    $year2,
  );  
} 
else {
  $sql = "SELECT * FROM VMovie;";
  $params = null;
}

$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

// Put results into a HTML-table
$tr = "<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th>Genre</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40' "
  . "src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td>"
  . "<td>{$val->year}</td><td>{$val->genre}</td></tr>";
}
// Do it and store it all in variables in the Anax container.
$bwix['title'] = "Sök film per år";

$year1 = htmlentities($year1);
$year2 = htmlentities($year2);
$paramsPrint = htmlentities(print_r($params, 1));
//$bwix['main'] 

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>
<form>
<fieldset>
<legend>Sök</legend>
<p><label>Skapad mellan åren: 
    <input type='text' name='year1' value='{$year1}'/>
    - 
    <input type='text' name='year2' value='{$year2}'/>
  </label>
</p>
<p><input type='submit' name='submit' value='Sök'/></p>
<p><a href='?'>Visa alla</a></p>
</fieldset>
</form>
<p>Resultatet från SQL-frågan:</p>
<p><code>{$sql}</code></p>
<p><pre>{$paramsPrint}</pre></p>
<table>
{$tr}
</table>
{$bwix['byline']}

EOD;

//-----------------------------------

// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);

