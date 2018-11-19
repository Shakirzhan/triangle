<?php
	function connectionToTheDatabase()
	{
		try {
	  	$connect = new PDO(HOST, USERNAME, PASSWORD);
		} catch(PDOException $err) {
	  	echo "Ошибка: не удается подключиться: " . $err->getMessage();
		}

		if (isset($connect)) return $connect;
	}

	function ID()
	{
		$db = connectionToTheDatabase();
		$sql = 'SELECT id FROM news';
		$statement = $db->prepare($sql);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}

	function exists($user_id)
	{
		$db = connectionToTheDatabase();
		$statement = $db->prepare("SELECT 1 FROM ipaddress_likes_map WHERE user_id = ?");
		$statement->execute([$user_id]);
		$res = $statement->fetchColumn();
		if ($res) return true;
		return false;
	}

	function pageID($page)
	{
		$perpage = 2;
		$db = connectionToTheDatabase();
		$PageSql = 'SELECT COUNT(*) as count FROM news';
		$statement = $db->prepare($PageSql);
		$statement->execute();
		$totalres = $statement->fetchColumn();
		$endpage = ceil($totalres / $perpage);
		if (($page >= 1) && ($page <= $endpage)) return true;
		return false;
	}

	function itemID($page)
	{
		$perpage = 2;
		$db = connectionToTheDatabase();
		$PageSql = 'SELECT COUNT(*) as count FROM news';
		$statement = $db->prepare($PageSql);
		$statement->execute();
		$totalres = $statement->fetchColumn();
		$endpage = ceil($totalres / $perpage);
		if (($page >= 1) && ($page <= $endpage)) return $page;
		return false;
	}

	function countComment($id)
	{
		$db = connectionToTheDatabase();
		$countSql = 'SELECT COUNT(*) as count FROM tbl_comment WHERE itemID = '.$id;
		$statement = $db->prepare($countSql);
		$res = $statement->execute();
		if ($res) return $totalres = $statement->fetchColumn();
		return 0;
	}