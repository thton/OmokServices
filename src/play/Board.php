<?php
class Board {
    
	public $grid = array (
			array ()
	);
	public $strat;
	public $isWin;
	public $isDraw;
	public $row = array();
	
	
	function __construct($strat){
	    for($i = 0; $i < 15; $i++) {
	        for($j = 0; $j < 15; $j++) {
	            $this->grid[$i][$j] = 0;
	        }
	    }
	    $this->strat = $strat;
	    $this->isWin = false;
	    $this->isDraw = false;
	    
	}

	function set($x,$y,$player){
		$this->grid[$y][$x] = $player==true ? 1 : 2;
	}

	function get($x,$y){
		return $this->grid[$y][$x];
	}

}

?>