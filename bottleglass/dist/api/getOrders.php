<?php
	
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');

	session_start();
	
	// What we gonna tell it back
	$response = array(
		'code' => -1,
		'orders' => array();
	);
	
	if (isset($_POST['token']) {
		$token = $_POST['token'];
		
		if ($token == $_POST['token']) {
			
			// For testing purpose
			array_push($response['orders'], array(
				'Jean',
				'Valjean',
				'1',
				'Suisse',
				'2732',
				'Les Emiboix',
				'Rue des étoiles 4'
			));
		}
		
		else {
			$response['code'] = 2;
		}
	
	}
	
	else {
		$response['code'] = 1;
	}
	
	// Send our response
	echo json_encode($response);

