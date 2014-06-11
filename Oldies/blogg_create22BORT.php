<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }




if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  //echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "logge new";
}
/*
if(isset($_SESSION['bloggContent'])) {
  $content = $_SESSION['bloggContent'];
  //echo "logge old";
}
else {
	$content = new CUser();
  $_SESSION['bloggContent'] = $content;
  //echo "logge new";
}
*/

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database2']);
  $bloggContent = new CContent($bwix['database2']);
 // createPost(array $postvar)
  
$pluppas = $user->CheckLoggedIn($bwix['database']);
//echo "PLUPPAS  " . $pluppas;
// Get parameters 


$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
echo "<br> iD " . $id;
$title  = isset($_POST['title']) ? $_POST['title'] : null;
echo "<br> title " . $title . "  <br>";
$slug   = isset($_POST['slug'])  ? $_POST['slug']  : null;
$url    = isset($_POST['url'])   ? strip_tags($_POST['url']) : null;
$data   = isset($_POST['data'])  ? $_POST['data'] : array();
$type   = isset($_POST['type'])  ? strip_tags($_POST['type']) : array();
$filter = isset($_POST['filter']) ? $_POST['filter'] : array();
$published = isset($_POST['published'])  ? strip_tags($_POST['published']) : array();
$save   = isset($_POST['save'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
echo "<br> stripped<br>";


// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to edit.');
is_numeric($id) or die('Check: Id must be numeric.');


echo "<br> acronym id " . $acronym . "  --  " . $id . "  <br>";
// dumpa($db);
// Check if form was submitted
$output = null;
echo "<br> outside saved <br>";

if($save) {
     echo "<br> inside saved <br>";
  $sql = '
    UPDATE Content SET
      title   = ?,
      slug    = ?,
      url     = ?,
      data    = ?,
      type    = ?,
      filter  = ?,
      published = ?,
      updated = NOW()
    WHERE 
      id = ?
  ';
  $url = empty($url) ? null : $url;
  $params = array($title, $slug, $url, $data, $type, $filter, $published, $id);
  dumpa($params);
  $res = $db->ExecuteQuery($sql, $params);
  //dumpa($res);
  if($res) {
    $output = 'Informationen sparades.';
  }
  else {
    $output = 'Informationen sparades EJ.<br><pre>' . print_r($db->ErrorInfo(), 1) . '</pre>';
  }
}
else{
       echo "<br>NOT   Saving<br>";
 $title  = "New Item";
$slug   = " ";
$url    = " ";
$data   = " ";
$type   = " ";
$filter = " ";
$published = " ";   


    
}


// Select from database
$sql = 'SELECT * FROM Content WHERE id = ?';
echo "id" . $id;
$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($id));
 dumpa(array($id)) ;
 dumpa($res);

if(isset($res[0])) {
  $c = $res[0];
}
else {
  //die('Misslyckades: det finns inget innehåll med sådant id.');
    echo $id . "Misslyckades: det finns inget innehåll med sådant id.";
}

// Sanitize content before using it.

if($save) {
    echo "<br>Sanitize!<br>";

$title  = htmlentities($c->title, null, 'UTF-8');
$slug   = htmlentities($c->slug, null, 'UTF-8');
$url    = htmlentities($c->url, null, 'UTF-8');
$data   = htmlentities($c->data, null, 'UTF-8');
$type   = htmlentities($c->type, null, 'UTF-8');
$filter = htmlentities($c->filter, null, 'UTF-8');
$published = htmlentities($c->published, null, 'UTF-8');

}

// Prepare content and store it all in variables in the Anax container.
$bwix['title'] = "Uppdatera innehåll";
$bwix['debug'] = $db->Dump();

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>

<form method=post>
  <fieldset>
  <legend>Skapa ny post</legend>
  <input type='hidden' name='id' value='{$id}'/>
  <p><label>Titel:<br/><input type='text' name='title' value='{$title}'/></label></p>
  <p><label>Slug:<br/><input type='text' name='slug' value='{$slug}'/></label></p>
  <p><label>Url:<br/><input type='text' name='url' value='{$url}'/></label></p>
  <p><label>Text:<br/><textarea name='data'>{$data}</textarea></label></p>
  <p><label>Type:<br/><input type='text' name='type' value='{$type}'/></label></p>
  <p><label>Filter:<br/><input type='text' name='filter' value='{$filter}'/></label></p>
  <p><label>Publiseringsdatum:<br/><input type='text' name='published' value='{$published}'/></label></p>
  <p class=buttons><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
  <p><a href='blogg_view.php'>Visa alla</a></p>
  <output>{$output}</output>
  </fieldset>
</form>

EOD;



// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);