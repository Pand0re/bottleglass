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
  $data = $_POST["d"];
  $lang = $_POST["l"];

  file_put_contents('../static/lang/' . $lang . '.json', $data);

  echo json_encode($response);


