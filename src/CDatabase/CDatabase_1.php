<?php
/**
 * Database wrapper, provides a database API for the framework but hides details of implementation.
 *
 */
class CDatabase {

  /**
   * Members
   */
  private $options;                   // Options used when creating the PDO object
  private $db   = null;               // The PDO object
  private $stmt = null;               // The latest statement used to execute a query
  private static $numQueries = 0;     // Count all queries made
  private static $queries = array();  // Save all queries for debugging purpose
  private static $params = array();   // Save all parameters for debugging purpose


  /**
   * Constructor creating a PDO object connecting to a choosen database.
   *
   * @param array $options containing details for connecting to the database.
   *
   */
  public function __construct($options) {
    $default = array(
      'dsn' => null,
      'username' => null,
      'password' => null,
      'driver_options' => null,
      'fetch_style' => PDO::FETCH_OBJ,
    );
    $this->options = array_merge($default, $options);
    
    try {
      $this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
    }
    catch(Exception $e) {
        //throw $e; // For debug purpose, shows all connection details  
      throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
    }    
        $this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']); 
 // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
   //----------------
    
      /*  
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
echo $login;
    
$dsn      = 'mysql:host=localhost;dbname=Movie;';
$login    = 'bjvi13';
$password = '';
$options  = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
$pdo = new PDO($dsn, $login, $password, $options);

        
  
*/
    
    
  
  //  } 
    // Get debug information from session if any.
/*
    if(isset($_SESSION['CDatabase'])) {
      self::$numQueries = $_SESSION['CDatabase']['numQueries'];
      self::$queries    = $_SESSION['CDatabase']['queries'];
      self::$params     = $_SESSION['CDatabase']['params'];
      foreach($_SESSION as $key => $value) 
{ 
   // dumpa($value);//echo $key . " = " . $value . "<br>"; 
}
      unset($_SESSION['CDatabase']);
    }
	//	echo "Inside_CDatabase_construct_wwwwwwwwwwwwwwwwwww";
	//	dumpa($default);
  
  */
  }
  /**
   * Getters
   */
  public function GetNumQueries() { return self::$numQueries; }
//===================================================  
	public function GetQueries() { return self::$queries; }

//=================================================== 
  /**
   * Get a html representation of all queries made, for debugging and analysing purpose.
   * 
   * @return string with html.
   */
  public function Dump() {
    $html  = '<p><i>You have made ' . self::$numQueries . ' database queries.</i></p><pre>';
    foreach(self::$queries as $key => $val) {
      $params = empty(self::$params[$key]) ? null : htmlentities(print_r(self::$params[$key], 1), null, 'UTF-8') . '<br><br>';
      $html .= htmlentities($val, null, 'UTF-8') . '<br>' . "Params: $params";
    }
    return $html . '</pre>';
  }

//=================================================== 

  /**
   * Save debug information in session, useful as a flashmemory when redirecting to another page.
   * 
   * @param string $debug enables to save some extra debug information.
   */
  public function SaveDebug($debug=null) {
    	
if($debug) {
      self::$queries[] = $debug;
      self::$params[] = null;
    }
		
    self::$queries[] = 'Saved debuginformation to session.';
    self::$params[] = null;

    $_SESSION['CDatabase']['numQueries'] = self::$numQueries;
    $_SESSION['CDatabase']['queries']    = self::$queries;
    $_SESSION['CDatabase']['params']     = self::$params;
  }

//=================================================== 

  /**
   * Execute a select-query with arguments and return the resultset.
   * 
   * @param string $query the SQL query with ?.
   * @param array $params array which contains the argument to replace ?.
   * @param boolean $debug defaults to false, set to true to print out the sql query before executing it.
   * @param int $fetchStyle can be changed by sending in arguments.
   * @return array with resultset.
   */
   
