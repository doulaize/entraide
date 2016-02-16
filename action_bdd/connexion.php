<?$link = @mysql_connect("localhost:8889", "root", "root") //connection a la bdd
	or die ('<meta http-equiv="refresh" content="0;url=./index.php?error=3">');//gestion de ma mauvaise connection 
mysql_select_db("entraide");//acces a la database?>
