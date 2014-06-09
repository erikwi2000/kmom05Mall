<?php

class CContent  

//class CContent 
{
   public $db;
   public $bloggContent;
  public  $params  ;  
    
    
    
    public function __construct($hej)
    {
        $this->bloggContent=$hej;    
       
     //   $this->bloggContent->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']); 

    }
    
   function queryReturn($Sql)
    {
        $this->setQuery($Sql);
        if($this->dbPrepare())  
        {
                         $this->bindParam();
            return $this->dbExecute();
        }
        return false;
    }
        public function deleteAt($sql, $params = array())   
    {  
      //  $sql = "DELETE FROM Content WHERE id = ?"; 
      //  $test = $this->queryReturn($sql);
       // dumpa($test);
     //   $this->$params = array($id);  
        echo "<br> sql inside deleteAt-------------------------------------------------------<br>". $sql . "<br>";
        
        dumpa($this->params);
        echo "<br> dumpat thid params <br>";
     dumpa($params);
             echo "<br> dumpat params <br>";
      //        echo "<br>rrr <br> " . $rrr . "<br>";
        $dddd = $this->ExecuteQuery17($sql, $params = array());  

    }
    
    public function check_if_object($obj)
{
    if (!is_object($obj)) {
        return false;
    }

    return $obj->students;
}
    
        public function ExecuteQuery17($query = array() , $params = array(), $debug=false)  
  {         
            
  echo "<br> Inside ExecCte query17<br>";
    //self::$queries[] = $query;  
   //self::$params[]  = $params;  
   // self::$numQueries++; 
    echo "<br>jjjjjjjjjjjj";
  echo "<br> Queryin EQ <br>";
  dumpa($query);
   echo "<br> prams in EQ <br>";
 dumpa($params);
  echo "<br> prammmmmmmmmmmmmmm <br>";
    if($debug)  
    { 
      echo "<p>Query = <br/><pre>{$query}</pre></p><p>Num query = " . self::$numQueries . "</p><p><pre>".print_r($params, 1)."</pre></p>"; 
    } 
    
 dumpa($query);
 
 echo "<br> DUMPAT query <br>" .  $query . "<br>";
 echo"<br> vardump <br>";
    var_dump($this->bloggContent);
     echo"<br> vardump <br>";
    
   // $sql = 'SELECT * FROM Content WHERE id = ?';
//$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
     
$bloggContent->send = array($query);
dumpa($send);

 $this->stmt = $this->bloggContent->prepare($query); 
    
    return $this->stmt->execute($this->params); 
    
  } 

  /**
 * Create a slug of a string, to be used as url.
 *
 * @param string $str the string to format as slug.
 * @returns str the formatted slug. 
 */
function slugify($str) {
  $str = mb_strtolower(trim($str));
  $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
  $str = preg_replace('/[^a-z0-9-]/', '-', $str);
  $str = trim(preg_replace('/-+/', '-', $str), '-');
  return $str;
}
  
  
  
    function ReCreateTableWithContent($hej)
    {

    if(isset($_POST['restore']) || isset($_GET['restore'])) {	

        $cmd = "{$hej['mysql']} -h {$hej['host']} -u {$hej['login']} -p {$hej['password']} < reset.sql 2>&1";
       //$cmd = "{$hej['mysql']} -h{$hej['host']} -u{$hej['login']} -p{$hej['password']} < reset.sql";
        $res = exec($cmd);
	$output = "<p>Databasen är återställd via kommandot<br/><code>{$cmd}</code></p><p>{$res}</p>";      
        return $output;      
        }
    }
        public function createTableFromContent()  
    {  
        // Get all content  
        $sql = 'SELECT *, (published <= NOW()) AS available FROM Content;';  
        $res = $this->ExecuteSelectQueryAndFetchAll($sql);  

        // Put results into a list  
        $items = null;  
        foreach($res AS $key => $val) {  
          $items .= "<li>{$val->type} (" . (!$val->available ? 'inte ' : null) . "publicerad): " .  
           htmlentities($val->title, null, 'UTF-8') . " (<a href='edit.php?id={$val->id}'>editera</a>  | "
           . " <a href='" . $this->getUrlToContent($val) . "'>visa</a> |  
           <a href='?delete=" . $val->id . "'>delete</a>)</li>\n";  
        }  
        return $items;  
    }
    
    
             public function createNew()  
    {  
            
          //  $db = new CDatabase($bwix['database2']);  
         ///////$bloggContent = new CContent($bwix['database2']);  

 // $bloggContent->params = array($xxx);
   //           $bloggContent->query = array($sql);    
             echo "<br> inside createNew =====================================================<br>";   
           echo "<br> id 11111111111111111111111111 " . "<br>";        
        $title = isset($_POST['title']) ? $_POST['title'] : null;  
          $sql = 'INSERT INTO Content (title) VALUES (?)';  
          $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;  
          $params = array($title);  
          echo "<br> sql <br>" . $sql . "<br>";
          
          
          dumpa($params);
          
          echo "<br> 11";
          $this->ExecuteQuery17($sql,$this->params );  
           echo "<br> 12";
          $id = $this->db->LastInsertId(); 
          echo "<br> id 11111111111111111111111111 " . $id . "<br>";
          header('Location:blogg_edit.php?id=' . $id); 
    }

    function CreateTableWithContent() 
        { 
        $sql = "DROP TABLE IF EXISTS Content17;"; 

        $this->db->ExecuteQuery($sql); 

        $sql = "CREATE TABLE Content17( 
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                slug CHAR(80) UNIQUE, 
                url CHAR(80) UNIQUE, 
                TYPE CHAR(89), 
                title CHAR(80), 
                DATA TEXT, 
                FILTER CHAR(80), 
                published DATETIME, 
                created DATETIME, 
                updated DATETIME, 
                deleted DATETIME) 
                ENGINE INNODB CHARACTER SET utf8;"; 

        $this->db->ExecuteQuery($sql); 

        $sql = "INSERT INTO Content17 (slug, url, TYPE, title, DATA, FILTER, published, created) VALUES  
                ('blog', 'blog', 'page', 'Min blogg', 'Detta är min blogg som jag skapat som en del i kursen objektorienterad PHP programmering vid Blekinge Tekniska högskola. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element vilket är smidigt då man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', NOW(), NOW()), 
                ('om', 'om', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-----------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', NOW(), NOW()), 
                ('blogpost-1', NULL, 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', NOW(), NOW()), 
                ('blogpost-2', NULL, 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', NOW(), NOW()), 
                ('blogpost-3', NULL, 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att hösten har kommit, ett budskap som kräver en bloggpost', 'nl2br', NOW(), NOW()) 
                ;"; 

        $this->db->ExecuteQuery($sql); 
        return 'Databasen är, intern, återställd'; 
    }    
    
     public function createTable()  
    {  
        // Get all content  
        $sql = 'SELECT *, (published <= NOW()) AS available FROM Content;';  
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);  

        // Put results into a list  
        $items = null;  
        foreach($res AS $key => $val) {  
          $items .= "<li>{$val->type} (" . (!$val->available ? 'inte ' : null) . "publicerad): " .  
           htmlentities($val->title, null, 'UTF-8') . " (<a href='edit.php?id={$val->id}'>editera</a>  |  "
           . "<a href='" . $this->getUrlToContent($val) . "'>visa</a> |  
           <a href='?delete=" . $val->id . "'>delete</a>)</li>\n";  
        }  
        return $items;  
    }    
    
    
    /*
       public function deleteAt($id)   
    {  
        $sql = "DELETE FROM Content WHERE id = ?;";  
        echo "<br> sql-------------------------" . $sql;
        $params = array($id);  
        $this->ExecuteQuery($sql, $params);  

    }  
    
    */
    
        public function getPostBySlug($slug)  
    {  
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
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($slug));  
        return $res;  
    }  
    
    
    
       function editContent() 
       { 
        // Get parameters  
        $id = isset($_POST['id']) ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null); 
        $title = isset($_POST['title']) ? $_POST['title'] : null; 
        $slug = isset($_POST['slug']) ? $_POST['slug'] : null; 
        $url = isset($_POST['url']) ? strip_tags($_POST['url']) : null; 
        $data = isset($_POST['data']) ? $_POST['data'] : array(); 
        $type = isset($_POST['type']) ? strip_tags($_POST['type']) : array(); 
        $filter = isset($_POST['filter']) ? $_POST['filter'] : array(); 
        $published = isset($_POST['published']) ? strip_tags($_POST['published']) : array(); 

                   
                    $sql = 'UPDATE Content SET 
                    title = ?, 
                    slug = ?, 
                    url = ?, 
                    TYPE = ?, 
                    DATA = ?, 
                    FILTER = ?, 
                    published = ?, 
                    updated = NOW()  
                    WHERE id = ?'; 
                    $params = array($title, $slug, $url, $type, $data, $filter, $published, $id); 
                    $this->db->ExecuteQuery($sql, $params);
        if($res) {  
          $output = "<p class='success'>En ny post/page har blivit skapad med titeln " . $title . ".<br /><a href='view.php'>Gå tillbaka till översikt</a></p>";  
        }  
        else {  
          $output = 'Informationen sparades EJ.<br><pre>' . print_r($this->db->ErrorInfo(), 1) . '</pre>';  
        }
                
                return $output; 
                } 
        
        
        function createNewdddd($title)
        {
              $sql = 'INSERT INTO Content (title, user) VALUES (?,?)';
              $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
               $params = array($title,$acronym);
               dumpa($params);
              $this->db->ExecuteQuery($sql,$params);
              header('Location: edit.php?id=' . $this->db->LastInsertId());
        } 
        
    
        
           public function createNewyyyyy()  
    {  
        $title = isset($_POST['title']) ? $_POST['title'] : null;  
          $sql = 'INSERT INTO Content (title) VALUES (?)';  
          $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;  
          $params = array($title);  
          $this->bloggContent->ExecuteQuery($sql,$params);  
          $id = $this->db->LastInsertId(); 
          header('Location:edit.php?id=' . $id); 
    }   
        
       //---------------------------------------- 
        
        
           public function getPageByUrl($url)  
    {  
        $sql = "SELECT * FROM Content WHERE type = 'page' AND url = ? AND published <= NOW();";  
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($url));  
        if(isset($res[0]))   
        {  
            return $res;  
        }  
        else   
        {  
            die('Misslyckades: det finns inget innehåll.');  
        }  
        return $res;  
    }  
      
    public function getContent($id)   
    {  
        // get content and santize it  
        $sql = 'SELECT * FROM Content WHERE id = ?';  
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));  
          
        if(isset($res[0]))   
        {  
            return $res[0];  
        }  
        else   
        {  
            die('Error: Det finns inget content vid id: ' . $id);  
        }  
    } 
          function deleteContent($id) 
         { 
                $sql = 'DELETE FROM Content WHERE id = ? LIMIT 1'; 
                $params = array($id); 
                $this->db->ExecuteQuery($sql, $params); 
             header('Location: view.php?'); 
        } 

          function selectId($id) 
          { 
          
        $sql = 'SELECT * FROM Content WHERE id = ?'; 
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id)); 

        if(isset($res[0])) 
        { 
            $c = $res[0]; 
            return $c; 
        } 
        else 
        { 
            die('Misslyckades: Inget innehåll med angivet id' . $id); 
        } 
    } 

    function select_page($url) 
    { 
        $sql = "SELECT *
            FROM Content
            WHERE
              type = 'page' AND
              url = ? AND
              published <= NOW();"; 
       $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($url)); 

        if(isset($res[0])) 
        { 
            $c = $res[0]; 
            return $c; 
        } 
        else 
        { 
            die('Misslyckades: Det finns inget innehåll.'); 
        } 
    } 
