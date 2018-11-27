<?php

	header("Access-Control-Allow-Origin: *");
	
	$mail = $_POST['email'];
	
	mail($mail, "Bottleglass - Commande", "Test");

	echo "{r:1}";

