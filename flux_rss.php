<?php

function &init_news_rss(&$xml_file)
{
        $root = $xml_file->createElement("rss"); // création de l'élément
        $root->setAttribute("version", "2.0"); // on lui ajoute un attribut
        $root = $xml_file->appendChild($root); // on l'insère dans le nœud parent (ici root qui est "rss")
       
        $channel = $xml_file->createElement("channel");
        $channel = $root->appendChild($channel);
               
        $desc = $xml_file->createElement("description");
        $desc = $channel->appendChild($desc);
        $text_desc = $xml_file->createTextNode("Le site de la Culture ou vous êtse la plume."); 
        $text_desc = $desc->appendChild($text_desc);
       
        $link = $xml_file->createElement("link");
        $link = $channel->appendChild($link);
        $text_link = $xml_file->createTextNode("http://www.culturemania.fr");
        $text_link = $link->appendChild($text_link);
       
        $title = $xml_file->createElement("title");
        $title = $channel->appendChild($title);
        $text_title = $xml_file->createTextNode("Culturemania");
        $text_title = $title->appendChild($text_title);
       
        return $channel;
}
 
function addNode(&$parent, $root, $line)
{
        $item = $parent->createElement("item");
        $item = $root->appendChild($item);
 
		$urlType = str_replace(" ", "", $line['TYPEURL']);
		$urlSousType = str_replace(" ", "", $line['SOUSTYPEURL']); 
		$urlTitre = formatURL(trim($line['TITLE']));
		$URL = 'http://www.culturemania.fr' . $urlType . $urlSousType . "/" .  $urlTitre . '-' . $line['IDCHRONIQUE'] . "";
		
		$titre = $line['TITLE'];
        $title = $parent->createElement("title");
        $title = $item->appendChild($title);
        $text_title = $parent->createTextNode($titre);
        $text_title = $title->appendChild($text_title);

		
        $link = $parent->createElement("link");
        $link = $item->appendChild($link);
        $text_link = $parent->createTextNode($URL);
        $text_link = $link->appendChild($text_link);
       
	   	$intro = $line['INTRODUCTION'];
		$intro = str_replace("\"", "'", $intro);
		
        $desc = $parent->createElement("description");
        $desc = $item->appendChild($desc);
        $text_desc = $parent->createTextNode($intro);
        $text_desc = $desc->appendChild($text_desc);
            
		$pseudo = $line['PSEUDO'];
        $author = $parent->createElement("author");
        $author = $item->appendChild($author);
        $text_author = $parent->createTextNode($pseudo);
        $text_author = $author->appendChild($text_author);
       
		$date = $line['DATECREATION'];
        $pubdate = $parent->createElement("pubDate");
        $pubdate = $item->appendChild($pubdate);
        $text_date = $parent->createTextNode($date);
        $text_date = $pubdate->appendChild($text_date);
       
		$idc = $line['TITLE'];
        $guid = $parent->createElement("guid");
        $guid = $item->appendChild($guid);
        $text_guid = $parent->createTextNode($idc);
        $text_guid = $guid->appendChild($text_guid);
       
        $src = $parent->createElement("source");
        $src = $item->appendChild($src);
        $text_src = $parent->createTextNode("http://www.culturemania.fr");
        $text_src = $src->appendChild($text_src);
}
 
function buildRSS($mysql)
{

        // on récupère les news
        $query = 'SELECT c.IDCHRONIQUE, c.TITLE, c.INTRODUCTION, c.IDTYPE, c.IDSOUSTYPE, c.DATECREATION, t.URL as TYPEURL, t.LIBELLE, st.URL as SOUSTYPEURL, st.LIBELLE as SOUSTYPELIBELLE, a.PSEUDO, i.URL  FROM chronique AS c LEFT JOIN typechronique AS t ON c.IDTYPE = t.IDTYPE LEFT JOIN soustypechronique AS st ON c.IDSOUSTYPE = st.IDSOUSTYPE LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR LEFT JOIN image AS i ON i.IDCHRONIQUE = c.IDCHRONIQUE AND i.IDTYPEIMAGE = 1 where c.PUBLISHED = 1 and c.DATECREATION < NOW() ORDER BY c.DATECREATION DESC LIMIT 0, 15';
        
        $res = $mysql->query($query);

        // on crée le fichier XML
        $xmlFile = new DOMDocument("1.0");

        // on initialise le fichier XML pour le flux RSS
        $channel = init_news_rss($xmlFile);
 
        // on ajoute chaque news au fichier RSS
        while ($row = $res->fetch_assoc()) 
        {
            addNode($xmlFile, $channel, $row);
        }
     	
        // on écrit le fichier
		$xmlFile->save("rss.xml");
}
?>