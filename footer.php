
<footer>
	
  <div class="cm-block-3">
  <H1> Plan du site </H1>
  <?php
	    $query = 'SELECT t.LIBELLE as TYPE, t.IDTYPE, t.URL as URL, st.LIBELLE SOUSTYPE, st.IDSOUSTYPE, st.URL as STURL FROM soustypechronique st, typechronique t WHERE st.IDTYPE = t.IDTYPE ORDER BY t.IDTYPE';
	    $res = $mysql->query($query);

	    $idlasttype = -1;
	    echo '<ul>';
	    echo '<li class="cm-item-100pc"><a href="/">Général</a><ul> <li><a href="/Espace-Redaction">Espace Rédaction</a></li><li><a href="/Inscription">Inscription</a></li><li><a href="/Contact">Contact</a></li><li><a href="/A-propos">A Propos</a></li><li><a href="/">Accueil</a></li></ul></li>';
	    while ($row = $res->fetch_assoc()) 
		{
			$idt = $row['IDTYPE'];
			$type = $row['TYPE'];
			$idsoustype = $row['IDSOUSTYPE'];
			$soustype = $row['SOUSTYPE'];
			$urltype   = $row['URL'];
			$urlsoustype   = $row['STURL'];
			if($idt != $idlasttype)
			{
				if ($idlasttype != -1)
					echo '</ul></li>';
				echo '<li class="cm-item-100pc"><a href="'.$urltype.'">'.$type.'</a><ul>';
				
			}
			$idlasttype = $idt;
			echo '<li><a href="'. $urltype. $urlsoustype.'">'. $soustype .'</a></li>';
		}
		echo '</ul></li>';
		

		echo '</ul>';
	    $res->close();
	  ?>

  </div><div class="cm-block-3">
  <H1>Participer</H1>
 
  <H3>Devenez redacteur !</H3>
  <H4><a href="/Inscription">S'nscrire sur Culturemania</a></H4>
  <H4><a href="/Espace-Redaction">Espace rédaction</a></H4>
  <H4><a href="/A-propos">Informations</a></H4>

  <BR>
  <H3>Nous contacter</H3>	
  <H4><strong>Inscription : </strong> inscription ( a ) culturemania ( point ) fr</H4>
  <H4><strong>Rédaction :</strong> redaction ( a ) culturemania ( point ) fr</H4>
  <H4><strong>Informations générales : </strong> contact ( a ) culturemania ( point ) fr</H4>


  </div><div class="cm-block-3">
  <H1>Réseaux sociaux</H1>
  <div class="divcenter">
  	<a href="https://www.facebook.com/culturemaniafr/"><img src="/assets/facebookBig.png" alt="facebook" /></a>
  	<a href="https://twitter.com/culturemaniafr"><img src="/assets/twitterBig.png" alt="twitter" /></a>
  	<a href="https://plus.google.com/u/0/b/110630698917025320545/110630698917025320545/posts"><img src="/assets/googleplusBig.png" alt="Google plus" /></a>
  </div>
  <BR>
  </div>

  <div class="cm-separator"></div>
  	<div class="cm-main">
		<div class="cm-grey">
	Ceci n'est pas une première. Culturemania a plus de deux ans. Sa première version n'a plus grand chose à voir avec celle que vous avez sous les yeux. En un sens, tant mieux. 
	Mais voilà que chaque année me prend l'envie  de modifier un élément du site. Quelques heures passent et me voilà en train de tout recoder. Ce scénario s'est déjà déroulé en avril 2015 lors du 1er anniversaire de Culturemania.
	Alors, en mai 2016, ça recommence, comme une irrésistible boucle temporelle. A la base, je voulais simplement refaire le menu. La suite, vous la devinez.<BR>
	
	Je ne suis pas un développeur web mais un développeur BackOffice (C++, C#, Python, SQL, etc). Mais lorsque les nuits sont longues et que la lune brille au loin, les quatre amis PHP, HTML5, CSS3, Javascript viennent frapper à ma porte.
	C'est alors que la partie commence. Et mine de rien, c'est pas mal de boulot car je prend le parti de tout faire moi-même. Pas de template ou autre escroquerie !
	<BR>
	CultureMania est un site sur la culture au sens large, où chacun pourra partager et échanger sur les quelques univers proposés. Ce site n'a pas de but commercial, vous n'y trouverez donc ni pub, ni inscription payante.
	Le but est le partage de la culture, du savoir qui sont les seules choses qui grandissent à chaque fois qu'on les partage. J'aime écrire à ma façon et j'aime croire qu'elle est différente du ton mielleux, généralisé et désespérant que l'on trouve un peu partout. 
	<BR>
	J'espère que vous passerez un bon moment ici et que vous découvrirez bien des choses. De CultureMania à la librairie ou au magasin de jeux, il n'y a qu'un pas !
	<BR><BR>
V.
		</div>
	</div>
</footer>