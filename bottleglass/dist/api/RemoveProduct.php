<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8');
	header('Access-Control-Allow-Headers: X-Requested-With');

  session_start();

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
  if (!isset($_POST["id"])) {
    $response['code'] = 3;
    echo json_encode($response);
    exit();
  }

  // Get data
  $id = json_decode($_POST["id"]);

  // Request template
  $sql = "DELETE FROM tb_produits WHERE id_pro = :id";

	require_once './bdd.php';

  $rqst = $sql;
  $stmt = $db->prepare($rqst);
  $stmt->execute(array(
    ':id'     => $id
  ));

  $response['numberOfDeleted'] = $stmt->rowCount();

	echo json_encode($response);
