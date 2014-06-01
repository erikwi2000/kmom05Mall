<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */


class CContent extends CDatabase  
{ 
    /* 
    *Edit properties 
    * 
    */ 

    private $id; 
    private $title; 
    private $slug; 
    private $url; 
    private $data; 
    private $type; 
    private $filter; 
    private $published; 
    private $save; 
    private $output = ''; 
    private $textfilter; 

    /* 
    *'public methods 
    __________________________________________________________ 
    */ 

    public function __construct($options)  
    { 
        parent::__construct($options); 
        $textfilter = new CTextFilter(); 
    } 

    public function GetAllContent($user) 
    { 
        $this->CreateTable(false); 
        // Get all content 
        $sql = ' 
          SELECT *, (published <= NOW()) AS available 
          FROM Content; 
        '; 
        $res = $this->ExecuteSelectQueryAndFetchAll($sql); 

        // Put results into a list 
        $items = null; 
        foreach($res AS $key => $val)  
        { 
          $items .= "<li>{$val->TYPE} (" . (!$val->available ? 'inte ' : null) . "publicerad): " . htmlentities($val->title, null, 'UTF-8') . "("; 
          if($user->IsAuthenticated($this)) 
          { 
                  $items .= "<a href='content_edit.php?id={$val->id}'>editera</a> <a href='content_delete.php?id={$val->id}'>ta bort</a> "; 
          } 
          $items .= "<a href='" . $this->getUrlToContent($val) . "'>visa</a>)</li>\n"; 
        } 

        return $items; 
    } 

