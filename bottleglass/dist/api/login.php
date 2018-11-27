<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');

	session_start();
	
	$_SESSION['token'] = NULL;
	
	define("TOKEN_SIZE", 64);
	
	// What we gonna tell it back
	$response = array(
		'code' => -1,
		'token' => NULL
	);
	
	// Form wasn't submitted using web page
	if (!isset($_POST['user']) || !isset($_POST['password'])) {
		$response['code'] = 2;
	}
	
	// Real loggin attempt
	else {
	
		// Credentials
		$user 	  = $_POST['user'];
		$password = $_POST['password'];
		
		// Invalid creds
		if ($user != 'Admin' || $password != 'Admlocal1') {
			$response['code'] = 1;
		}
		
		// Valid creds
		else {
			$response['code']  = 0;		
			$response['token'] = bin2hex(random_bytes(TOKEN_SIZE));		
			$_SESSION['token'] = $response['token'];
		}
	}
	
	// Send our response
	echo json_encode($response);

