<?php
	
	function OneNews($id)
	{
		$db = connectionToTheDatabase();
		$sql = 'SELECT * FROM news WHERE id = :id';
		$statement = $db->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
