<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $anax variable with its defaults.
include(__DIR__.'/config.php'); 


/**
 * Create a link to the content, based on its type.
 *
 * @param object $content to link to.
 * @return string with url to display content.
 */
function getUrlToContent($content) {
  switch($content->type) {
    case 'page': return "page.php?url={$content->url}"; break;
    case 'post': return "blog.php?slug={$content->slug}"; break;
    default: return null; break;
  }
}


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database']);


// Get all content
$sql = '
  SELECT *, (published <= NOW()) AS available
  FROM Content;
';
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

// Put results into a list
$items = null;
foreach($res AS $key => $val) {
  $items .= "<li>{$val->type} (" . (!$val->available ? 'inte ' : null) . "publicerad): " . htmlentities($val->title, null, 'UTF-8') . " (<a href='edit.php?id={$val->id}'>editera</a> <a href='" . getUrlToContent($val) . "'>visa</a>)</li>\n";
}


// Do it and store it all in variables in the Anax container.
$anax['title'] = "Visa allt innehåll";
$anax['debug'] = $db->Dump();

$anax['main'] = <<<EOD
<h1>{$anax['title']}</h1>

<p>Här är en lista på allt innehåll i databasen.</p>

<ul>
{$items}
</ul>

<p><a href='blog.php'>Visa alla bloggposter.</a></p>

EOD;



// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);