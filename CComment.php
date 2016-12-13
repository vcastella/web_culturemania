

<?php
	class CComment extends stdClass
	{
		private $texte = null;
		private $authorname = null;
		private $datecreation = null;
		
		public function draw()
		{
            $time = strtotime($this->datecreation);
            $date = strftime('%A %d %B %Y', $time) . ' à ' . strftime('%H:%M', $time);

            echo '<div class="cm-box">';
			echo '<p>' . $this->texte.'</p>';
            echo '<H4>Ecrit par '. $this->authorname.' le '. $date .'</H4>';
            echo '</div>';

		}
	}
?>