<?php

	function admin()
	{
		if (isset($_POST['login'])) {
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);

			if ($username == ADMIN_USERNAME && $password == ADMIN_PASSWORD) {
				$_SESSION['admin_username'] = $username;
				if (isset($_SESSION['admin_username'])) {
					header("location: ./?action=list");
				}
			} else {
				return 'Неправильное имя пользователя или пароль!';
			}
		}
	}