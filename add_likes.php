<?php
	
	session_start();
	require_once('config/db_params.php');
	require_once('components/db.php');
	$db = connectionToTheDatabase();
	if (isset($_SESSION['session_username'])) {
		if (!empty($_POST['id'])) {
			$login = $_SESSION['session_username'].'-'.$_POST['id'];
			switch ($_POST['action']) {
					case 'like':
						$sql = 'INSERT INTO ipaddress_likes_map (ip_address, tutorial_id, user_id) VALUES (:ip_address, :tutorial_id, :user_id)';
						$statement = $db->prepare($sql);
						$statement->bindParam(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
						$statement->bindParam(':tutorial_id', $_POST['id'], PDO::PARAM_STR);
						$statement->bindParam(':user_id', $login, PDO::PARAM_STR);
						$res = $statement->execute();
						if (!empty($res)) {
							$sql = 'UPDATE news SET love = love + 1 WHERE id = :id';	
							$statement = $db->prepare($sql);
							$statement->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
							$statement->execute();
							echo true;
						}
						break;
					case 'unlike':
						$sql = "DELETE FROM ipaddress_likes_map WHERE user_id = :user_id";
						$statement = $db->prepare($sql);
						$statement->bindParam(':user_id', $login, PDO::PARAM_STR);
						$res = $statement->execute();
						if (!empty($res)) {
							$sql = 'UPDATE news SET love = love - 1 WHERE id = :id and love > 0';	
							$statement = $db->prepare($sql);
							$statement->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
							$statement->execute();
							echo 0;
						}
						break;
				}	
		}
	} else {
		echo false;
	}