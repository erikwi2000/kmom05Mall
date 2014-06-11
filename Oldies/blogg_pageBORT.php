<?php
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
include(__DIR__.'/filter.php'); 


session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database2']);


// Get parameters 
$url     = isset($_GET['url']) ? $_GET['url'] : null;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;


// Get content
$sql = "
SELECT *
FROM Content
WHERE
  type = 'page' AND
  url = ? AND
  published <= NOW();
";
$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($url));

if(isset($res[0])) {
  $c = $res[0];
}
else {
  die('Misslyckades: det finns inget innehåll.');
}

// Sanitize content before using it.
$title  = htmlentities($c->title, null, 'UTF-8');
$data   = doFilter(htmlentities($c->data, null, 'UTF-8'), $c->filter);


// Prepare content and store it all in variables in the Bwix container.
$bwix['title'] = $title;
$bwix['debug'] = $db->Dump();

$editLink = $acronym ? "<a href='blogg_edit.php?id={$c->id}'>Uppdatera sidan</a>" : null;

$bwix['main'] = <<<EOD
<article>
<header>
<h1>{$title}</h1>
</header>

{$data}

<footer>
{$editLink}
</footer
</article>
EOD;



// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);
