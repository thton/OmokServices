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
		$token = $player == true ? 1 : 2;
		$counter = 1;
		
		// horizontal check
		$k = 0;
		for($i = $x; $i >= 0; $i --) {
			if ($token == $this->grid [$y] [$i]) {
				if ($i != $x) {
					$counter ++;
					$this->row[$k] = $i; $k++;
					$this->row[$k] = $y; $k++;
				}
			} else
				break;
		}
		for($i = $x; $i <= 14; $i ++) {
			if ($token == $this->grid [$y] [$i]) {
				if ($i != $x) {
					$counter ++;
					$this->row[$k] = $i; $k++;
					$this->row[$k] = $y; $k++;
				}
			} else
				break;
		}
		if ($counter == 5){
			$this->row[$k] = $x; $k++;
			$this->row[$k] = $y;
			return true;
		}
		else{
			$counter = 1;
			$this->row = array();
			$k = 0;
		}
		// vertical check
		for($i = $y; $i >= 0; $i--){
			if($token == $this->grid[$i][$x]){
				if($i != $y){
					$counter++;
					$this->row[$k] = $x; $k++;
					$this->row[$k] = $i; $k++;
				}
			}
			else break;
		}
		for($i = $y; $i <= 14; $i++){
			if($token == $this->grid[$i][$x]){
				if($i != $y){
					$counter++;
					$this->row[$k] = $x; $k++;
					$this->row[$k] = $i; $k++;
				}
			}
			else break;
		}
		
		if($counter == 5){
			$this->row[$k] = $x; $k++;
			$this->row[$k] = $y;
			return true;
		}
		else{
			$counter = 1;
			$this->row = array();
			$k = 0;
		}
		#diagonal check upper left to lower right and vice versa
		for($i = $x, $j = $y; $i >= 0 && $j >= 0; $i--, $j--){
			if($token == $this->grid[$j][$i]){
				if($i != $x && $j != $y){
					$counter++;
					$this->row[$k] = $i; $k++;
					$this->row[$k] = $j; $k++;
				}
			}
			else break;
		}
		for($i = $x, $j = $y; $i <= 14 && $j <= 14; $i++, $j++){
			if($token == $this->grid[$j][$i]){
				if($i != $x && $j != $y){
					$counter++;
					$this->row[$k] = $i; $k++;
					$this->row[$k] = $j; $k++;
				}
			}
			else break;
		}
		if($counter == 5){
			$this->row[$k] = $x; $k++;
			$this->row[$k] = $y;
			return true;
		}
		else{
			$counter = 1;
			$this->row = array();
			$k = 0;
		}
		#diagonal check lower left to upper right and vice versa
		for($i = $x, $j = $y; $i >= 0 && $j <= 14; $i--, $j++){
			if($token == $this->grid[$j][$i]){
				if($i != $x && $j != $y){
					$counter++;
					$this->row[$k] = $i; $k++;
					$this->row[$k] = $j; $k++;
				}
			}
			else break;
		}
		for($i = $x, $j = $y; $i <= 14 && $j >= 0; $i++, $j--){
			if($token == $this->grid[$j][$i]){
				if($i != $x && $j != $y){
					$counter++;
					$this->row[$k] = $i; $k++;
					$this->row[$k] = $j; $k++;
				}
			}
			else break;
		}
		if($counter == 5){
			$this->row[$k] = $x; $k++;
			$this->row[$k] = $y;
			return true;
		}
		else{
			$counter = 1;
			$this->row = array();
			$k = 0;
		}
		
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