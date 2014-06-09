<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 /* This is a Bwix pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 

function getUrlToContent($content) {
  switch($content->TYPE) {
    case 'page': return "blogg_page.php?url={$content->url}"; break;
    case 'post': return "blogg_showa.php?slug={$content->slug}"; break;
    default: return null; break;
  }
}


session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }

/**
 * Create a link to the content, based on its type.
 *
 * @param object $content to link to.
 * @return string with url to display content.
 */
 
/*
//echo "ee";
if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
 // echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
}
*/
if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "loggenew";
}


$_SESSION['navbar2']='blogg'; 
//$_SESSION['navbar2']='movie'; 
  //echo "loggenew";
// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database2']);


if($user->GetAcronym()) 
{ 
    $output = "Du är inloggad som " . $user->GetAcronym() . "."; 
} 
else 
{ 
    $output = "Du är INTE inloggad."; 
} 


// Get all content
$sql = '
  SELECT *, (published <= NOW()) AS available
  FROM Content;
';
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

// Put results into a list
$items = null;
foreach($res AS $key => $val) {
  $items .= "<li>{$val->TYPE} (" . (!$val->available ? 'inte ' : null) . "publicerad): " . htmlentities($val->title, null, 'UTF-8') . " (<a href='blogg_edit.php?id={$val->id}'>editera</a> <a href='" . getUrlToContent($val) . "'>visa</a>)</li>\n";
}

//$pluppas = $user->CheckLoggedIn($bwix['database2']); 
//echo "blogg  pluppas  " . $pluppas;


// Do it and store it all in variables in the Anax container.
$bwix['title'] = "Visa allt innehåll";
$bwix['debug'] = $db->Dump();

$bwix['main'] = <<<EOD
<h3>$output</h3> 
<h1>{$bwix['title']}</h1>

<p>Här är en lista på allt innehåll i databasen.</p>

<ul>
{$items}
</ul>

<p><a href='blogg_showa.php'>Visa alla bloggposter.</a></p>

EOD;



// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);