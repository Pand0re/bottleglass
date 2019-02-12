<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');

	require_once './bdd.php';

	$name		  = htmlentities($_POST['name']);
	$forname 	= htmlentities($_POST['forname']);
	$gender		= htmlentities($_POST['gender']);
	$npa 		  = htmlentities($_POST['npa']);
	$locality = htmlentities($_POST['locality']);
	$address 	= htmlentities($_POST['address']);
	$country 	= htmlentities($_POST['country']);
	$email 		= htmlentities($_POST['email']);
	$orders   = json_decode(utf8_decode(urldecode($_POST['order'])), true);

	$shipping = true;
	$admin = false;

	if (isset($_POST['shipping'])) {
	  $shipping = htmlentities($_POST['shipping']);
	  $admin = true;
	  var_dump($shipping);
	}

	if (!$admin) {
    $title = "Bottleglass - Commande";

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8-1\r\n";
    $headers .= 'content-transfer-encoding: quoted-printable\r\n';
    $headers .= 'content-type: text/plain; charset="UTF-8"';
    $headers .= 'Mime-Version: 1.0';

    $mail  = file_get_contents("./mailTemplate.html");
    $order = file_get_contents("./rowTemplate.html");
	}
	
	$rows = "";
	$totalCost = $shipping ? 6 : 0;
	
	$stmt = $db->prepare('INSERT INTO tb_commandes VALUES(NULL, :date, :name, :forname, :mail, :sexe, :npa, :loca, :address, :country, NULL, 0, :shipping);');
	$stmt->execute(array(
		':date' 	=> date('Y-m-d H:i:s'),
		':name' 	=> $name,
		':forname'	=> $forname,
		':mail'		=> $email,
		':sexe'		=> $gender == 'man' ? 'H' : 'F',
		':npa'		=> $npa,
		':loca'		=> $locality,
		':address'	=> $address,
		':country'	=> $country,
		':shipping'	=> $shipping
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

        $lang = file_get_contents("./../static/lang/fr.json");
        $lang_array = json_decode($lang, true);

        $name_array = explode(".",$res['nom_pro']);

        $iname = $lang_array[$name_array[0]][$name_array[1]][$name_array[2]];
		$amount = $item['amount'];
		$price  = $res['prix_pro'];
		
		$totalCost += $price * $amount;

		if (!$admin) {
		  $currentRow = $order;
      $currentRow = str_replace("%%NAME%%", 		htmlentities($iname), 			$currentRow);
      $currentRow = str_replace("%%AMOUNT%%", 	$amount, 		$currentRow);
      $currentRow = str_replace("%%PRICE%%", 		number_format($price, 2, '.', "'"),			$currentRow);
      $currentRow = str_replace("%%TOTALPRICE%%", number_format($price*$amount, 2, '.', "'"), $currentRow);

      $rows .= iconv("UTF-8", "Windows-1252", $currentRow);
		}

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


	if (!empty($email)) {
    $mail = str_replace('%%TOTAL_PRICE%%', number_format($totalCost, 2, '.', "'")	, $mail);
    $mail = str_replace('%%NAME%%'	 	 , $name		, $mail);
    $mail = str_replace('%%FORNAME%%'	 , $forname	 	, $mail);
    $mail = str_replace('%%ORDERS%%'	 , $rows		, $mail);
    $mail = str_replace('%%BENEFICIAIRE%%'	, 'Bottle Glass' 		, $mail);
    $mail = str_replace('%%IBANACCOUNT%%'	, 'CH14 8080 8001 6709 7491 1' 		, $mail);
    //$mail = str_replace('%%ADRESSACCOUNT%%'	, utf8_decode(''), $mail);
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
   }
