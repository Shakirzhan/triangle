<?php

	function EditController($id, $uri)
	{
		require_once '../models/OneNews.php';
		require_once '../models/Upgrade.php';
		$message = upgrade($id);
		$dataId = OneNews($id);
		$linksss = links();
		require_once '../views/admin/edit/index.php';
	}