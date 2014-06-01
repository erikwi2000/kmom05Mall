<?php

class CContent
{
    protected $db;
    
    
    
    
    public function __construct($hej)
    {
        $this->db=$hej;    
    }
    
    function ReCreateTableWithContent($hej)
    {
          dumpa($hej);
       //    echo "<br>---rrrr------------<br>";
       // dumpa($hej['mysql']);
       //    echo "<br>------rrrrr---------<br>";
    if(isset($_POST['restore']) || isset($_GET['restore'])) {	
        
        echo "<br>Restore: " ;
        $hej['login'] = "doe";
        $hej['password'] = "doe";
        $cmd = "{$hej['mysql']} -h{$hej['host']} -u{$hej['login']} -p{$hej['password']} < reset.sql 2>&1";
       $cmd = "{$hej['mysql']} -h{$hej['host']} -u{$hej['login']} -p{$hej['password']} < reset.sql";
        //$res = exec($cmd);
        echo "<br>---------------<br>";
        dumpa($cmd);
           echo "<br>---------------";
	//$output = "<p>Databasen är återställd via kommandot<br/><code>{$cmd}</code></p><p>{$res}</p>";
	//$output = $bloggContent->ReCreateTableWithContent() ;
        
       return $cmd; 
        
        }
    }
    
    
    function CreateTableWithContent() 
        { 
        $sql = "DROP TABLE IF EXISTS Content;"; 

        $this->db->ExecuteQuery($sql); 

        $sql = "CREATE TABLE Content( 
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

        $sql = "INSERT INTO Content (slug, url, TYPE, title, DATA, FILTER, published, created) VALUES  
                ('blog', 'blog', 'page', 'Min blogg', 'Detta är min blogg som jag skapat som en del i kursen objektorienterad PHP programmering vid Blekinge Tekniska högskola. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element vilket är smidigt då man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', NOW(), NOW()), 
                ('om', 'om', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-----------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', NOW(), NOW()), 
                ('blogpost-1', NULL, 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', NOW(), NOW()), 
                ('blogpost-2', NULL, 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', NOW(), NOW()), 
                ('blogpost-3', NULL, 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att hösten har kommit, ett budskap som kräver en bloggpost', 'nl2br', NOW(), NOW()) 
                ;"; 

        $this->db->ExecuteQuery($sql); 
        return 'Databasen är återställd'; 
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
                    $output = 'Informationen sparades.';
                
                return $output; 
                } 
        
        
        function create($title)
        {
              $sql = 'INSERT INTO Content (title, user) VALUES (?,?)';
              $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
               $params = array($title,$acronym);
              $this->db->ExecuteQuery($sql,$params);
              header('Location: edit.php?id=' . $this->db->LastInsertId());
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

    function select_posts($slug) 
    { 
       $slugSql = $slug ? 'slug = ?' : '1';  
        $sql = "SELECT * FROM Content WHERE TYPE = 'post' AND $slugSql AND published <= NOW() ORDER BY updated DESC;"; 
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($slug)); 
        return $res; 
    }
      
} // end class