  public function ExecuteSelectQueryAndFetchAll($query, $params=array(), $debug=false) {
 
    self::$queries[] = $query; 
    self::$params[]  = $params; 
    self::$numQueries++;

    if($debug) {
      echo "<p>Query = <br><pre>{$query}</pre></p><p>Num query = " . self::$numQueries . "</p><p><pre>".print_r($params, 1)."</pre></p>";
    }
 
    $this->stmt = $this->db->prepare($query);
    $this->stmt->execute($params);
    return $this->stmt->fetchAll();
  }
   

//=================================================== 

  /**
   * Execute a SQL-query and ignore the resultset.
   *
   * @param string $query the SQL query with ?.
   * @param array $params array which contains the argument to replace ?.
   * @param boolean $debug defaults to false, set to true to print out the sql query before executing it.
   * @return boolean returns TRUE on success or FALSE on failure. 
   */
  public function ExecuteQuery($query, $params = array(), $debug=false) {
 
    self::$queries[] = $query; 
    self::$params[]  = $params; 
    self::$numQueries++;
 
    if($debug) {
      echo "<p>Query = <br><pre>{$query}</pre></p><p>Num query = " . self::$numQueries . "</p><p><pre>".print_r($params, 1)."</pre></p>";
    }
 
    $this->stmt = $this->db->prepare($query);
    return $this->stmt->execute($params);
  }


//=================================================== 

  /**
   * Return last insert id, see PDO::LastInsertId().
   *
   * @return string representation of id of last inserted row.
   */
  public function LastInsertId() {
    return $this->db->lastInsertid();
  }



  /**
   * Return rows affected of last INSERT, UPDATE, DELETE, see PDOStatment::rowCount().
   *
   * @return int number of affected rows of last statement.
   */
  public function RowCount() {
    return is_null($this->stmt) ? 0 : $this->stmt->rowCount();
  }

//=================================================== 

