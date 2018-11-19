<?php

	function ErrorController()
	{
		$linksss = links();
		require_once ROOT.'/views/404/404.php';
	}

	function ErrorController_2() {
		$linksss = links();
		require_once  '../views/404/404.php';
	}