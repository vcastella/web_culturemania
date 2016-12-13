<?php
	if(!empty($_POST))
	{

		include 'connect.php';
		include 'CArticle.php';
		setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
		
		
		$limit = $_POST['limit'];
		$query = 'SELECT c.IDCHRONIQUE as idchronique, c.TITLE as title, c.NBVIEWS as nbview, c.NBLIKES as nblike, i.URL as image, c.DATECREATION as datecreation, t.URL as urltype, st.LIBELLE as libellesubtype, st.URL as urlsubtype, count(co.IDCOMMENTAIRE) as nbcomment
		FROM chronique AS c 
		LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE 
		LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE 
		LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE and i.IDTYPEIMAGE = 11 
		LEFT JOIN commentaire AS co ON co.IDCHRONIQUE = c.IDCHRONIQUE 
		where c.PUBLISHED = 1 
		and c.DATECREATION < NOW() ';

		if (isset($_POST['idtype']) && $_POST['idtype'] > 0)
			$query = $query . 'AND c.IDTYPE = ' . $_POST['idtype'] . ' ';
		if (isset($_POST['idsubtype']) && $_POST['idsubtype'] > 0)
			$query = $query . ' AND c.IDSOUSTYPE = ' . $_POST['idsubtype'] . ' ';
		if (isset($_POST['idauthor']) && $_POST['idauthor'] > 0)
			$query = $query . ' AND c.IDAUTHOR = ' . $_POST['idauthor'] . ' ';

		
		if (isset($_POST['s']) && !empty($_POST['s']))
			$query = $query . ' AND UPPER(c.TITLE) LIKE \'%' . $_POST['s'] . '%\' OR UPPER(c.TEXT) LIKE \'%' . $_POST['s'] . '%\'';

		$query = $query . 'GROUP BY c.TITLE, c.NBVIEWS, c.NBLIKES, c.IDCHRONIQUE, i.URL, c.DATECREATION ORDER BY c.DATECREATION DESC LIMIT '. $limit.', 9';
	
		$res = $mysql->query($query);
		while ($article = $res->fetch_object('CArticle')) 
       		$article->drawSmall();
    	$res->close();
		$mysql->close();
	}
?>