<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-type: text/html; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
require_once './bdd.php';

$stmt = $db->query("SELECT * FROM tb_produits WHERE dispo_pro = 1",PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());


