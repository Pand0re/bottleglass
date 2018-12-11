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

            try {
                $db = new PDO('mysql:host=xy1fd.myd.infomaniak.com;dbname=xy1fd_bottleglass', 'xy1fd_admin','XUxtMTgfTqcx');

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }

            $stmt = $db->query("SELECT * FROM tb_commandes ORDER BY id_com",PDO::FETCH_ASSOC);

            $response = $stmt->fetchAll();

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

