<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $anax variable with its defaults.
include(__DIR__ . '/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));


//$bwix['stylesheets'][] = '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css';

$bwix['inlinestyle'] = "
.orderby a {
  text-decoration: none;
  color: black;
}

.dbtable {

}

.dbtable table {
  width: 100%;
}

.dbtable .rows {
  text-align: right;
}

.dbtable .pages {
  text-align: center;
}

td.menu {
  padding-left: 1em;
  padding-right: 1em;
}

td.menu a {
  text-decoration: none;
  color: #666;
}

td.menu a:hover {
  color: #333;
}

.debug {
  color: #666;
}

label {
  font-size: smaller;
}

input[type=text] {
  width: 300px;
}

select {
  height: 10em;
}
";


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database']);


if (!isset($_SESSION)) { session_start(); }

if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}


if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
}
$check = $log->IsUserAuthenticated();

$pluppas = $log->CheckLoggedIn($bwix['database']);
//echo $pluppas;



$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
//dumpa($acronym);
if($acronym) {
  $output = "Du är inloggad som: $acronym ({$_SESSION['user']->name})";
  $way = TRUE;
}
else {
  $output = "Du är INTE inloggad.";
  $way = FALSE;
}
//cho $output;
//echo "<br> way:  " . $way;
//if($way){echo "YES";} else {echo "NO";}

if(!$way)
    {
   // echo "NOPE";
    $tr = " Du är inte inloggad. Logga in till databasen.";
    }
 else {
// Do SELECT from a table
$sql = "SELECT * FROM Movie;";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);


// Put results into a HTML-table
$tr = "<table>";
$tr .= "<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th></th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40'"
  . " src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td>"
  . "<td>{$val->year}</td><td class='menu'><a href='movie_edit.php?id={$val->id}'><i class='icon-edit'></i></a></td></tr>";

  
  }
$tr .= "</table>";
 }  
 //echo "YESS";}

// Do it and store it all in variables in the Anax container.
$bwix['title'] = "Välj och uppdatera info om film";

$sqlDebug = $db->Dump();

//------------------------------------

$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>
<h3>$pluppas</h3>
{$tr}

<div class=debug>{$sqlDebug}</div>
{$bwix['byline']}
EOD;




// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);
