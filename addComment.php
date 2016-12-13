<?php

	if(!empty($_POST))
	{	
		if (isset($_POST['comment']) && isset($_POST['idchronique']))
		{

			if(!empty($_POST['comment']) && !empty($_POST['idchronique']))
			{ 
				
				include 'connect.php';
				include 'functions.php';
				
				$date = date('Y-m-d H:i:s');
				$comment = $mysql->real_escape_string($_POST['comment']);
				$idchronique = $_POST['idchronique'];
				$idauthor = 0;
				if (isset($_POST['idauthor']))
					$idauthor = $_POST['idauthor'];
				
				$anonymouspseudo = "";
				if (isset($_POST['anonymouspseudo']))
					$anonymouspseudo = $mysql->real_escape_string($_POST['anonymouspseudo']);

				$request = "INSERT INTO commentaire (TEXTE, IDCHRONIQUE, IDAUTHOR, ANONYMOUSPSEUDO, DATECREATION) VALUES ('$comment', $idchronique, $idauthor, '$anonymouspseudo', '$date')";			
				$mysql->query($request);

				// On envoi un mail à l'auteur de la chronique
				
				$query = 'SELECT a.PSEUDO, a.EMAIL, c.TITLE, t.URL as URLTYPE, st.URL as URLSUBTYPE FROM author a, chronique c, typechronique t, soustypechronique st 
					where c.IDAUTHOR = a.IDAUTHOR AND c.IDCHRONIQUE = '. $idchronique .' AND c.IDTYPE = t.IDTYPE AND c.IDSOUSTYPE = st.IDSOUSTYPE ';

				
				$res = $mysql->query($query);
				$row = $res->fetch_assoc();
				$mailto = $row['EMAIL'];
				$pseudo = $row['PSEUDO'];
				$title = $row['TITLE'];
				$urltype = $row['URLTYPE'];
				$urlsubtype = $row['URLSUBTYPE'];
				$res->close();

				

				$suburl = formatURL(trim($title));
				$link = $urltype . $urlsubtype . "/" .  $suburl . '-' . $idchronique;


				$subject = $pseudo . ', quelqu\'un a commenté votre article sur Culturemania !';
                $message = '<html><body>Bonjour '. $pseudo .', <BR><p>Quelqu\'un vient de poster un commentaire à propos de votre article <strong>"' . $title . '"</strong> sur <strong>Culturemania</strong> !</p>
<p>N\'hésitez pas à le consulter et à y répondre en suivant ce lien : <a href="http://www.culturemania.fr'. $link .'#comment-area"> '. $title . ' sur Culturemania</a>. <BR><BR>A très bientôt !<BR>Vincent, Culturemania.</p></body></html>';
                $headers = 'From: CultureMania redaction@culturemania.fr' . "\r\n" ;
                $headers .='Reply-To: '. $mailto . "\r\n" ;
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: CultureMania <redaction@culturemania.fr>' . "\r\n";

                mail($mailto,$subject,$message,$headers);

				$mysql->close();
			}
		}
	}

?>