<?php
	// Connexion et sélection de la base DEV
	$mysql = new MySQLi('localhost', 'root', '', 'culturemdmania');
							
	//$linkDB = mysql_connect('mysql51-108.perso', 'culturemdmania', 'tjEr4MYUAaZb') or die('Impossible de se connecter : ' . mysql_error());
	//mysql_select_db('culturemdmania') or die('Impossible de sélectionner la base de données');
	//$mysql = new MySQLi('mysql51-108.perso', 'culturemdmania', 'tjEr4MYUAaZb', 'culturemdmania');
	
	$mysql->set_charset("utf8");			
	
?>
	