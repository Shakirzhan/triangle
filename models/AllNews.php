<?php
	
	function allNews($start, $perpage)
	{
		$db = connectionToTheDatabase();
		$sql = 'SELECT * FROM news LIMIT :start, :perpage';
		$statement = $db->prepare($sql);
		$statement->bindParam(':start', $start, PDO::PARAM_INT);
		$statement->bindParam(':perpage', $perpage, PDO::PARAM_INT);
		$statement->execute();
		$data = $statement->fetchAll(PDO::FETCH_CLASS);
  	if (isset($data)) return $data;
	}