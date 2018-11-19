<?php
	session_start();
	
	error_reporting(-1);	
	define('ROOT', __DIR__);
	require_once ROOT.'/config/db_params.php';
	require_once ROOT.'/components/db.php';
	require_once ROOT.'/components/links.php';

	$action = $_SERVER['REQUEST_URI'];
	$url = isset($_GET['newsId']) ? $_GET['newsId'] : '';
	$page = isset($_GET['page']) ? $_GET['page'] : '';

	$actions = (isset($_GET['action'])) ? $_GET['action'] : '';

	$listID = ID();

	switch ($action) {
		case '/':
			require_once ROOT.'/controllers/NewsController.php';
			NewsController();
			break;

		case '/login/':
			require_once ROOT.'/controllers/LoginController.php';
			LoginController();
			break;

		case '/registration/':
			require_once ROOT.'/controllers/RegistrationController.php';
			RegistrationController();
			break;

		case '/logout/':
			unset($_SESSION['session_username']);
			session_destroy();
			header("location: ../");
			break;
		
		default:
			switch ($actions) {		
				case 'item':
					require_once ROOT.'/controllers/OneNewsController.php';
					$d = 0;
					while ($d < count($listID)) {
						$bool = ($listID[$d]->id == $url) ? true : false;
						if ($bool) break;
						$d++;
					}
					if ($bool) { 
						OneNewsController($url);
					} else {
						require_once ROOT.'/controllers/ErrorController.php';
						ErrorController();	
					}
					break;
				case 'new':
					require_once ROOT.'/controllers/NewsController.php';
					require_once ROOT.'/controllers/ErrorController.php';
					if (pageID($page)) {
						NewsController();
					} else {
						ErrorController();
					}
						
					break;
				
				default:
					require_once ROOT.'/controllers/ErrorController.php';
					ErrorController();
					break;
			}
			/**
			require_once ROOT.'/controllers/ErrorController.php';
			ErrorController();
			
			header('location: '.links().'404.html');
			*/
			break;
	}