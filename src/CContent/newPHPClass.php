<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author erikwi2000
 */
class newPHPClass {
    //put your code here
    

         
        /* 
        * CDatabase::fetch(string:$sqlquery,[array:params],[bool:false]) : array(rows) 
        * -- createupdateDelete -- 
        * CDatabase::cudData(string:$sqlquery,[array:params],[bool:false]): BOOLEAN (if rowcount >0 true else false) 
        */ 
        protected $db; 
        /* 
        * CContentHTMLGenerator::getForm([array:postedFormData]) : mixed HTML 
        */ 
        protected $htmlGen; 
         
        /* 
        * Inkluderar filter för att kunna validera userinput mot publika metoder i objekt. 
        */ 
        protected $filter; 
         
        public function __construct(CDatabase $db){ 
            $this->db = $db; 
            $this->htmlGen = new CContentHTMLGenerator(); 
            $this->filter = new CFilters();  
            $this->createContentTable(); 
             
            //Håller meny i minne vid hemsidevisning. Förstör här för att alltid hålla den uppdaterad. (sätts i CPage::getMenuAndOnePage()); 
            if(isset($_SESSION['pages_menu'])){ 
                unset($_SESSION['pages_menu']); 
            } 
        } 
         
         
        //Returnerar tomt formulär (tillåter en optionell param i form av en assArray). 
        public function init(){ 
            return $this->htmlGen->getForm(); 
        } 
         
        /* 
        * Kort beskrivning av posterna och dess status. Ej hela posten! 
        * Returnerar länkar till direktpublicering, editering,visning osv. 
        */ 
        public function viewAllPosts(){  
            $res = $this->db->fetch("SELECT * FROM oop_kmom05_content ORDER BY created DESC"); 
            return $this->htmlGen->wrapDBContent($res); 
        } 

         
        /*----------------------------CRUD AND PUBLISH---------------------------------------------------------------------------------------------*/ 
         
        /* 
        * Hämta tider och populera paramsarray vidare beroende på vilken aktion användaren väljer. 
        * Publiceras nu = nutid x 2, Senare : publiceringsdatum = userinput 
        */ 
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
         
        /* 
        * Redigera post. 
        * Skicka dbpost för HTML wrap. Omvandla resultat till array för att tillåta kunna skicka POST_var oxå i samma funktion. 
        * ID sparas som hidden input i HTMLgen. 
        */ 
        public function editPost(){ 
         
            if(!is_numeric($_GET['id'])){ 
                return $this->init(); 
            } 
            $res = $this->db->fetch("SELECT * FROM oop_kmom05_content WHERE id = ?",array($_GET['id'])); 
             
            //Skapa en array av objektet 
            $arr = get_object_vars($res[0]); 
            return $this->htmlGen->getForm($arr); 
        } 
         
        /* 
        * Endast publicering av icke publicerad post. Sätter published till nu och returnerar en bekräftelse 
        */ 
        public function publishSavedPost(){ 
         
            is_numeric($_GET['id']) ? $id = $_GET['id'] : die("Not valid id!"); 
            $time = $this->getDateTime(); 
            $sql = "UPDATE oop_kmom05_content SET published=? WHERE id=?"; 
            $params = array($time,$id); 
             
            if($this->db->cudData($sql,$params)){ 
                return "<section class='success'><h2>Din Post har publicerats " . $time . "</h2></section>"; 
            } 
            return "<section class='failure'><h2>Oväntat fel. Din post publicerades inte</h2></section>"; 
        } 
         
