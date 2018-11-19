<?php 
	
	function RegistrationController()
	{
		require_once ROOT.'/models/Registration.php';
		$numrows = registration();
		$linksss = links();
		require_once ROOT.'/views/registration/index.php';
	}