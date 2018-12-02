<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');
	
	$name		= $_POST['name'];
	$forname 	= $_POST['forname'];
	$gender		= $_POST['gender'];
	$npa 		= $_POST['npa'];
	$locality 	= $_POST['locality'];
	$address 	= $_POST['address'];
	$country 	= $_POST['country'];
	$email 		= $_POST['email'];
	
	$title = "Bottleglass - Commande";
	
	//$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$content = "Les commandes ne sont pas encore fonctionnelles. Aucune commande n'a encore réellement été faite. Veuillez réessayer plus tard\n" .
					file_get_contents("./mailTemplate.html");
	
	mail($email, $title, $content, $headers);

	echo $content;