        /* 
        * uppdatera befintlig post och/eller ändra publiceringstid på en befintlig post 
        */ 
        public function updatePost(array $postarr){ 
            is_numeric($postarr['id']) ? $id = $postarr['id'] : die("Not valid id!"); 
            $time = $this->getDateTime(); 
            $sql = "UPDATE oop_kmom05_content SET url=?,data_type=?,title=?,text_data=?,data_filter=?"; 
             
            //preppa de params som alltid finns med även om de är null 
            $params = $this->prepParams($postarr); 
             
            //Om användare vill ändra publiceringdatum. Inkludera i query. 
             
            if(!empty($postarr['pubDate']) && preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$postarr['pubDate'])){ 
                $sql .= ",published=?"; 
                array_push($params,$postarr['pubDate'] . " 00:00:01"); 
            } 
             
            //Avsluta paramsarray med de som alltid ska finnas med vid uppdatering. Avsluta query. 
             
            $sql .= ",updated=? WHERE id=?"; 
            array_push($params,$time,$id); 
             
            if($this->db->cudData($sql,$params)){ 
                return "<section class='success'><h2>Din Post har uppdaterats " . $time . "</h2></section>"; 
            } 
            return "<section class='failure'><h2>Oväntat fel. Din post uppdaterades inte</h2></section>"; 
        } 
         
        /* 
        * "Unpublish" 
        * Sätt published till null,deleted till now på postid. 
        * returnerar bekräftelse 
        */ 
        public function deletePost(array $postarr){ 
         
            is_numeric($postarr['id']) ? $id = $postarr['id'] : die("Not valid id!"); 
            $delTime = $this->getDateTime(); 
            $time = null; 
            $sql = "UPDATE oop_kmom05_content SET published=?,deleted=? WHERE id=?"; 
            $params = array($time,$delTime,$id); 
             
            if($this->db->cudData($sql,$params)){ 
                return "<section class='success'><h2>Din Post har depublicerats " . $time . "</h2></section>"; 
            } 
            return "<section class='failure'><h2>Oväntat fel. Din post depublicerades inte</h2></section>"; 
        } 
         
        /*----------------------------SLUT CRUD metoder----------------------------------------------------------*/ 
         
        protected function getDateTime(){ 
            return date("Y-m-d H:i:s");  
        } 
         
        /* 
        * allmän sanering, Ej maincontentfiltrering. 
        * Returnerar array (ej klar. Saknar datum) Byggs på i metod som kallar denna metod. 
        * Dessa parametrar ingår i alla queries vare sig de är null eller har värde 
        */ 
        protected function prepParams(array $postvar){ 
         
            //Säkerställ med säkerhet att ett okej filter inte har kringgåtts från klient. Alla publika metoder i klass motsvarar namn på filter. 
             
            $validFilters = get_class_methods($this->filter); 
            if(!in_array($postvar['data_filter'],$validFilters) || empty($postvar['data_filter'])){ 
                die("Error catastrophe! - Filter måste anges"); 
                return; 
            } 
             
            //Tillåt nullvärden i följande enligt uppgift? 
            !empty($postvar['url']) ? $url = strip_tags(urlencode($postvar['url'])) : $url = null; 
            !empty($postvar['data_type']) ? $type = strip_tags($postvar['data_type']) : $type = null; 
            !empty($postvar['title']) ? $title = strip_tags($postvar['title']) : $title = null; 
            !empty($postvar['text_data']) ? $text = $postvar['text_data'] : $text = null; 
            $filter = strip_tags($postvar['data_filter']); 
            $params = array($url,$type,$title,$text,$filter); 
            return $params; 
        } 
         
        protected function createContentTable(){ 
             
            $sql = "CREATE TABLE IF NOT EXISTS oop_kmom05_content 
                    ( 
                      id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                      url CHAR(80) UNIQUE, 
                      
                      data_type CHAR(80), 
                      title VARCHAR(80), 
                      text_data TEXT, 
                      data_filter CHAR(80), 
                      
                      published DATETIME, 
                      created DATETIME, 
                      updated DATETIME, 
                      deleted DATETIME 
                      
                    ) ENGINE INNODB CHARACTER SET utf8;"; 
            $this->db->cudData($sql); 
        } 
    } 

