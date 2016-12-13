<?php

	if(!empty($_POST))
	{	
		if (isset($_POST['idchronique']))
		{

			if(!empty($_POST['idchronique']))
			{ 
				include 'connect.php';

				$idchronique = $_POST['idchronique'];
				
				$request="UPDATE chronique SET NBLIKES = NBLIKES + 1 WHERE IDCHRONIQUE = " . $idchronique . "";			
				$mysql->query($request);
				$mysql->close();
				
			}
		}
	}

?>