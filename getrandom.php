<?php
	include 'connect.php';
	include 'CArticle.php';
	setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
	
	
  	$query = 'SELECT c.IDCHRONIQUE as idchronique, c.TITLE as title, i.URL as image, t.URL as urltype, st.URL as urlsubtype
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

	$mysql->close();
?>