<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 

// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";

// Do it and store it all in variables in the BWi container.
//$bwix['title'] = "Pflimmer";
//echo getCurrentUrl();

if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}

$db = new CDatabase($bwix['database']);

$genre = isset($_GET['genre']) ? $_GET['genre'] : null;

// Get parameters for sorting
$genre = isset($_GET['genre']) ? $_GET['genre'] : null;

// Get all genres that are active
$sql = '
  SELECT DISTINCT G.name
  FROM Genre AS G
    INNER JOIN Movie2Genre AS M2G
      ON G.id = M2G.idGenre
';
// Fetch
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

$genres = null;
foreach($res as $val) {
  $genres .= "<a href=?genre={$val->name}>{$val->name}</a> ";
}

// Do SELECT from a table
if($genre) {
  $sql = '
    SELECT 
      M.*,
      G.name AS genre
    FROM Movie AS M
      LEFT OUTER JOIN Movie2Genre AS M2G
        ON M.id = M2G.idMovie
      INNER JOIN Genre AS G
        ON M2G.idGenre = G.id
    WHERE G.name = ?
    ;
  ';

  $params = array(
    $genre,
  );  
} 
else {
  $sql = 'SELECT * FROM VMovie;';
  $params = null;
}


$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);


// Put results into a HTML-table
$tr = '<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th>Genre</th></tr>';
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40'"
  . " src='{$val->image}' alt='{$val->title}' /></td>"
  . "<td>{$val->title}</td><td>{$val->year}</td><td>{$val->genre}</td></tr>";
}

// Do it and store it all in variables in the Anax container.
$bwix['genre'] = "Sök film per genre";

$paramsPrint = htmlentities(print_r($params, 1));

//$anax['main'] 

$bwix['main'] = <<<EOD
<h1>{$bwix['genre']}</h1>
<form>
<fieldset>
<legend>Sök</legend>
<p><label>Välj genre:</label><br/>{$genres}</p>
<p><a href='?'>Visa alla</a></p>
</fieldset>
</form>
<p>Resultatet från SQL-frågan:</p>
<pre>{$sql}</pre>
<pre>{$paramsPrint}</pre>
<table>
{$tr}
</table>
{$bwix['byline']}

EOD;


/*
$bwix['main'] = <<<EOD
{$trxx}

EOD;
*
 * 
 */

// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);