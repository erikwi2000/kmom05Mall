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

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }

 
function getUrlToContent($content) {
  switch($content->type) {
    case 'page': return "blogg_page.php?url={$content->url}"; break;
    case 'post': return "blogg_blog.php?slug={$content->slug}"; break;
    default: return null; break;
  }
}
//echo "ee";

// Connect to a MySQL database using PHP PDO

$db = new CDatabase($bwix['database2']);
 $bloggContent = new CContent($bwix['database2']); 
//dumpa($bloggContent);
//echo "<br> dump bloggC 1 <br>";
    
 if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "loggenew";
}   
$rrc = array(0 => "D",);
$rrc = $user->GetUserLoginStatus();
  $output = $rrc[0];
  $way = $rrc[1];
  



  //dumpa($bloggContent);
//echo "<br> dump bloggC 2 <br>";
  
  if(isset($_GET['delete']))  
{  
      
    //    dumpa($bloggContent);
//echo "<br> dump bloggC 3 <br>";
     // echo "<brIn in GET deleta";
   //  $content->deleteAt($_GET['delete']);   
     // dumpa($bloggContent);
   //   echo "<br>1. bloggContent<br>";
     /// echo $_GET['delete'];
       //     echo "<br>2. bloggContent<br>";
            $xxx = $_GET['delete'];
            
             $bloggContent->params = array($xxx);
        //    echo "<br>3. params array <br>";
        //    dumpa($bloggContent->params);
         //       echo "<br>4. dumpat! params array <br>";
              $sql = "DELETE FROM Content WHERE id = ?"; 
              $bloggContent->query = array($sql);
       //       echo "<br>55555555555555555. sql<br>";
          //    echo "<br> <br> LEAVING blogg_view<br><br>";
              
    $rrrrrr = $db->deleteAt22($sql, $bloggContent->params);  
             //     echo "<br>6. rrrrrr<br>";
  //  echo $rrrrrr;
    
} 
   
//----------------

/*

if(isset($_GET['newpost']))  
{  
      
        dumpa($bloggContent);
echo "<br> dump bloggC 3XX <br>";
      echo "<brIn in GET deleta";
   //  $content->deleteAt($_GET['delete']);   
      dumpa($bloggContent);
      echo "<br>1. bloggContent<br>";
      echo $_GET['newpost'];
            echo "<br>2. bloggContent<br>";
            $xxx = $_GET['newpost'];
            
             $bloggContent->params = array($xxx);
            echo "<br>3. params array <br>";
            dumpa($bloggContent->params);
                echo "<br>4. dumpat! params array <br>";
              $sql = "INSERT INTO Content WHERE id = ?"; 
              $bloggContent->query = array($sql);
              echo "<br>55555555555555555. sql<br>";
              echo "<br> <br> LEAVING blogg_view<br><br>";
              
    $rrrrrr = $bloggContent->create($sql, $bloggContent->params);  
                  echo "<br>6. rrrrrr<br>";
    echo $rrrrrr;
    
} 
  */

if($user->GetAcronym()) 
{ 
    $output = "Du är inloggad som " . $user->GetAcronym() . "."; 
    //echo "<br>" . $output . "<br>";
} 
else 
{ 
    $output = "Du är INTE inloggad."; 
 // echo "<br>" . $output . "<br>";
} 


// Get all content
$sql = '
  SELECT *, (published <= NOW()) AS available
  FROM Content;
';
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

// Put results into a list
$items = null;
$idplus = 0;
$idx = 0;
foreach($res AS $key => $val) {
                  $idx++;
      $items .= "<li> {$val->type} (" . 
              (!$val->available ? 'inte ' : null) . 
              "publicerad): " . htmlentities($val->title, null, 'UTF-8') . 
              " (<a href='blogg_edit.php?id={$val->id}'>editera </a> <a href='" .
              getUrlToContent($val) . "'>visa </a>" .
                 "<a href='?delete=" . $val->id . "'>delete </a>)"
                      . "(  id = {$idx}) </li>\n"     
              ;
              /*
              
              
              
                   foreach($res AS $key => $val) {  
          $items .= "<li>{$val->type} (" . (!$val->available ? 'inte ' : null) . "publicerad): " .  
           htmlentities($val->title, null, 'UTF-8') 
               
               . " (<a href='edit.php?id={$val->id}'>editera</a>  |  <a href='" . $this->getUrlToContent($val) . "'>visa</a> |  
           <a href='?delete=" . $val->id . "'>delete</a>)</li>\n";  
        }  
              
              
              */
              $idplus++;

              $rrrr = $val->id;
           //   echo "<br> idplus  " . $idplus . " id i posten " . $rrrr ;
}

$idx++;
//echo "<br> idplus  " . $idplus . " last id -->> " . $rrrr . " next free id  " . $idx;

$output ="<br><h3>" . $output . "</h3>";


if(isset($_SESSION['newItem'])) {
 $_SESSION['newItem'] = 0;
 //echo "<br> OneMoreNewsInView:   " . $_SESSION['newItem'];
  //echo "logge old";
}
//$bloggContent = new CContent($bwix['database2']);

//$items2 = $bloggContent->createTable();

// Do it and store it all in variables in the Bwix container.
$bwix['title'] = "Visa allt innehåll";
$bwix['debug'] = $db->Dump();
//$newitem = TRUE;
$bwix['main'] = <<<EOD
{$output}
<h1>{$bwix['title']}</h1>

<p>Här är en lista på allt innehåll i databasen.</p>

<ul>
{$items}
</ul>

<p><a href='blogg_blog.php'>Visa alla bloggposter.</a></p>
<p><a href='blogg_create.php'>Skapa ny bloggpost.</a></p>
<a href='blogg_reset.php' class="button">Återställ databasen</a>   
 
{$bwix['byline']}
EOD;



// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);