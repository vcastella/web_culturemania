<?php
	/////////////////////////////////////////////////////
	// GESTION DES SESSIONS
	/////////////////////////////////////////////////////
	if(!empty($_POST))
	// Gestion de la connexion utilisateur
	{ 
		if (isset($_POST['login']) && isset($_POST['password']) )
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			
			// Exécution des requêtes SQL
			$query = 'SELECT PASSWORD FROM author WHERE ACTIF=1 AND EMAIL= \'' . $login . '\'';

			$res = $mysql->query($query);
			$row = $res->fetch_assoc();
			$hashPass = $row['PASSWORD'];
			
			$res->close();

			if (crypt($password, $hashPass) == $hashPass)
			{
				$query = 'SELECT PSEUDO, IDAUTHOR FROM author WHERE ACTIF=1 AND EMAIL= \'' . $login . '\'';
				$res = $mysql->query($query);
				
				if ($row = $res->fetch_assoc())
				{
					$_SESSION['pseudo'] = $row['PSEUDO'];
					$_SESSION['idcm'] = $login;
					$_SESSION['idauthor'] = $row['IDAUTHOR'];
					
				}
				$res->close();
			}					
		}
	}
?>
