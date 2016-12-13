<!DOCTYPE html>
<html>
<head>
    <title>PHP Objet</title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body id ="topanchor">

<?php
	class Author extends stdClass
	{
		private $pseudo = null;
		private $email  = null;

		public function __construct($pseudo='toto', $email='toto@gmail.com')
		{
			echo '<i>::__construct</i>';
			if (!$this->pseudo)
		    	$this->pseudo = $pseudo;
		   	if (!$this->email)
		    	$this->email = $email;
		}

		public function draw()
		{
			echo '<H2> Author </H2>';
			echo '<H4>'. $this->pseudo . '</H4>';
			echo '<H4>'. $this->email . '</H4>';
		}
	}


	$mysql = new MySQLi('localhost', 'root', '', 'culturemdmania');
	$mysql->set_charset("utf8");
	$request = "SELECT title as pseudo, introduction as email FROM chronique LIMIT 0,2";

	$res = $mysql->query($request);
	while ($obj = $res->fetch_object()) 
	{
		$author = new Author($obj->pseudo, $obj->email);
    	$author->draw();
	}

	echo "<BR>=======================================THE FUCKING MOTHER FUCKER PART ééé=======================================<BR><BR><BR>";
	$res = $mysql->query($request);
	while ($author = $res->fetch_object('Author')) 
	{
    	$author->draw();
	}
	$mysql->close();

?>

</body>
</html>