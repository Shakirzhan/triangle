<?php 
	session_start();

	require_once '../components/links.php';
	require_once '../config/db_params.php';
	require_once '../components/db.php';
	require_once '../controllers/AdminController.php';
	require_once '../controllers/ErrorController.php';
	$linksss = links();
	$action = (isset($_GET['action'])) ? $_GET['action'] : '';
	$uri = $_SERVER['REQUEST_URI'];
	$page = isset($_GET['page']) ? $_GET['page'] : '';
	$itemID = isset($_GET['itemId']) ? $_GET['itemId'] : '';

	if (empty($_SESSION['admin_username'])) {
		AdminController();	
		exit;
	}

	switch ($action) {
		case 'login':
			if (isset($_SESSION['admin_username'])) {
				header("location: ./?action=list");
			} else {
				AdminController();
			}
			break;
		case 'list':
			require_once '../controllers/ListController.php';
			ListController();
			break;
		case 'edit':
			require_once '../controllers/EditController.php';
			EditController($itemID, $uri);
			break;
		case 'append':
			require_once '../controllers/AppendController.php';
			AppendController();
			break;
		case 'logout':
			unset($_SESSION['admin_username']);
			session_destroy();
			header("location: /admin/");
			break;
		default:
			switch ($uri) {
				case '/admin/':
					if (isset($_SESSION['admin_username'])) {
						header("location: ./?action=list");
					} else {
						AdminController();
					}
					break;	
			}
			break;
	}