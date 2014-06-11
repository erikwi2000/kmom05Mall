<?php  

class CContent {  
    protected $db = null;  
    public function __construct($db)   
    {  
        $this->db = $db;  
    }  
      
    public function getUrlToContent($content)   
    {  
        switch($content->type)   
        {  
            case 'page': return "page.php?url={$content->url}"; break;  
            case 'post': $slugCreated = CCommonFunctions::slugify($content->slug); return "blog.php?slug={$slugCreated}"; break;  
            default: return null; break;  
        }  
    }  

    public function createNew()  
    {  
        $title = isset($_POST['title']) ? $_POST['title'] : null;  
          $sql = 'INSERT INTO Content (title) VALUES (?)';  
          $acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;  
          $params = array($title);  
          $this->db->ExecuteQuery($sql,$params);  
          $id = $this->db->LastInsertId(); 
          header('Location:edit.php?id=' . $id); 
    }  
      
    public function deleteAt($id)   
    {  
        $sql = "DELETE FROM Content WHERE id = ?";  
        $params = array($id);  
        $this->db->ExecuteQuery($sql, $params);  

    }  

    public function resetContent()  
    {  
        $sql = "DROP TABLE IF EXISTS Content;";  
        $this->db->ExecuteQuery($sql);  

        $sql = "CREATE TABLE Content(  
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,  
                slug CHAR(80) UNIQUE,  
                url CHAR(80) UNIQUE,  
                type CHAR(89),  
                title CHAR(80),  
                data TEXT,  
                filter CHAR(80),  
                published DATETIME,  
                created DATETIME,  
                updated DATETIME,  
                deleted DATETIME)  
                ENGINE INNODB CHARACTER SET utf8;";  

        $this->db->ExecuteQuery($sql);  

        $sql =     "INSERT INTO Content (slug, url, type, title, data, filter, published, created) VALUES   
                ('blog', 'blog', 'page', 'Min blogg', 'Detta är min blogg som jag skapat som en del i kursen objektorienterad PHP programmering vid Blekinge Tekniska högskola. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element vilket är smidigt då man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', NOW(), NOW()),  
                ('om', 'om', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-----------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', NOW(), NOW()),  
                ('blogpost-1', NULL, 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', NOW(), NOW()),  
                ('blogpost-2', NULL, 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', NOW(), NOW()),  
                ('blogpost-3', NULL, 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost', 'nl2br', NOW(), NOW())  
                ;";  

        $this->db->ExecuteQuery($sql);  
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
           htmlentities($val->title, null, 'UTF-8') . " (<a href='edit.php?id={$val->id}'>editera</a>  |  <a href='" . $this->getUrlToContent($val) . "'>visa</a> |  
           <a href='?delete=" . $val->id . "'>delete</a>)</li>\n";  
        }  
        return $items;  
    }  
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
    public function updateContent($id)   
    {  
        $title = isset($_POST['title']) ? $_POST['title'] : null;  
        $slug = isset($_POST['slug']) ? $_POST['slug'] : null;  
        $url = isset($_POST['url']) ? strip_tags($_POST['url']) : null;  
        $data = isset($_POST['data']) ? $_POST['data'] : null;  
        $type = isset($_POST['type']) ? $_POST['type'] : null;  
        $filter = isset($_POST['filter']) ? $_POST['filter'] : null;  
        $published = isset($_POST['published']) ? $_POST['published'] : null;  
        $url = empty($url) ? null : $url;  
          
        $sql = 'UPDATE Content SET  
            title = ?,  
            slug = ?,  
            url = ?,  
            type = ?,  
            data = ?,  
            filter = ?,  
            published = ?,  
            updated = NOW()   
            WHERE id = ?';  
        $params = array($title, $slug, $url, $type, $data, $filter, $published, $id);  
        $res = $this->db->ExecuteQuery($sql, $params);  
        if($res) {  
          $output = "<p class='success'>En ny post/page har blivit skapad med titeln " . $title . ".<br /><a href='view.php'>Gå tillbaka till översikt</a></p>";  
        }  
        else {  
          $output = 'Informationen sparades EJ.<br><pre>' . print_r($this->db->ErrorInfo(), 1) . '</pre>';  
        }  
          
        return $output;  
    }  
}  