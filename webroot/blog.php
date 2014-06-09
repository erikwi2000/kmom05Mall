<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include(__DIR__.'/config.php'); 
include(__DIR__.'/filter.php'); 


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($anax['database']);


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


// Prepare content and store it all in variables in the Anax container.
$anax['title'] = "Bloggen";
$anax['debug'] = $db->Dump();

$anax['main'] = null;
if(isset($res[0])) {
  foreach($res as $c) {
    // Sanitize content before using it.
    $title  = htmlentities($c->title, null, 'UTF-8');
    $data   = doFilter(htmlentities($c->data, null, 'UTF-8'), $c->filter);

    if($slug) {
      $anax['title'] = "$title | " . $anax['title'];
    }
    $editLink = $acronym ? "<a href='edit.php?id={$c->id}'>Uppdatera posten</a>" : null;

    $anax['main'] .= <<<EOD
<section>
  <article>
  <header>
  <h1><a href='blog.php?slug={$c->slug}'>{$title}</a></h1>
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
  $anax['main'] = "Det fanns inte en sådan bloggpost.";
}
else {
  $anax['main'] = "Det fanns inga bloggposter.";
}


// Finally, leave it all to the rendering phase of Anax.
include(ANAX_THEME_PATH);
