<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8');
	header('Access-Control-Allow-Headers: X-Requested-With');

  session_start();

  //var_dump($_SESSION);

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
  $stat = ($data->stat_com == 0) ? 1 : 0;

  //var_dump($data);

  // Request template
      $sql = "UPDATE tb_commandes SET stat_com = :stat WHERE id_com = :id;";

	require_once './bdd.php';

  $rqst = $sql;
  $stmt = $db->prepare($rqst);
  $stmt->execute(array(
    ':stat'     => $stat,
    ':id'      => $data->id_com
  ));

    $response['stat'] = $stat;

	echo json_encode($response);
