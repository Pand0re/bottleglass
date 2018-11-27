<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Content-type: text/html; charset=UTF-8'); 
	header('Access-Control-Allow-Headers: X-Requested-With');
	
	$mail = $_POST['email'];
	
	mail($mail, "Bottleglass - Commande", "Test");

	echo "{r:1}";

