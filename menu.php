<nav class="nav-screen">
	<div class="culturemania"><a href="/"><H1>Culturemania</H1></a></div>
	 <?php
	    $query = 'SELECT t.LIBELLE as TYPE, t.IDTYPE, t.URL as URL, st.LIBELLE SOUSTYPE, st.IDSOUSTYPE, st.URL as STURL FROM soustypechronique st, typechronique t WHERE st.IDTYPE = t.IDTYPE ORDER BY t.IDTYPE';

	    $res = $mysql->query($query);
	    $idlasttype = -1;
	    echo '<ul>';
	    echo '<li><a href="/"><img src="/assets/menu.png" alt="menu"/></a><ul><li><a href="/Espace-Redaction">Espace Rédaction</a></li><li><a href="/Inscription">Inscription</a></li><li><a href="/Contact">Contact</a></li><li><a href="/A-propos">A Propos</a></li><li><a href="/">Accueil</a></li>';
	    if (isset($_SESSION['idcm']))
	    	echo '<li><a href="/logout">Se déconnecter</a></li>';
	    echo '</ul></li>';
	    while ($row = $res->fetch_assoc()) 
		{
			$idtype = $row['IDTYPE'];
			$type = $row['TYPE'];
			$idsoustype = $row['IDSOUSTYPE'];
			$soustype = $row['SOUSTYPE'];
			$urltype   = $row['URL'];
			$urlsoustype   = $row['STURL'];
			if($idtype != $idlasttype)
			{
				if ($idlasttype != -1)
					echo '</ul></li>';
				echo '<li><a href="'.$urltype.'">'.$type.'</a><ul>';
				
			}
			$idlasttype = $idtype;
			echo '<li><a href="'. $urltype. $urlsoustype.'">'. $soustype .'</a></li>';
		}
		$res->close();
		echo '</ul></li>';
		echo '</ul>';
	    
	  ?>
</nav>