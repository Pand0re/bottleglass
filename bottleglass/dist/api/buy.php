<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');

	require_once './bdd.php';

	$name		= $_POST['name'];
	$forname 	= $_POST['forname'];
	$gender		= $_POST['gender'];
	$npa 		= $_POST['npa'];
	$locality 	= $_POST['locality'];
	$address 	= $_POST['address'];
	$country 	= $_POST['country'];
	$email 		= $_POST['email'];
	$orders     = json_decode(utf8_decode(urldecode($_POST['order'])), true);
		
	$title = "Bottleglass - Commande";
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= 'content-transfer-encoding: quoted-printable\r\n';
	$headers .= 'content-type: text/plain; charset="UTF-8"';
	$headers .= 'Mime-Version: 1.0';
	
	$mail  = file_get_contents("./mailTemplate.html");
	$order = file_get_contents("./rowTemplate.html");
	
	$rows = "";
	$totalCost = 0;
	
	$stmt = $db->prepare('INSERT INTO tb_commandes VALUES(NULL, :date, :name, :forname, :mail, :sexe, :npa, :loca, :address, :country);');
	$stmt->execute(array(
		':date' 	=> date('Y-m-d H:i:s'),
		':name' 	=> $name,
		':forname'	=> $forname,
		':mail'		=> $email,
		':sexe'		=> $gender == 'man' ? 'H' : 'F',
		':npa'		=> $npa,
		':loca'		=> $locality,
		':address'	=> $address,
		':country'	=> $country
	));
	
	define('PK_COMM', $db->lastInsertId());
	
	// Build mail
	foreach($orders["data"] as $item) {		
		$stmt = $db->prepare("SELECT * FROM tb_produits WHERE id_pro = :id AND dispo_pro = 1 AND quant_pro >= :amount;");

		$stmt->execute(array(':id' => intval($item['id']), ':amount' => intval($item['amount'])));

		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// Invalid product
		if (!isset($res['nom_pro'])) {
			continue;
		}

		$iname   = $res['nom_pro'];
		$amount = $item['amount'];
		$price  = $res['prix_pro'];
		
		$totalCost += $price * $amount;
		
		$currentRow = $order;
		$currentRow = str_replace("%%NAME%%", 		$iname, 			$currentRow);
		$currentRow = str_replace("%%AMOUNT%%", 	$amount, 		$currentRow);
		$currentRow = str_replace("%%PRICE%%", 		number_format($price, 2, '.', "'"),			$currentRow);
		$currentRow = str_replace("%%TOTALPRICE%%", number_format($price*$amount, 2, '.', "'"), $currentRow);
		
		$rows .= iconv("UTF-8", "Windows-1252", $currentRow);
		
		// Insert this item as a part of the order
		$stmt = $db->prepare("INSERT INTO tb_panier VALUES(:pk_prod, :pk_comm, :amount);");
		
		$stmt->execute(array(
			'pk_prod' => $item['id'],
			'pk_comm' => PK_COMM,
			'amount'  => $item['amount']
		));
		
		// Update amount of available stock
		$stmt = $db->prepare("UPDATE tb_produits SET quant_pro = :newamount WHERE id_pro = :id;");
		$stmt->execute(array(
			':newamount' 	=> $res['quant_pro'] - $item['amount'],
			':id' 			=> $item['id']
		));
		
	}
	
	$mail = str_replace('%%TOTAL_PRICE%%', number_format($totalCost, 2, '.', "'")	, $mail);
	$mail = str_replace('%%NAME%%'	 	 , $name		, $mail);
	$mail = str_replace('%%FORNAME%%'	 , $forname	 	, $mail);
	$mail = str_replace('%%ORDERS%%'	 , $rows		, $mail);
    $mail = str_replace('%%BENEFICIAIRE%%'	, 'Bottleglass' 		, $mail);
	$mail = str_replace('%%IBANACCOUNT%%'	, 'CH14 8080 8001 6709 7491 1' 		, $mail);
    $mail = str_replace('%%ADRESSACCOUNT%%'	, 'Adresse, NPA Localité - SUISSE' 		, $mail);
    $mail = str_replace('%%ORDERNUMBER%%'	, PK_COMM 		, $mail);


	$content = $mail;
	
	// Send mail
	if (mail($email, $title, $content, $headers)) {
		/*mail(
			"contact@bottleglass.ch", 
			"Bottleglass - Commande",
			"Une commande a �t� pass�e sur le site internet pour un total de ". $totalCost . " CHF.", 
			$headers
		);*/
		echo 0;
	}
	
	else {
		echo 1;
	}
