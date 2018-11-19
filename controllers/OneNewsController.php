<?php
	
	function OneNewsController($id)
	{
		require_once ROOT.'/models/OneNews.php';
		$dataId = OneNews($id);
		require_once ROOT.'/views/item/index.php';
	}