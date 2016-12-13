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
    <title>CultureMania - Le site de la culture où vous êtes la plume. Jeux - Livres - BD - Films - Series TV - Lieux - Musique - Objets - Internet</title>
    <meta name="description" content="Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania"/>
	<meta name="keywords" content="jeux, jeu, video, livre, livres, film, films, serie, series, TV, télé, lieux, musique, album, artiste, concert, culture, mania, evenement, console, ps3, ps4, xbox, cinema, PC, actualité"/>
    <link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" href="images/logo.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name = "author" content ="Vincent Castella"/>
	<meta name="description" content="Site de la culture autour des jeux video, des livres et BD, des films et des evenements culturels. Culturemania"/>
	<meta name="keywords" content="jeux, jeu, video, livre, livres, film, films, culture, evenement, console, ps3, ps4, xbox, cinema"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" language="javascript" src="script.js"></script>
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
                	
	                <H1>Validation de votre inscription</H1>
	                <div class="cm-separator-double"></div>

	            	<div class="cm-formulaire" id="formulaire">
	            
				

						<?php
							$valid = false;
							
							if(!empty($_GET))
							{
								if (isset($_GET['email']) && !empty($_GET['email']))
								{
									$email = $_GET['email'];

									$stmt = $mysql->prepare("UPDATE author SET ACTIF=1 WHERE EMAIL = ?"); 
									$stmt->bind_param('s',  $email);
									$stmt->execute(); 
									$stmt->close();
									$valid = true;
								}
							}
							
							if ($valid == true)	
							{
								?>
								<div class="cm-info-message">
									<H3>Validation de votre inscription !</H3>
									<BR>
									
									<p>Votre inscription sur <strong>CultureMania</strong> est confirmée ! </p>
									<p>Connectez-vous et rejoignez dès à présent <a href="/Espace-Redaction"><strong>l'Espace Rédaction</strong></a> situé aussi dans le menu principal du site. Entrez votre adresse e-mail et votre mot de passe, et faite partie de l'équipe Culturemania en participant à la rédaction des articles du site !</p>
								
								</div>
						<?php
							}
							else
							{
						?>
								<div class="cm-error-message">
									<H3> Echec de votre inscription</H3>
									<BR>
									<p> Impossible de valider votre inscription pour l'une des raisons suivantes :</p>
									
									<p>
										Cette adresse mail est déjà confirmée. Dans ce cas, vous pouvez dès à présent vous connecter à Culturemania.<BR>
										Problème interne : veuillez contacter la technique à l'adresse : <b><a href="mailto:contact@culturemania.fr">contact@culturemania.fr</a></b><BR>
										Vous êtes un pirate-hacker sans scrupule qui essaye des adresses mail en boucle. Je ne peux rien pour vous.<BR>
										Vous êtes un robot malfaisant. Contactez votre créateur et dites-lui d'utiliser son pré-supposé génie pour quelque chose d'utile.<BR>
									</p>	

								</div>
								
						<?php 
							}
						?>
					</div>
	            </article>
			</div>
		</div>
	</section>
	<BR><BR>
</body>

<?php
	include 'footer.php';
	$mysql->close();
?>


</html>
