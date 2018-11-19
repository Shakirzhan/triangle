<?php
	
	function registration()
	{
		$db = connectionToTheDatabase();
		if (isset($_POST['register'])) { 
			if (!empty($_POST['username']) && !empty($_POST['password'])) { 
				$username = htmlspecialchars($_POST['username']);
				$password = htmlspecialchars($_POST['password']);

				$statement = $db->prepare("SELECT 1 FROM users WHERE username = ?");
				$statement->execute([$username]);
				$found = $statement->fetchColumn();
				if (!$found) {
					$sql = 'INSERT INTO users (username, password) VALUES(:username, :password)';
					$statement = $db->prepare($sql);
					$statement->bindParam(':username', $username, PDO::PARAM_STR);
					$statement->bindParam(':password', $password, PDO::PARAM_STR);
					$res = $statement->execute();
					if ($res) {
						return '<div class="alert alert-success" role="alert">Вы успешно зарегистрированы!</div>';
					} else {
						return '<div class="alert alert-danger" role="alert">Ошибка проверьте данные!</div>';	
					}
				} else {
					return '<div class="alert alert-danger" role="alert">Это имя пользователя уже существует!</div>';
				}
			}
		}
	}