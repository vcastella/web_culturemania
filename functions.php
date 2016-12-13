<?php	
	
	function formatURL($string) 
	{
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
  		$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
		$string = str_replace($a, $b, $string);

		// Mettez ici les caractères spéciaux qui seraient susceptibles d'apparaître dans les titres. La liste ci-dessous est indicative.
		$speciaux = array("?","!","@","#","%","&amp;","*","(",")","[","]","=","+",";",":",".","_",",");
		$string = str_replace($speciaux, "", $string); // Les caractères spéciaux dont les espaces, sont remplacés par un tiret.

		$speciaux = array(" ","'","’");
		$string = str_replace($speciaux, "-", $string); // Les caractères spéciaux dont les espaces, sont remplacés par un tiret.

		$string = str_replace("--", "-", $string); // Les caractères spéciaux dont les espaces, sont remplacés par un tiret.

		$string = strtolower(strip_tags($string));

		return $string;
	}


	function checkImages()
	// Retourne une chaine = "OK" si tout est respecté 
	{
		$ErrorMessages = array();
		
		$maxwidth    = 2000;
		$maxheight   = 2000;
		$goodExtends = array( 'jpg' , 'jpeg', 'png' );
		
		if (isset($_FILES['image']))
		{
			$arrayImg = $_FILES['image'];
			$count = count($arrayImg['name']);

			$maxsize = 4000000;
			for ($i=0; $i< $count; $i++)
			{
	    		$size = $arrayImg['size'][$i];
	    		$filename = $arrayImg['name'][$i];
	    		$tmp_filename = $arrayImg['tmp_name'][$i];
	    		
				if ($size > $maxsize) 
					$ErrorMessages[] = 'Le fichier '. $filename .' est trop gros. Il doit faire un poids < 2 Mo.';

				$extension = strtolower(substr(strrchr($filename, '.'),1));
				if ( !in_array($extension,$goodExtends)) 
					$ErrorMessages[] = 'Le fichier '. $filename .' comporte une extension incorrecte. Les extensions d\'image possibles sont : jpg, jpeg, png.';

				$image_sizes = getimagesize($tmp_filename);
				if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) 
					$ErrorMessages[] = 'Le fichier '. $filename .' comporte trop de pixels. La taille maximale pour une image est 2000px * 2000px.';
			}	
		}
		

		if ($_FILES['bandeauFrame']['name'] == '') 
			$ErrorMessages[] = "Veuillez sélectionner une couverture principale pour votre article";
		else
		{
			$tmp_filename = $_FILES['bandeauFrame']['tmp_name'];
			$image_size = getimagesize($tmp_filename);
				if ($image_size[0] < 1200) 
					$ErrorMessages[] = 'Le fichier image de couverture doit faire au moins 1200px de large.';

		}


		return $ErrorMessages;
	} 

	function resize_image($file, $ratio) 
	{
	    list($width, $height) = getimagesize($file);

	    $src = imagecreatefromjpeg($file);
	    $dst = imagecreatetruecolor($width * $ratio, $height * $ratio);
	    
	    $res = imagecopyresampled($dst, $src, 0, 0, 0, 0, $width * $ratio, $height * $ratio, $width, $height);

	    return $dst;
	}
	

	function uploadImage($tmp_filename, $dir) 
	{
		if (!is_dir($dir))
			mkdir($dir, 0777, true);
	 
		//Créer un identifiant difficile à deviner ahaha
		$nom = md5(uniqid(rand(), true));
		$nom = $nom . '.jpg';

		$resultat = move_uploaded_file($tmp_filename,"$dir$nom");
		if ($resultat)
		{
			$filename = '/' . $dir . $nom;			
			return $filename;
		}
		else
			return '';
	} 

	function insertImage($mysql, $idChronique, $url, $typeImage)
	{
		$request = "INSERT INTO image (IDCHRONIQUE, URL, IDTYPEIMAGE) VALUES ($idChronique, '$url', $typeImage)";
		$res = $mysql->query($request);
		
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}

	}
?>

