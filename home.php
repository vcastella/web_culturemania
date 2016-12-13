<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Culturemania - Culture Jeux, Livres, Films, Series TV, Musique, Internet...</title>

    <meta name="description" content="Culturemania, Site de la culture autour des jeux video, des livres et BD, des films et des séries TV, des lieux culturels, de la musique et des sites internet. Culturemania"/>
    <meta name="keywords" content="jeux, jeu, video, livre, livres, film, films, serie, series, TV, télé, lieux, musique, album, artiste, concert, culture, mania, evenement, console, ps3, ps4, xbox, cinema, PC, actualité"/>

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
    
</head>
<body id="topanchor">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=195778581115";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
                    <div class="cm-news-75">
                        <div class="cm-padding-10" id="posts">
                        <?php
                            $idtype = 0;
                            $idsubtype = 0;
                            $search = "";
                            $ida = 0;
                            
                            if(!empty($_GET))
                            {
                                if (isset($_GET['type']))
                                    $idtype = $_GET['type'];
                                if (isset($_GET['soustype']))
                                    $idsubtype = $_GET['soustype']; 
                                if (isset($_GET['author']))
                                    $ida = $_GET['author'];
                            }

                            if(!empty($_POST))
                            {
                                if (isset($_POST['s']))
                                {
                                    $search = strip_tags($mysql->real_escape_string($_POST['s']));
                                    $search = strtoupper($search);
                                    $search = strtr($search, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ');
                                }   
                            }

                            

                            $pagetitle = "Les derniers articles";
                            if ($idsubtype > 0)
                            {
                                $query = "SELECT t.LIBELLE as LIBELLE FROM soustypechronique t where IDSOUSTYPE = " . $idsubtype;
                                $res = $mysql->query($query);
                                $row = $res->fetch_row();
                                $res->close();
                                $pagetitle = 'Les derniers articles ' . $row[0];
                            }
                            else if ($idtype > 0)
                            {
                                $query = "SELECT t.LIBELLE as LIBELLE FROM typechronique t where IDTYPE = " . $idtype;
                                $res = $mysql->query($query);
                                $row = $res->fetch_row();
                                $res->close();
                                $pagetitle = 'Les derniers articles ' . $row[0];
                            }
                            else if (strlen($search) > 0)
                            {
                                $pagetitle = 'Les résultats de votre recherche pour "' . $search . '"';
                            }
                            else if ($ida > 0)
                            {
                                $query = "SELECT a.PSEUDO  FROM author a where IDAUTHOR = " . $ida;
                                $res = $mysql->query($query);
                                $row = $res->fetch_row();
                                $res->close();
                                $pagetitle = 'Tous les articles rédigés par ' . $row[0] . '';
                            }

                        
                            $query = 'SELECT c.IDCHRONIQUE as idchronique, c.TITLE as title, c.INTRODUCTION as intro, c.NBVIEWS as nbview, c.NBLIKES as nblike, i.URL as image, c.DATECREATION as datecreation, t.URL as urltype, st.LIBELLE as libellesubtype, st.URL as urlsubtype, a.PSEUDO, a.IDAUTHOR, count(co.IDCOMMENTAIRE) as nbcomment
                            FROM chronique AS c 
                            LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 11 
                            LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                            LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                            LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
                            LEFT JOIN author AS a ON a.IDAUTHOR = c.IDAUTHOR
                            where c.PUBLISHED = 1 and c.DATECREATION < NOW() ';
                            

                            

                            if ($idtype > 0)
                                $query = $query . ' AND c.IDTYPE = ' . $idtype;
                            if ($idsubtype > 0)
                                $query = $query . ' AND c.IDSOUSTYPE = ' . $idsubtype;
                            if ($ida > 0)
                                $query = $query . ' AND c.IDAUTHOR = ' . $ida;  
                            if (strlen($search) > 0)
                                $query = $query . ' AND (UPPER(c.TITLE) LIKE \'%' . $search . '%\' OR UPPER(c.TEXT) LIKE \'%' . $search . '%\')';

                            echo '<BR><H1> '. $pagetitle .'</H1>';
                            echo '<div class="cm-separator-double"></div><BR>';


                            $query = $query . ' GROUP BY c.IDCHRONIQUE, c.TITLE, c.INTRODUCTION, c.NBVIEWS, c.NBLIKES, i.URL, c.DATECREATION, a.PSEUDO, a.IDAUTHOR ORDER BY c.DATECREATION DESC LIMIT 0,9';

                            $res = $mysql->query($query);
                            $count = 0;
                            while ($article = $res->fetch_object('CArticle')) 
                            {
                               $article->drawSmall();
                               $count ++;
                            }
                            $res->close();

                            if ($count == 9)
                                echo '<H2 id="showmore">Voir la suite...</H2>';
                        ?>

                            
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
                            <H2>Articles en vrac :</H2>
                            <BR>
                            <?php
                                $query = 'SELECT c.IDCHRONIQUE as idchronique,  c.TITLE as title, c.DATECREATION as datecreation, t.URL as urltype, st.URL as urlsubtype
                                        FROM chronique AS c 
                                        LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
                                        LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
                                        where c.PUBLISHED = 1 
                                        and c.DATECREATION < NOW() 
                                        ORDER BY RAND() DESC LIMIT 10';

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
                </article>    
            </div>  
        </div>  
        <BR>
    </section>
    <BR>

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
$(document).ready(function() 
{
    var win = $(window);
    var limitsearch = 9;
    var canload = false;
    <?php 
        echo 'var idt =' .$idtype. ';';
        echo 'var idst =' .$idsubtype. ';';
        echo 'var ida =' .$ida. ';';
        echo 'var vsearch ="' .$search. '";';
    ?>


    // Each time the user scrolls
    $("#showmore").click(function() 
    {
        $("body").css("cursor", "progress");
        
        $.ajax
        (
            {
                type : "POST",
                url: '/getarticle.php',
                data: { idtype : idt, idsubtype : idst, idauthor : ida, s : vsearch, limit : limitsearch },
                success: function(html) 
                {   
                    $("#showmore").before(html);
                    limitsearch += 9;
                    var numItems = $(html).find('h3').length;
                    if (numItems < 9)
                        $("#showmore").remove();
                    $("body").css("cursor", "auto");

                },
                error: function(msg, status)
                {
                    console.log(msg);
                    console.log(status);
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