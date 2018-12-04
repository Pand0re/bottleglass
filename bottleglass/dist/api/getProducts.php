<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 04.12.2018
 * Time: 11:09
 */

try {
    $db = new PDO('mysql:host=xy1fd.myd.infomaniak.com;dbname=xy1fd_bottleglass', 'xy1fd_admin','XUxtMTgfTqcx');

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$stmt = $db->query("SELECT * FROM tb_produits",PDO::FETCH_ASSOC);

echo json_encode($stmt->fetchAll());


