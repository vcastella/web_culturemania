

<?php
	include 'CComment.php';
    include 'functions.php';

	class CArticle extends stdClass
	{
		private $idchronique = null;
		private $title = null;
		private $image  = null;
		private $intro  = null;
		private $texte = null;
        private $website = null;
		private $nblike = null;
		private $nbview = null;
		private $nbcomment = null;
		private $idtype = null;
		private $idsoustype = null;
		private $idauthor = null;
		private $authorname = null;
		private $datecreation = null;
        private $logo = null;
        private $urltype = null;
        private $urlsubtype = null;
        private $libellesubtype = null;
		
        public function getlink()
        {
            $suburl = formatURL(trim($this->title));
            $link = 'http://www.culturemania.fr' . $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;
            return $link;
        }

        public function gettitle()
        {
            return $this->title;
        }

        public function getwebsite()
        {
            return $this->website;
        }

		public function getIdSousType()
		{
			return $this->idsoustype;
		}

        public function getnblike()
        {
            return $this->nblike;
        }

        public function getnbview()
        {
            return $this->nbview;
        }

        public function getimage()
        {
            return $this->image;
        }

        public function geturltype()
        {
            return $this->urltype;
        }

        public function geturlsubtype()
        {
            return $this->urlsubtype;
        }

        public function getmetatitle()
        {
            return $this->libellesubtype . " : " .$this->title;
        }

		public function drawBig()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;
            $time = strtotime($this->datecreation);
            $date = strftime('%d %B', $time);

			echo'<div class="cm-news-main">';

                
                    echo '<div class="cm-frame-rectangle">';

                        echo '<div class="cm-crop">';
                        	echo '<a href="'.$link.'">';
                            	echo '<img class="cm-img-cover" src="'. $this->image .'" alt="cover">';
                            echo '</a>';
                            if ($this->logo != null)
                                echo '<img class="cm-img-logo" src="'. $this->logo .'" alt="logo"/>';
                        	echo '<div class="cm-info-frame">';
                        		echo '<H2>' . $this->libellesubtype .'</H2>';
                        		echo '<H1> ' . $this->title .'</H1>';
                        	echo '</div>';
                        echo '</div>';
                    echo '</div>';
                
                
		        echo '<div class="cm-inline">';
	                echo '<div class="cm-article-infos">';
	                echo '<img src="/assets/date.png" alt="date" /><span class="cm-article-info-span">'. $date .'</span>';
	                echo '<img src="/assets/eye.png" alt="views" /><span class="cm-article-info-span">'. $this->nbview .'</span>';
	                echo '<img src="/assets/comment.png" alt="comments" /><span class="cm-article-info-span"><a href="'.$link.'#comment-area">'. $this->nbcomment .'</a></span>';
	                echo '<img src="/assets/star.png" alt="likes" /><span class="cm-article-info-span">'. $this->nblike .'</span>';
	                echo '</div>';
    	        echo '</div>';
    	        


                echo '<div class="cm-padding-10">';
    			echo '<p>'. $this->intro .'</p>';
                echo '</div>';
            echo '</div>';
		}

		public function drawSmall()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

			echo '<div class="cm-news-2">';
            echo '<a href="'.$link.'">';
            echo '<div class="cm-frame-rectangle"><div class="cm-crop"><img class="cm-img-cover" src="'. $this->image .'" alt="cover">';
            if ($this->logo != null)
                echo '<img class="cm-img-logo" src="'. $this->logo .'" alt="logo"/>';
            echo '</div></div></a>';
            
            $time = strtotime($this->datecreation);
            $date = strftime('%d-%B', $time);
            echo '<H4>' . $this->libellesubtype .'</H4>';
	    		echo '<H3> ' . $this->title .'</H3>';

            /*
            echo '<div class="cm-separator-double"></div>';
            echo '<div class="cm-inline">';
                echo '<div class="cm-article-infos">';
                echo '<img src="/assets/date.png" alt="date" /><span class="cm-article-info-span">'. $date .'</span>';
                echo '<img src="/assets/eye.png" alt="views" /><span class="cm-article-info-span">'. $this->nbview .'</span>';
                echo '<img src="/assets/comment.png" alt="comments" /><span class="cm-article-info-span"><a href="'.$link.'#comment-area">'. $this->nbcomment .'</a></span>';
                echo '<img src="/assets/star.png" alt="likes" /><span class="cm-article-info-span">'. $this->nblike .'</span>';
                echo '</div>';
            echo '</div>';
            */
            echo '</div>';
		}

		public function drawTitle()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;
			echo '<a href="'. $link .'"><H4>'. $this->title .'</H4></a>';
		}

        public function drawPopup()
        {
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;
            echo '<div class="cm-padding-10">';
            echo '<a href="'. $link .'"><img class="" src="'.$this->image.'" alt="cover">';
            echo '<h3>'.$this->title.'</h3></a>';
            echo '</div>';
        }

		public function drawFocus()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;
            echo '<div class="cm-news-5">';
			echo '<a href="'. $link .'">';
			echo '<h3>'.$this->title.'</h3>';
            echo '</a>';
            echo '<a href="'. $link .'"><div class="cm-crop"><img class="cm-img-cover" src="'.$this->image.'" alt="cover"></div></a>';
            echo '</div>';
		}

		public function drawLastYear()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

			echo '<a href="'. $link .'"><img src="'. $this->image .'" alt="cover"></a>';
        	echo '<BR>';
        	echo '<a href="'. $link .'"><H2>'. $this->title .'</H2></a>';
        	echo '<p>'. $this->intro .'</p>';
		}

		public function drawRanked($rank)
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

			echo '<div class="cm-news-2">';
			echo '<H1>'.$rank.'</H1>';
            echo '<a href="'. $link .'"><div class="cm-frame-rectangle"><div class="cm-crop"><img class="cm-img-cover" src="'.$this->image.'" alt="cover"></div></div></a>';
            echo '<BR>';
            echo '<a href="'. $link .'"><H3>'.$this->title.'</H3></a>';
            echo '<p>'. $this->intro.'</p>';
            echo '</div>';
		}

		public function drawRecent()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

			echo '<div class="cm-news-3">';
            echo '<a href="'. $link .'">';
            echo '<div class="cm-frame-rectangle"><div class="cm-crop"><img class="cm-img-cover" src="'. $this->image .'" alt="cover">';
            echo '</div></div></a>';
            echo '<a href="'. $link .'"><H3>'.$this->title.'</H3></a>';
            echo '<p>'. $this->intro.'</p>';
            echo '</div>';
		}

        public function drawTiny()
        {
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

            echo '<div class="cm-news-5">';
            echo '<a href="'. $link .'">';
            echo '<div class="cm-frame-rectangle"><div class="cm-crop"><img class="cm-img-cover" src="'. $this->image .'" alt="cover">';
            echo '</div></div></a>';
            echo '<BR>';
            echo '<a href="'. $link .'"><H3>'.$this->title.'</H3></a>';

            echo '<div class="cm-padding-10">';
            echo '<p>'. $this->intro.'</p>';
            echo '</div>';
            echo '</div>';
        }

		public function drawAside()
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

			echo '<div class="cm-article-aside">';
            echo '<a href="'. $link .'"><H3>'.$this->title.'</H3></a>';
            echo '<a href="'. $link .'"><img src="'.$this->image.'" alt="cover"></a>';
            echo '</div>';
		}

        public function drawAsideTitle()
        {
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

            $time = strtotime($this->datecreation);
            $date = strftime('%d-%m', $time);
            echo '<div class="cm-inline">';
            echo '<span class="cm-small-date">'.$date. '</span> <a href="'. $link .'"><H3>'. $this->title .'</H3></a>';
            echo '</div>';
        }


        public function drawTooltip($tooltiptext)
        {
            $time = strtotime($this->datecreation);
            $date = strftime('%d-%m', $time);

            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;


            echo '<div class="cm-inline">';
            echo '<span class="cm-small-date">'.$date. '</span> <a class="tooltips" href="'. $link .'"><H3>'. $this->title .'</H3><span>'. $tooltiptext .' </span></a>';
            echo '</div>';
        }

		public function drawArticle($mysql)
		{
            $suburl = formatURL(trim($this->title));
            $link = $this->urltype . $this->urlsubtype . "/" .  $suburl . '-' . $this->idchronique;

			echo'<div class="cm-item-100pc">';
                echo '<img src="'. $this->image .'" alt="cover" />';
                if ($this->logo != null)
                    echo '<img class="cm-img-logo" src="'. $this->logo .'" alt="logo"/>';
            
                echo '<div class="cm-article-title">';
                    echo '<H1>'.$this->title.'</H1>';
                    
            
                    $time = strtotime($this->datecreation);
                    $date = strftime('%A %d %B %Y', $time) . ' à ' . strftime('%H:%M', $time);
                    echo '<div class="cm-inline">Article écrit par <a href="/author-'.$this->idauthor.' ">' . $this->authorname .'</a> le '. $date .'</div>';
            
                    echo '<div id="divstars" class="cm-article-star">';
                    for ($star=0;$star<$this->nblike; $star++)
            	       echo '<img src="/assets/star.png" alt="likes"/>';
                    echo '</div>';

                    if ($this->nblike < 2)
                    	echo '<span class="cm-font-1-3" id="likecount">'.$this->nblike.'</span> <span> personne a aimé</span>';
                    else
                    	echo '<span class="cm-font-1-3" id="likecount">'.$this->nblike.'</span> <span> personne(s) ont aimé</span>';
            

                    echo '<a onclick="addlike('.$this->idchronique.')"><img id="likestar" src="/assets/starLike.png" alt="Add Like"/></a>';

                    echo '<div class="cm-separator-double"></div>';
                    echo '<div class="cm-article-infos">';
                        echo '<img src="/assets/eye.png" alt="views" /><span class="cm-article-info-span">'. $this->nbview .' vue(s)</span>';
                        echo '<img src="/assets/comment.png" alt="comments"/><span class="cm-article-info-span"><a href="'. $link .'#comment-area">'. $this->nbcomment .' commentaire(s)</a></span>';
                        if ($this->website != null)
                            echo '<a class="cm-blue-link" href="' . $this->website. '">' . $this->website. '</a>';
        			echo '</div>';
                    echo '<div class="cm-separator-double"></div>';
                    echo '<div class="fb-like" data-href="http://www.culturemania.fr'. $link .'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>';
                    echo '<div class="cm-center">';
                        echo '<BR><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=#Culturemania%20:%20'. $this->title .'" >Tweet</a>';
                    echo '</div>';
                echo '</div>';

            echo '</div>';

            echo '<article class="cm-news-75">';
            
                echo '<div class="cm-intro">'. $this->intro.'</div>';
                echo '<div class="cm-separator-double"></div><BR><BR>';


                $keys   = array("[P]", "[/P]", "[-]", "[--]", "[B]", "[/B]", "[C]", "[/C]", "[I]", "[/I]", "[T]", "[/T]", "[F]", "[/F]", "[URL=", "]]", "[/URL]", "[R]", "[PC]", "[/PC]", "[FA]", "[/FA]", "[VIDEO]", "[/VIDEO]", "[LEFT]", "[/LEFT]", "[RIGHT]", "[/RIGHT]", "[CENTER]", "[/CENTER]", "[CENTERSMALL]", "[/CENTERSMALL]", "[H4]", "[/H4]", "[CL]");
                $values = array("<p>", "</p>",  "<div class=\"separator\"></div>", "<p class=\"pseparator\"></p>", "<strong>", "</strong>", "<blockquote>", "</blockquote>", "<span class=\"spanitalic\">", "</span>", "<H2>", "</H2>", "<div class=\"infobox-container\"><div class=\"infobox\">", "</div></div>", "<a class=\"artlink\" target=\"blank\" href=", ">", "</a>", "<BR>","<p class=\"pclear\">", "</p>", "<div class=\"ficheaudio\">", "</div>", "<div class=\"cm-image-container\"><div class=\"cm-video-wrapper\">", "</div></div>", "<div class=\"picturecenter\">", "</div>", "<div class=\"picturecenter\">", "</div>", "<div class=\"picturecenter\">", "</div>", "<div class=\"cm-width-50\">", "</div>", "<h4>", "</h4>", "");
                $texte = str_replace($keys, $values, $this->texte);


                $query_image = 'SELECT URL, IDTYPEIMAGE FROM image WHERE IDTYPEIMAGE in (2,3,4) AND IDCHRONIQUE =' . $this->idchronique;
                $res = $mysql->query($query_image);

    			$startAt = 0;
    			$countimage = 0;
    			while ($line = $res->fetch_object()) 
    			{
    				// On recherche les tag [IMG]
    				$pos = strpos($texte, '[IMG]', $startAt);
    				if ($pos !== false)
    				{

    					$replaceString = '<div class="cm-image-container"><a href="'. $line->URL.'" target="_blank" data-imagelightbox="b" title="'.$this->title.'"><img src="'. $line->URL .'" alt="preview"></a></div>';
    					$countimage ++;
    					$texte = substr_replace($texte, $replaceString, $pos, strlen('[IMG]'));
    					$startAt = $pos + 1;
    				}
    			}
    			$res->close();


			    echo '<div class="cm-article-texte">';
                    echo $texte;
                echo '</div>';
            
                echo '<div class="cm-signature">';
                    echo '<div class="cm-padding-10">';
                        $time = strtotime($this->datecreation);
                        $date = strftime('%A %d %B %Y', $time) . ' à ' . strftime('%H:%M', $time);
                        echo '<div class="cm-inline">Article écrit par <a href="/author-'.$this->idauthor.' ">' . $this->authorname .'</a> le '. $date .'</div>';
                    echo '</div>';
                echo '</div>';
            

                echo '<div id="comment-area" class="cm-comment-area">';
                    echo '<div class="cm-padding-10">';
                        echo '<H1>Commentaires </H1>';
                        echo '<div class="cm-separator-double"></div>';


                        $query = 'SELECT c.DATECREATION as datecreation, IFNULL(a.PSEUDO, c.ANONYMOUSPSEUDO) as authorname, c.TEXTE as texte FROM commentaire as c LEFT JOIN author AS a ON c.IDAUTHOR = a.IDAUTHOR WHERE IDCHRONIQUE =' . $this->idchronique .' ORDER BY c.DATECREATION';

                        $res = $mysql->query($query);
                        echo '<div id="commentboxid">';
                            while ($item = $res->fetch_object('CComment')) 
                            {
                               $item->draw();
                               echo '<div class="cm-separator-double"></div>';
                            }
                            $res->close();
                        echo '</div>';


                        echo '<div class="cm-formulaire">';
                            echo '<H2>Poster un commentaire : </H2>';
            			    echo '<input type="text" name="pseudo" placeholder="Veuillez renseigner votre nom..." maxlength="128" id="comment-pseudo">';
                			echo '<textarea rows="3" cols="40" maxlength="4096" id="comment-text-area" placeholder="Rédigez votre commentaire..." name="comment" ></textarea>';
                			echo '<input type="text" id="dont-fuck-with-me" class="cm-dontfuck">';
                			echo '<div class="divcenter"><input id="addComment" type="button" value="Ajouter un commentaire" onclick="javascript: addComment('. $this->idchronique.')"></div>';

            			echo '</div>';

                    echo '</div>';
                echo '</div>';
            echo '</article>';
		}
	}
?>


