<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-type: text/html; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
try {
    $db = new PDO('mysql:host=xy1fd.myd.infomaniak.com;dbname=xy1fd_bottleglass', 'xy1fd_admin','XUxtMTgfTqcx');

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$stmt = $db->query("SELECT * FROM tb_produits WHERE dispo_pro = 1",PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());


