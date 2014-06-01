<?php 
/**
 * This is a Bwix pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
  $_SESSION['navbar2']='pflimmer'; 


//$bwix['stylesheets'][] = '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css';

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

td.menu {
  padding-left: 1em;
  padding-right: 1em;
}

td.menu a {
  text-decoration: none;
  color: #666;
}

td.menu a:hover {
  color: #333;
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




if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  //echo "user old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "usernew";
}


//Check of logged in
//$pluppas = $log->CheckLoggedIn($bwix['database']);  

        
 $rrc = array(0 => "D",);
$rrc = $user->GetUserLoginStatus();
  $output = $rrc[0];
  $way = $rrc[1];  

/*
        
    if($user->GetAcronym()) 
{ 
    $output = "Du är inloggad som " . $user->GetAcronym() . "."; 
} 
else 
{ 
    $output = "Du är INTE inloggad."; 
}    
  
*/

$db = new CDatabase($bwix['database']);



if(!$user->GetAcronym())
    {
   // echo "NOPE";
    $tr = " Du är inte inloggad. Logga in till databasen.";
    }
 else {
// Do SELECT from a table
$sql = "SELECT * FROM Movie;";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);


// Put results into a HTML-table
$tr = "<table>";
$tr .= "<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th></th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40'"
  . " src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td>"
  . "<td>{$val->year}</td><td class='menu'><a href='movie_edit.php?id={$val->id}'>"
  . "<i class='icon-edit'></i></a></td></tr>";

  }
$tr .= "</table>";
 }  
 //echo "YESS";}

// Do it and store it all in variables in the Bwix container.
$bwix['title'] = "Välj och uppdatera info om film";

$sqlDebug = $db->Dump();

//------------------------------------
//$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>
<h3>$output</h3>
{$tr}
<div class=debug>{$sqlDebug}</div>
{$bwix['byline']}
EOD;

// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);
