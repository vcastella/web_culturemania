<!DOCTYPE html>
<html id="topanchor">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Culturemania - Page de contact</title>
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
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <?php
        include 'connect.php';
        setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
        include 'menu.php'; 
        include 'CArticle.php';
    ?>


    <section class="cm-section">
        <div class="cm-main">
            <div class="cm-glass-main">

                <article class="cm-article">
                	
	                <H1>Contacter Culturemania</H1>
	                <div class="cm-separator-double"></div>

	            	<div class="cm-formulaire" id="formulaire">
					<?php 
						$name = '';
						$email = '';
						$message = '';
						if(!empty($_POST))
						{
							$name = strip_tags($_POST['name']);
							$email = strip_tags($_POST['email']);
							$message = strip_tags($_POST['message']);

							if (empty($_POST['dontfuckwithme']))
							{
								// Envoi du mail
								$subject = 'Message provenant de www.culturemania.fr';
								$headers = 'From: '. $email . "\r\n" ;
								$headers .='Reply-To: '. $email . "\r\n" ;
								$headers .='X-Mailer: PHP/' . phpversion();
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
								$headers .= 'From: '.$name . ' <'.$email.'>' . "\r\n";

								if (mail('contact@culturemania.fr',$subject,$message,$headers) == true)
								{
									echo '<div class="cm-ok-message"> Votre message a été envoyé ! </div>';
									$name = '';
									$email = '';
									$message = '';
								}
								else
									echo '<div class="cm-error-message"> Une erreur est survenue lors de l\'envoi de votre message. </div>';
							}
						}
						
						echo '<form name="mainform" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">';
						echo '<H3> Votre nom : </H3>';
						echo '<input type="text" name="name" maxlength="256" placeholder="Veuillez renseigner votre nom" value="'.$name.'">';
						echo '<H3> Votre e-mail : </H3>';
						echo '<input type="text" name="email" maxlength="256" placeholder="Veuillez renseigner votre adresse e-mail" value="'.$email.'">';
						echo '<H3> Votre message : </H3>';
						echo '<textarea rows="10" cols="40" maxlength="2048" name="message">'.$message.'</textarea>';
						echo '<input type="text" name="dontfuckwithme" class="cm-dontfuck">';
						
						echo '<div class="divcenter"><input type="submit" value="Envoyer le message"></div>';
						
						echo '</form>';
						echo '</div>';
					?>


					</div>	

            </article>    
        </div>  
        </div>  
    </section>
    <BR><BR>
    

    <section class="cm-section-100pc">
        <BR>
        <H1> Participer à Culturemania </H1>
        <div class="cm-separator-double"></div>

        <div class="cm-main">
            <div class="cm-div-3">
                <H1> S'inscrire</H1>
                <a href="/Inscription"><img src="/assets/connect.png" alt="Inscription"/></a>
                <BR><BR>
                <p>Inscrivez-vous et prenez la plume pour publier vous-même des articles sur Culturemania ! On vous demandera le minimum : un pseudonyme, un e-mail valide et un mot de passe savament choisi. Le reste, c'est si uniquement si vous le décidez !</p>
            </div><div class="cm-div-3">
                <H1>Espace rédaction</H1>
                <a href="/Espace-Redaction"><img src="/assets/pencil.png" alt="Redaction"/></a>
                <BR><BR>
                <p>Déjà inscrit ? Alors direction l'espace rédaction de Culturemania pour vous lancer et rédiger vos articles ! Textes, images, vidéo, citations, utilisez toutes les options disponibles pour donner à vos articles ce petit truc qui fait qu'on le lira jusqu'au bout !</p>   
            </div><div class="cm-div-3">
                <H1>Informations</H1>
                <a href="/A-propos"><img src="/assets/information.png" alt="A Propos"/></a>
                <BR><BR>
                <p>Vous voulez en savoir plus sur Culturemania et son mode de fonctionnement ? C'est par ici ! Tout a été fait pour se simplifier la vie au maximum. Nous avons fait le choix de vivre avec les machines alors autant que ce ne soit pas pour se pourrir la vie !</p>
            </div>
        </div>
        <BR>
        <BR>
    </section>



<script>
function validateEmail(email) 
{
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function validateForm() 
{
	formulaire = document.getElementById("formulaire");	
	topBody = document.getElementById("topanchor");	
	todestroy = document.getElementById("todestroy");	
	if (todestroy != null)
		formulaire.removeChild(todestroy);

	newDiv = document.createElement("div");
    newDiv.id = "todestroy"
    newDiv.className = "cm-error-message";

    var value = document.forms["mainform"]["name"].value;
    if (value == null || value == "") 
    {
    	newDiv.innerHTML =" Vous devez renseigner un nom.";
    	formulaire.insertBefore(newDiv, formulaire.firstChild);
    	topBody.scrollIntoView(true);
        return false;
    }
	var value = document.forms["mainform"]["email"].value;
    if (value == null || value == "" || !validateEmail(value)) 
    {
    	newDiv.innerHTML =" Vous devez renseigner un email valide.";
    	formulaire.insertBefore(newDiv, formulaire.firstChild);
    	topBody.scrollIntoView(true);
        return false;
    }

	var value = document.forms["mainform"]["message"].value;
	alert (value);
    if (value == null || value == "") 
    {
    	newDiv.innerHTML ="Votre message est vide.";
    	formulaire.insertBefore(newDiv, formulaire.firstChild);
    	topBody.scrollIntoView(true);
        return false;
    }

    
    return true;
}
</script>
</body>

<?php
    include 'footer.php';
    $mysql->close();
?>

</html>