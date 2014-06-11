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




// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database2']);
  $bloggContent = new CContent($bwix['database2']);
  
  
$pluppas = $user->CheckLoggedIn($bwix['database']);
//echo "PLUPPAS  " . $pluppas;
// Get parameters 



$idnew     = isset($_POST['idnew'])    ? strip_tags($_POST['idnew']) : (isset($_GET['idnew']) ? strip_tags($_GET['idnew']) : null);
echo "<br> idnew  " . $idnew . "<br>";
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


echo "<br> idnew " . $idnew;
if($idnew) {
//$sql = 'INSERT INTO content (id) VALUES (NULL);';

/*
 //   $output = $content->createNew();   
 $url = empty($url) ? null : $url;
 // $params = array($title, $slug, $url, $data, $type, $filter, $published, $id);
 //$res = $db->ExecuteQuery($sql, $params);
$res = $db->ExecuteQuery($sql);
$idnew = FALSE;
*/

        $title = isset($_POST['title']) ? $_POST['title'] : null;  
          $sql = 'INSERT INTO Content (title) VALUES (?)';  
          $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;  
          $params = array($title);  
          $this->db->ExecuteQuery($sql,$params);  
          $id = $this->db->LastInsertId(); 
          
          echo "<br> ID  " . $id;
          $id = 7;
          header('Location:blogg_edit.php?id=' . $id); 



echo "<br> New createn!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!" ;
}






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


// Select from database


/*

$sql = 'INSERT INTO content (id) VALUES (NULL);';

 $url = empty($url) ? null : $url;
 // $params = array($title, $slug, $url, $data, $type, $filter, $published, $id);
 //$res = $db->ExecuteQuery($sql, $params);
$res = $db->ExecuteQuery($sql);

*/

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

//$res = $db->ExecuteQuery($sql);






/*
$sql = 'SELECT * FROM Content WHERE id = ?';
$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($id));

*/
 dumpa($res);
 
//$sql = 'SELECT LAST_INSERT_ID();';
 
 
if(isset($res[0])) {
  $c = $res[0];
}
else {
  //die('Misslyckades: det finns inget innehåll med sådant id.');
  $print = $db->lastInsertId();
  echo "<br> last id ---->>  " . $print;
    //$print = PDO::lastInsertId;
   //echo "<br> last id ---->>  " . $print;
  $sql = ' INSERT INTO Content Values (?,"", "", "", "", "", "", NOW(), NOW(), NOW(), NOW());';
 // insert into content Values (9,"", "", "", "", "", "", NOW(), NOW(), NOW(), NOW());
  
   $params = array($title, $slug, $url, $data, $type, $filter, $published, $id);
  $res = $db->ExecuteQuery($sql, $params);
  dumpa($res);
}

// Sanitize content before using it.
$title  = htmlentities($c->title, null, 'UTF-8');
$slug   = htmlentities($c->slug, null, 'UTF-8');
$url    = htmlentities($c->url, null, 'UTF-8');
$data   = htmlentities($c->data, null, 'UTF-8');
$type   = htmlentities($c->type, null, 'UTF-8');
$filter = htmlentities($c->filter, null, 'UTF-8');
$published = htmlentities($c->published, null, 'UTF-8');


// Prepare content and store it all in variables in the Anax container.
$bwix['title'] = "Uppdatera innehåll";
$bwix['debug'] = $db->Dump();
$idnew = FALSE;
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