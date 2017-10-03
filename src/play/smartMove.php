<?php
class smartMove {
	public $gameboard;
	public $tokencountdef = 0;
	public $tokencountatk = 0;
	public $defenseMove = array ();
	public $attackMove = array ();
	function __construct($board) {
		$this->gameboard = $board;
		// horizontal strats
		horiDefStrat();
		hortAtkStrat();
		
	}
	function horiDefStrat() {
		for($j = 0; $j <= 14; $j ++) {
			$counter = 0;
			for($i = 0; $i <= 14; $i ++) {
				if ($this->gameboard [$j] [$i] == 1) {
					$counter ++;
					if ($counter > $tokencountdef) {
						if ($i + 1 <= 14 && $this->gameboard [$j] [$i + 1] = 0) {
							$tokencountdef = $counter;
							$defenseMove = array (
									$j,
									$i + 1 
							);
						} elseif ($i - $counter >= 0 && $this->gameboard [$j] [$i - $counter] = 0) {
							$tokencountdef = $counter;
							$defenseMove = array (
									$j,
									$i - $counter 
							);
						} else {
							$counter = 0;
						}
					}
				} else
					$counter = 0;
			}
		}
	}
	function horiAtkStrat() {
		for($j = 0; $j <= 14; $j ++) {
			$counter = 0;
			for($i = 0; $i <= 14; $i ++) {
				if ($this->gameboard [$j] [$i] == $token) {
					$counter ++;
					if ($counter > $tokencountatk) {
						if ($i + 1 <= 14 && $this->gameboard [$j] [$i + 1] = 0) {
							$tokencountatk = $counter;
							$attackMove = array (
									$j,
									$i + 1 
							);
						} elseif ($i - $counter >= 0 && $this->gameboard [$j] [$i - $counter] = 0) {
							$tokencountatk = $counter;
							$attackMove = array (
									$j,
									$i - $counter 
							);
						} else {
							$counter = 0;
						}
					}
				} else
					$counter = 0;
			}
		}
	}
}

?>