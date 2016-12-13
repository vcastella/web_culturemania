<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Culturemania - Mot de passe oublié ?</title>
    <meta name="description" content="Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania"/>
    <meta name="keywords" content="jeux, jeu, video, livre, livres, film, films, serie, series, TV, télé, lieux, musique, album, artiste, concert, culture, mania, evenement, console, ps3, ps4, xbox, cinema, PC, actualité"/>
    <meta property="og:image" content="http://www.culturemania.fr/assets/culturemania.jpg" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="/style.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1220px)" href="/style-1200.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1020px)" href="/style-1000.css"/>
    <link rel="stylesheet" media="screen and (max-width: 620px)" href="/style-600.css"/>

	<script type="text/javascript">

	function validateEmail(email) 
	{
	    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    return re.test(email);
	}


	function validateForm() 
	{
		formulaire = document.getElementById("formulaire");	
		todestroy = document.getElementById("todestroy");	
		if (todestroy != null)
			formulaire.removeChild(todestroy);

		newDiv = document.createElement("div");
	    newDiv.id = "todestroy"
	    newDiv.className = "cm-error-message";


	    var value = document.forms["mainform"]["email"].value;

	    if (value == null || value == "" || !validateEmail(value)) 
	    {
	    	newDiv.innerHTML =" Vous devez renseigner un email valide.";
	    	formulaire.insertBefore(newDiv, formulaire.firstChild);
	        return false;
	    }

	    var value = document.forms["mainform"]["password"].value;
	    if (value == null || value == "") 
	    {
	    	newDiv.innerHTML =" Vous devez renseigner un password";
	    	formulaire.insertBefore(newDiv, formulaire.firstChild);
	        return false;
	    }

	    var valuebis = document.forms["mainform"]["passwordBis"].value;
	    if (valuebis == null || valuebis == "" || value != valuebis )  
	    {
	    	newDiv.innerHTML ="Les deux password ne correspondent pas.";
	    	formulaire.insertBefore(newDiv, formulaire.firstChild);
	        return false;
	    }
	    return true;
	}

	</script>
</head>   


    
<body id="topanchor">
	<div class="cm-margin-150"></div>
	<?php 
		include 'connect.php';
		include 'menu.php';
		setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
	?>

    <section class="cm-section">
        <div class="cm-main">
            <div class="cm-glass-main">
                <article class="cm-article">
                	
	                <H1>Mot de passe oublié ?</H1>
	                <div class="cm-separator-double"></div>

	            	<div class="cm-formulaire" id="formulaire">
		
					<?php 
						$error = '';
						$showform = true;
						$email = "";
						
						
						if(!empty($_POST) && empty($_POST['dontfuckwithme']))
						// On vérifie que le champs dontfuckwithme n'ai pas été rempli par un fucking robot
						{
							$email = $_POST['email'];
							$password = $_POST['password'];
							$passwordBis = $_POST['passwordBis'];
							if(!empty($email) && !empty($password) && !empty($passwordBis) && $password == $passwordBis)  
							{
								$cost = 10;
								// Create a random salt
								$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
								// Prefix information about the hash so PHP knows how to verify it later.
								// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
								$salt = sprintf("$2a$%02d$", $cost) . $salt;
								$hashpass = crypt($password, $salt);
								$sql="UPDATE author SET PASSWORD = '$hashpass', ACTIF = 0 WHERE EMAIL = '$email'";
								$mysql->query($sql);
								
								$count = $mysql->affected_rows;
								
								if($count > 0)
								{
									// Envoi du mail
									$subject = 'Bon retour sur Culturemania.fr !';
									$message = "<html><body>Bonjour ". $prenom .", <BR><BR>Vous venez de réinitialiser votre mot de passe sur CultureMania. Pour confirmer cette procédure et réactiver votre compte, veuillez suivre le lien suivant : <a href=\"http://www.culturemania.fr/confirmation.php?email=".$email."\">http://www.culturemania.fr/confirmation.php?email=".$email."</a>
									<BR><BR>
									Rappel de vos identifiants : <BR>
									login : ". $email ."<BR>
									password : Vous seul le connaissez ! <BR><BR>
									
									Merci de conserver cet email, et à très bientôt sur <a href=\"http://www.culturemania.fr\">http://www.culturemania.fr</a> ! <BR><BR>CultureMania)</body></html>";
									$headers = 'From: CultureMania inscription@culturemania.fr' . "\r\n" ;
									$headers .='Reply-To: '. $email . "\r\n" ;
									$headers .='X-Mailer: PHP/' . phpversion();
									$headers  = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
									$headers .= 'From: CultureMania <inscription@culturemania.fr>' . "\r\n";

									mail($email,$subject,$message,$headers);
									
									echo '<article><H2>Mot de passe oublié ?</H2><p>Un mail de confirmation vient de vous être envoyé. <BR><BR><BR> Bon retour sur Culturemania ! </p></article>';
									$showform = false;
								}
								else
								{
									
									echo '<div class="cm-error-message">';
									echo '<h3>Erreur : </h3>';
									echo '<p>Cette adresse e-mail n\'est pas enregistrée parmi les comptes de Culturemania</p>';
									echo '</div>';
								}
							}
								
						}
						
						?>
						<div class="cm-info-message">
						<h3>Pas de panique !</h3>
						<BR>
						<p>
							Si vous avez oublié votre <strong>mot de passe</strong> mais que vous avez toujours dans votre esprit votre adresse <strong>e-mail</strong> (ce que nous espérons), nous vous invitons à saisir de nouveau votre e-mail ainsi que votre nouveau password.
							Un nouvel e-mail de confirmation vous sera envoyé à cette adresse avec un lien pour <strong>réactiver votre compte</strong> avec ce nouveau mot de passe. A vous de jouer !						
						</p>
						</div>
						<form  name="mainform" onsubmit="return validateForm();" method="POST">
							
							<h3> E-mail : </h3>
							<input type="text" name="email" placeholder="adresse e-mail"  value="<?php echo $email; ?>">
							
							<h3>Nouveau password :</h3> 
							<input type="password" name="password" placeholder="mot de passe" >

							<p>Veuillez ré-entrer votre nouveau password </h3>
							<input type="password" name="passwordBis" placeholder="mot de passe" >
							<input type="text" name="dontfuckwithme" class="cm-dontfuck">

							<input type="submit" value="Envoyer"/>

							<a href="/Inscription"><i>Page d'inscription</i></a>
							<a href="/Espace-Redaction"><i>Retour à l'Espace Rédaction</i></a>
						</form>
					</div>
				</article>
			</div>
		</div>
	</section>
	<BR>
	<BR>


<?php

	include 'footer.php';
	$mysql->close();
?>

</body>
</html>
