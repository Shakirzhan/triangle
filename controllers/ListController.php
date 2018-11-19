<?php

	function ListController()
	{
		require_once '../models/AllNews.php';
		require_once '../models/Pagination.php';
		$dataIndex = allNews($start, $perpage);
		$linksss = links();
		require_once '../views/admin/list/index.php';
	}