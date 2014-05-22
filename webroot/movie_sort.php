<?php 
/**
 * This is a BWi pagecontroller.
 *
 */

include(__DIR__.'/config.php'); 

// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
//session_start(); 

// echo the session variable
//echo 'The value of foo is '.$_SESSION['foo']; 

if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
  //echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  //echo "logge new";
}



if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}

$db = new CDatabase($bwix['database']);

  // $action =  isset($_SESSION['user']) ? TRUE : FALSE;
   //if($action){echo "wwwwwwwweeeeeeeeeeeerrrr";}
   
   
$bwix['inlinestyle'] = "
.orderby a {
  text-decoration: none;
  color: black;
}
";
$pluppas = $log->CheckLoggedIn($bwix['database']);


// Get parameters for sorting
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'asc';


// Check that incoming is valid
in_array($orderby, array('id', 'title', 'year')) or die('Check: Not valid column.');
in_array($order, array('asc', 'desc')) or die('Check: Not valid sort order.');

// Do SELECT from a table
$sql = "SELECT * FROM VMovie ORDER BY $orderby $order;";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

/**
 * Function to create links for sorting
 *
 * @param string $column the name of the database column to sort by
 * @return string with links to order by column.
 */
function orderby($column) {
  return "<span class='orderby'><a href='?orderby={$column}&amp;order=asc'>&amp;darr;</a><a href='?orderby={$column}&amp;.order=desc'>&amp;.uarr;</a></span>";
}
// Put results into a HTML-table
$tr = "<tr><th>Rad</th><th>Id " . orderby('id') . "</th><th>Bild</th><th>Titel " . orderby('title') . "</th><th>År " . orderby('year') . "</th><th>Genre</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40'"
  . " src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td>"
  . "<td>{$val->year}</td><td>{$val->genre}</td></tr>";
}

// Do it and store it all in variables in the Anax container.
$bwix['title'] = "<h1>Sortera tabellens innehåll</h1>";

//if(!$action){$bwix['title'] .= "<h3> Du är inte inloggad.</h3>";}
        
$bwix['main'] = <<<EOD
{$bwix['title']}
{$pluppas}
<p>Resultatet från SQL-frågan:</p>
<p><code>{$sql}</code></p>
<table>
{$tr}
</table>
{$bwix['byline']}

EOD;

// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);

