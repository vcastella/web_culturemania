<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="/lib/imagelightbox.min.js"></script>
    <script src="/script.js"></script>

    <link rel="stylesheet" href="/lib/imagelightbox.css">
    <meta name="description" content="Culturemania, Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania"/>
    <meta name="keywords" content="jeux, jeu, video, livre, livres, film, films, serie, series, TV, télé, lieux, musique, album, artiste, concert, culture, mania, evenement, console, ps3, ps4, xbox, cinema, PC, actualité"/>

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Culturemania">
    
    <meta property="og:description" content="Culturemania, Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania">
    <meta name="twitter:site" content="@culturemaniafr">


    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="/style.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1220px)" href="/style-1200.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1020px)" href="/style-1000.css"/>
    <link rel="stylesheet" media="screen and (max-width: 620px)" href="/style-600.css"/>
<?php
    session_start();
    include 'connect.php';
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
    include 'CArticle.php';
    $idChronique = 0;
    if(!empty($_GET))
    {
        if (isset($_GET['idChronique']))
            $idChronique = $_GET['idChronique'];
    }
    
    if(!isset($_SESSION['visitedpages']))
    {
        $arrayIdc = array($idChronique);
        
        $_SESSION['visitedpages'] = $arrayIdc;
        $queryUpdate = 'UPDATE chronique c SET c.NBVIEWS=c.NBVIEWS+1 WHERE c.IDCHRONIQUE = ' . $idChronique;
        $mysql->query($queryUpdate);
    }
    else if (!in_array($idChronique, $_SESSION['visitedpages']))
    {
        array_push($_SESSION['visitedpages'], $idChronique);
        $queryUpdate = 'UPDATE chronique c SET c.NBVIEWS=c.NBVIEWS+1 WHERE c.IDCHRONIQUE = ' . $idChronique;
        $mysql->query($queryUpdate);   
    }

    $query = 'SELECT c.IDCHRONIQUE as idchronique, c.INTRODUCTION as intro, c.IDTYPE as idtype, c.IDSOUSTYPE as idsoustype, c.WEB as website, c.TEXT as texte, c.TITLE as title, c.NBVIEWS as nbview, c.NBLIKES as nblike, c.DATECREATION as datecreation, i.URL as  image, a.PSEUDO as authorname, a.IDAUTHOR as idauthor, t.URL as urltype, st.URL as urlsubtype, st.LIBELLE as libellesubtype, f.LOGO as logo, count(co.IDCOMMENTAIRE) as nbcomment 
            FROM chronique AS c 
            LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 1 
            LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
            LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
            LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
            LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR 
            LEFT JOIN feeling AS f ON c.IDFEELING = f.IDFEELING
            where c.IDCHRONIQUE = ' . $idChronique .' ';
    $res = $mysql->query($query);
    $mainArticle = $res->fetch_object('CArticle');
    $res->close();
    $ogimage = 'http://www.culturemania.fr' . $mainArticle->getimage();
    echo '<title> '. $mainArticle->getmetatitle() .' - culturemania.fr</title> ';
    echo '<meta property="og:image" content="'. $ogimage .'"/>';
    echo '<meta property="og:title" content="'. $mainArticle->getmetatitle() .' ">';
?>
</head>

<body id="topanchor">
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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

    
    <?php 
        include 'menu.php';  
    ?>

    <section class="cm-section">
        <div class="cm-main">
            <div class="cm-glass-main">
                <div class="cm-article">
                
                    <?php 
                        $mainArticle->drawArticle($mysql);  
                    ?>

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
                            <div class="cm-align-left">
                            <H2>Les derniers articles :</H2>
                            <BR>
                            <?php
                                $query = 'SELECT c.IDCHRONIQUE as idchronique,  c.TITLE as title, c.DATECREATION as datecreation, t.URL as urltype, st.URL as urlsubtype
                                        FROM chronique AS c 
                                        LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                        LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                        where c.PUBLISHED = 1 
                                        and c.DATECREATION < NOW() 
                                        and c.IDCHRONIQUE != '.$idChronique.'
                                        ORDER BY c.DATECREATION DESC LIMIT 10';

                                $res = $mysql->query($query);
                                while ($article = $res->fetch_object('CArticle')) 
                                   $article->drawAsideTitle();
                                $res->close();
                            ?>   
                            </div>
                        </div>
                            
                        <div class="cm-padding-10">
                            <div class="cm-align-left">
                            <H2>10 articles au hasard :</H2>
                            <BR>
                            <?php
                                $query = 'SELECT c.IDCHRONIQUE as idchronique,  c.TITLE as title, c.DATECREATION as datecreation, t.URL as urltype, st.URL as urlsubtype
                                        FROM chronique AS c 
                                        LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                        LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                        where c.PUBLISHED = 1 
                                        and c.DATECREATION < NOW() 
                                        and c.IDCHRONIQUE != '.$idChronique.'
                                        ORDER BY RAND() LIMIT 10';

                                $res = $mysql->query($query);
                                while ($article = $res->fetch_object('CArticle')) 
                                   $article->drawAsideTitle();
                                $res->close();
                            ?>   
                            </div>
                        </div>
                        <div class="cm-padding-10">
                            <a class="twitter-timeline" href="https://twitter.com/culturemaniafr" data-widget-id="458611543425314816">Tweets de @culturemaniafr</a>
                        </div>
                	</aside>
             	    <div class="cm-clear"></div>
                    <BR><BR>
                    <div class="cm-100pc">
                        <div class="cm-separator-double"></div>

                        <H2> Vous aimerez peut-être aussi : </H2>

                    
                    <?php
                        $query = 'SELECT c.IDCHRONIQUE as idchronique, c.INTRODUCTION as intro, c.TITLE as title, c.NBVIEWS, c.NBLIKES, c.DATECREATION, i.URL as  image, a.PSEUDO, a.IDAUTHOR, t.URL as urltype, st.URL as urlsubtype, count(co.IDCOMMENTAIRE) NBCOMMENTS 
                                FROM chronique AS c 
                                LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 1 
                                LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
                                LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR 
                                where c.PUBLISHED = 1 
                                AND c.IDSOUSTYPE = '. $mainArticle->getIdSousType() .'
                                and c.IDCHRONIQUE != '.$idChronique.'
                                GROUP BY c.IDCHRONIQUE, c.INTRODUCTION, c.TITLE, c.NBVIEWS, c.NBLIKES, c.DATECREATION, i.URL, a.PSEUDO, a.IDAUTHOR, t.URL,st.URL 
                                ORDER BY RAND() LIMIT 3';

                        $res = $mysql->query($query);
                        while ($article = $res->fetch_object('CArticle')) 
                           $article->drawRecent();
                        $res->close();

                        echo '<a class="cm-right-link" href="'. $mainArticle->geturltype() . $mainArticle->geturlsubtype().'">Consulter les articles du même genre...</a><BR>';


                    ?>
                    </div>  
                </div>    
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


<?php
    include 'footer.php';
    $mysql->close();
?>

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

});
</script>
</body>
</html>