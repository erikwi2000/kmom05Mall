<?php
/**
 * A hand of dices, with graphical representation, to roll.
 *
 */
class CDiceHand {

  /**
   * Properties
   *
   */
   	private $dices;					// Sidor på tärningen
  	private $numDices;      // Antal tärningar
		private $sum;           //summan av en tärnings slag 
		private  $sumRound;			// kan nollas
		private  $sumRoundAll;			// alla gjorda slag
		private $highScore;   //sparade slag
		public  $dicePic; 
		public $html;
                private  $rounds;
                private $sumRoll;           //summan av alla tärningars slag aka EN träning
                public $winner;
                public $noRolls;

  /**
   * Constructor
   *
   * @param int $numDices the number of dices in the hand, defaults to six dices. 
   */
  public function __construct($numDices = 1) {
    for($i=0; $i < $numDices; $i++) {
      $this->dices[] = new CDiceImage();
    }
    $this->numDices = $numDices;
    $this->sum = 0;
    $this->sumRound = 0;
	  $this->sumRoundAll = 0;	
		$this->highScore = 0;
//    $this->sumSavedRounds = 0;
		$this->rounds = 0;

		$this->deal = 0;
		$this->dicePic = array();
		$this->dicePic = "";
                $this->noRolls = FALSE;
		
					
  }
	

  
  
 public function GetInputInfo2() {
     
     if(isset($_SESSION['dump'])) {
  $dump = $_SESSION['dump'];
}
else {
	$dump = new CDump(1);
  $_SESSION['dump'] = $dump;
}
     $statStringRoll = "EMPTY";
     $choice = "destruct";
     $ffff = "NoActivitySet";
 $roll = isset($_GET['roll']) ? true : false;
 
 
 //if(!$this->noRolls){
 if($roll){$choice = "roll"; 
 
  $this->Roll();
$ffff = $dump->GetRollResult();
//echo "<br> ffff result" . $ffff;
 }
 //}
 
$init = isset($_GET['init']) ? true : false;

 if($init){$choice = "init";
  $this->InitRound();
  $ffff = $this->GetInitResult();
// xxxx echo "<br> hhhh result" . $ffff;
 }
 
$noll = isset($_GET['noll']) ? true : false; 

 if($noll){$choice = "noll";
  $this->saveRound();
  $ffff = $dump->GetNollResult();
//echo "<br> gggg result" . $ffff;
 }

 //return $choice;
 
 
 return $ffff;
 
 }
  
  
	
  public function GetInitResult () {
      $this-> faul = FALSE;

      if(isset($_SESSION['dicehand'])) {
  $hand = $_SESSION['dicehand'];
}
else {
	//$hand = new CDiceHand(1);
  $_SESSION['dicehand'] = $hand;
}
   //  unset($dicehand);
    $hand->sumRound = 0;
    $hand->sumRoundAll = 0;		
		$hand->rounds = 0;
		$hand->highScore = 0;	
		$this->dicePic = array();
                $hand->noRolls = FALSE;
                $winner = FALSE;
              //  $winner2 = FALSE;
	//	$hand->dicePic = ""; 
                $initOutput = "<br> <br><h3>Rundan initierad!!</h3>";
                return $initOutput;
              
  }


  /**
   * Roll all dices in the hand.
   *
   */
  public function Roll() {
	
    $this->sum = 0;
    for($i=0; $i < $this->numDices; $i++) {
      

        $roll = $this->dices[$i]->Roll(1);

               if(!$this->noRolls){         
      $this->sum += $roll;
      $this->sumRound += $roll;
			$this->sumRoundAll += $roll;	
      					$this->dicePic[] += $roll;
              }
		//		print_r($this->dicePic) ;	



//			if ($this->sumRound > $this->highScore)
//			{
//			$this->highScore = $this->sumRound;
//			}
			$this->rounds += 1;
    }
  }


  /**
   * Get the sum of the last roll.
   *
   * @return int as a sum of the last roll, or 0 if no roll has been made.
   */
	 
  public function GetPlay() {
    return $this->sum;
  }
	
  public function GetRolls() {
    return $this->sum;
  }
 public function GetSumRound() {
    return $this->sumRound;
  }
	
	// Number of rounds---------------in a play
	 public function GetRoundsOK() {
	//	 echo "<br>this-rounds in GetRoundsOK-------------<br> " .  $this->rounds;
 
    return $this->rounds;
  }
		 public function GetHighScore() {
    return $this->highScore;
  }