    public function CreateTable($restore) 
    { 
        $sql = ''; 
        if($restore) 
        { 
            $sql .= "DROP TABLE IF EXISTS Content;  
                    CREATE TABLE Content "; 
        } 
        else if(!$restore) 
        { 
            $sql .= "CREATE TABLE IF NOT EXISTS Content"; 
        } 
        $sql = "  
        (  
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  
        slug CHAR(80) UNIQUE,  
        url CHAR(80) UNIQUE,  
        user char(12),  
        TYPE CHAR(80),  
        title VARCHAR(80),  
        DATA TEXT,  
        FILTER CHAR(80),  
       
        published DATETIME,  
        created DATETIME,  
        updated DATETIME,  
        deleted DATETIME ) ENGINE INNODB CHARACTER SET utf8; "; 
             
        $this->ExecuteQuery($sql); 

        $sql = "INSERT INTO Content (user,slug, url, TYPE, title, DATA, FILTER, published, created) VALUES  
        ('admin', 'hem','hem', 'page', 'Hem', 'Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', NOW(), NOW()),  
        ('admin','om', 'om', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', NOW(), NOW()),  
        ('admin','blogpost-1', NULL, 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', NOW(), NOW()),  
        ('admin','blogpost-2', NULL, 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', NOW(), NOW()),  
        ('admin','blogpost-3', NULL, 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att hösten har kommit, ett budskap som kräver en bloggpost', 'nl2br', NOW(), NOW()); "; 

        $this->ExecuteQuery($sql); 
    } 

    /* 
    *'public methods - Create 
    __________________________________________________________ 
    */     
    public function GetCreateParameters() 
    { 
        // Get parameters  
        $this->title  = isset($_POST['title']) ? strip_tags($_POST['title']) : null; 
        $create = isset($_POST['create'])  ? true : false; 
        // Check if form was submitted 
        if($create)  
        { 
          $sql = 'INSERT INTO Content (title, published, created) VALUES (?, NOW(), NOW())'; 
          $this->ExecuteQuery($sql, array($this->title)); 
          $this->SaveDebug(); 
          header('Location: content_edit.php?id=' . $this->LastInsertId()); 
          exit; 
        } 
    } 

    public function GenerateCreateForm() 
    { 
        $html = "<form method=post> 
          <fieldset> 
          <legend>Skapa ny sida/blogginlägg</legend> 
          <p><label>Titel:<br/><input type='text' name='title'/></label></p> 
          <p><input type='submit' name='create' value='Skapa'/></p> 
          </fieldset> 
        </form>"; 
        return $html; 
    } 



    /* 
    *'public methods - Edit 
    __________________________________________________________ 
    */ 

    public function GetEditParameters() 
    { 
        // Get parameters  
        $this->id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null); 
        $this->title  = isset($_POST['title']) ? $_POST['title'] : null; 
        $this->slug   = isset($_POST['slug'])  ? $_POST['slug']  : null; 
        $this->url    = isset($_POST['url'])   ? strip_tags($_POST['url']) : null; 
        $this->data   = isset($_POST['data'])  ? $_POST['data'] : array(); 
        $this->type   = isset($_POST['type'])  ? strip_tags($_POST['type']) : array(); 
        $this->filter = isset($_POST['filter']) ? $_POST['filter'] : array(); 
        $this->published = isset($_POST['published'])  ? strip_tags($_POST['published']) : array(); 
        $this->save   = isset($_POST['save'])  ? true : false; 
        is_numeric($this->id) or die('Check: Id must be numeric.'); 
    } 

    public function CheckEditForm() 
    { 
        // Check if form was submitted 
        $this->output = null; 
        if($this->save)  
        { 
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
          $this->url = empty($this->url) ? null : $this->url; 
          $params = array($this->title, $this->slug, $this->url, $this->data, $this->type, $this->filter, $this->published, $this->id); 
          $res = $this->ExecuteQuery($sql, $params); 
          if($res)  
          { 
            $output = 'Informationen sparades.'; 
          } 
          else  
          { 
            $output = 'Informationen sparades EJ.<br><pre>' . print_r($db->ErrorInfo(), 1) . '</pre>'; 
          } 
        } 
    } 

    public function GetEditForm() 
    { 
        $html = "<form method=post> 
          <fieldset> 
          <legend>Uppdatera innehåll</legend> 
          <input type='hidden' name='id' value='{$this->id}'/> 
          <p><label>Titel:<br/><input type='text' name='title' value='{$this->title}'/></label></p> 
          <p><label>Slug:<br/><input type='text' name='slug' value='{$this->slug}'/></label></p> 
          <p><label>Url:<br/><input type='text' name='url' value='{$this->url}'/></label></p> 
          <p><label>Text:<br/><textarea name='data'>{$this->data}</textarea></label></p> 
          <p><label>Type:<br/><input type='text' name='type' value='{$this->type}'/></label></p> 
          <p><label>Filter:<br/><input type='text' name='filter' value='{$this->filter}'/></label></p> 
          <p><label>Publiseringsdatum:<br/><input type='text' name='published' value='{$this->published}'/></label></p> 
          <p class=buttons><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p> 
          <p><a href='content_view.php'>Visa alla</a></p> 
          <output>{$this->output}</output> 
          </fieldset> 
        </form>"; 
        return $html; 
    } 

    public function SanitizeEditContent() 
    { 
        // Select from database 
        $sql = 'SELECT * FROM Content WHERE id = ?'; 
        $res = $this->ExecuteSelectQueryAndFetchAll($sql, array($this->id)); 

        if(isset($res[0]))  
        { 
          $c = $res[0]; 
        } 
        else  
        { 
          die('Misslyckades: det finns inget innehåll med sådant id.'); 
        } 

        // Sanitize content before using it. 
        $this->title  = htmlentities($c->title, null, 'UTF-8'); 
        $this->slug   = htmlentities($c->slug, null, 'UTF-8'); 
        $this->url    = htmlentities($c->url, null, 'UTF-8'); 
        $this->data   = htmlentities($c->DATA, null, 'UTF-8'); 
        $this->type   = htmlentities($c->TYPE, null, 'UTF-8'); 
        $this->filter = htmlentities($c->FILTER, null, 'UTF-8'); 
        $this->published = htmlentities($c->published, null, 'UTF-8'); 
    } 

    /* 
    *'public methods - Delete 
    __________________________________________________________ 
    */ 
    public function GetDeleteParam() 
    { 
        $html = ''; 

        // Get parameters  
        $this->id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null); 
        is_numeric($this->id) or die('Check: Id must be numeric.'); 

        // Select from database 
        $sql = 'SELECT * FROM Content WHERE id = ?'; 
        $res = $this->ExecuteSelectQueryAndFetchAll($sql, array($this->id)); 

        if(isset($res[0]))  
        { 
          $c = $res[0]; 
        } 
        else  
        { 
          die('Misslyckades: det finns inget innehåll med sådant id.'); 
        } 

        return $c; 
    } 

    public function DeleteContent($id) 
    { 
        $sql = 'DELETE FROM Content WHERE id = ?'; 
          $this->ExecuteQuery($sql, array($id)); 
          $this->SaveDebug("Det raderades " . $this->RowCount() . " rader från databasen."); 
          header('Location: content_view.php'); 
    } 

    public function GetDeleteForm($content) 
    { 
        $html = '<form method=post> 
                  <fieldset> 
                    <legend>Radera innehåll: ' . $content->title .', med id: ' . $content->id . '</legend> 
                    <p><input type="submit" name="delete" value="Radera"</p> 
                  </fieldset> 
                </form>'; 

        return $html; 
    } 


    /* 
    *'Private methods 
    __________________________________________________________ 
    */ 

    /** 
     * Create a link to the content, based on its type. 
     * 
     * @param object $content to link to. 
     * @return string with url to display content. 
     */ 
    private function getUrlToContent($content)  
    { 
      switch($content->TYPE)  
      { 
        case 'page': return "page.php?url={$content->url}"; break; 
        case 'post': return "blog.php?slug={$content->slug}"; break; 
        default: return null; break; 
      } 
    } 

} 

?> 