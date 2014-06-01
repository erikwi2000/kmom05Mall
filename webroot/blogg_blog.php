<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include(__DIR__.'/config.php'); 
include(__DIR__.'/filter.php'); 


session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database2']);


// Get parameters 
$slug    = isset($_GET['slug']) ? $_GET['slug'] : null;

$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;


// Get content
$slugSql = $slug ? 'slug = ?' : '1';
$sql = "
SELECT *
FROM Content
WHERE
  type = 'post' AND
  $slugSql AND
  published <= NOW()
ORDER BY updated DESC
;
";
$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($slug));
//dumpa($res);
// Prepare content and store it all in variables in the Bwix container.
$bwix['title'] = "Bloggen";
$bwix['debug'] = $db->Dump();

$bwix['main'] = null;
if(isset($res[0])) {
  foreach($res as $c) {
    // Sanitize content before using it.
    $title  = htmlentities($c->title, null, 'UTF-8');
    $data   = doFilter(htmlentities($c->data, null, 'UTF-8'), $c->filter);
//dumpa($data);
    if($slug) {
      $bwix['title'] = "$title | " . $bwix['title'];
    }
    $editLink = $acronym ? "<a href='blogg_edit.php?id={$c->id}'>Uppdatera posten</a>" : null;

    $bwix['main'] .= <<<EOD
<section>
  <article>
  <header>
  <h1><a href='blogg_blog.php?slug={$c->slug}'>{$title}</a></h1>
  </header>

  {$data}

  <footer>
  {$editLink}
  </footer
  </article>
</section>
EOD;
  }
}
else if($slug) {
  $bwix['main'] = "Det fanns inte en sådan bloggpost.";
}
else {
  $bwix['main'] = "Det fanns inga bloggposter.";
}


// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);