  /**
   * Init the round.
   *
   */
  public function InitRound() {
	unset($dicehand);
    $this->sumRound = 0;
    $this->sumRoundAll = 0;		
		$this->rounds = 0;
		$this->highScore = 0;	
		$this->dicePic = array();		
	//	$this->dicePic = "";
        //        $hand->winner = FALSE;
  }
	public function CleanHighScore() {
			$this->highScore = 0;	
			$this->sumRound = 0;	
	}
/*	public function GetSumRound() {
	    return $this->sumRound;
	}*/
		public function CleanSumRound() {
	//		$this->highScore = 0;	
			$this->dicePic = array();
			$this->sumRound = 0;	
			$this->sum = 0;
	}
		public function SetHighScore() {
			$this->highScore = $this->sumRoundAll;	
	}


  /**
   * Get the accumulated sum of the round.
   *
   * @return int as a sum of the round, or 0 if no roll has been made.
   */
        
        
  public function GetRoundTotal() {
    return $this->sumRoundAll;
  }
	public function SetRoundTotal() {
 $this->sumRoundAll = $this->highScore;
  }
  
//---------------------------------------------


//--------------------------------------------

  /**
   * Get the rolls as a serie of images.
   *
   * @return string as the html representation of the last roll.
   */

  public function GetRollsAsImageList() {
//$html = "111111111111111111111111111ksdhfhpkasdhghsakdgfkl";
	   
     
    $html = "<ul class='dice'>";
  //    $hhggl = "<ul class='dice'>";
    
    // echo "<br> inside ---- printing html <br>" . $html . "<br>";   
    if(isset($this->dicePic)) {
	//	echo "hellobalo";
		foreach($this->dicePic as $laban) {       
      $val = $laban;   //  echo "<br> inside function GetRollsAsImageList inside foreach printing val<br>" . $val . "<br>";            
      $html .= "<li class='dice-{$val}'></li>";
   }
    $html .= "</ul>";
		return $html;}
  }
	
	
	
	public function saveRound(){

 //   $this->sumRoundAll += $this->sumRound;
		$this->highScore = $this->sumRoundAll;
		$this->sum = 0;
			    $this->sumRound = 0;
	}

public function GetPageInfo() { 


//222 START

// Sanity Check, unnecessary??
if(isset($_SESSION['dump'])) {
  $dump = $_SESSION['dump'];
}
else {
	$dump = new CDump(1);
  $_SESSION['dump'] = $dump;
}

if(isset($_SESSION['dicehand'])) {
  $hand = $_SESSION['dicehand'];
}
else {
	$hand = new CDiceHand(1);
  $_SESSION['dicehand'] = $hand;
}
//222END

//333START
$bwix['main'] = $dump->GetAddPart1();

//$statString = "aaa";
$statString = $hand->GetInputInfo2();
//$statString .= "bbbb";
$diceList = "";
if(!$dest){
 if($statString !== "NoActivitySet")    {
$diceList = $hand->GetRollsAsImageList(); 
 }
    else 
        {$statString = "";
        }
 
 }

 $dest = FALSE;
 if(isset($statString)) {}
 else {$statString= "";}
 
 
 //333END
 
 
 /*
 //444START
//---------------------------
$bwix['main'] .= <<<EOD
{$diceList}
{$statString}
{$bwix['byline']}
 
EOD;
//444END
*/
    $page = "fffffffffffffffffffffffffffffffffffffff<br>jjjjj<br>ssss";
    
    
    return $page;
    
}
//=====================================================000
public function GetInitStarter(){
    
    
        //111START
    $dest = FALSE;
  if(isset($_GET['destroy'])){
$dest = TRUE;
  }
if(isset($_GET['destroy'])) { 
  // Unset all of the session variables. 
  $_SESSION = array(); 
//echo "<br> DESTROY "  ;
  // If it's desired to kill the session, also delete the session cookie. 
  // Note: This will destroy the session, and not just the session data! 

 if (ini_get("session.use_cookies")) { 
      $params = session_get_cookie_params(); 
      setcookie(session_name(), '', time() - 42000, 
          $params["path"], $params["domain"], 
          $params["secure"], $params["httponly"] 
      ); 
  } 

  // Finally, destroy the session. 
  session_destroy(); 
  $sessiondestroyed = 'Spelet rensat!'; 
} 
else 
{ 
  $sessiondestroyed = ''; 
} 
   //111end           
  return $dest;          
            
}

public function StartSessions() {
// Sanity Check, unnecessary??
if(isset($_SESSION['dump'])) {
  $dump = $_SESSION['dump'];
}
else {
	$dump = new CDump(1);
  $_SESSION['dump'] = $dump;
}

if(isset($_SESSION['dicehand'])) {
  $hand = $_SESSION['dicehand'];
}
else {
	$hand = new CDiceHand(1);
  $_SESSION['dicehand'] = $hand;
}
$putte = "PUTTe";
return $dump;
//$temp2 = StartSessions();


}

public function GetBumpData($i){
    
    $i2 = $i*$i;
    return $i2;
}
/*

 */
}