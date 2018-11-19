<?php 
	
	function NewsController()
	{
		require_once ROOT.'/models/AllNews.php';
		require_once ROOT.'/models/Pagination.php';
		$dataIndex = allNews($start, $perpage);
		require_once ROOT.'/views/news/index.php';
	}