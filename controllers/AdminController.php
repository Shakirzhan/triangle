<?php

	function AdminController()
	{
		require_once '../models/Admin.php';
		$res = admin();
		$linksss = links();
		require_once '../views/admin/login/index.php';
	}