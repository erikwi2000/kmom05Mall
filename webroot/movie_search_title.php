<?php 
/**
 * This is a BWi pagecontroller.
 *
 */

//variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "PFlimmer";

//echo getCurrentUrl();

if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}

$db = new CDatabase($bwix['database']);

// Get parameters for sorting
$title = isset($_GET['title']) ? $_GET['title'] : null;

// Do SELECT from a table
if($title) {
  $sql = "SELECT * FROM VMovie WHERE title LIKE ?;";
  $params = array(
    $title,
  );  
} 
else {
  $sql = "SELECT * FROM VMovie;";
  $params = null;
}
// Fetch search

$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);

// Put results into a HTML-table

$tr = "<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th>Genre</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40'"
  . " src='{$val->image}' alt='{$val->title}' /></td>"
  . "<td>{$val->title}</td><td>{$val->year}</td><td>{$val->genre}</td></tr>";
}


// Do it and store it all in variables in the Bwix container.
$bwix['title'] = "Sök titel i filmdatabasen";

$title = htmlentities($title);
$paramsPrint = htmlentities(print_r($params, 1));
//dumpa($paramsPrint);


//$bwix['main'] 

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>
<form>
<fieldset>
<legend>Sök</legend>
<p><label>Titel (delsträng, använd % som *): <input type='search' name='title' value='{$title}'/></label></p>
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




// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);