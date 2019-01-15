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
  if (!isset($_POST["d"])) {
    $response['code'] = 3;
    echo json_encode($response);
    exit();
  }

  // Get data
  $data = json_decode($_POST["d"]);

  // Request template
  $sql = "UPDATE tb_produits SET " .
       "nom_pro=:nom,desc_pro=:desc,img_pro=:img " .
        "WHERE id_pro=:id;";

	require_once './bdd.php';

  foreach ($data as $p) {
    $rqst = $sql;
    $stmt = $db->prepare($rqst);
    $stmt->execute(array(
      ':nom'      => $p->nom_pro,
      ':desc'     => $p->desc_pro,
      ':img'      => $p->img_pro,
      ':id'       => $p->id_pro
    ));

  }

	echo json_encode($response);
