<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8');
	header('Access-Control-Allow-Headers: X-Requested-With');

	require_once './bdd.php';

  $response = array(
    'code' =>  0
  );

  if (!isset($_POST["d"]) {
    echo json_encode($response);
    exit();
  }

  $data = json_decode($_POST["d"]);

  $sql = "UPDATE tb_product SET prix_pro=:prix,dispo_pro=:dispo,quant_pro=:quant,cat_pro=:cat WHERE id_pro=:id;";

  function CreateRequest(price, available, amount, cat, id){
    global $sql;
    $rqst = str_replace(':prix', price, $sql);
    $rqst = str_replace(':dispo', available, $rqst);
    $rqst = str_replace(':quant', amount, $rqst);
    $rqst = str_replace(':cat', cat, $rqst);
    $rqst = str_replace(':id', id, $rqst);
    return $rqst;
  }

  foreach ($data as $product) {
    $rqst = CreateRequest()
  }
