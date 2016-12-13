<?php
    session_start();
    if(!empty($_GET) && isset($_GET['logout']))
    {
        session_destroy();
        $_SESSION = array(); 
    }   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Culturemania - Culture Jeux, Livres, Films, Series TV, Musique, Internet...</title>
    <meta name="description" content="Culturemania, Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania"/>
    <meta name="keywords" content="jeux, jeu, video, livre, livres, film, films, serie, series, TV, télé, lieux, musique, album, artiste, concert, culture, mania, evenement, console, ps3, ps4, xbox, cinema, PC, actualité"/>
    <meta property="og:image" content="http://www.culturemania.fr/assets/culturemania.jpg" />
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Culturemania">
    <meta property="og:title" content="Culturemania - Culture Jeux, Livres, Films, Series TV, Musique, Internet...">
    <meta property="og:description" content="Culturemania, Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania">
    <meta name="twitter:site" content="@culturemaniafr">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="/style.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1220px)" href="/style-1200.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1020px)" href="/style-1000.css"/>
    <link rel="stylesheet" media="screen and (max-width: 620px)" href="/style-600.css"/>
    <link rel="alternate" type="application/rss+xml" title="RSS Culturemania" href="/rss.xml" />
</head>


<body id="id-body">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=195778581115";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div class="cm-popup" id="id-popup">
    </div>
    <div class="cm-margin-150"></div>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <div class="cm-main">

    </div>

    <?php
        include 'connect.php';
        setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
        include 'menu.php'; 
        include 'CArticle.php';
        include 'flux_rss.php';
		buildRSS($mysql);
    ?>
    <section class="cm-section">
        <div class="cm-main">
            <div class="cm-glass-main">
                <div class="cm-article">
                    <?php
                        $query = 'SELECT c.IDCHRONIQUE as idchronique, c.INTRODUCTION as intro, c.TITLE as title, c.NBVIEWS as nbview, c.NBLIKES as nblike, c.DATECREATION as datecreation, i.URL as image, a.PSEUDO as authorname, a.IDAUTHOR, t.URL as urltype, st.LIBELLE as libellesubtype, st.URL as urlsubtype, f.LOGO as logo, count(co.IDCOMMENTAIRE) as nbcomment 
                                FROM chronique AS c 
                                LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 11 
                                LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
                                LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR 
                                LEFT JOIN feeling AS f ON c.IDFEELING = f.IDFEELING
                                where c.PUBLISHED = 1 
                                and c.DATECREATION < NOW() 
                                GROUP BY c.IDCHRONIQUE, c.INTRODUCTION, c.TITLE, c.NBVIEWS, c.NBLIKES, c.DATECREATION, i.URL, a.PSEUDO, a.IDAUTHOR, t.URL,st.URL 
                                ORDER BY DATECREATION DESC LIMIT 0, 2';

                        $res = $mysql->query($query);
                        while ($article = $res->fetch_object('CArticle')) 
                           	$article->drawBig();
                        $res->close();
                    ?>
                    <div class="cm-news-75">
                        <div class="cm-padding-10">
                            <?php
                                $query = 'SELECT c.IDCHRONIQUE as idchronique, c.TITLE as title, c.NBVIEWS as nbview, c.NBLIKES as nblike, c.DATECREATION as datecreation, i.URL as  image, a.PSEUDO as authorname, a.IDAUTHOR, t.URL as urltype, st.LIBELLE as libellesubtype, st.URL as urlsubtype, f.LOGO as logo, count(co.IDCOMMENTAIRE) as nbcomment 
                                FROM chronique AS c 
                                LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 11 
                                LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
                                LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR 
                                LEFT JOIN feeling AS f ON c.IDFEELING = f.IDFEELING
                                where c.PUBLISHED = 1 
                                and c.DATECREATION < NOW() 
                                GROUP BY c.IDCHRONIQUE, c.TITLE, c.NBVIEWS, c.NBLIKES, c.DATECREATION, i.URL, a.PSEUDO, a.IDAUTHOR, t.URL, st.URL 
                                ORDER BY DATECREATION DESC LIMIT 2, 12';

                                $res = $mysql->query($query);
                                while ($article = $res->fetch_object('CArticle')) 
                                   $article->drawSmall();
                                $res->close();
                            ?>
                            <BR>
                            <a href="/home"><H2>Voir la suite...</H2></a>
                        </div>
                    </div>
                    <aside>
                        <form method="POST" action="/home">
                            <input type="text" placeholder="titre, artiste, auteur, acteur..." name="s">
                            <input class="cm-input-search" type="submit" value="Rechercher"/>
                        </form>
                        <div class="cm-padding-10">
                        	<H2>Réseaux Sociaux</H2>
                        	<BR>
                			<div class="cm-inline">
                                <a class="twitter-follow-button" href="https://twitter.com/culturemaniafr"></a>
								<BR><BR>
                                <div class="fb-like" data-href="https://www.facebook.com/culturemaniafr/" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    		</div>
    					</div>
                        <div class="cm-padding-10">
                        	
                        	<img src="assets/star.png" alt="star" />
                           	<H2>Le Top 10</H2>
                            <div class="cm-align-left">
                                <BR>
                                <?php
                                    $query = 'SELECT c.IDCHRONIQUE as idchronique,  c.NBLIKES as nblike, c.TITLE as title, c.DATECREATION as datecreation, t.URL as urltype, st.URL as urlsubtype
                                            FROM chronique AS c 
                                            LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                			LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                            where c.PUBLISHED = 1 
                                            and c.DATECREATION < NOW() 
                                            ORDER BY c.NBLIKES DESC LIMIT 10';

                                    $res = $mysql->query($query);
                                    while ($article = $res->fetch_object('CArticle')) 
                                       $article->drawTooltip($article->getnblike() . ' étoile(s)');
                                    $res->close();
                                ?>   
                            </div>
                            
                            <BR>
                            <img src="assets/eye.png" alt="views"/>
                           	<H2>Le Top 10</H2>
                            <div class="cm-align-left">
                                <BR>
                                <?php
                                    $query = 'SELECT c.IDCHRONIQUE as idchronique,  c.NBVIEWS as nbview, c.TITLE as title, c.DATECREATION as datecreation, t.URL as urltype, st.URL as urlsubtype
                                            FROM chronique AS c 
                                            LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                			LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                            where c.PUBLISHED = 1 
                                            and c.DATECREATION < NOW() 
                                            ORDER BY c.NBVIEWS DESC LIMIT 10';

                                    $res = $mysql->query($query);
                                    while ($article = $res->fetch_object('CArticle')) 
                                       $article->drawTooltip($article->getnbview() . ' vue(s)');
                                    $res->close();
                                ?>   
                            </div>
                        </div>
                    </aside>
                    <div class="cm-clear"></div>
                </div>
            </div>  
        </div> 
    </section>

	<BR><BR><BR><BR>
	<section class="cm-section-100pc-blue">
		<div class="cm-center">
		<BR>
    	<H1> Les auteurs </H1>

    	<?php

			$query = "SELECT a.IDAUTHOR, a.PRENOM, a.PSEUDO, IFNULL(a.AVATAR, '/assets/anonymous.png') as AVATAR, a.FACEBOOK, a.TWITTER, count(*) as NBARTICLES
					FROM author a, chronique c 
					WHERE a.IDAUTHOR = c.IDAUTHOR
					AND c.PUBLISHED = 1
					and c.DATECREATION < NOW() 
					group by a.PRENOM, a.PSEUDO
					order by count(*) DESC ";

				
				$res = $mysql->query($query);
				$rank = 1;
				while ($row = $res->fetch_assoc()) 
				{
					$ida = $row['IDAUTHOR'];
					$prenom = $row['PRENOM'];
					$pseudo = $row['PSEUDO'];
					$avatar = $row['AVATAR'];
					$facebook = $row['FACEBOOK'];
					$twitter = $row['TWITTER'];
					$count = $row['NBARTICLES'];

					echo '<div class="cm-author">';
					echo '<h2>'. $rank .'</h2>';
					echo '<div class="cm-rounded-img">';
					echo '<a class="cm-right" href="/author-'.$ida.'"><img src="'. $avatar.'" alt="avatar"/></a>';
					echo '</div>';
					echo '<div class="cm-separator-double-blue"></div>';

					echo '<H3>' . $pseudo .' </H3>';
					if ($count == 1)
						echo '<p> '. $count .' article publié</p><BR>';
					else
						echo '<p> '. $count .' articles publiés</p><BR>';

					
					echo '</div>';
					$rank ++;

				}
				$res->close();	
    	?>
    	</div>
	</section>
     <section class="cm-section-100pc">
        <BR>
        <H1> Participer à Culturemania </H1>
        <div class="cm-separator-double"></div>

        <div class="cm-main">
            <div class="cm-div-3">
                <H2> S'inscrire</H2>
                <a href="/Inscription"><img src="/assets/connect.png" alt="Inscription"/></a>
                <BR><BR>
                <p>Inscrivez-vous et prenez la plume pour publier vous-même des articles sur Culturemania ! On vous demandera le minimum : un pseudonyme, un e-mail valide et un mot de passe savament choisi. Le reste, c'est si uniquement si vous le décidez !</p>
            </div><div class="cm-div-3">
                <H2>Espace rédaction</H2>
                <a href="/Espace-Redaction"><img src="/assets/pencil.png" alt="Redaction"/></a>
                <BR><BR>
                <p>Déjà inscrit ? Alors direction l'espace rédaction de Culturemania pour vous lancer et rédiger vos articles ! Textes, images, vidéo, citations, utilisez toutes les options disponibles pour donner à vos articles ce petit truc qui fait qu'on le lira jusqu'au bout !</p>   
            </div><div class="cm-div-3">
                <H2>Informations</H2>
                <a href="/A-propos"><img src="/assets/information.png" alt="A Propos"/></a>
                <BR><BR>
                <p>Vous voulez en savoir plus sur Culturemania et son mode de fonctionnement ? C'est par ici ! Tout a été fait pour se simplifier la vie au maximum. Nous avons fait le choix de vivre avec les machines alors autant que ce ne soit pas pour se pourrir la vie !</p>
            </div>
        </div>
        <BR>
        <BR>
    </section>

  <div class="cm-margin-150"></div>
    <section class="cm-section">
        <div class="cm-main">
            <div class="cm-glass-main">
                <div class="cm-article">
                    <?php
                    	$query = 'SELECT IDTYPE, LIBELLE, URL FROM typechronique';
                    	$restype = $mysql->query($query);
                    	while ($row = $restype->fetch_assoc()) 
                    	{
                    		$idtype = $row['IDTYPE'];
                    		$libelle = $row['LIBELLE'];
                    		$url = $row['URL'];
                    		echo '<H1>Les derniers articles '. $libelle .'</H1>';
                    		echo '<div class="cm-separator-double"></div>';
                			echo '<div class="cm-padding-10">';

                    		$query = 'SELECT c.IDCHRONIQUE as idchronique, c.TITLE as title, i.URL as image, t.URL as urltype, st.URL as urlsubtype, f.LOGO as logo, c.NBVIEWS as nbview, c.NBLIKES as nblike, count(co.IDCOMMENTAIRE) as nbcomment  
                            FROM chronique AS c 
                            LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
                            JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 11
                            JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE and t.IDTYPE = '.$idtype.'
                            JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                            LEFT JOIN feeling AS f ON c.IDFEELING = f.IDFEELING
                            where c.PUBLISHED = 1 
                            and c.DATECREATION < NOW() 
                            GROUP by c.IDCHRONIQUE, c.TITLE, i.URL, t.URL, st.URL, f.LOGO, c.NBVIEWS, c.NBLIKES
                            ORDER BY c.DATECREATION DESC LIMIT 0, 3';

                            $res = $mysql->query($query);
                            while ($article = $res->fetch_object('CArticle')) 
                               $article->drawSmall();
                            $res->close();

                    		echo '<a class="cm-right-link" href="'.$url.'">Voir la suite...</a>';
                    		echo '</div>';

                    		
                    	}

                    	$restype->close();
                    ?>
				 </div>
			</div>
		</div>
	</section>

   <BR><BR>

    
   
    <section class="cm-section-100pc">
    	<BR>
		<div class="cm-block">
            <H1> Lancez les dés... </H1>
            <img src="assets/dice.png" id="cm-id-dice" alt="Dices"/>
            <BR>
            <H4 class="cm-grey"> et découvrez 5 articles au hasard ! </H4>
        </div>
        <div class="cm-focus" id="cm-id-focus">
            <?php
               $query = 'SELECT c.IDCHRONIQUE as idchronique, c.TITLE as title, i.URL as  image, t.URL as urltype, st.URL as urlsubtype
			            FROM chronique AS c 
			            LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 11 
			            LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
			            LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
			            where c.PUBLISHED = 1 
			            and c.DATECREATION < NOW() 
			            ORDER BY RAND() LIMIT 5';


                $res = $mysql->query($query);
                while ($article = $res->fetch_object('CArticle')) 
                   $article->drawFocus();
                $res->close();
            ?>        
        </div>
    </section> 	


