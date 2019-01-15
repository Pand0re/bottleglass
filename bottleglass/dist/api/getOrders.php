<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Content-type: text/html; charset=UTF-8');
    header('Access-Control-Allow-Headers: X-Requested-With');
    require_once './bdd.php';

	session_start();
	
	// What we gonna tell it back
	$response = array(
		'code' => -1,
		'orders' => array()
	);
	
	if (isset($_POST['token'])) {
		if ($_SESSION['token'] == $_POST['token']) {

            $stmt = $db->query("SELECT * FROM tb_commandes ORDER BY id_com",PDO::FETCH_ASSOC);
            /*

            TERMINER CETTE REQUETE
             * SELECT adresse_cli_com, date_com,id_com,localite_cli_con,mail_cli_com,nom_cli_com,npa_cli_com,pays_cli_com,prenom_cli_com,sexe_cli_com, nom_pro

                FROM tb_commandes
                INNER JOIN tb_panier ON id_com = id_fk_commande
                INNER JOIN tb_produits ON id_pro = id_fk_produit
                #GROUP BY id_com
                ORDER BY id_com


             */

            $response['orders'] = $stmt->fetchAll();

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