  /**
   * Return error code of last unsuccessful statement, see PDO::errorCode().
   *
   * @return mixed null or the error code.
   */
  public function ErrorCode() {
    return $this->stmt->errorCode();
  }


//=================================================== 
  /**
   * Return textual representation of last error, see PDO::errorInfo().
   *
   * @return array with information on the error.
   */
  public function ErrorInfo() {
    return $this->stmt->errorInfo();
  }
public function GetDBaseMovieView($hej){


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
";

/*------------------------------

try {
//  $pdo = new PDO($dsn, $login, $password, $options);
 	  $pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	

}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 
 ---*/
/**
 * Use the current querystring as base, modify it according to $options and return the modified query string.
 *
 * @param array $options to set/change.
 * @param string $prepend this to the resulting query string
 * @return string with an updated query string.
 */
 
//////////////////FUNCTION
 
function getQueryString($options=array(), $prepend='?') {
  // parse query string into array
  $query = array();
  parse_str($_SERVER['QUERY_STRING'], $query);

  // Modify the existing query string with new options
  $query = array_merge($query, $options);

  // Return the modified querystring
  return $prepend . htmlentities(http_build_query($query));
}



/**
 * Create links for hits per page.
 *
 * @param array $hits a list of hits-options to display.
 * @param array $current value.
 * @return string as a link to this page.
 */
 
//////////////////FUNCTION
 
function getHitsPerPage($hits, $current=null) {
  $nav = "Träffar per sida: ";
  foreach($hits AS $val) {
    if($current == $val) {
      $nav .= "$val ";
    }
    else {
      $nav .= "<a href='" . getQueryString(array('hits' => $val)) . "'>$val</a> ";
    }
  }  
  return $nav;
}



/**
 * Create navigation among pages.
 *
 * @param integer $hits per page.
 * @param integer $page current page.
 * @param integer $max number of pages. 
 * @param integer $min is the first page number, usually 0 or 1. 
 * @return string as a link to this page.
 */
 
//////////////////FUNCTION
 
function getPageNavigation($hits, $page, $max, $min=1) {
  $nav  = ($page != $min) ? "<a href='" . getQueryString(array('page' => $min)) . "'>&lt;&lt;</a> " : '&lt;&lt; ';
  $nav .= ($page > $min) ? "<a href='" . getQueryString(array('page' => ($page > $min ? $page - 1 : $min) )) . "'>&lt;</a> " : '&lt; ';

  for($i=$min; $i<=$max; $i++) {
    if($page == $i) {
      $nav .= "$i ";
    }
    else {
      $nav .= "<a href='" . getQueryString(array('page' => $i)) . "'>$i</a> ";
    }
  }

  $nav .= ($page < $max) ? "<a href='" . getQueryString(array('page' => ($page < $max ? $page + 1 : $max) )) . "'>&gt;</a> " : '&gt; ';
  $nav .= ($page != $max) ? "<a href='" . getQueryString(array('page' => $max)) . "'>&gt;&gt;</a> " : '&gt;&gt; ';
  return $nav;
}



/**
 * Function to create links for sorting
 *
 * @param string $column the name of the database column to sort by
 * @return string with links to order by column.
 */
 
//////////////////FUNCTION
 
function orderby($column) {
  $nav  = "<a href='" . getQueryString(array('orderby'=>$column, 'order'=>'asc')) . "'>&darr;</a>";
  $nav .= "<a href='" . getQueryString(array('orderby'=>$column, 'order'=>'desc')) . "'>&uarr;</a>";
  return "<span class='orderby'>" . $nav . "</span>";
}


////////////////////// EOFunctions
//
//
// Connect to a MySQL database using PHP PDO
//$db = new CDatabase($anax['database']);
/*
if(isset($_SESSION['CDatabase'])) {
  $db = $_SESSION['CDatabase'];
}
else {

//echo "ZZZZNoDB";
	$db = new CDatabase($hej);
  $_SESSION['CDatabase'] = $db;
}
*/
/*
if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
  echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  echo "loggenew";
}
*/
//Check of logged in
//$pluppas = $log->CheckLoggedIn($bwix['database']);   




/*

try {
//  $pdo = new PDO($dsn, $login, $password, $options);
 	  $pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	

}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
*/

// Get parameters 
$title    = isset($_GET['title']) ? $_GET['title'] : null;
$genre    = isset($_GET['genre']) ? $_GET['genre'] : null;
$hits     = isset($_GET['hits'])  ? $_GET['hits']  : 8;
$page     = isset($_GET['page'])  ? $_GET['page']  : 1;
$year1    = isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null;
$year2    = isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null;
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'asc';


// Check that incoming parameters are valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');
is_numeric($year1) || !isset($year1)  or die('Check: Year must be numeric or not set.');
is_numeric($year2) || !isset($year2)  or die('Check: Year must be numeric or not set.');


// Get all genres that are active
$sql = '
  SELECT DISTINCT G.name
  FROM Genre AS G
    INNER JOIN Movie2Genre AS M2G
      ON G.id = M2G.idGenre
';





//$hej = $bwix['database']; 

/*---------------------------

try {

$pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	
}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}

 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 
 -------------------*/

$res = $this->ExecuteSelectQueryAndFetchAll($sql);

$genres = null;
foreach($res as $val) {
  if($val->name == $genre) {
    $genres .= "$val->name ";
  }
  else {
    $genres .= "<a href='" . getQueryString(array('genre' => $val->name)) . "'>{$val->name}</a> ";
  }
}


// Prepare the query based on incoming arguments
$sqlOrig = '
  SELECT 
    M.*,
    GROUP_CONCAT(G.name) AS genre
  FROM Movie AS M
    LEFT OUTER JOIN Movie2Genre AS M2G
      ON M.id = M2G.idMovie
    INNER JOIN Genre AS G
      ON M2G.idGenre = G.id
';
$where    = null;
$groupby  = ' GROUP BY M.id';
$limit    = null;
$sort     = " ORDER BY $orderby $order";
$params   = array();

// Select by title
if($title) {
  $where .= ' AND title LIKE ?';
  $params[] = $title;
} 

// Select by year
if($year1) {
  $where .= ' AND year >= ?';
  $params[] = $year1;
} 
if($year2) {
  $where .= ' AND year <= ?';
  $params[] = $year2;
} 

// Select by genre
if($genre) {
  $where .= ' AND G.name = ?';
  $params[] = $genre;
} 

// Pagination
if($hits && $page) {
  $limit = " LIMIT $hits OFFSET " . (($page - 1) * $hits);
}

// Complete the sql statement
$where = $where ? " WHERE 1 {$where}" : null;
$sql = $sqlOrig . $where . $groupby . $sort . $limit;
$res = $this->ExecuteSelectQueryAndFetchAll($sql, $params);


// Put results into a HTML-table
$tr = "<tr><th>Rad</th><th>Id " . orderby('id') . "</th><th>Bild</th><th>Titel " . orderby('title') . "</th><th>År " . orderby('year') . "</th><th>Genre</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td><td>{$val->year}</td><td>{$val->genre}</td></tr>";
}



// Get max pages for current query, for navigation
$sql = "
  SELECT
    COUNT(id) AS rows
  FROM 
  (
    $sqlOrig $where $groupby
  ) AS Movie
";
$res = $this->ExecuteSelectQueryAndFetchAll($sql, $params);
$rows = $res[0]->rows;
$max = ceil($rows / $hits);

//$pluppas = $log->CheckLoggedIn($bwix['database']);  

// Do it and store it all in variables in the Anax container.
$bwix['title'] = "Visa filmer med sökalternativ kombinerade";

$hitsPerPage = getHitsPerPage(array(2, 4, 8), $hits);
$navigatePage = getPageNavigation($hits, $page, $max);
$sqlDebug = $this->Dump();

//$anax['main'] 

$trxx = <<<EOD
<h1>{$bwix['title']}</h1>

<form>
  <fieldset>
  <legend>Sök</legend>
  <input type=hidden name=genre value='{$genre}'/>
  <input type=hidden name=hits value='{$hits}'/>
  <input type=hidden name=page value='1'/>
  <p><label>Titel (delsträng, använd % som *): <input type='search' name='title' value='{$title}'/></label></p>
  <p><label>Välj genre:</label> {$genres}</p>
  <p><label>Skapad mellan åren: 
      <input type='text' name='year1' value='{$year1}'/></label>
      - 
      <label><input type='text' name='year2' value='{$year2}'/></label>
    