<script>
$(document).ready(function() 
{
    function showpopup()
    {
        $.ajax
        (
            {
                type : "POST",
                url: '/getrandompopup.php',
                success: function(html) 
                {   
                    $("#id-popup").empty();
                    $("#id-popup").append(html);
                },
                error: function(msg)
                {
                    console.log('Erreur de chargement des articles !');
                },
                complete : function(data)
                {
                    $("#id-popup").css({bottom: 0});
                    var number = 10 + Math.floor(Math.random() * 50);
                    setTimeout(hidepopup, number*1000);
                }
            }
        );
    }

    function hidepopup()
    {
        $("#id-popup").css({bottom: -1000});
        setTimeout(showpopup, 1000);
    }

    setTimeout(showpopup, 10000);
    

    $('.cm-close-parent').on("click", function () 
    {
        $(this).parents('div').fadeOut();
    });

    $("#cm-id-dice").click(function() 
    {
        $("body").css("cursor", "progress");
        
        $.ajax
        (
            {
                type : "POST",
                url: 'getrandom.php',
                success: function(html) 
                {   
                    $("#cm-id-focus").empty();
                    $("#cm-id-focus").append(html);
                    $("body").css("cursor", "auto");


                },
                error: function(msg)
                {
                    alert('Erreur de chargement des articles !');
                    $("body").css("cursor", "auto");
                }
            }
        );
        
    });
});
</script>
<?php
	include 'footer.php';
    $mysql->close();
?>
</body>
</html>