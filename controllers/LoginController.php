<?php 
	
	function LoginController()
	{
		require_once ROOT.'/models/Login.php';
		$res = login();
		$linksss = links();
		require_once ROOT.'/views/login/index.php';
	}