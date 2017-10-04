<?php
#Toan Ton
#80535761
#Progamming Languages Lab 1
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
	#check for draw
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
	#smart strategy
	function checkMove(){
		$counter = 0;
		$tokenCount = 0;
		$nextMove = array(0,0);
		#horizontal player
		for($j = 0; $j <= 14; $j++){
			$counter = 0;
			for($i=0;$i<=14;$i++){
				if($this->grid[$j][$i] == 1){
					$counter++;
					if($counter >= $tokenCount && $i+1 <= 14 && $this->grid[$j][$i+1] === 0){
						$tokenCount = $counter;
						$nextMove = array($j,$i+1);
					}
					elseif($counter >= $tokenCount && $i-$counter >= 0 && $this->grid[$j][$i-$counter] === 0){
						$tokenCount = $counter;
						$nextMove = array($j,$i-$counter);
					}
				}
				else{
					$counter = 0;
				}
			}
		}
		#horizontal computer
		for($j = 0; $j <= 14; $j++){
			$counter = 0;
			for($i=0;$i<=14;$i++){
				if($this->grid[$j][$i] == 2){
					$counter++;
					if($counter > $tokenCount && $i+1 <= 14 && $this->grid[$j][$i+1] === 0){
						$tokenCount = $counter;
						$nextMove = array($j,$i+1);
					}
					elseif($counter > $tokenCount && $i-$counter >= 0 && $this->grid[$j][$i-$counter] === 0){
						$tokenCount = $counter;
						$nextMove = array($j,$i-$counter);
					}
				}
				else{
					$counter = 0;
				}
			}
		}
		#vertical player
		for($i = 0; $i <= 14; $i++){
			$counter = 0;
			for($j=0;$j<=14;$j++){
				if($this->grid[$j][$i] == 1){
					$counter++;
					if($counter >= $tokenCount && $j+1 <= 14 && $this->grid[$j+1][$i] === 0){
						$tokenCount = $counter;
						$nextMove = array($j+1,$i);
					}
					elseif($counter >= $tokenCount && $j-$counter >= 0 && $this->grid[$j-$counter][$i] === 0){
						$tokenCount = $counter;
						$nextMove = array($j-$counter,$i);
					}
				}
				else{
					$counter = 0;
				}
			}
		}
		#vertical computer
		for($i = 0; $i <= 14; $i++){
			$counter = 0;
			for($j=0;$j<=14;$j++){
				if($this->grid[$j][$i] == 2){
					$counter++;
					if($counter >= $tokenCount && $j+1 <= 14 && $this->grid[$j+1][$i] === 0){
						$tokenCount = $counter;
						$nextMove = array($j+1,$i);
					}
					elseif($counter >= $tokenCount && $j-$counter >= 0 && $this->grid[$j-$counter][$i] === 0){
						$tokenCount = $counter;
						$nextMove = array($j-$counter,$i);
					}
				}
				else{
					$counter = 0;
				}
			}
		}
		#diagonal player upper left to lower right
		for($i = 0; $i <= 14; $i++){
			for($j=0;$j<=14;$j++){
				for($k = $i, $l = $j; $k <= 14 && $l <= 14; $k++,$l++){
					if($this->grid[$l][$k] == 1){
						$counter++;
						if($counter >= $tokenCount && $l+1 <= 14 && $k+1 <=14 && $this->grid[$l+1][$k+1] === 0){
							$tokenCount = $counter;
							$nextMove = array($l+1,$k+1);
						}
						elseif($counter >= $tokenCount && $l-$counter >= 0 && $k-$counter >= 0 && $this->grid[$l-$counter][$k-$counter] === 0){
							$tokenCount = $counter;
							$nextMove = array($l-$counter,$k-$counter);
						}
					}	
					else{
						$counter = 0;
						break;
					}
				}
			}
		}
		#diagonal computer upper left to lower right
		for($i = 0; $i <= 14; $i++){
			for($j=0;$j<=14;$j++){
				for($k = $i, $l = $j; $k <= 14 && $l <= 14; $k++,$l++){
					if($this->grid[$l][$k] == 2){
						$counter++;
						if($counter >= $tokenCount && $l+1 <= 14 && $k+1 <=14 && $this->grid[$l+1][$k+1] === 0){
							$tokenCount = $counter;
							$nextMove = array($l+1,$k+1);
						}
						elseif($counter >= $tokenCount && $l-$counter >= 0 && $k-$counter >= 0 && $this->grid[$l-$counter][$k-$counter] === 0){
							$tokenCount = $counter;
							$nextMove = array($l-$counter,$k-$counter);
						}
					}	
					else{
						$counter = 0;
						break;
					}
				}
			}
		}
		#diagonal player lower left to upper right
		for($i = 0; $i <= 14; $i++){
			for($j=0;$j<=14;$j++){
				for($k = $i, $l = $j; $k <= 14 && $l >= 0; $k++,$l--){
					if($this->grid[$l][$k] == 1){
						$counter++;
						if($counter >= $tokenCount && $l-1 >= 0 && $k+1 <= 14 && $this->grid[$l-1][$k+1] === 0){
							$tokenCount = $counter;
							$nextMove = array($l-1,$k+1);
						}
						elseif($counter >= $tokenCount && $l+$counter <= 14 && $k-$counter >= 0 && $this->grid[$l+$counter][$k-$counter] === 0){
							$tokenCount = $counter;
							$nextMove = array($l+$counter,$k-$counter);
						}
					}	
					else{
						$counter = 0;
						break;
					}
				}
			}
		}
		#diagonal computer lower left to upper right
		for($i = 0; $i <= 14; $i++){
			for($j=0;$j<=14;$j++){
				for($k = $i, $l = $j; $k <= 14 && $l >= 0; $k++,$l--){
					if($this->grid[$l][$k] == 2){
						$counter++;
						if($counter >= $tokenCount && $l-1 >= 0 && $k+1 <= 14 && $this->grid[$l-1][$k+1] === 0){
							$tokenCount = $counter;
							$nextMove = array($l-1,$k+1);
						}
						elseif($counter >= $tokenCount && $l+$counter <= 14 && $k-$counter >= 0 && $this->grid[$l+$counter][$k-$counter] === 0){
							$tokenCount = $counter;
							$nextMove = array($l+$counter,$k-$counter);
						}
					}	
					else{
						$counter = 0;
						break;
					}
				}
			}
		}
		return $nextMove;
	}
}

?>