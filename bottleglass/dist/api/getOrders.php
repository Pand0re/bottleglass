<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Content-type: text/html; charset=UTF-8');
    header('Access-Control-Allow-Headers: X-Requested-With');
    require_once './bdd.php';

	session_start();
	
	// What we gonna tell it back
	$response = array(
		'code' => -1,
		'orders' => array()
	);
	
	if (isset($_POST['token'])) {
		if ($_SESSION['token'] == $_POST['token']) {

            $stmt = $db->query("SELECT * FROM tb_commandes ORDER BY id_com",PDO::FETCH_ASSOC);

            $response['orders'] = $stmt->fetchAll();

            $response['code'] = 0;
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

