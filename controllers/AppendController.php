<?php
	
	function AppendController()
	{
		require_once '../models/Append.php';
		$mes = append();
		$linksss = links();
		require_once '../views/admin/append/index.php';
	}