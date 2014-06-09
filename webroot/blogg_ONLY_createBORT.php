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
//--------------------------------------------
if(isset($_SESSION['newItem'])) {
 $_SESSION['newItem'] = $_SESSION['newItem']+1;
 echo "<br> OneMoreNews:   " . $_SESSION['newItem'];
  //echo "logge old";
}
else {
$_SESSION['newItem'] = 1;
echo "<br> RealNews:   " . $_SESSION['newItem'];
  //echo "logge new";
}
//$_SESSION['bloggContent'] = [bloggContent]
//-------------------
if(isset($_SESSION['CDatabase'])) {
  $db = $_SESSION['CDatabase'];
}
else {

//echo "ZZZZNoDB";
	$db = new CDatabase($bwix['database2']);
  $_SESSION['CDatabase'] = $db;
}
// Connect to a MySQL database using PHP PDO
//$db = new CDatabase($bwix['database2']);


  $bloggContent = new CContent($bwix['database2']);
  
  
$pluppas = $user->CheckLoggedIn($bwix['database2']);
//echo "PLUPPAS  " . $pluppas;
// Get parameters 



//$idnew     = isset($_POST['idnew'])    ? strip_tags($_POST['idnew']) : (isset($_GET['idnew']) ? strip_tags($_GET['idnew']) : null);
//echo "<br> idnew  " . $idnew . "<br>";
$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title  = isset($_POST['title']) ? $_POST['title'] : null;
$slug   = isset($_POST['slug'])  ? $_POST['slug']  : null;
$url    = isset($_POST['url'])   ? strip_tags($_POST['url']) : null;
$data   = isset($_POST['data'])  ? $_POST['data'] : array();
$type   = isset($_POST['type'])  ? strip_tags($_POST['type']) : array();
$filter = isset($_POST['filter']) ? $_POST['filter'] : array();
$published = isset($_POST['published'])  ? strip_tags($_POST['published']) : array();
$save   = isset($_POST['save'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

// Check that incoming parameters are valid
isset($acronym) or die('Check: You must login to edit.');
is_numeric($id) or die('Check: Id must be numeric.');
//echo "<br> acronym id " . $acronym . "  --  " . $id . "  <br>";
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

  $res = $db->ExecuteQuery($sql, $params);
  if($res) {
    $output = 'Informationen sparades.';
  }
  else {
    $output = 'Informationen sparades EJ.<br><pre>' . print_r($db->ErrorInfo(), 1) . '</pre>';
  }
}

//2	om	om	page	Om	Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig ...	markdown	2014-06-05 17:30:29	2014-06-05 17:30:29		


$slug = "om";
$url = "om";
$type = "page";
$title = "om";
$data = "jkasjdhfalksdhflkasjhdflakshdflakshdflkajsh  asdkfjhaskdfa";
$filter = "markdown";
   $published = "2014-06-03";
    $updated  = "2014-06-03";
    //$id=8;

if($_SESSION['newItem'] == 1) {
    echo "<br> New apae ";

// $sql = 'INSERT INTO content (slug, url, type, title, data, filter, published, created)'
 //       . 'VALUES (NULL);';

//$sql = 'INSERT INTO content ;';
 $sql = 'INSERT INTO Content (title) VALUES (?)';     

 $url = empty($url) ? null : $url;
 //echo "<br>hohohhhhhhhhhhhhhhhhh";
// $params = array(NULL);
  $params = array($title, $slug, $url, $data, $type, $filter, $published, $id);
//  INSERT INTO Content (slug, url, type, title, data, filter, published, created) VALUES
 //  ('hem', 'hem', 'page', 'Hem', "Dettaengar.", 'bbcode,nl2br', NOW(), NOW()),
 
  dumpa($params);
  
  echo "<br>id  " . $id;
 echo "<br>id  " . $params[7];


  $debug = FALSE;
  $res = $db->ExecuteQuery($sql,$params = array(), $debug);
 //$res = $db->ExecuteQuery($sql);
 
//$res = $db->ExecuteQuery($sql);
//$idnew = FALSE;
 dumpa($res);
echo "<br> After resdumpa New createnhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh!!!!" ;


}
// Select from database


/*
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

$res = $db->ExecuteQuery($sql);
*/





/*
$sql = 'SELECT * FROM Content WHERE id = ?';
$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($id));

*/
echo "<br> res  ";
dumpa($res);
 echo "<br> res  ";
//$sql = 'SELECT LAST_INSERT_ID();';
 
 
if(isset($res[0])) {
  $c = $res[0];
}
else {
  die('Misslyckades: det finns inget innehåll med sådant id.');

}

echo "<br> testet " . $_SESSION['newItem'] ;
if($_SESSION['newItem'] > 1) {
    echo "  rep--- " . $_SESSION['newItem'] ;
// Sanitize content before using it.
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
//$idnew = FALSE;
$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>

<form method=post>
  <fieldset>
  <legend>Uppdatera innehåll</legend>
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