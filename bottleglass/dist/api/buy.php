<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');

	require_once './bdd.php';

	/*
	$name		  = $_POST['name'];
	$forname 	= $_POST['forname'];
	$gender		= $_POST['gender'];
	$npa 		  = $_POST['npa'];
	$locality = $_POST['locality'];
	$address 	= $_POST['address'];
	$country 	= $_POST['country'];
	$email 		= $_POST['email'];
	$order    = $_POST['order'];
*/

	$name		  = $_GET['name'];
	$forname 	= $_GET['forname'];
	$gender		= $_GET['gender'];
	$npa 		  = $_GET['npa'];
	$locality = $_GET['locality'];
	$address 	= $_GET['address'];
	$country 	= $_GET['country'];
	$email 		= $_GET['email'];
	$order    = $_GET['order'];


	$title = "Bottleglass - Commande";
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= 'content-transfer-encoding: quoted-printable\r\n';
	$headers .= 'content-type: text/plain; charset="UTF-8"';
	$headers .= 'Mime-Version: 1.0';
	
	$mail  = file_get_contents("./mailTemplate.html");
	$order = file_get_contents("./rowTemplate.html");
	
	$rows = "";
	
	foreach($order => $item) {
		
		
		
		$currentRow = $order;
		$currentRow = str_replace("%%NAME%%", "Verre � pieds", $name);
		$currentRow = str_replace("%%AMOUNT%%", "Verre � pieds", $amount);
		$currentRow = str_replace("%%PRICE%%", "Verre � pieds", $price);
		$currentRow = str_replace("%%TOTALPRICE%%", "Verre � pieds", $price*$amount);
		$rows .= $currentRow;
	}
	
	$mail = str_replace('%%NAME%%'	 	, $name		, $mail);
	$mail = str_replace('%%FORNAME%%'	, $forname	, $mail);
	$mail = str_replace('%%ORDERS%%'	, $rows		, $mail);
	
	$content = $mail;	
	
	if (mail($email, $title, $content, $headers)) {
		mail(
			"contact@bottleglass.ch", 
			"Bottleglass - Commande",
			"Une commande a �t� pass� sur le site internet.", 
			$headers
		);
		echo $content;
	}
	
	else {
		echo "Error sending mail.";
	}


