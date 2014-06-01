<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
include(__DIR__.'/filter.php'); 


// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database']);


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
$bwix['title'] = "Bloggen";
$bwix['debug'] = $db->Dump();

$bwix['main'] = null;
if(isset($res[0])) {
  foreach($res as $c) {
    // Sanitize content before using it.
    $title  = htmlentities($c->title, null, 'UTF-8');
    $data   = doFilter(htmlentities($c->data, null, 'UTF-8'), $c->filter);

    if($slug) {
      $bwix['title'] = "$title | " . $bwix['title'];
    }
    $editLink = $acronym ? "<a href='edit.php?id={$c->id}'>Uppdatera posten</a>" : null;

    $bwix['main'] .= <<<EOD
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
  $bwix['main'] = "Det fanns inte en sådan bloggpost.";
}
else {
  $bwix['main'] = "Det fanns inga bloggposter.";
}


// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);


