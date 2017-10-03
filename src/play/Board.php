<?php
class Board {
	public $grid = array (
			array () 
	);
	public $strat;
	public $isWin;
	public $isDraw;
	public $row = array ();
	function __construct($strat) {
		for($i = 0; $i < 15; $i ++) {
			for($j = 0; $j < 15; $j ++) {
				$this->grid [$i] [$j] = 0;
			}
		}
		$this->strat = $strat;
		$this->isWin = false;
		$this->isDraw = false;
	}
	function set($x, $y, $player) {
		$this->grid [$y] [$x] = $player == true ? 1 : 2;
	}
	function get($x, $y) {
		return $grid [$y] [$x];
	}
	function checkWin($x, $y, $player) {
		#$xstart = $x;
		#$ystart = $y;
		$token = $player == true ? 1 : 2;
		$counter = 1;
		
		// horizontal check
		for($i = $x; $i >= 0; $i --) {
			if ($token == $this->grid [$y] [$i]) {
				if ($i != $x) {
					$counter ++;
				}
			} else
				break;
		}
		for($i = $x; $i <= 14; $i ++) {
			if ($token == $this->grid [$y] [$i]) {
				if ($i != $x) {
					$counter ++;
				}
			} else
				break;
		}
		if ($counter == 5)
			return true;
		else
			$counter = 1;
		// vertical check
		for($i = $y; $i >= 0; $i--){
			if($token == $this->grid[$i][$x]){
				if($i != $y){
					$counter++;
				}
			}
			else break;
		}
		for($i = $y; $i <= 14; $i++){
			if($token == $this->grid[$i][$x]){
				if($i != $y){
					$counter++;
				}
			}
			else break;
		}
		
		if($counter == 5){
			return true;
		}
		else
			$counter = 1;
		
		return false;
	}
	function checkDraw() {
		for($i = 0; $i < 15; $i ++) {
			for($j = 0; $j < 15; $j ++) {
				if ($this->grid [$i] [$j] == 0) {
					return false;
				}
			}
		}
		return true;
	}
}

?>