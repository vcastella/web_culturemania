<?php
	// Connexion et sélection de la base DEV
	$mysql = new MySQLi('localhost', 'root', '', 'tete');
							
	//$linkDB = mysql_connect('etnontulauraspas', 'degage', 'celuilanonplus') or die('Impossible de se connecter : ' . mysql_error());
	//mysql_select_db('tete') or die('Impossible de sélectionner la base de données');
	//$mysql = new MySQLi('etnontulauraspas', 'degage', 'celuilanonplus', 'tiretoi');
	
	$mysql->set_charset("utf8");			
	
?>
	