public function createPost(array $postvar){ 
            $params = $this->prepParams($postvar); 
            $time = $this->getDateTime(); 
            $sql = "INSERT INTO oop_kmom05_content (url,data_type,title,text_data,data_filter,published,created) VALUES (?,?,?,?,?,?,?)"; 
             
            if(isset($postvar['storeData'])){ 
                //Validera och fixa till inkommande datum. Sätter första sekund på dygnet för möjlighet att publicera samma dag. 
                //Annars fallerar query om WHERE time < NOW() med samma dag fast ett tidigare klockslag 
                 
                preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$postvar['pubDate']) ? $pubdate = $postvar['pubDate'] . " 00:00:01" : $pubdate = null; 
                array_push($params,$pubdate); 
                array_push($params,$time); 
                 
            } 
            if(isset($postvar['publishData'])){ 
                array_push($params,$time,$time); 
            } 
            $this->db->cudData($sql,$params); 
            return $this->init(); 
        } 
         
    function select_posts($slug) 
    { 
       $slugSql = $slug ? 'slug = ?' : '1';  
        $sql = "SELECT * FROM Content WHERE TYPE = 'post' AND $slugSql AND published <= NOW() ORDER BY updated DESC;"; 
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($slug)); 
        return $res; 
    }
      
} // end class
