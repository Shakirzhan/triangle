<?php
	function login()
	{
		$db = connectionToTheDatabase();
		if (isset($_POST['login'])) {
			if (!empty($_POST['username']) && !empty($_POST['password'])) {
				$username = htmlspecialchars($_POST['username']);
				$password = htmlspecialchars($_POST['password']);

				$sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
				$statement = $db->prepare($sql);
				$statement->bindParam(':username', $username, PDO::PARAM_INT);
				$statement->bindParam(':password', $password, PDO::PARAM_INT);
				$statement->execute();
				$count = $statement->rowCount();
				if ($count != 0) {
					$row = $statement->fetch(PDO::FETCH_ASSOC);
					$dbusername = $row['username'];
					$dbpassword = $row['password'];
					if ($username == $dbusername && $dbpassword) {
						$_SESSION['session_username'] = $username;
						header('Location: ../');
					}
				} else {
					return 'Неправильное имя пользователя или пароль!';
				}
			}
		}
	}