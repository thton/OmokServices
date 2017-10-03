<?php
class Board {
	public $grid = array (
			array () 
	);
	function __contruct() {
		for($i = 0; $i < 15; $i ++) {
			for($j = 0; $j < 15; $j ++) {
				$grid [i] [j] = 0;
			}
		}
	}
}

?>