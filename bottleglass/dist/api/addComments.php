<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8');
	header('Access-Control-Allow-Headers: X-Requested-With');

  session_start();

  var_dump($_SESSION);

  $response = array(
    /**
     *
     **/
    'code' =>  0
  );


  // If there isn't any token, we stop
	if (!isset($_POST['token'])) {
	  $response['code'] = 1;
		echo json_encode($response);
		exit();
	}

  // If the token's wrong, we stop
	if ($_SESSION['token'] != $_POST['token']) {
	  $response['code'] = 2;
	  echo json_encode($response);
	  exit();
	}

  // If no data was provided, we stop
  if (!isset($_POST["d"])) {
    $response['code'] = 3;
    echo json_encode($response);
    exit();
  }

  // Get data
  $data = json_decode($_POST["d"]);

  var_dump($data);

  // Request template
  $sql = "UPDATE tb_commandes SET remarque_com = :com WHERE id_com = :id;";

	require_once './bdd.php';

  $rqst = $sql;
  $stmt = $db->prepare($rqst);
  $stmt->execute(array(
    ':com'     => $data->remarque_com,
    ':id'      => $data->id_com
  ));

	echo json_encode($response);
