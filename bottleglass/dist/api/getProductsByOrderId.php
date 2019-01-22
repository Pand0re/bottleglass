<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-type: text/html; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
require_once './bdd.php';

session_start();

$id = (isset($_POST['id'])) ? (int)$_POST['id'] : 0;

// What we gonna tell it back
$response = array(
    'code' => -1,
    'products' => array()
);

if (isset($_POST['token'])) {
    if ($_SESSION['token'] == $_POST['token']) {

        $stmt = $db->query("SELECT quantite_pan,nom_pro FROM tb_panier
                                    INNER JOIN tb_produits ON tb_produits.id_pro = tb_panier.id_fk_produit
                                    WHERE id_fk_commande = ".$id,PDO::FETCH_ASSOC);


        $response['products'] = $stmt->fetchAll();

        $response['code'] = 0;
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

