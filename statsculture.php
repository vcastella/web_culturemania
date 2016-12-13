<?php
session_start();
if(!empty($_GET))
{
	if (isset($_GET['logout']))
	{
		session_destroy();
		$_SESSION = array(); 
	}
}	
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>CultureMania - Le site de la culture où vous êtes la plume. Jeux - Livres - BD - Films - Series TV - Lieux - Musique - Objets - Internet</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0">
	<link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1220px)" href="style-1200.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1020px)" href="style-1000.css"/>
    <link rel="stylesheet" media="screen and (max-width: 620px)" href="style-600.css"/>

</head>

<body>
<div class="cm-margin-150"></div>
<?php
	include 'connect.php';	
	include 'menu.php';
?>
			
	<section class="cm-section">
        <div class="cm-main">
            <div class="cm-glass-main">
                <article class="cm-article">
                	<H1>Statistiques Culturemania</H1>
						<div class="cm-separator-double"></div>
						<div class="cm-article-texte">
	                
	           
					<div class="messageOK">
						<?php

								$res = $mysql->query('SELECT SUM(NBVIEWS) AS total FROM chronique');
								$row = $res->fetch_assoc();
								$count=$row['total']; //On récupère le total pour le placer dans la variable $total.
								echo 'Total global des pages vues : ' . $count;
								$res->close();
						?>
					</div>
					
					<div class="messageOK">
						<?php

								$res = $mysql->query('SELECT SUM(c.NBLIKES) AS total FROM chronique c');
								$row = $res->fetch_assoc();
								$count=$row['total']; //On récupère le total pour le placer dans la variable $total.
								echo 'Total likes : ' . $count;
								$res->close();
						?>
					</div>

					
						
					
						<?php
							echo '<H1>Commentaires</H1>';
							$res = $mysql->query('SELECT c.IDCHRONIQUE, c.TITLE, c.NBVIEWS, c.NBLIKES FROM chronique as c ORDER BY DATECREATION DESC');
							// Affichage des chroniques
								
							while ($line = $res->fetch_assoc()) 									
							{
								$idc = $line['IDCHRONIQUE'];
								$title = $line['TITLE'];
								$nbviews = $line['NBVIEWS'];
								$nblikes = $line['NBLIKES'];
								echo '<H3>' . $title . '</H3>';
								echo '<H4>' . $nbviews . ' views, ' . $nblikes . ' likes</H4>';
								

								$rescomm = $mysql->query('SELECT c.TEXTE, a.PSEUDO FROM commentaire as c LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR WHERE c.IDCHRONIQUE = '. $idc .'');

								while ($comment = $rescomm->fetch_assoc()) 
								{
									$texte = $comment['TEXTE'];
									$pseudo = $comment['PSEUDO'];
									
									echo '<p>'. $texte . '<BR>' . $pseudo . '<BR>'. '</p>';
								}
								$rescomm->close();
								echo '<p class="separatorblack"></p>';
							}
							
							$res->close();
						?>
					
						
					
					<?php
							echo '<H1>Auteurs</H1><BR>';
							
							$res = $mysql->query('SELECT * FROM author ORDER BY DATECREATION DESC');
							echo '<table>';
							while ($line = $res->fetch_assoc()) 									
							{
								$nom = $line['NOM'];
								$prenom = $line['PRENOM'];
								$pseudo = $line['PSEUDO'];
								$email = $line['EMAIL'];

								echo '<tr>';
								echo '<td>';
								echo $prenom;
								echo '</td>';
								echo '<td>';
								echo $nom;
								echo '</td>';
								echo '<td>';
								echo $pseudo;
								echo '</td>';
								echo '<td>';
								echo $email;
								echo '</td>';
								echo '</tr>';
								
							}
							echo '</table>';
							$res->close();
							
							

						?>
						
					</div>
				</article>
			</div>
		</div>
	</section>	
			
        <?php
        	
			include 'footer.php';
			$mysql->close();
		?>    

</body>
</html>
