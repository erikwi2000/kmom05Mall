<?php  
include(__DIR__.'/config.php');  

$db = new CDatabase($adaras['database']);  
$content = new CContent($db);  

$adaras['stylesheets'][] = 'css/table.css';  
$adaras['stylesheets'][] = 'css/form.css';  

// Get parameters   
$id = isset($_GET['id']) ? strip_tags($_GET['id']) : null;  
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;  
$output = null;  

// Check that incoming parameters are valid  
isset($acronym) or header("Location: error.php");  
//isset($acronym) or die('Check: You must login to create.');  
//is_numeric($id) or die('Check: Id must be numeric.');  

if(isset($_POST['doSave'])) {   
    $output = $content->updateContent($id);       
}   

$res = $content->getContent($id);   

$title = htmlentities($res->title, null, 'UTF-8');   
$slug = htmlentities($res->slug, null, 'UTF-8');   
$url = htmlentities($res->url, null, 'UTF-8');   
$data = htmlentities($res->data, null, 'UTF-8');   
$type = htmlentities($res->type, null, 'UTF-8');   
$filter = htmlentities($res->filter, null, 'UTF-8');   
$published = htmlentities($res->published, null, 'UTF-8');   


$adaras['title'] = "Redigera";  
$adaras['main'] = <<<EOD

<h1>{$adaras['title']}</h1>  

<form method=post>  
  <fieldset>  
  <legend>Uppdatera innehåll</legend>  
  <input type='hidden' name='id' value='{$id}'/>  
 <p><label>Titel:</label><br/><input type="text" name="title" required placeholder="Titel" value='{$title}'/></p> 
  <p><label>Slug:</label><br/><input type="text" name="slug" required placeholder="Slug" value='{$slug}'/></p> 
  <p><label>Url:</label><br/><input type="text" name="url" required placeholder="URL" value='{$url}'/></p> 
  <p><label>Text:</label><br/><textarea name="data" cols="50" rows="6" required placeholder="Innehåll ...">{$data}</textarea></p> 
  <p><label>Type (post, page):</label><br/><input type="text" name="type" required placeholder="Typ" value='{$type}'/></p> 
  <p><label>Filter:</label><br/><input type="text" name="filter" required value="nl2br" placeholder="Filter" value='{$filter}'/></p> 
  <p><label>Publiseringsdatum:</label><br/><input type="text" name="published" placeholder="Tid" value='{$published}'/></p> 
  <button type="submit" name="doSave" class="button-blue" value='Spara'><span class="label">Spara</span></button> 
  <input type='reset' class="button" value='Återställ'/></p>  
  <p><a href='view.php'>Visa alla</a></p>  
  <output>{$output}</output>  
</fieldset>  
</form>  

EOD;

// Finally, leave it all to the rendering phase of Adaras.  
include(ADARAS_THEME_PATH);  
