<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }

  $_SESSION['navbar2']='pflimmer'; 


if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
 // echo "loggenew";
}




$bwix['inlinestyle'] = "
.orderby a {
  text-decoration: none;
  color: black;
}

.dbtable {

}

.dbtable table {
  width: 100%;
}

.dbtable .rows {
  text-align: right;
}

.dbtable .pages {
  text-align: center;
}

.debug {
  color: #666;
}

label {
  font-size: smaller;
}

input[type=text] {
  width: 300px;
}


select {
  height: 10em;
}
";



// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database']);
//$_SESSION['cdatabase'] = $db;


// Get parameters 
$title  = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
$create = isset($_POST['create'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;


// Check that incoming parameters are valid
//isset($acronym) or die('Check: You must login to edit.');


$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
//dumpa($acronym);


if($acronym) {
  $output = "Du är inloggad som " . $user->GetAcronym() . ".";
  $way = TRUE;
}
else {
  $output = "Du är INTE inloggad.";
  $way = FALSE;
}
//echo $output;
//echo "<br> way:  " . $way;


$bwix['title'] = "Skapa ny film";
if(!$way) {
        //echo "NOPE";
    $tr = "<h3> Du är inte inloggad. Logga in till databasen.</h3>";
    $bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>
{$tr}
{$bwix['byline']}

EOD;
    
}
 else {
    
 
// Check if form was submitted
if($create) {
   //  echo "<br>Insert--------------<br>"; 
    // $bwix['title'] = "PRUTTAR";
 $sql = "INSERT INTO Movie (title) VALUES (?);";
  //echo "<br>Insert--------------<br>";
  $db->ExecuteQuery($sql, array($title));
  $db->SaveDebug();
  header('Location: movie_edit.php?id=' . $db->LastInsertId());
  exit;
}
 

/*
if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
 // echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  //echo "loggenew";
}
*/
//Check of logged in
//
//

        
 $rrc = array(0 => "D",);
$rrc = $user->GetUserLoginStatus();
  $output = $rrc[0];
  $way = $rrc[1];  

//$pluppas = $db->CheckLoggedIn($bwix['database']);
$pluppas = $output;

//<h3>{$pluppas}</h3>
//
//
//echo $pluppas;
// Do it and store it all in variables in the Anax container.


$sqlDebug = $db->Dump();

//$create = TRUE;
$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>
<h3>{$pluppas}</h3>
<form method=post>
  <fieldset>
  <legend>Skapa ny film</legend>
  <p><label>Titel:<br/><input type='text' name='title'/></label></p>
  <p><input type='submit' name='create' value='Skapa'/></p>
  </fieldset>
</form>
{$bwix['byline']}
EOD;
 }
 


// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);