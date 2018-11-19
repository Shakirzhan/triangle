<?php

	$perpage = 2;
	if (isset($_GET['page']) & !empty($_GET['page'])) {
		$curpage = $_GET['page'];
	} else {
		$curpage = 1;
	}

	$db = connectionToTheDatabase();
	$start = ($curpage * $perpage) - $perpage;
	$PageSql = 'SELECT COUNT(*) as count FROM news';
	$statement = $db->prepare($PageSql);
	$statement->execute();
	$totalres = $statement->fetchColumn();
	$endpage = ceil($totalres / $perpage);
	$startpage = 1;
	$nextpage = $curpage + 1;
	$previouspage = $curpage - 1;