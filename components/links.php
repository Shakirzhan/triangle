<?php
	
	function links()
	{
		$a = $_SERVER['REQUEST_URI'];
		$a = explode('/', $a);

		$k = 0;
		$b = [];

		while ($k < count($a)) {
			if ($a[$k]) { 
				$b[] = $a[$k];  
			}
			$k++;
		}

		$k = 1;
		$linksss = '';

		while ($k <= count($b)) {
			$linksss .= '../';
			$k++;
		}
		return $linksss;
	}