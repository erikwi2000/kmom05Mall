<?php   
/**  
 * This is an bwix pagecontroller.  
 *  
 */  
// Include the essential config-file which also creates the $bwix variable with its defaults.  
include(__DIR__.'/config.php');   


session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }
// Connect to a MySQL database using PHP PDO  
$db = new CDatabase($bwix['database']);  
$content = new CContent($db);  

if(isset($_GET['delete']))  
{  
    $content->deleteAt($_GET['delete']);  
}  

$items = $content->createTable();  

// Do it and store it all in variables in the Aler container.  
$bwix['title'] = "Visa allt innehåll";  

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>  

<p>Här är en lista med allt innehåll i databasen.</p>  
<ul>  
{$items}  
</ul>  
<br /> 
<a href='create.php' class="button-blue">Skapa ny post/page</a>   
<a href='reset.php' class="button">Återställ databasen</a>   
<a href='blog.php' class="button">Visa alla bloggposter</a>   

EOD;

// Finally, leave it all to the rendering phase of Aler.  
include(BWI_THEME_PATH); 