  </p>
  <p><input type='submit' name='submit' value='Sök'/></p>
  <p><a href='?'>Visa alla</a></p>
  </fieldset>
</form>

<div class='dbtable'>
  <div class='rows'>{$rows} träffar. {$hitsPerPage}</div>
  <table>
  {$tr}
  </table>
  <div class='pages'>{$navigatePage}</div>
</div>



EOD;
//<div class=debug>{$sqlDebug}</div>


// Finally, return info.
return $trxx;
}
public function CheckLoggedIn ($hej) {
      
      
//$hej = $bwix['database'];
//----------------------------------------
try {
  $pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	
}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//--------------------------------------
//=========================================

   

    $pluppas = isset($_SESSION['user']) ? "Du är inloggad!" : "Du är INTE inloggad!";
//echo "pluppa2" . $pluppas;

return $pluppas;
  }
  
  
  public function GetCreateDBaseItemOBSOLERTE(){
      
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
$_SESSION['cdatabase'] = $db;


// Get parameters 
$title  = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
$create = isset($_POST['create'])  ? true : false;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;


// Check that incoming parameters are valid
//isset($acronym) or die('Check: You must login to edit.');


$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
//dumpa($acronym);


if($acronym) {
  $output = "Du är inloggad som: $acronym ({$_SESSION['user']->name})";
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
$pluppas = $db->CheckLoggedIn($bwix['database']);
//echo $pluppas;
// Do it and store it all in variables in the Anax container.


$sqlDebug = $db->Dump();

//$create = TRUE;



//$bwix['main'] 
        
        
$trxx  = <<<EOD
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


return $trxx;
 }
 

  }

}
